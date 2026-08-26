<?php
/**
 * My Account page wrapper — WooCommerce's default template (navigation.php
 * + content) renders with no container/grid wrapper at all, so it spanned
 * the full browser width instead of the site's normal centered 1280px
 * container. This wraps it in the .account-main / .account-main-grid
 * classes that already existed unused in pages.css (the sidebar+content
 * two-column layout), matching every other page's .container use.
 * Structure/logic otherwise matches WooCommerce's own my-account.php.
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<div class="container account-main">
    <div class="account-main-grid">
        <?php do_action('woocommerce_account_navigation'); ?>
        <div class="woocommerce-MyAccount-content">
            <?php do_action('woocommerce_account_content'); ?>
        </div>
    </div>
</div>
