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
 * Insert "My Vault" into the account nav right after "Orders".
 */
add_filter('woocommerce_account_menu_items', function ($items) {
    $new = [];
    foreach ($items as $key => $label) {
        $new[$key] = $label;
        if ($key === 'orders') {
            $new['vault'] = 'My Vault';
        }
    }
    return $new;
});

/**
 * "My Vault" endpoint content — static/informational for now, since
 * there's no real vault data model yet (no mapping from past orders to
 * vault items). Mirrors the intro copy + "Next Milestone" panel from
 * src/pages/MyAccount.jsx's Vault tab, built with the account- prefixed
 * classes already defined in assets/css/pages.css.
 */
add_action('woocommerce_account_vault_endpoint', function () {
    ?>
    <h2 class="account-panel-title account-panel-title--tight">My Facetbound Vault</h2>
    <p class="account-panel-sub">Your Curated Gems &mdash; a digital record of every piece you&rsquo;ve acquired.</p>

    <div class="account-vault-grid">
        <div class="account-vault-card">
            <?php facetbound_placeholder('light', 'your collection', ['style' => 'height:200px']); ?>
            <div class="account-vault-card-body">
                <div class="account-vault-name">Your pieces will appear here</div>
                <div class="account-vault-acquired">Start your collection in the Shop</div>
            </div>
        </div>
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
 * Dashboard welcome flourish: a small "Collector Member" badge + active
 * shipment status line, hooked BEFORE WooCommerce's own "Hello, {name}"
 * dashboard text (which stays intact below it, untouched).
 */
add_action('woocommerce_account_dashboard', function () {
    ?>
    <div class="account-banner-badge" style="position: static; margin-bottom: 18px;">
        <i class="fa-solid fa-gem" style="font-size: 11px;"></i>
        Facetbound Collector Member
    </div>
    <div class="account-banner-status" style="color: var(--slate-text); margin-bottom: 24px;">
        <i class="fa-solid fa-plane" style="color: var(--terracotta); font-size: 13px;"></i>
        You have 1 Active Express Shipment in transit.
    </div>
    <?php
}, 5);
