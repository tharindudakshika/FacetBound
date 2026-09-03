<?php
/**
 * Facetbound theme bootstrap.
 */

if (!defined('ABSPATH')) {
    exit;
}

define('FACETBOUND_VERSION', '1.0.0');
define('FACETBOUND_DIR', get_template_directory());
define('FACETBOUND_URI', get_template_directory_uri());

require_once FACETBOUND_DIR . '/inc/theme-setup.php';
require_once FACETBOUND_DIR . '/inc/enqueue.php';
require_once FACETBOUND_DIR . '/inc/woocommerce-support.php';
require_once FACETBOUND_DIR . '/inc/content-seed.php';
require_once FACETBOUND_DIR . '/inc/template-tags.php';
require_once FACETBOUND_DIR . '/inc/my-account.php';
require_once FACETBOUND_DIR . '/inc/contact-form.php';
require_once FACETBOUND_DIR . '/inc/product-certificate.php';
require_once FACETBOUND_DIR . '/inc/cookie-consent.php';

add_action('wp_footer', function () {
    if (!isset($_GET['wmc_debug'])) {
        return;
    }
    if (!class_exists('WOOMULTI_CURRENCY_F_Data')) {
        echo '<!-- WMC_DEBUG: plugin class not found -->';
        return;
    }
    $settings = WOOMULTI_CURRENCY_F_Data::get_ins();
    echo '<!-- WMC_DEBUG fixed_price=' . var_export($settings->check_fixed_price(), true)
        . ' current_currency=' . esc_html($settings->get_current_currency())
        . ' enable=' . var_export($settings->get_enable(), true) . ' -->';
    $product = wc_get_product(82);
    if ($product) {
        echo '<!-- WMC_DEBUG product82 meta=' . esc_html($product->get_meta('_regular_price_wmcp', true))
            . ' price=' . esc_html($product->get_price())
            . ' regular_price=' . esc_html($product->get_regular_price())
            . ' changes=' . esc_html(wp_json_encode($product->get_changes())) . ' -->';
        echo '<!-- WMC_DEBUG product82 price_html=' . esc_html($product->get_price_html()) . ' -->';
    }
    global $wp_query;
    if (isset($wp_query->posts) && is_array($wp_query->posts)) {
        foreach ($wp_query->posts as $wp_post) {
            if (get_post_type($wp_post) !== 'product') {
                continue;
            }
            $loop_product = wc_get_product($wp_post->ID);
            if (!$loop_product) {
                continue;
            }
            echo '<!-- WMC_DEBUG loop_product id=' . (int) $wp_post->ID
                . ' price=' . esc_html($loop_product->get_price())
                . ' changes=' . esc_html(wp_json_encode($loop_product->get_changes())) . ' -->';
        }
    }
});
