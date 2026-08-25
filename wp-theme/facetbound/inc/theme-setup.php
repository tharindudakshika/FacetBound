<?php
/**
 * Core theme supports and image sizes.
 */

if (!defined('ABSPATH')) {
    exit;
}

function facetbound_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
    add_theme_support('wp-block-styles');
    add_theme_support('editor-styles');
    add_theme_support('responsive-embeds');

    // WooCommerce
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');

    add_image_size('facetbound-card', 600, 600, true);
    add_image_size('facetbound-hero', 1600, 900, true);
}
add_action('after_setup_theme', 'facetbound_setup');

/**
 * Fallback nav-link blocks are authored directly in parts/header.html
 * (block themes handle navigation with the block-based Navigation
 * block/wp_navigation post type, not register_nav_menus()/wp_nav_menu()).
 */
