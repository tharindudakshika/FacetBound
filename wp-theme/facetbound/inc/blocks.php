<?php
/**
 * Small server-rendered blocks used by parts/header.html, parts/footer.html
 * and templates/home.html — each replaces a handful of lines that used to
 * live directly in header.php/footer.php/home.php with a PHP render
 * callback, since static block-template HTML files can't run PHP.
 */

if (!defined('ABSPATH')) {
    exit;
}

add_action('init', function () {
    register_block_type('facetbound/header-utilities', [
        'render_callback' => 'facetbound_render_header_utilities',
    ]);
    register_block_type('facetbound/footer-copyright', [
        'render_callback' => 'facetbound_render_footer_copyright',
    ]);
    register_block_type('facetbound/posts-page-content', [
        'render_callback' => 'facetbound_render_posts_page_content',
    ]);
});

/**
 * Search icon + account link (with active state) + SSL badge
 * (checkout only). Mirrors header.php's original $show_ssl /
 * $account_active logic.
 */
function facetbound_render_header_utilities() {
    $show_ssl = function_exists('is_checkout') && is_checkout();
    $account_active = function_exists('is_account_page') && is_account_page();
    $account_url = class_exists('WooCommerce') ? wc_get_page_permalink('myaccount') : home_url('/my-account/');

    ob_start();
    ?>
    <?php if ($show_ssl) : ?>
        <div class="fb-header__ssl">
            <i class="fa-solid fa-lock"></i>
            <span>SSL Encrypted</span>
        </div>
    <?php endif; ?>
    <i class="fa-solid fa-magnifying-glass fb-header__icon" title="Search"></i>
    <a href="<?php echo esc_url($account_url); ?>" title="Account">
        <i class="<?php echo $account_active ? 'fa-regular fa-user fb-header__icon fb-header__icon--active' : 'fa-regular fa-user fb-header__icon'; ?>"></i>
    </a>
    <?php
    return ob_get_clean();
}

function facetbound_render_footer_copyright() {
    return '<p class="fb-footer__copyright">&copy; ' . esc_html(date('Y')) . ' Facetbound. All rights reserved.</p>';
}

/**
 * Renders the "Posts page" (page_for_posts, slug `journal`) page's own
 * block-editor content on templates/home.html — a Query/Post-Content
 * block has no post to bind to on the blog index, so this fetches and
 * renders that page explicitly, same as the old home.php did.
 */
function facetbound_render_posts_page_content() {
    $journal_page = get_post(get_option('page_for_posts'));
    if (!$journal_page) {
        return '';
    }
    return apply_filters('the_content', $journal_page->post_content);
}

add_action('init', function () {
    register_block_pattern_category('facetbound', [
        'label' => __('Facetbound', 'facetbound'),
    ]);
});
