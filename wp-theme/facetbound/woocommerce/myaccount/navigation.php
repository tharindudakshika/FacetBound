<?php
/**
 * My Account sidebar navigation — overrides WooCommerce's default
 * template (which escapes labels via esc_html(), so icons can't be
 * added through the woocommerce_account_menu_items filter alone) to
 * add the per-row icon each tab has in the design. Structure/logic
 * otherwise matches WooCommerce's own navigation.php exactly — this
 * only adds the icon markup.
 */

if (!defined('ABSPATH')) {
    exit;
}

$facetbound_nav_icons = [
    'dashboard' => 'fa-solid fa-gauge',
    'orders' => 'fa-solid fa-box',
    'vault' => 'fa-solid fa-gem',
    'edit-address' => 'fa-solid fa-location-dot',
    'edit-account' => 'fa-regular fa-user',
    'customer-logout' => 'fa-solid fa-arrow-right-from-bracket',
];
?>
<nav class="woocommerce-MyAccount-navigation">
    <ul>
        <?php foreach (wc_get_account_menu_items() as $endpoint => $label) : ?>
            <li class="<?php echo esc_attr(wc_get_account_menu_item_classes($endpoint)); ?>">
                <a href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>">
                    <?php if (!empty($facetbound_nav_icons[$endpoint])) : ?>
                        <i class="<?php echo esc_attr($facetbound_nav_icons[$endpoint]); ?>"></i>
                    <?php endif; ?>
                    <?php echo esc_html($label); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>
<?php do_action('woocommerce_after_account_navigation'); ?>
