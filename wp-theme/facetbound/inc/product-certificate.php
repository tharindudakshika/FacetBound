<?php
/**
 * "Gem Certificate" metabox on the product edit screen — lets admins
 * attach a digital certificate of authenticity PDF per product (from the
 * Media Library), stored as post meta so it can be surfaced to customers
 * later (e.g. My Account's "Digital Authenticity Certificates" card).
 * Registered as its own postbox (context "normal", priority "default")
 * rather than a field inside Product Data, so it renders as a separate
 * box right below it — Product Data itself uses priority "high" in the
 * same "normal" context.
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

add_action('add_meta_boxes', function () {
    add_meta_box(
        'facetbound_gem_certificate',
        'Gem Certificate',
        'facetbound_render_gem_certificate_metabox',
        'product',
        'normal',
        'default'
    );
});

function facetbound_render_gem_certificate_metabox($post) {
    $attachment_id = (int) get_post_meta($post->ID, '_gem_certificate_id', true);
    $filename = $attachment_id ? basename(get_attached_file($attachment_id)) : '';
    $url = $attachment_id ? wp_get_attachment_url($attachment_id) : '';
    ?>
    <p>
        <label for="gem_certificate_upload_btn"><strong>Gem Certificate (PDF)</strong></label>
    </p>
    <p>
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
}

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

/**
 * Per-variation Gem Certificate — each ring size can hold a physically
 * different gemstone, so variable products need their own certificate
 * PDF per variation rather than one shared per product. Falls back to
 * the parent product's certificate (above) if a variation has none.
 */
add_action('woocommerce_product_after_variable_attributes', 'facetbound_render_variation_gem_certificate_field', 10, 3);
function facetbound_render_variation_gem_certificate_field($loop, $variation_data, $variation) {
    $attachment_id = (int) get_post_meta($variation->ID, '_gem_certificate_id', true);
    $filename = $attachment_id ? basename(get_attached_file($attachment_id)) : '';
    $url = $attachment_id ? wp_get_attachment_url($attachment_id) : '';
    ?>
    <div class="form-row form-row-full facetbound-variation-gem-certificate">
        <label><strong>Gem Certificate (PDF)</strong></label><br />
        <input
            type="hidden"
            class="facetbound-gem-certificate-id"
            name="facetbound_gem_certificate_id[<?php echo esc_attr($loop); ?>]"
            value="<?php echo esc_attr($attachment_id); ?>"
        />
        <button type="button" class="button facetbound-gem-certificate-upload-btn"><?php echo $attachment_id ? 'Replace PDF' : 'Upload PDF'; ?></button>
        <button type="button" class="button facetbound-gem-certificate-remove-btn" <?php echo $attachment_id ? '' : 'style="display:none;"'; ?>>Remove</button>
        <span class="facetbound-gem-certificate-filename" style="margin-left:8px;">
            <?php if ($attachment_id) : ?>
                <a href="<?php echo esc_url($url); ?>" target="_blank"><?php echo esc_html($filename); ?></a>
            <?php endif; ?>
        </span>
    </div>
    <?php
}

add_action('woocommerce_save_product_variation', 'facetbound_save_variation_gem_certificate', 10, 2);
function facetbound_save_variation_gem_certificate($variation_id, $loop) {
    if (!isset($_POST['facetbound_gem_certificate_id'][$loop])) {
        return;
    }
    $attachment_id = absint($_POST['facetbound_gem_certificate_id'][$loop]);
    if ($attachment_id) {
        update_post_meta($variation_id, '_gem_certificate_id', $attachment_id);
    } else {
        delete_post_meta($variation_id, '_gem_certificate_id');
    }
}

/**
 * Media-picker JS for the per-variation fields. Variation rows are loaded
 * and re-rendered via WooCommerce's own AJAX, so handlers are delegated
 * from a static ancestor rather than bound directly to each button.
 */
add_action('admin_footer-post.php', 'facetbound_variation_gem_certificate_script');
add_action('admin_footer-post-new.php', 'facetbound_variation_gem_certificate_script');
function facetbound_variation_gem_certificate_script() {
    global $post;
    if (!$post || $post->post_type !== 'product') {
        return;
    }
    ?>
    <script>
    jQuery(function ($) {
        $(document).on('click', '.facetbound-gem-certificate-upload-btn', function (e) {
            e.preventDefault();
            var $button = $(this);
            var $wrap = $button.closest('.facetbound-variation-gem-certificate');
            var $input = $wrap.find('.facetbound-gem-certificate-id');
            var $filename = $wrap.find('.facetbound-gem-certificate-filename');
            var $removeBtn = $wrap.find('.facetbound-gem-certificate-remove-btn');

            var mediaFrame = wp.media({
                title: 'Select Gem Certificate PDF',
                library: { type: 'application/pdf' },
                button: { text: 'Use this PDF' },
                multiple: false
            });
            mediaFrame.on('select', function () {
                var attachment = mediaFrame.state().get('selection').first().toJSON();
                // WooCommerce's variations panel only enables its "Save
                // changes" button when it sees a change/input event fire on
                // a field inside .woocommerce_variations — setting .val()
                // alone doesn't trigger that, so the value would otherwise
                // never actually get saved. Firing 'change' here is what
                // makes the Save button (and the real save) work.
                $input.val(attachment.id).trigger('change');
                $filename.html('<a href="' + attachment.url + '" target="_blank">' + attachment.filename + '</a>');
                $button.text('Replace PDF');
                $removeBtn.show();
            });
            mediaFrame.open();
        });

        $(document).on('click', '.facetbound-gem-certificate-remove-btn', function (e) {
            e.preventDefault();
            var $wrap = $(this).closest('.facetbound-variation-gem-certificate');
            $wrap.find('.facetbound-gem-certificate-id').val('').trigger('change');
            $wrap.find('.facetbound-gem-certificate-filename').html('');
            $wrap.find('.facetbound-gem-certificate-upload-btn').text('Upload PDF');
            $(this).hide();
        });
    });
    </script>
    <?php
}

/**
 * Gem Certificate URL for a specific variation, falling back to the
 * parent product's certificate when the variation has none of its own.
 */
function facetbound_get_variation_gem_certificate_url($variation_id, $product_id = 0) {
    $attachment_id = (int) get_post_meta($variation_id, '_gem_certificate_id', true);
    if (!$attachment_id && $product_id) {
        $attachment_id = (int) get_post_meta($product_id, '_gem_certificate_id', true);
    }
    return $attachment_id ? wp_get_attachment_url($attachment_id) : '';
}

