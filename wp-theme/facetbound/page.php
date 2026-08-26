<?php
/**
 * Generic Page fallback — required for WooCommerce's Cart, Checkout, and
 * My Account pages to work at all: those are plain WordPress Pages whose
 * content is just a shortcode ([woocommerce_cart] / [woocommerce_checkout]
 * / [woocommerce_my_account]), rendered via the_content(). Without this
 * file the theme had no page.php, so WordPress fell through to index.php
 * (the archive/search fallback) instead — which never calls the_content()
 * at all, so the WooCommerce shortcode never ran and these pages rendered
 * as a generic single-post card instead of the real cart/checkout/account
 * UI. Pages with their own template (Our Story, Sustainability) never
 * reach this file — WordPress picks their page-*.php template first.
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

if (function_exists('is_checkout') && is_checkout()) {
    facetbound_hero([
        'min_height' => 220,
        'padding' => '48px',
        'title' => 'Secure Checkout',
        'subtitle' => "You're one step away from your handcrafted Facetbound ring.",
        'max_width' => 640,
    ]);
}

if (function_exists('is_account_page') && is_account_page() && is_user_logged_in()) {
    $current_user = wp_get_current_user();
    $first_name = $current_user->first_name ?: $current_user->display_name;
    ?>
    <section class="account-banner">
        <?php facetbound_placeholder('dark', '', ['style' => 'position:absolute;inset:0']); ?>
        <div class="account-banner-scrim"></div>
        <div class="container account-banner-content">
            <div class="account-banner-badge">
                <i class="fa-solid fa-gem"></i> Facetbound Collector Member
            </div>
            <h1 class="account-banner-title">Welcome back, <?php echo esc_html($first_name); ?></h1>
            <div class="account-banner-status">
                <i class="fa-solid fa-plane"></i> You have 1 Active Express Shipment in transit.
            </div>
        </div>
    </section>
    <?php
}

if (have_posts()) {
    while (have_posts()) {
        the_post();
        the_content();
    }
}

if (function_exists('is_checkout') && function_exists('is_account_page') && (is_checkout() || is_account_page())) {
    facetbound_concierge_cta();
}

get_footer();
