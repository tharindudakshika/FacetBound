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
require_once FACETBOUND_DIR . '/inc/appointment-form.php';
