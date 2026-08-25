<?php
/**
 * WooCommerce integration: the free-engraving field and breadcrumb
 * styling. Shop/Product/Cart/Checkout deliberately have NO template
 * overrides in this theme (see readme.md) — WooCommerce supplies its
 * own block templates automatically for a block theme, and
 * assets/css/woocommerce-blocks.css skins them instead.
 */

if (!defined('ABSPATH')) {
    exit;
}

// Breadcrumbs styling hook (used on the Product Detail page).
add_filter('woocommerce_breadcrumb_defaults', function ($defaults) {
    $defaults['wrap_before'] = '<nav class="pdp-breadcrumb">';
    $defaults['wrap_after'] = '</nav>';
    $defaults['delimiter'] = ' / ';
    return $defaults;
});

/**
 * Free inside-band engraving field (max 12 chars), shown above Add to Cart
 * on the single product page — see design spec's Product Detail buy box.
 */
add_action('woocommerce_before_add_to_cart_button', function () {
    global $product;
    if (!$product || !$product->is_type(['simple', 'variable'])) {
        return;
    }
    ?>
    <div class="pdp-engraving">
        <div class="pdp-engraving__label">Add Free Inside Band Engraving (Max 12 chars)</div>
        <input
            type="text"
            name="fb_engraving"
            id="fb_engraving"
            maxlength="12"
            placeholder="Enter text here..."
            class="pdp-engraving__input"
        />
    </div>
    <?php
});

add_filter('woocommerce_add_cart_item_data', function ($cart_item_data, $product_id) {
    if (!empty($_POST['fb_engraving'])) {
        $engraving = sanitize_text_field(wp_unslash($_POST['fb_engraving']));
        $cart_item_data['fb_engraving'] = substr($engraving, 0, 12);
        // Ensures visually-identical products with different engraving text
        // are kept as separate cart line items instead of merging quantities.
        $cart_item_data['unique_key'] = md5(microtime() . wp_rand());
    }
    return $cart_item_data;
}, 10, 2);

add_filter('woocommerce_get_item_data', function ($item_data, $cart_item) {
    if (!empty($cart_item['fb_engraving'])) {
        $item_data[] = [
            'key' => 'Engraving',
            'value' => sanitize_text_field($cart_item['fb_engraving']),
        ];
    }
    return $item_data;
}, 10, 2);

add_action('woocommerce_checkout_create_order_line_item', function ($item, $cart_item_key, $values) {
    if (!empty($values['fb_engraving'])) {
        $item->add_meta_data('Engraving', $values['fb_engraving'], true);
    }
}, 10, 3);

/**
 * Cart & Checkout use WooCommerce's own auto-generated block templates
 * (Cart/Checkout blocks) — no page-id/shortcode forcing needed. The
 * express-payment banner that used to render above the classic
 * checkout form now lives as the "Checkout Express Payment Banner"
 * pattern (patterns/checkout-express-banner.php); add it above the
 * Checkout block from the Site Editor if you want it, since the
 * classic woocommerce_before_checkout_form hook doesn't fire for the
 * block-based Checkout.
 */
