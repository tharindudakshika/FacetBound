<?php
/**
 * Core theme supports, nav menus, image sizes.
 */

if (!defined('ABSPATH')) {
    exit;
}

function facetbound_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
    add_theme_support('customize-selective-refresh-widgets');

    // WooCommerce
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');

    register_nav_menus([
        'primary' => __('Primary Navigation', 'facetbound'),
        'footer-policies' => __('Footer Policies', 'facetbound'),
    ]);

    add_image_size('facetbound-card', 600, 600, true);
    add_image_size('facetbound-hero', 1600, 900, true);
}
add_action('after_setup_theme', 'facetbound_setup');

/**
 * Default nav links used whenever no "Primary Navigation" menu has been
 * assigned yet in Appearance > Menus (matches the design spec exactly).
 */
function facetbound_nav_fallback() {
    $links = [
        ['label' => 'Shop', 'url' => function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop/')],
        ['label' => 'Our Story', 'url' => home_url('/our-story/')],
        ['label' => 'Sustainability', 'url' => home_url('/sustainability/')],
        ['label' => 'Journal', 'url' => home_url('/journal/')],
        ['label' => 'Contact Us', 'url' => home_url('/contact/')],
    ];
    echo '<nav class="fb-header__nav">';
    foreach ($links as $link) {
        printf('<a class="fb-header__link" href="%s">%s</a>', esc_url($link['url']), esc_html($link['label']));
    }
    echo '</nav>';
}

add_filter('nav_menu_link_attributes', function ($atts) {
    $atts['class'] = trim(($atts['class'] ?? '') . ' fb-header__link');
    return $atts;
}, 10, 1);

function facetbound_nav_menu() {
    if (has_nav_menu('primary')) {
        wp_nav_menu([
            'theme_location' => 'primary',
            'container' => 'nav',
            'container_class' => 'fb-header__nav',
            'menu_class' => 'fb-header__nav-list',
            'items_wrap' => '%3$s',
            'depth' => 1,
        ]);
    } else {
        facetbound_nav_fallback();
    }
}

/**
 * The header search (magnifying-glass icon) is scoped to Journal posts
 * only — not products or pages — so restrict the underlying WP search
 * query to post_type=post regardless of what the search form submits.
 */
add_action('pre_get_posts', function ($query) {
    if (!is_admin() && $query->is_main_query() && $query->is_search()) {
        $query->set('post_type', 'post');
    }
});
