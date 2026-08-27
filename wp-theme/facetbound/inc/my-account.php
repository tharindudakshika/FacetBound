<?php
/**
 * My Account customizations: a custom "My Vault" endpoint (matching
 * MyAccount.jsx's Vault tab) and a small dashboard welcome flourish —
 * both added via safe WooCommerce filters/hooks, no template overrides.
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register the "vault" endpoint so /my-account/vault/ resolves to our
 * callback below. NOTE: after this is deployed, visiting Settings >
 * Permalinks and clicking "Save Changes" once on the live site is
 * needed to flush rewrite rules so the new endpoint URL works —
 * this is a one-time live-site action, not something to force here.
 */
add_action('init', function () {
    add_rewrite_endpoint('vault', EP_ROOT | EP_PAGES);
});

/**
 * Adjust the account nav labels/order: "My Vault" inserted after
 * "Orders" with its full design label, "Downloads" hidden (not part of
 * the design — WooCommerce only shows it for stores with downloadable
 * products, but this catalog has none), "Account details" recapitalized
 * to match the design's "Account Details". Per-row icons (also part of
 * the design) can't be added here — WooCommerce runs these labels
 * through esc_html() in its nav template, so embedded HTML shows as
 * literal text instead of rendering; see woocommerce/myaccount/navigation.php
 * for the actual icon markup.
 */
add_filter('woocommerce_account_menu_items', function ($items) {
    unset($items['downloads']);
    if (isset($items['edit-account'])) {
        $items['edit-account'] = 'Account Details';
    }

    $new = [];
    foreach ($items as $key => $label) {
        $new[$key] = $label;
        if ($key === 'orders') {
            $new['vault'] = 'My Vault / Collections';
        }
    }
    return $new;
});

/**
 * "My Vault" endpoint content — one card per piece from the customer's
 * paid orders (real product image/name + the order date as "Acquired"),
 * so it actually reflects what they've bought instead of always showing
 * the empty state. Falls back to the empty state only when they have no
 * paid orders yet. Mirrors the intro copy + "Next Milestone" panel from
 * src/pages/MyAccount.jsx's Vault tab, built with the account- prefixed
 * classes already defined in assets/css/pages.css.
 */
add_action('woocommerce_account_vault_endpoint', function () {
    $vault_items = [];
    $orders = wc_get_orders([
        'customer' => get_current_user_id(),
        'status' => wc_get_is_paid_statuses(),
        'limit' => -1,
        'orderby' => 'date',
        'order' => 'DESC',
    ]);
    foreach ($orders as $order) {
        foreach ($order->get_items() as $item) {
            $product = $item->get_product();
            $vault_items[] = [
                'name' => $item->get_name(),
                'product' => $product,
                'date' => $order->get_date_created(),
            ];
        }
    }
    ?>
    <h2 class="account-panel-title account-panel-title--tight">My Facetbound Vault</h2>
    <p class="account-panel-sub">Your Curated Gems &mdash; a digital record of every piece you&rsquo;ve acquired.</p>

    <div class="account-vault-grid">
        <?php if ($vault_items) : ?>
            <?php foreach ($vault_items as $vault_item) : ?>
                <div class="account-vault-card">
                    <?php
                    $image_id = $vault_item['product'] ? $vault_item['product']->get_image_id() : 0;
                    if ($image_id) {
                        echo wp_get_attachment_image($image_id, 'medium', false, ['style' => 'width:100%;height:200px;object-fit:cover;display:block']);
                    } else {
                        facetbound_placeholder('light', $vault_item['name'], ['style' => 'height:200px']);
                    }
                    ?>
                    <div class="account-vault-card-body">
                        <div class="account-vault-name"><?php echo esc_html($vault_item['name']); ?></div>
                        <div class="account-vault-acquired">Acquired <?php echo esc_html($vault_item['date'] ? $vault_item['date']->date_i18n('F j, Y') : ''); ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="account-vault-card">
                <?php facetbound_placeholder('light', 'your collection', ['style' => 'height:200px']); ?>
                <div class="account-vault-card-body">
                    <div class="account-vault-name">Your pieces will appear here</div>
                    <div class="account-vault-acquired">Start your collection in the Shop</div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div class="account-milestone">
        <div class="kicker">Next Milestone</div>
        <p class="account-milestone-text">
            Complete your collection with a handcrafted Natural Spinel or Amethyst Accent Band.
        </p>
        <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="account-btn account-btn-terracotta">
            Explore Accent Bands
        </a>
    </div>
    <?php
});

/**
 * The "Collector Member" badge + active shipment status now render once,
 * page-wide, in the account-banner hero built in page.php (matches the
 * design: the banner appears above the Dashboard/Orders/Vault/etc. tabs,
 * not just inside the Dashboard panel) — no per-tab hook needed here.
 */
