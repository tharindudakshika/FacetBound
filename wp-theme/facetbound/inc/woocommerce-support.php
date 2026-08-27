<?php
/**
 * WooCommerce integration: layout hooks, direct-checkout behavior, and
 * keeping Cart/Checkout on the classic shortcode-based flow so this
 * theme's own markup/CSS controls them instead of WC Blocks.
 */

if (!defined('ABSPATH')) {
    exit;
}

// This theme supplies its own wrapper markup in woocommerce/archive-product.php
// and woocommerce/single-product.php, so drop WooCommerce's default one.
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

// archive-product.php already renders the ordering <select> once, itself,
// inside the .shopcol-sort toolbar — without this, WooCommerce's own
// woocommerce_before_shop_loop hook renders a second one right above the
// product grid.
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

// Drop the default "Showing all N results" line above the Shop grid —
// not part of the design.
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);

// Default WooCommerce shows 3 sale/result-count/ordering rows we style ourselves
// via woocommerce/archive-product.php's own toolbar; keep result count + ordering,
// drop the default sale badge markup (we render our own "Ethically Sourced" /
// "Natural Stone" badge from a product tag instead).
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);

// Every ring is a one-per-purchase item: this hides WooCommerce's quantity
// selector everywhere (product page, cart, checkout review) and forces
// exactly 1 into the cart, same as WooCommerce's per-product "Sold
// individually" checkbox — just applied to every product at once.
add_filter('woocommerce_is_sold_individually', '__return_true');

// My Account renders the logged-out Login/Register form via WooCommerce's
// own template (myaccount/form-login.php) directly — it never reaches our
// woocommerce/myaccount/my-account.php override — so it was spanning the
// full browser width instead of the site's container. These hooks (fired
// by that WC template itself) wrap it in the same .container.account-main
// treatment the logged-in dashboard already uses.
add_action('woocommerce_before_customer_login_form', function () {
    echo '<div class="container account-main">';
});
add_action('woocommerce_after_customer_login_form', function () {
    echo '</div>';
});

// Breadcrumbs styling hook (used on the Product Detail page).
add_filter('woocommerce_breadcrumb_defaults', function ($defaults) {
    $defaults['wrap_before'] = '<nav class="pdp-breadcrumb">';
    $defaults['wrap_after'] = '</nav>';
    $defaults['delimiter'] = ' / ';
    return $defaults;
});

/**
 * Direct checkout: skip the Cart page entirely. Adding a product to the
 * cart sends the shopper straight to Checkout (where the order review
 * table still lets them adjust quantity/remove the item), and every
 * "Add to Cart" button/label site-wide reads "Buy Now" instead.
 */
add_filter('woocommerce_add_to_cart_redirect', function () {
    return wc_get_checkout_url();
});

add_filter('woocommerce_product_add_to_cart_text', function () {
    return 'Buy Now';
});
add_filter('woocommerce_product_single_add_to_cart_text', function () {
    return 'Buy Now';
});

/**
 * "Buy Now" is a single-product direct purchase, not a running cart — so
 * clear out whatever was left in the cart from a previous visit before
 * WooCommerce processes the new add-to-cart request. Runs at priority 15,
 * ahead of WC_Form_Handler::add_to_cart() (registered at 20 on the same
 * hook), so the cart is empty by the time the requested item is added.
 */
add_action('wp_loaded', function () {
    if (isset($_REQUEST['add-to-cart']) && is_numeric($_REQUEST['add-to-cart']) && WC()->cart) {
        WC()->cart->empty_cart();
    }
}, 15);

/**
 * The redirect above lands the shopper on Checkout carrying WooCommerce's
 * default "X has been added to your cart. [Continue shopping]" notice
 * (queued in session at add-to-cart time, meant for the Cart page it used
 * to redirect to). That "Continue shopping" prompt doesn't belong on a
 * direct-checkout flow, so drop just that notice before it's printed.
 */
add_action('template_redirect', function () {
    if (!function_exists('is_checkout') || !is_checkout() || !WC()->session) {
        return;
    }
    $notices = WC()->session->get('wc_notices', []);
    if (empty($notices['success'])) {
        return;
    }
    foreach ($notices['success'] as $key => $notice) {
        $message = is_array($notice) ? ($notice['notice'] ?? '') : $notice;
        if (strpos($message, 'Continue shopping') !== false) {
            unset($notices['success'][$key]);
        }
    }
    $notices['success'] = array_values($notices['success']);
    WC()->session->set('wc_notices', $notices);
}, 5);

/**
 * Keep Cart & Checkout on the classic shortcode templates (this theme
 * overrides woocommerce/cart/*.php and woocommerce/checkout/*.php to
 * match the design exactly — Cart/Checkout blocks bypass those files).
 */
add_filter('option_woocommerce_cart_page_id', function ($page_id) {
    return facetbound_ensure_shortcode_page($page_id, 'cart', '[woocommerce_cart]');
});
add_filter('option_woocommerce_checkout_page_id', function ($page_id) {
    return facetbound_ensure_shortcode_page($page_id, 'checkout', '[woocommerce_checkout]');
});

function facetbound_ensure_shortcode_page($page_id, $key, $shortcode) {
    if (!$page_id) {
        return $page_id;
    }
    $post = get_post($page_id);
    if ($post && !has_block('woocommerce/' . $key, $post) && strpos($post->post_content, $shortcode) !== false) {
        return $page_id; // already classic, nothing to do
    }
    if ($post && (has_block('woocommerce/' . $key, $post) || strpos($post->post_content, $shortcode) === false)) {
        wp_update_post([
            'ID' => $page_id,
            'post_content' => $shortcode,
        ]);
    }
    return $page_id;
}

/**
 * Express-payment row + "OR CONTINUE WITH STANDARD CHECKOUT" divider
 * above the classic checkout form (design spec: Checkout page).
 * The actual PayPal / Apple Pay / Google Pay buttons here render only
 * once the corresponding official gateway plugin is installed and
 * configured with real merchant credentials — until then this shows
 * a disabled preview so the layout is visible immediately.
 */
add_action('woocommerce_before_checkout_form', function () {
    ?>
    <div class="checkout-express">
        <button type="button" class="checkout-express__paypal" disabled>Express Checkout with PayPal</button>
        <button type="button" class="checkout-express__wallet" disabled>
            <i class="fa-brands fa-apple"></i> <span> / </span> <i class="fa-brands fa-google"></i>
            <span>Express Checkout with Apple Pay / Google Pay</span>
        </button>
    </div>
    <div class="checkout-divider">
        <span></span>
        <p>OR CONTINUE WITH STANDARD CHECKOUT</p>
        <span></span>
    </div>
    <?php
}, 5);
