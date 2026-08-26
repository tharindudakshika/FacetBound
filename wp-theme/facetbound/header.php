<?php
/**
 * Mirrors src/components/Header.jsx. Pass a $facetbound_header array of
 * overrides before calling get_header() from a template if needed:
 *   $facetbound_header = ['show_ssl' => true, 'account_active' => true];
 */
if (!defined('ABSPATH')) {
    exit;
}

$show_ssl = $GLOBALS['facetbound_header']['show_ssl'] ?? (function_exists('is_checkout') && is_checkout());
$account_active = $GLOBALS['facetbound_header']['account_active'] ?? (function_exists('is_account_page') && is_account_page());
$cart_count = (class_exists('WooCommerce') && WC()->cart) ? WC()->cart->get_cart_contents_count() : 0;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="fb-header">
    <div class="container fb-header__row">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="fb-header__wordmark">Facetbound</a>
        <?php facetbound_nav_menu(); ?>
        <div class="fb-header__icons">
            <?php if ($show_ssl) : ?>
                <div class="fb-header__ssl">
                    <i class="fa-solid fa-lock"></i>
                    <span>SSL Encrypted</span>
                </div>
            <?php endif; ?>
            <i class="fa-solid fa-magnifying-glass fb-header__icon" title="Search"></i>
            <a href="<?php echo esc_url(class_exists('WooCommerce') ? wc_get_page_permalink('myaccount') : home_url('/my-account/')); ?>" title="Account">
                <i class="<?php echo $account_active ? 'fa-regular fa-user fb-header__icon fb-header__icon--active' : 'fa-regular fa-user fb-header__icon'; ?>"></i>
            </a>
            <a href="<?php echo esc_url(class_exists('WooCommerce') ? wc_get_checkout_url() : '#'); ?>" class="fb-header__cart" title="Checkout">
                <i class="fa-solid fa-bag-shopping fb-header__icon"></i>
                <?php if ($cart_count > 0) : ?>
                    <div class="fb-header__cart-badge"><?php echo (int) $cart_count; ?></div>
                <?php endif; ?>
            </a>
        </div>
    </div>
</header>
