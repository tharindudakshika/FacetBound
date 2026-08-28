<?php
/**
 * The main Shop page (and product category/tag archives) — overrides
 * WooCommerce's plugin default. Mirrors src/pages/ShopCollection.jsx.
 *
 * WooCommerce loads this automatically for the Shop page and for
 * product_cat / product_tag archives instead of its own template.
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header('shop');

facetbound_hero([
    'min_height' => 420,
    'padding' => '80px',
    'caption' => 'hero image: curated ring collection, studio flat lay',
    'kicker' => 'The Handcrafted Collection',
    'title' => 'Mined by Nature. Shaped by Hand.',
    'subtitle' => 'Explore our collection of natural Sri Lankan gemstones set in solid 925 sterling silver — handcrafted to commemorate life’s most cherished milestones.',
    'max_width' => 640,
]);
?>

<!-- Filter & Sort Toolbar -->
<style>
    /* Make WooCommerce's real (functional) ordering <select> inherit the
       shopcol-sort__select look defined in pages.css, without editing it. */
    .shopcol-sort form.woocommerce-ordering {
        margin: 0;
    }
    .shopcol-sort select.orderby {
        border: 1px solid var(--slate-border);
        border-radius: 8px;
        padding: 9px 14px;
        font-size: 13px;
        font-family: var(--font-sans);
        color: var(--ink);
        background: var(--cream);
        cursor: pointer;
    }
</style>
<div class="shopcol-toolbar">
    <div class="container shopcol-toolbar__row">
        <div class="shopcol-filters">
            <button type="button" class="shopcol-filter-pill">
                Gemstone Type
                <i class="fa-solid fa-chevron-down" style="font-size:10px"></i>
            </button>
            <button type="button" class="shopcol-filter-pill">
                Silver Texture
                <i class="fa-solid fa-chevron-down" style="font-size:10px"></i>
            </button>
            <button type="button" class="shopcol-filter-pill">
                Ring Style
                <i class="fa-solid fa-chevron-down" style="font-size:10px"></i>
            </button>
        </div>
        <div class="shopcol-sort">
            <label for="shopcol-sort-select" class="shopcol-sort__label">Sort by:</label>
            <?php woocommerce_catalog_ordering(); ?>
        </div>
    </div>
</div>

<!-- Product Grid -->
<section class="shopcol-grid-section">
    <div class="container">
        <?php if (woocommerce_product_loop()) : ?>
            <?php
            global $wp_query;
            $total_products = isset($wp_query->found_posts) ? (int) $wp_query->found_posts : (int) wc_get_loop_prop('total');

            // Swap WooCommerce's default <ul class="products"> wrapper for the
            // design's CSS-grid <div class="shopcol-grid"> — called twice below
            // (with the trust banner spliced between) when there are more than
            // 6 products, so both halves stay valid, self-closing grid blocks.
            add_filter('woocommerce_product_loop_start', function () {
                return '<div class="shopcol-grid">';
            });
            add_filter('woocommerce_product_loop_end', function () {
                return '</div>';
            });

            do_action('woocommerce_before_shop_loop');

            woocommerce_product_loop_start();

            $loop_index = 0;
            while (have_posts()) :
                the_post();

                do_action('woocommerce_shop_loop');

                wc_get_template_part('content', 'product');
                $loop_index++;

                // Inline Trust Banner — spliced in right after the 6th product,
                // only when there are more products still to come.
                if ($loop_index === 6 && $total_products > 6) :
                    woocommerce_product_loop_end();
                    ?>
                    <div class="shopcol-trust-banner">
                        <h3 class="shopcol-trust-banner__title">Unsure About Your Ring Size?</h3>
                        <p class="shopcol-trust-banner__body">
                            We offer surprise-proof open-gap designs and a comprehensive US Sizing Guide with free exchanges.
                        </p>
                        <button type="button" class="btn btn-terracotta">View Sizing Guide</button>
                    </div>
                    <?php
                    woocommerce_product_loop_start();
                endif;
            endwhile;

            woocommerce_product_loop_end();

            do_action('woocommerce_after_shop_loop');
            ?>
        <?php else : ?>
            <p><?php esc_html_e('No products found.', 'facetbound'); ?></p>
        <?php endif; ?>
    </div>
</section>

<?php
facetbound_concierge_cta();

get_footer();
