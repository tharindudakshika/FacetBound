<?php
/**
 * The front page (Homepage). Mirrors src/pages/Home.jsx.
 * WordPress serves this automatically for the site's front page
 * (Reading settings are configured in inc/content-seed.php).
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

$fb_collection_captions = [
    'birthdays-personal-milestones' => 'blue topaz ring, studio shot',
    'anniversaries-commitments'     => 'hammered & tree bark texture band',
    'self-reward-achievements'      => 'minimalist solitaire ring',
];

$fb_unboxing_features = [
    [
        'title' => 'Geometric Emerald-Green Wooden Keepsake Box',
        'desc'  => 'Reusable solid wood housing for a lifetime of protection.',
    ],
    [
        'title' => 'Infused with Mitti Attar',
        'desc'  => 'Pure essential oil scent capturing the essence of rain-soaked Sri Lankan earth.',
    ],
    [
        'title' => 'Hand-Folded Terracotta Inserts',
        'desc'  => 'Plastic-free board and natural straw echoing our island’s mining pits.',
    ],
    [
        'title' => 'Signed Authenticity & Provenance Card',
        'desc'  => 'Certificate confirming 100% natural Sri Lankan gemstones and ethically artisan-crafted 925 silver.',
    ],
];

$fb_testimonials = [
    [ 'name' => 'Rachel H.', 'location' => 'Austin, TX', 'quote' => "The sizing guide was spot on — first ring I've ordered online that fit perfectly. Unboxing felt like a gift to myself." ],
    [ 'name' => 'Megan T.', 'location' => 'Portland, OR', 'quote' => 'Genuinely the nicest packaging I\'ve seen from a jewelry brand. The earthy scent when you open the box is unexpected and lovely.' ],
    [ 'name' => 'Danielle K.', 'location' => 'Charleston, SC', 'quote' => 'I was nervous about ring size but their guide made it easy. The hammered band is even better than the photos.' ],
];

$fb_shop_url = esc_url( function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' ) );
?>

<!-- Hero -->
<section class="home-hero">
    <?php
    facetbound_placeholder(
        'dark',
        'hero image: hand modeling gemstone ring, natural light',
        [
            'boxed' => true,
            'style' => 'min-height:420px;display:flex;align-items:center;justify-content:center',
        ]
    );
    ?>
    <div class="home-hero__copy">
        <h1 class="home-hero__title">Mind by Nature. Shaped by Hand.</h1>
        <p class="home-hero__subtitle">Mark your personal milestones with handcrafted Sri Lankan earth set in solid 925 sterling silver.</p>
        <a href="<?php echo $fb_shop_url; ?>" class="btn btn-terracotta home-hero__cta">Explore Milestone Collections</a>
    </div>
</section>

<!-- Assurance Row (same as Shop page) -->
<section class="shopcol-assurance">
    <div class="container shopcol-assurance__grid">
        <div class="shopcol-assurance__item">
            <div class="shopcol-assurance__icon">
                <i class="fa-solid fa-box"></i>
            </div>
            <h4 class="shopcol-assurance__title">Custom Octagonal Packaging Included</h4>
            <p class="shopcol-assurance__desc">Every ring comes in our emerald wooden box with Mitti Attar scent.</p>
        </div>
        <div class="shopcol-assurance__item">
            <div class="shopcol-assurance__icon">
                <i class="fa-solid fa-scroll"></i>
            </div>
            <h4 class="shopcol-assurance__title">Authenticity Certificate</h4>
            <p class="shopcol-assurance__desc">Gemologist-certified natural Sri Lankan stones.</p>
        </div>
        <div class="shopcol-assurance__item">
            <div class="shopcol-assurance__icon">
                <i class="fa-solid fa-plane"></i>
            </div>
            <h4 class="shopcol-assurance__title">Insured Global Courier</h4>
            <p class="shopcol-assurance__desc">Ships via DHL/FedEx with full tracking.</p>
        </div>
    </div>
</section>

<!-- Curated Collections -->
<section class="home-collections">
    <div class="container">
        <div class="section-head">
            <div class="kicker" style="text-align:center">Celebrate Your Moment</div>
            <h2>Curated Milestone Collections</h2>
            <p class="section-head__body">Mark life&rsquo;s unforgettable chapters with handcrafted Sri Lankan earth set in solid 925 sterling silver.</p>
        </div>
        <div class="home-collections__grid">
            <?php
            $fb_collection_terms = get_terms(
                [
                    'taxonomy'   => 'product_cat',
                    'hide_empty' => false,
                    'slug'       => array_keys( $fb_collection_captions ),
                ]
            );
            if ( ! is_wp_error( $fb_collection_terms ) && ! empty( $fb_collection_terms ) ) {
                // Preserve the canonical order (Birthdays, Anniversaries, Self-Reward).
                $fb_terms_by_slug = [];
                foreach ( $fb_collection_terms as $fb_term ) {
                    $fb_terms_by_slug[ $fb_term->slug ] = $fb_term;
                }
                foreach ( $fb_collection_captions as $fb_slug => $fb_caption ) {
                    if ( ! isset( $fb_terms_by_slug[ $fb_slug ] ) ) {
                        continue;
                    }
                    $fb_term = $fb_terms_by_slug[ $fb_slug ];
                    ?>
                    <a href="<?php echo esc_url( get_term_link( $fb_term ) ); ?>" class="home-collection-card">
                        <div class="home-collection-card__img-wrap">
                            <?php facetbound_placeholder( 'light', $fb_caption ); ?>
                        </div>
                        <h3 class="home-collection-card__title"><?php echo esc_html( $fb_term->name ); ?></h3>
                        <?php if ( $fb_term->description ) : ?>
                            <p class="home-collection-card__desc"><?php echo esc_html( $fb_term->description ); ?></p>
                        <?php endif; ?>
                    </a>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</section>

<!-- Brand Story -->
<section class="home-story">
    <?php
    facetbound_placeholder(
        'darker',
        'artisan hand-carving silver band, Sri Lanka workshop',
        [
            'boxed' => true,
            'style' => 'min-height:460px',
        ]
    );
    ?>
    <div class="home-story__copy">
        <div class="kicker">Our Story &amp; Heritage</div>
        <h2 class="home-story__heading">Mined by Nature. Shaped by Hand.</h2>
        <p class="home-story__body">From the quiet depths of Sri Lankan riverbeds to your hands, every natural Spinel and gemstone is thoughtfully sourced and set by local artisans. What begins as a raw piece of earth is slowly transformed into a refined keepsake &mdash; crafted in solid 925 sterling silver to commemorate life&rsquo;s most meaningful personal milestones.</p>
        <a href="<?php echo esc_url( home_url( '/our-story/' ) ); ?>" class="home-story__link">Discover Our Roots &rarr;</a>
    </div>
</section>

<!-- Featured Products -->
<section class="home-featured">
    <div class="container">
        <div class="section-head">
            <div class="kicker" style="text-align:center">Curated for Your Milestones</div>
            <h2>Featured Keepsakes</h2>
            <p class="section-head__body">Handcrafted 925 sterling silver rings set with natural Sri Lankan gemstones, designed to celebrate life&rsquo;s most cherished moments.</p>
        </div>
        <div class="home-featured__grid">
            <?php
            if ( function_exists( 'wc_get_products' ) ) {
                $fb_products = wc_get_products(
                    [
                        'limit'   => 4,
                        'status'  => 'publish',
                        'orderby' => 'date',
                        'order'   => 'ASC',
                    ]
                );
                foreach ( $fb_products as $fb_product ) {
                    $fb_permalink = get_permalink( $fb_product->get_id() );
                    ?>
                    <div class="home-product-card">
                        <a href="<?php echo esc_url( $fb_permalink ); ?>" class="home-product-img-wrap">
                            <?php facetbound_placeholder( 'light', $fb_product->get_name() . ', product photo', [ 'class' => 'home-product-img' ] ); ?>
                            <div class="home-product-quickview">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7" /><path d="m21 21-4.3-4.3" /></svg>
                            </div>
                        </a>
                        <h3 class="home-product-name"><?php echo esc_html( $fb_product->get_name() ); ?></h3>
                        <p class="home-product-price"><?php echo $fb_product->get_price_html(); ?></p>
                        <div class="home-product-actions">
                            <a href="<?php echo esc_url( $fb_permalink ); ?>" class="home-btn-sm home-btn-outline-emerald">Make it Yours</a>
                            <a
                                class="home-btn-sm home-btn-whatsapp"
                                href="https://wa.me/?text=<?php echo esc_attr( rawurlencode( "Hi! I'm interested in the " . $fb_product->get_name() ) ); ?>"
                                target="_blank"
                                rel="noopener noreferrer"
                            >
                                <i class="fa-brands fa-whatsapp"></i>
                                Customer Care
                            </a>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <div class="home-featured__cta">
            <a href="<?php echo esc_url( function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' ) ); ?>" class="btn btn-terracotta">
                Discover Our Collection
            </a>
        </div>
    </div>
</section>

<!-- Unboxing / Sustainability -->
<section class="home-unboxing">
    <div class="container home-unboxing__grid">
        <div>
            <div class="kicker">Sustainability &amp; Packaging</div>
            <h2 class="home-unboxing__heading">An Unboxing Rooted in Earth.</h2>
            <p class="home-unboxing__body">Handcrafted 925 sterling silver rings presented in 100% plastic-free packaging &mdash; designed to safely deliver and commemorate life&rsquo;s meaningful moments.</p>
            <div class="home-unboxing__list">
                <?php foreach ( $fb_unboxing_features as $fb_feature ) : ?>
                    <div class="home-unboxing__item">
                        <span class="home-unboxing__dot"></span>
                        <span class="home-unboxing__label">
                            <span class="home-unboxing__item-title"><?php echo esc_html( $fb_feature['title'] ); ?>:</span>
                            <span class="home-unboxing__item-desc"><?php echo esc_html( $fb_feature['desc'] ); ?></span>
                        </span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
        facetbound_placeholder(
            'dark',
            'opened wooden gift box: terracotta inserts, authenticity card',
            [
                'boxed' => true,
                'style' => 'border:1px solid rgba(200,138,117,0.35);border-radius:16px;min-height:400px',
            ]
        );
        ?>
    </div>
</section>

<!-- Testimonials -->
<section class="home-testimonials">
    <div class="container">
        <div class="section-head">
            <div class="kicker" style="text-align:center">Reviews</div>
            <h2>Loved Across the Globe</h2>
            <p class="section-head__body">Real stories from collectors who marked their cherished milestones with a piece of Sri Lankan earth.</p>
        </div>
        <div class="home-testimonials__grid">
            <?php foreach ( $fb_testimonials as $fb_t ) : ?>
                <div class="home-testimonial-card">
                    <?php facetbound_stars( 5, 15 ); ?>
                    <p class="home-testimonial-card__quote">&ldquo;<?php echo esc_html( $fb_t['quote'] ); ?>&rdquo;</p>
                    <p class="home-testimonial-card__meta"><?php echo esc_html( $fb_t['name'] ); ?> — <span><?php echo esc_html( $fb_t['location'] ); ?></span></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Instagram grid -->
<section class="home-instagram">
    <div class="container">
        <div class="home-instagram__head">
            <h2 class="home-instagram__heading">Join the Collectors&rsquo; Circle</h2>
            <p class="home-instagram__desc">Share how you style your Sri Lankan earth. Tag us to be featured in our milestone gallery.</p>
            <a class="home-instagram__handle" href="#">@facetbound.jewelry</a>
        </div>
        <div class="home-instagram__grid">
            <?php for ( $fb_i = 1; $fb_i <= 6; $fb_i++ ) : ?>
                <?php facetbound_placeholder( 'dark', 'lifestyle shot ' . $fb_i, [ 'class' => 'home-instagram__tile' ] ); ?>
            <?php endfor; ?>
        </div>
    </div>
</section>

<?php facetbound_concierge_cta(); ?>

<?php get_footer(); ?>
