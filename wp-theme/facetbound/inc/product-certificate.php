<?php
/**
 * "Gem Certificate (PDF)" field on the Product Data > General tab —
 * lets admins attach a digital certificate of authenticity PDF per
 * product (from the Media Library), stored as post meta so it can be
 * surfaced to customers later (e.g. My Account's "Digital Authenticity
 * Certificates" card).
 */

if (!defined('ABSPATH')) {
    exit;
}

add_action('admin_enqueue_scripts', function ($hook) {
    global $post;
    if (!in_array($hook, ['post.php', 'post-new.php'], true) || !$post || $post->post_type !== 'product') {
        return;
    }
    wp_enqueue_media();
});

add_action('woocommerce_product_options_general_product_data', function () {
    global $post;
    $attachment_id = (int) get_post_meta($post->ID, '_gem_certificate_id', true);
    $filename = $attachment_id ? basename(get_attached_file($attachment_id)) : '';
    $url = $attachment_id ? wp_get_attachment_url($attachment_id) : '';
    ?>
    <p class="form-field gem_certificate_field">
        <label for="gem_certificate_upload_btn">Gem Certificate (PDF)</label>
        <input type="hidden" id="gem_certificate_id" name="gem_certificate_id" value="<?php echo esc_attr($attachment_id); ?>" />
        <button type="button" class="button" id="gem_certificate_upload_btn"><?php echo $attachment_id ? 'Replace PDF' : 'Upload PDF'; ?></button>
        <button type="button" class="button" id="gem_certificate_remove_btn" <?php echo $attachment_id ? '' : 'style="display:none;"'; ?>>Remove</button>
        <span id="gem_certificate_filename" style="margin-left:8px;">
            <?php if ($attachment_id) : ?>
                <a href="<?php echo esc_url($url); ?>" target="_blank"><?php echo esc_html($filename); ?></a>
            <?php endif; ?>
        </span>
    </p>
    <script>
    jQuery(function ($) {
        var frame;
        $('#gem_certificate_upload_btn').on('click', function (e) {
            e.preventDefault();
            if (frame) {
                frame.open();
                return;
            }
            frame = wp.media({
                title: 'Select Gem Certificate PDF',
                library: { type: 'application/pdf' },
                button: { text: 'Use this PDF' },
                multiple: false
            });
            frame.on('select', function () {
                var attachment = frame.state().get('selection').first().toJSON();
                $('#gem_certificate_id').val(attachment.id);
                $('#gem_certificate_filename').html('<a href="' + attachment.url + '" target="_blank">' + attachment.filename + '</a>');
                $('#gem_certificate_upload_btn').text('Replace PDF');
                $('#gem_certificate_remove_btn').show();
            });
            frame.open();
        });
        $('#gem_certificate_remove_btn').on('click', function (e) {
            e.preventDefault();
            $('#gem_certificate_id').val('');
            $('#gem_certificate_filename').html('');
            $('#gem_certificate_upload_btn').text('Upload PDF');
            $(this).hide();
        });
    });
    </script>
    <?php
});

add_action('woocommerce_process_product_meta', function ($post_id) {
    if (!isset($_POST['gem_certificate_id'])) {
        return;
    }
    $attachment_id = absint($_POST['gem_certificate_id']);
    if ($attachment_id) {
        update_post_meta($post_id, '_gem_certificate_id', $attachment_id);
    } else {
        delete_post_meta($post_id, '_gem_certificate_id');
    }
});

/**
 * Fetch the Gem Certificate PDF URL for a product, if one is attached.
 */
function facetbound_get_gem_certificate_url($product_id) {
    $attachment_id = (int) get_post_meta($product_id, '_gem_certificate_id', true);
    return $attachment_id ? wp_get_attachment_url($attachment_id) : '';
}
