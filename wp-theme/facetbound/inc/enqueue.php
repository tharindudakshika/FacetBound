<?php
/**
 * Fonts, icons, and stylesheet/script enqueueing.
 */

if (!defined('ABSPATH')) {
    exit;
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

    wp_enqueue_style('facetbound-tokens', FACETBOUND_URI . '/assets/css/tokens.css', [], FACETBOUND_VERSION);
    wp_enqueue_style('facetbound-global', FACETBOUND_URI . '/assets/css/global.css', ['facetbound-tokens'], FACETBOUND_VERSION);
    wp_enqueue_style('facetbound-components', FACETBOUND_URI . '/assets/css/components.css', ['facetbound-global'], FACETBOUND_VERSION);
    wp_enqueue_style('facetbound-pages', FACETBOUND_URI . '/assets/css/pages.css', ['facetbound-components'], FACETBOUND_VERSION);

    // Loaded after wp-block-library and pages.css so its !important rules
    // reliably win over core's default Group-block layout classes, which
    // otherwise silently collapse the hand-authored grid/flex sections
    // (Home, Our Story, Sustainability) into a single stacked column.
    wp_enqueue_style('facetbound-block-overrides', FACETBOUND_URI . '/assets/css/block-overrides.css', ['facetbound-pages', 'wp-block-library'], FACETBOUND_VERSION);

    if (function_exists('is_woocommerce') && (is_woocommerce() || is_cart() || is_checkout() || is_account_page())) {
        wp_enqueue_style('facetbound-woocommerce', FACETBOUND_URI . '/assets/css/woocommerce.css', ['facetbound-pages'], FACETBOUND_VERSION);
        wp_enqueue_style('facetbound-woocommerce-blocks', FACETBOUND_URI . '/assets/css/woocommerce-blocks.css', ['facetbound-woocommerce'], FACETBOUND_VERSION);
    }

    wp_enqueue_script('facetbound-main', FACETBOUND_URI . '/assets/js/main.js', [], FACETBOUND_VERSION, true);

    if (function_exists('is_product') && is_product()) {
        wp_enqueue_script('facetbound-product', FACETBOUND_URI . '/assets/js/product.js', [], FACETBOUND_VERSION, true);
    }
}
add_action('wp_enqueue_scripts', 'facetbound_assets');
