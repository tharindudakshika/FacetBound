<?php
/**
 * Fonts, icons, and stylesheet/script enqueueing.
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Version a local asset by its file's last-modified time instead of the
 * static FACETBOUND_VERSION constant, so every deploy automatically
 * busts browser/CDN caches for any file that actually changed — no
 * more visual fixes silently not appearing because a stylesheet's
 * query-string version never changed.
 */
function facetbound_asset_version($relative_path) {
    $file = FACETBOUND_DIR . $relative_path;
    return file_exists($file) ? filemtime($file) : FACETBOUND_VERSION;
}

function facetbound_assets() {
    wp_enqueue_style(
        'facetbound-fonts',
        'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=Montserrat:wght@500;600;700&family=Lato:wght@400;500;600;700&display=swap',
        [],
        null
    );
    wp_enqueue_style(
        'facetbound-fontawesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
        [],
        '6.5.1'
    );

    wp_enqueue_style('facetbound-tokens', FACETBOUND_URI . '/assets/css/tokens.css', [], facetbound_asset_version('/assets/css/tokens.css'));
    wp_enqueue_style('facetbound-global', FACETBOUND_URI . '/assets/css/global.css', ['facetbound-tokens'], facetbound_asset_version('/assets/css/global.css'));
    wp_enqueue_style('facetbound-components', FACETBOUND_URI . '/assets/css/components.css', ['facetbound-global'], facetbound_asset_version('/assets/css/components.css'));
    wp_enqueue_style('facetbound-pages', FACETBOUND_URI . '/assets/css/pages.css', ['facetbound-components'], facetbound_asset_version('/assets/css/pages.css'));

    if (function_exists('is_woocommerce') && (is_woocommerce() || is_cart() || is_checkout() || is_account_page())) {
        wp_enqueue_style('facetbound-woocommerce', FACETBOUND_URI . '/assets/css/woocommerce.css', ['facetbound-pages'], facetbound_asset_version('/assets/css/woocommerce.css'));
    }

    wp_enqueue_script('facetbound-main', FACETBOUND_URI . '/assets/js/main.js', [], facetbound_asset_version('/assets/js/main.js'), true);

    if (function_exists('is_product') && is_product()) {
        wp_enqueue_script('facetbound-product', FACETBOUND_URI . '/assets/js/product.js', [], facetbound_asset_version('/assets/js/product.js'), true);
    }
}
add_action('wp_enqueue_scripts', 'facetbound_assets');
