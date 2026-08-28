<?php
/**
 * Single Product template override — Product Detail page.
 *
 * Ports the visual structure of src/pages/ProductDetail.jsx onto a real
 * WC_Product (variable product with a real "Ring Size" attribute/variations).
 * Cart, variation selection, and checkout all run through WooCommerce's own
 * template functions (woocommerce_template_single_add_to_cart(), the
 * comments/review system) so the store actually functions — only the
 * gallery lightbox and the details tabs are hand-rolled vanilla JS
 * (assets/js/product.js), since there is no React runtime here.
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

global $product;
$product = wc_get_product(get_the_ID());

if (!$product) {
    ?>
    <div class="container" style="padding:80px var(--section-x)">
        <p>This product could not be found.</p>
    </div>
    <?php
    get_footer();
    return;
}

if (have_posts()) :
    while (have_posts()) :
        the_post();

        $is_featured = ($product->get_slug() === 'raw-edge-blue-topaz-solitaire');
        $average_rating = (float) $product->get_average_rating();
        $review_count = (int) $product->get_review_count();

        /* -------------------------------------------------------------
         * Hero
         * ----------------------------------------------------------- */
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

        <!-- Breadcrumb (real WooCommerce breadcrumb; wrapper markup/classes
             already customized to .pdp-breadcrumb in inc/woocommerce-support.php) -->
        <div class="container">
            <?php woocommerce_breadcrumb(); ?>
        </div>

        <!-- Gallery + Buy Box -->
        <div class="container pdp-main">

            <!-- Gallery -->
            <div class="pdp-gallery">
                <?php
                $gallery_ids = $product->get_gallery_image_ids();

                if (!empty($gallery_ids)) :
                    foreach ($gallery_ids as $i => $img_id) :
                        $img_url = wp_get_attachment_image_url($img_id, 'large');
                        $alt = get_post_meta($img_id, '_wp_attachment_image_alt', true);
                        $caption = $alt ?: $product->get_name();
                        ?>
                        <div
                            class="pdp-gallery__tile pdp-gallery-tile"
                            data-lightbox-index="<?php echo (int) $i; ?>"
                            data-lightbox-src="<?php echo esc_url($img_url); ?>"
                            data-lightbox-caption="<?php echo esc_attr($caption); ?>"
                        >
                            <?php
                            echo wp_get_attachment_image($img_id, 'large', false, [
                                'style' => 'width:100%;height:280px;object-fit:cover;border-radius:14px;cursor:zoom-in;display:block',
                            ]);
                            ?>
                            <div class="pdp-gallery__expand"><i class="fa-solid fa-expand"></i></div>
                        </div>
                    <?php endforeach; ?>
                <?php elseif ($is_featured) :
                    $media = [
                        ['caption' => 'Studio shot, hero angle, neutral background'],
                        ['caption' => 'On-finger wear angle'],
                        ['caption' => 'Open-back setting & hammered texture close-up'],
                        ['caption' => 'Ring inside emerald wooden box with terracotta packaging'],
                        ['caption' => '10-second sunlight sparkle video clip', 'is_video' => true],
                    ];
                    foreach ($media as $i => $m) :
                        ?>
                        <div
                            class="pdp-gallery__tile pdp-gallery-tile"
                            data-lightbox-index="<?php echo (int) $i; ?>"
                            data-lightbox-caption="<?php echo esc_attr($m['caption']); ?>"
                        >
                            <?php facetbound_placeholder('light', $m['caption'], [
                                'style' => 'cursor:zoom-in;position:relative;border-radius:14px;height:280px',
                            ]); ?>
                            <?php if (!empty($m['is_video'])) : ?>
                                <div class="pdp-gallery__play"><i class="fa-solid fa-play"></i></div>
                            <?php endif; ?>
                            <div class="pdp-gallery__expand"><i class="fa-solid fa-expand"></i></div>
                        </div>
                    <?php endforeach; ?>
                <?php else :
                    $name = $product->get_name();
                    $media = [
                        sprintf('%s, studio shot', $name),
                        sprintf('%s, on-finger wear', $name),
                        sprintf('%s, texture close-up', $name),
                        sprintf('%s, packaging', $name),
                    ];
                    foreach ($media as $i => $caption) :
                        ?>
                        <div
                            class="pdp-gallery__tile pdp-gallery-tile"
                            data-lightbox-index="<?php echo (int) $i; ?>"
                            data-lightbox-caption="<?php echo esc_attr($caption); ?>"
                        >
                            <?php facetbound_placeholder('light', $caption, [
                                'style' => 'cursor:zoom-in;position:relative;border-radius:14px;height:280px',
                            ]); ?>
                            <div class="pdp-gallery__expand"><i class="fa-solid fa-expand"></i></div>
                        </div>
                    <?php endforeach;
                endif;
                ?>
            </div>

            <!-- Buy Box -->
            <div class="pdp-buybox">
                <h1 class="pdp-buybox__title"><?php echo esc_html($product->get_name()); ?></h1>

                <div class="pdp-buybox__rating">
                    <?php if ($review_count > 0) :
                        facetbound_stars((int) round($average_rating));
                        ?>
                        <span>
                            <?php
                            printf(
                                '%s/5 &middot; %d review%s',
                                esc_html(number_format_i18n($average_rating, 1)),
                                $review_count,
                                $review_count === 1 ? '' : 's'
                            );
                            ?>
                        </span>
                    <?php else :
                        facetbound_stars(0);
                        ?>
                        <span>No reviews yet</span>
                    <?php endif; ?>
                </div>

                <div class="pdp-buybox__price"><?php echo $product->get_price_html(); ?></div>
                <div class="pdp-buybox__shipping">Includes Insured Worldwide Shipping</div>

                <?php
                $desc = $product->get_description();
                if (!$desc) {
                    $desc = $product->get_short_description();
                }
                ?>
                <p class="pdp-buybox__desc"><?php echo wp_kses_post($desc); ?></p>

                <!-- Real WooCommerce add-to-cart (variation select + qty + button).
                     Note: without a variation-swatches plugin, WooCommerce's default
                     template renders the Ring Size attribute as a <select> dropdown
                     rather than the design's pill-swatch UI; wrapped below so it can
                     be visually skinned later without touching cart/checkout logic. -->
                <div class="pdp-native-addtocart">
                    <?php woocommerce_template_single_add_to_cart(); ?>
                </div>

                <a
                    class="btn btn-emerald pdp-whatsapp-btn"
                    href="https://wa.me/?text=<?php echo rawurlencode("Hi! I'm interested in the " . $product->get_name()); ?>"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    <i class="fa-brands fa-whatsapp"></i> Chat on WhatsApp
                </a>

                <button type="button" class="pdp-pay-btn" disabled>
                    Buy with PayPal / Apple Pay
                </button>

                <!-- Trust badges -->
                <div class="pdp-trust">
                    <div class="pdp-trust__row">
                        <i class="fa-solid fa-plane"></i>
                        <span>Free Worldwide Insured Shipping (5&ndash;7 Business Days via DHL/FedEx)</span>
                    </div>
                    <div class="pdp-trust__row">
                        <i class="fa-solid fa-scroll"></i>
                        <span>Gemologist Authenticity Certificate included</span>
                    </div>
                    <div class="pdp-trust__row">
                        <i class="fa-solid fa-rotate"></i>
                        <span>Easy 30-Day Size Exchange Policy</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lightbox (hidden by default via inline style, toggled by assets/js/product.js) -->
        <div class="pdp-lightbox" id="pdp-lightbox" style="display:none">
            <button type="button" class="pdp-lightbox__close" id="pdp-lightbox-close">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <button type="button" class="pdp-lightbox__nav pdp-lightbox__nav--prev" id="pdp-lightbox-prev">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <div class="pdp-lightbox__media" id="pdp-lightbox-media" style="border-radius:14px;width:min(680px, 86vw);height:min(680px, 80vh);position:relative;overflow:hidden"></div>
            <button type="button" class="pdp-lightbox__nav pdp-lightbox__nav--next" id="pdp-lightbox-next">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>

        <!-- Details Tabs -->
        <div class="pdp-details">
            <div class="pdp-details__inner">
                <div class="pdp-tabs">
                    <button type="button" class="pdp-tab pdp-tab--active" data-tab="1">Gemstone &amp; Metal Specs</button>
                    <button type="button" class="pdp-tab" data-tab="2">Ethical Origin &amp; Craftsmanship</button>
                    <button type="button" class="pdp-tab" data-tab="3">Packaging &amp; Unboxing</button>
                </div>

                <div class="pdp-tab-panel">
                    <?php
                    if ($is_featured) {
                        $specs = [
                            ['label' => 'Gemstone', 'value' => '100% Natural Sri Lankan Blue Topaz (Unheated/Natural)'],
                            ['label' => 'Carat Weight', 'value' => '1.15 – 1.20 Carats'],
                            ['label' => 'Gem Cut', 'value' => 'Cushion Cut / Round Brilliant Cut'],
                            ['label' => 'Metal Standard', 'value' => 'Solid 925 Sterling Silver (Nickel-free, Hypoallergenic)'],
                            ['label' => 'Finish/Texture', 'value' => 'Artisan Hand-Hammered Texture'],
                            ['label' => 'Setting Type', 'value' => 'Open-back bezel setting (max light transmission, direct skin contact)'],
                        ];
                    } else {
                        $short_desc = wp_strip_all_tags($product->get_short_description());
                        $gem_name = trim(explode('|', $short_desc)[0]);
                        $gem_name = preg_replace('/^Natural\s+/i', '', $gem_name);
                        if (!$gem_name) {
                            $gem_name = 'Gemstone';
                        }
                        $specs = [
                            ['label' => 'Gemstone', 'value' => sprintf('100%% Natural Sri Lankan %s', $gem_name)],
                            ['label' => 'Carat Weight', 'value' => '1.10 – 1.30 Carats'],
                            ['label' => 'Gem Cut', 'value' => 'Cushion Cut / Round Brilliant Cut'],
                            ['label' => 'Metal Standard', 'value' => 'Solid 925 Sterling Silver (Nickel-free, Hypoallergenic)'],
                            ['label' => 'Finish/Texture', 'value' => 'Artisan Hand-Hammered Texture'],
                            ['label' => 'Setting Type', 'value' => 'Open-back bezel setting (max light transmission, direct skin contact)'],
                        ];
                    }
                    ?>
                    <div class="pdp-specs" data-tab-panel="1">
                        <?php foreach ($specs as $s) : ?>
                            <div class="pdp-specs__row">
                                <span class="pdp-specs__label"><?php echo esc_html($s['label']); ?></span>
                                <span class="pdp-specs__value"><?php echo esc_html($s['value']); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <p class="pdp-origin-copy" data-tab-panel="2" style="display:none">
                        Directly sourced from local miners in Ratnapura, Sri Lanka. Faceted by licensed lapidaries and hand-set by master
                        silversmiths.
                    </p>

                    <div class="pdp-packaging" data-tab-panel="3" style="display:none">
                        <?php
                        $packaging_items = [
                            'Octagonal Teak Wood Box (Deep Emerald Green)',
                            'Terracotta Well Insert infused with Mitti Attar essential oil',
                            'Hand-signed Artisan Thank You Tag & Authenticity Card',
                            'Silver Polishing Cloth & Care Card',
                        ];
                        foreach ($packaging_items as $item) :
                            ?>
                            <div class="pdp-packaging__row">
                                <i class="fa-solid fa-check"></i>
                                <span><?php echo esc_html($item); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Visual Story Banner -->
        <div class="pdp-story">
            <div class="container pdp-story__inner">
                <h2 class="pdp-story__title">Crafted with Intention</h2>
                <div class="pdp-story__grid">
                    <?php facetbound_placeholder('dark', 'macro: hammering texture into silver', ['style' => 'border-radius:14px;height:280px']); ?>
                    <?php facetbound_placeholder('dark', 'macro: hammering texture into silver', ['style' => 'border-radius:14px;height:280px']); ?>
                    <?php facetbound_placeholder('dark', 'macro: stone-setting process', ['style' => 'border-radius:14px;height:280px']); ?>
                </div>
                <p class="pdp-story__copy">
                    No two rings are 100% identical. The subtle hammer marks on the silver and the unique natural inclusions inside the
                    crystal ensure your piece is uniquely yours.
                </p>
            </div>
        </div>

        <!-- Reviews (real average rating + real WordPress/WooCommerce review list & form) -->
        <div class="pdp-reviews">
            <div class="container">
                <div class="pdp-reviews__summary">
                    <div class="pdp-reviews__score">
                        <?php if ($review_count > 0) : ?>
                            <div class="pdp-reviews__score-num"><?php echo esc_html(number_format_i18n($average_rating, 1)); ?><span>/ 5</span></div>
                            <?php facetbound_stars((int) round($average_rating), 15); ?>
                            <div class="pdp-reviews__score-count">
                                Based on <?php echo (int) $review_count; ?> review<?php echo $review_count === 1 ? '' : 's'; ?>
                            </div>
                        <?php else : ?>
                            <div class="pdp-reviews__score-num">&mdash;<span>/ 5</span></div>
                            <?php facetbound_stars(0, 15); ?>
                            <div class="pdp-reviews__score-count">No reviews yet &mdash; be the first</div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="pdp-reviews-native">
                    <?php comments_template(); ?>
                </div>
            </div>
        </div>

        <!-- You May Also Like -->
        <div class="pdp-crosssell">
            <div class="container">
                <div class="section-head">
                    <div class="kicker" style="text-align:center">Pair With Your Moment</div>
                    <h2 class="pdp-crosssell__title">You May Also Cherish</h2>
                    <p class="section-head__body">Complement your ring or discover another piece of Sri Lankan earth, handcrafted to celebrate life&rsquo;s special milestones.</p>
                </div>
                <div class="pdp-crosssell__grid">
                    <?php
                    $related_ids = wc_get_related_products($product->get_id(), 3);
                    foreach ($related_ids as $related_id) :
                        $related = wc_get_product($related_id);
                        if (!$related) {
                            continue;
                        }
                        ?>
                        <a class="pdp-crosssell__item" href="<?php echo esc_url(get_permalink($related_id)); ?>" style="display:block;color:inherit;text-decoration:none">
                            <?php facetbound_placeholder('light', $related->get_name(), ['style' => 'border-radius:12px;height:300px']); ?>
                            <div class="pdp-crosssell__name"><?php echo esc_html($related->get_name()); ?></div>
                            <div class="pdp-crosssell__price"><?php echo $related->get_price_html(); ?></div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <?php facetbound_concierge_cta(); ?>

    <?php
    endwhile;
endif;

get_footer();
