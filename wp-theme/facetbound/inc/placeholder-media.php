<?php
/**
 * Generates real Media Library placeholder images (via GD) so every
 * "photo" slot in the block-editable pages is a genuine core/image
 * block the user can click "Replace" on — not just a styled CSS div.
 * Falls back to facetbound_placeholder() (the CSS striped div) only
 * if GD isn't available on the host.
 */

if (!defined('ABSPATH')) {
    exit;
}

function facetbound_placeholder_palette($variant) {
    switch ($variant) {
        case 'dark':
            return ['bg' => [15, 46, 35], 'stripe' => [26, 74, 58], 'text' => [226, 232, 240]];
        case 'darker':
            return ['bg' => [5, 26, 20], 'stripe' => [15, 46, 35], 'text' => [226, 232, 240]];
        case 'terra-dark':
            return ['bg' => [15, 46, 35], 'stripe' => [26, 74, 58], 'text' => [217, 182, 168]];
        case 'warm':
            return ['bg' => [239, 230, 220], 'stripe' => [217, 201, 188], 'text' => [138, 122, 108]];
        case 'light':
        default:
            return ['bg' => [253, 251, 247], 'stripe' => [231, 234, 238], 'text' => [169, 180, 194]];
    }
}

/**
 * Draws a diagonal-striped placeholder JPEG with a wrapped caption,
 * uploads it to the Media Library, and returns the attachment ID.
 * Idempotent per $slug via post meta lookup — safe to call repeatedly.
 */
function facetbound_get_or_create_placeholder($slug, $caption, $width = 1200, $height = 800, $variant = 'light') {
    $existing = get_posts([
        'post_type' => 'attachment',
        'posts_per_page' => 1,
        'meta_key' => '_facetbound_placeholder_slug',
        'meta_value' => $slug,
        'fields' => 'ids',
    ]);
    if (!empty($existing)) {
        return (int) $existing[0];
    }

    if (!function_exists('imagecreatetruecolor')) {
        return 0; // No GD on this host — caller should fall back to facetbound_placeholder().
    }

    $palette = facetbound_placeholder_palette($variant);
    $img = imagecreatetruecolor($width, $height);
    $bg = imagecolorallocate($img, $palette['bg'][0], $palette['bg'][1], $palette['bg'][2]);
    $stripe = imagecolorallocate($img, $palette['stripe'][0], $palette['stripe'][1], $palette['stripe'][2]);
    $text_color = imagecolorallocate($img, $palette['text'][0], $palette['text'][1], $palette['text'][2]);
    imagefilledrectangle($img, 0, 0, $width, $height, $bg);

    // Diagonal stripes, ~28px period, matching the CSS repeating-linear-gradient look.
    $period = 28;
    $diag = $width + $height;
    for ($x = -$height; $x < $diag; $x += $period) {
        $points = [$x, 0, $x + $period / 2, 0, $x + $period / 2 + $height, $height, $x + $height, $height];
        imagefilledpolygon($img, $points, 4, $stripe);
    }

    // Wrap and center the caption text using a built-in GD font (no font file dependency).
    $font = 5; // largest built-in font
    $char_w = imagefontwidth($font);
    $char_h = imagefontheight($font);
    $max_chars_per_line = max(10, floor(($width * 0.7) / $char_w));
    $words = explode(' ', $caption);
    $lines = [];
    $line = '';
    foreach ($words as $word) {
        $test = trim($line . ' ' . $word);
        if (strlen($test) > $max_chars_per_line && $line !== '') {
            $lines[] = $line;
            $line = $word;
        } else {
            $line = $test;
        }
    }
    if ($line !== '') {
        $lines[] = $line;
    }

    $total_text_h = count($lines) * ($char_h + 6);
    $y = ($height - $total_text_h) / 2;
    foreach ($lines as $l) {
        $x = ($width - strlen($l) * $char_w) / 2;
        // Faux "boxed" backdrop behind the text for legibility over the stripes.
        imagefilledrectangle($img, $x - 12, $y - 4, $x + strlen($l) * $char_w + 12, $y + $char_h + 4, imagecolorallocatealpha($img, 0, 0, 0, 90));
        imagestring($img, $font, (int) $x, (int) $y, $l, $text_color);
        $y += $char_h + 6;
    }

    $upload_dir = wp_upload_dir();
    $filename = 'facetbound-placeholder-' . sanitize_title($slug) . '.jpg';
    $filepath = trailingslashit($upload_dir['path']) . $filename;
    imagejpeg($img, $filepath, 82);
    imagedestroy($img);

    $filetype = wp_check_filetype($filename, null);
    $attachment = [
        'post_mime_type' => $filetype['type'],
        'post_title' => $caption,
        'post_content' => '',
        'post_status' => 'inherit',
    ];
    $attach_id = wp_insert_attachment($attachment, $filepath);
    if (is_wp_error($attach_id) || !$attach_id) {
        return 0;
    }
    require_once ABSPATH . 'wp-admin/includes/image.php';
    $attach_data = wp_generate_attachment_metadata($attach_id, $filepath);
    wp_update_attachment_metadata($attach_id, $attach_data);
    update_post_meta($attach_id, '_facetbound_placeholder_slug', $slug);
    update_post_meta($attach_id, '_wp_attachment_image_alt', $caption);

    return $attach_id;
}

/**
 * Echoes a core/image block referencing a generated placeholder, or
 * falls back to the CSS striped div (facetbound_placeholder()) if GD
 * is unavailable — used only while BUILDING block-content strings in
 * inc/block-content.php, not at normal page-render time.
 */
function facetbound_placeholder_image_block($slug, $caption, $args = []) {
    $width = $args['width'] ?? 1200;
    $height = $args['height'] ?? 800;
    $variant = $args['variant'] ?? 'light';
    $class = $args['class'] ?? '';

    $attach_id = facetbound_get_or_create_placeholder($slug, $caption, $width, $height, $variant);
    if (!$attach_id) {
        return sprintf(
            '<!-- wp:html --><div class="ph ph-%s%s">%s</div><!-- /wp:html -->',
            esc_attr($variant),
            $class ? ' ' . esc_attr($class) : '',
            $caption ? '<div class="ph-caption">[ ' . esc_html($caption) . ' ]</div>' : ''
        );
    }

    $url = wp_get_attachment_image_url($attach_id, 'full');
    return sprintf(
        '<!-- wp:image {"id":%1$d,"sizeSlug":"full","linkDestination":"none"%2$s} --><figure class="wp-block-image size-full%3$s"><img src="%4$s" alt="%5$s" class="wp-image-%1$d"/></figure><!-- /wp:image -->',
        $attach_id,
        $class ? ',"className":"' . esc_attr($class) . '"' : '',
        $class ? ' ' . esc_attr($class) : '',
        esc_url($url),
        esc_attr($caption)
    );
}
