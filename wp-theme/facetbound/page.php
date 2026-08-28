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

$is_cart_page = function_exists('is_cart') && is_cart();
$is_checkout_page = function_exists('is_checkout') && is_checkout();

if ($is_cart_page) {
    facetbound_hero([
        'min_height' => 220,
        'padding' => '48px',
        'title' => 'Your Cart',
        'subtitle' => 'Review your handcrafted pieces before checkout.',
        'max_width' => 640,
    ]);
}

if ($is_checkout_page) {
    facetbound_hero([
        'min_height' => 220,
        'padding' => '48px',
        'kicker' => '256-Bit Encrypted Secure Checkout',
        'title' => 'Complete Your Milestone Order',
        'subtitle' => 'You’re one step away from owning an authentic piece of Sri Lankan earth, handcrafted in solid 925 sterling silver to celebrate your special moment.',
        'max_width' => 640,
    ]);
}

// Cart and Checkout are otherwise unwrapped shortcode output (no
// container like every other page has) — My Account gets its own
// container via woocommerce/myaccount/my-account.php, so it's excluded
// here to avoid double-wrapping/double horizontal padding.
if ($is_cart_page || $is_checkout_page) {
    echo '<div class="container wc-content-wrap">';
}

if (function_exists('is_account_page') && is_account_page() && is_user_logged_in()) {
    $current_user = wp_get_current_user();
    $first_name = $current_user->first_name ?: $current_user->display_name;
    ?>
    <section class="account-banner">
        <?php facetbound_placeholder('dark', '', ['style' => 'position:absolute;inset:0']); ?>
        <div class="account-banner-scrim"></div>
        <div class="container">
            <div class="account-banner-content">
                <div class="account-banner-badge">
                    <i class="fa-solid fa-gem"></i> Facetbound Collector Member
                </div>
                <h1 class="account-banner-title">Welcome back, <?php echo esc_html($first_name); ?></h1>
                <div class="account-banner-status">
                    <i class="fa-solid fa-plane"></i> You have 1 Active Express Shipment in transit.
                </div>
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

if ($is_cart_page || $is_checkout_page) {
    echo '</div>';
}

if ($is_checkout_page || (function_exists('is_account_page') && is_account_page())) {
    facetbound_concierge_cta();
}

get_footer();
