<?php
/**
 * My Account "Dashboard" tab override — replaces WooCommerce's generic
 * "Hello X... From your dashboard you can..." text with the three
 * custom cards from the design (Latest Order Status, Digital
 * Authenticity Certificates, Scent Refill Claim). Card 1 reflects the
 * customer's REAL latest order (with a graceful empty state) rather
 * than the design mockup's fixed "#FB-8042" placeholder — there's no
 * real backend yet for the certificate/scent-refill features those
 * other two cards describe, so they stay informational with a sensible
 * link destination until that infrastructure exists.
 */

if (!defined('ABSPATH')) {
    exit;
}

$latest_order = null;
$orders = wc_get_orders([
    'customer' => get_current_user_id(),
    'limit' => 1,
    'orderby' => 'date',
    'order' => 'DESC',
]);
if (!empty($orders)) {
    $latest_order = $orders[0];
}
?>

<h2 class="account-panel-title">Dashboard</h2>

<div class="account-dash-grid">

    <div class="account-card">
        <i class="fa-solid fa-box account-card-icon"></i>
        <div class="account-card-title">Latest Order Status</div>
        <?php if ($latest_order) : ?>
            <p class="account-card-body">
                Order #<?php echo esc_html($latest_order->get_order_number()); ?> &middot;
                <?php echo esc_html(wc_get_order_status_name($latest_order->get_status())); ?>
            </p>
            <a href="<?php echo esc_url($latest_order->get_view_order_url()); ?>" class="account-btn account-btn-emerald">
                Track Shipment
            </a>
        <?php else : ?>
            <p class="account-card-body">You haven&rsquo;t placed an order yet &mdash; your first Facetbound piece is waiting.</p>
            <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="account-btn account-btn-emerald">
                Browse the Shop
            </a>
        <?php endif; ?>
    </div>

    <div class="account-card">
        <i class="fa-solid fa-scroll account-card-icon"></i>
        <div class="account-card-title">Digital Authenticity Certificates</div>
        <p class="account-card-body">View &amp; download PDF certificates for your gemstones.</p>
        <a href="<?php echo esc_url(wc_get_endpoint_url('orders')); ?>" class="account-btn account-btn-outline-emerald">
            View Certificates
        </a>
    </div>

    <div class="account-card account-card--highlight">
        <i class="fa-solid fa-seedling account-card-icon"></i>
        <div class="account-card-title">Scent Refill Claim</div>
        <p class="account-card-body">Eligible for a complimentary Mitti Attar refill on your next drop.</p>
        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="account-btn account-btn-terracotta">
            Claim Refill
        </a>
    </div>

</div>

<?php do_action('woocommerce_account_dashboard'); ?>
