<?php
/**
 * Builds the real Gutenberg block-markup for the 4 previously-hardcoded
 * pages (Home, Our Story, Sustainability, Journal) and seeds it into
 * their post_content once, so the user can edit text/photos in the
 * normal WordPress block editor going forward.
 *
 * Every block below matches exactly what WordPress's own serializer
 * would produce (group w/ className only, heading, paragraph, image
 * via facetbound_placeholder_image_block(), shortcode) — or falls back
 * to core/html (validation-exempt) for anything more complex, so the
 * editor never shows an "unexpected or invalid content" warning.
 */

if (!defined('ABSPATH')) {
    exit;
}

function facetbound_home_block_content() {
    $shop_url = esc_url(function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop/'));
    $our_story_url = esc_url(home_url('/our-story/'));

    ob_start();
    ?>
    <!-- wp:group {"className":"home-hero"} -->
    <div class="wp-block-group home-hero">

    <?php echo facetbound_placeholder_image_block('home-hero', 'hand modeling gemstone ring, natural light', ['width' => 900, 'height' => 900, 'variant' => 'dark']); ?>

    <!-- wp:group {"className":"home-hero__copy"} -->
    <div class="wp-block-group home-hero__copy">

    <!-- wp:heading {"level":1,"className":"home-hero__title"} -->
    <h1 class="home-hero__title">Mind by Nature. Shaped by Hand.</h1>
    <!-- /wp:heading -->

    <!-- wp:paragraph {"className":"home-hero__subtitle"} -->
    <p class="home-hero__subtitle">Ethically sourced natural Sri Lankan gemstones crafted into 925 sterling silver rings.</p>
    <!-- /wp:paragraph -->

    <!-- wp:html -->
    <a href="<?php echo $shop_url; ?>" class="btn btn-terracotta home-hero__cta">Explore Collections</a>
    <!-- /wp:html -->

    </div>
    <!-- /wp:group -->

    </div>
    <!-- /wp:group -->

    <!-- wp:group {"className":"home-trust"} -->
    <div class="wp-block-group home-trust">

    <!-- wp:group {"className":"container home-trust__grid"} -->
    <div class="wp-block-group container home-trust__grid">

    <!-- wp:html -->
    <div class="home-trust__item">
        <div class="home-trust__icon"><svg width="18" height="18" viewBox="0 0 18 18" fill="none"><circle cx="9" cy="9" r="7" stroke="#0F2E23" stroke-width="1.4"/><path d="M9 2c2.5 2 2.5 12 0 14M9 2c-2.5 2-2.5 12 0 14M2.3 9h13.4" stroke="#0F2E23" stroke-width="1.2" fill="none"/></svg></div>
        <div class="home-trust__label">Ethically Sourced Gems</div>
    </div>
    <div class="home-trust__item">
        <div class="home-trust__icon"><svg width="18" height="18" viewBox="0 0 18 18" fill="none"><circle cx="9" cy="11" r="5.5" stroke="#0F2E23" stroke-width="1.4"/><path d="M6 6l3-4.5L12 6" stroke="#0F2E23" stroke-width="1.4" fill="none" stroke-linejoin="round"/></svg></div>
        <div class="home-trust__label">925 Sterling Silver</div>
    </div>
    <div class="home-trust__item">
        <div class="home-trust__icon"><svg width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M2 13l14-9-5 14-2.5-6L2 13z" stroke="#0F2E23" stroke-width="1.3" stroke-linejoin="round" fill="none"/></svg></div>
        <div class="home-trust__label">Worldwide Courier Shipping (DHL/FedEx)</div>
    </div>
    <!-- /wp:html -->

    </div>
    <!-- /wp:group -->

    </div>
    <!-- /wp:group -->

    <!-- wp:group {"className":"home-collections"} -->
    <div class="wp-block-group home-collections">

    <!-- wp:group {"className":"container"} -->
    <div class="wp-block-group container">

    <!-- wp:html -->
    <div class="section-head"><div class="kicker" style="text-align:center">Shop</div><h2>Curated Collections</h2></div>
    <!-- /wp:html -->

    <!-- wp:shortcode -->
    [facetbound_curated_collections]
    <!-- /wp:shortcode -->

    </div>
    <!-- /wp:group -->

    </div>
    <!-- /wp:group -->

    <!-- wp:group {"className":"home-story"} -->
    <div class="wp-block-group home-story">

    <?php echo facetbound_placeholder_image_block('home-story', 'artisan hand-carving silver band, Sri Lanka workshop', ['width' => 900, 'height' => 900, 'variant' => 'darker']); ?>

    <!-- wp:group {"className":"home-story__copy"} -->
    <div class="wp-block-group home-story__copy">

    <!-- wp:html -->
    <div class="kicker">Our Story</div>
    <!-- /wp:html -->

    <!-- wp:heading {"level":2,"className":"home-story__heading"} -->
    <h2 class="home-story__heading">The Raw &amp; Refined Journey</h2>
    <!-- /wp:heading -->

    <!-- wp:paragraph {"className":"home-story__body"} -->
    <p class="home-story__body">From the depths of Sri Lankan earth to your finger, each stone is hand-selected, cut, and set by artisan hands. What begins as raw, unpolished texture is slowly transformed — faceted, tempered, refined — into a quiet luxury meant to be worn every day.</p>
    <!-- /wp:paragraph -->

    <!-- wp:html -->
    <a href="<?php echo $our_story_url; ?>" class="home-story__link">Discover Our Roots →</a>
    <!-- /wp:html -->

    </div>
    <!-- /wp:group -->

    </div>
    <!-- /wp:group -->

    <!-- wp:group {"className":"home-featured"} -->
    <div class="wp-block-group home-featured">

    <!-- wp:group {"className":"container"} -->
    <div class="wp-block-group container">

    <!-- wp:html -->
    <div class="section-head"><div class="kicker" style="text-align:center">Bestsellers</div><h2>Featured Products</h2></div>
    <!-- /wp:html -->

    <!-- wp:shortcode -->
    [facetbound_featured_products]
    <!-- /wp:shortcode -->

    </div>
    <!-- /wp:group -->

    </div>
    <!-- /wp:group -->

    <!-- wp:group {"className":"home-unboxing"} -->
    <div class="wp-block-group home-unboxing">

    <!-- wp:group {"className":"container home-unboxing__grid"} -->
    <div class="wp-block-group container home-unboxing__grid">

    <!-- wp:group -->
    <div class="wp-block-group">

    <!-- wp:html -->
    <div class="kicker">Sustainability</div>
    <!-- /wp:html -->

    <!-- wp:heading {"level":2,"className":"home-unboxing__heading"} -->
    <h2 class="home-unboxing__heading">An Unboxing Rooted in Earth.</h2>
    <!-- /wp:heading -->

    <!-- wp:paragraph {"className":"home-unboxing__body"} -->
    <p class="home-unboxing__body">100% plastic-free, from box to bubble wrap. Every order arrives in a geometric emerald-green wooden box with a hint of mitti attar — the scent of Sri Lankan earth after rain.</p>
    <!-- /wp:paragraph -->

    <!-- wp:html -->
    <div class="home-unboxing__list">
        <div class="home-unboxing__item"><span class="home-unboxing__dot"></span><span class="home-unboxing__label">Geometric emerald-green wooden keepsake box</span></div>
        <div class="home-unboxing__item"><span class="home-unboxing__dot"></span><span class="home-unboxing__label">Mitti attar — the scent of Sri Lankan earth</span></div>
        <div class="home-unboxing__item"><span class="home-unboxing__dot"></span><span class="home-unboxing__label">Hand-folded terracotta fabric inserts</span></div>
        <div class="home-unboxing__item"><span class="home-unboxing__dot"></span><span class="home-unboxing__label">Signed authenticity &amp; provenance card</span></div>
    </div>
    <!-- /wp:html -->

    </div>
    <!-- /wp:group -->

    <?php echo facetbound_placeholder_image_block('home-unboxing', 'opened wooden gift box: terracotta inserts, authenticity card', ['width' => 900, 'height' => 700, 'variant' => 'terra-dark']); ?>

    </div>
    <!-- /wp:group -->

    </div>
    <!-- /wp:group -->

    <!-- wp:group {"className":"home-testimonials"} -->
    <div class="wp-block-group home-testimonials">

    <!-- wp:group {"className":"container"} -->
    <div class="wp-block-group container">

    <!-- wp:html -->
    <div class="section-head"><div class="kicker" style="text-align:center">Reviews</div><h2>Loved, Worldwide</h2></div>
    <!-- /wp:html -->

    <!-- wp:group {"className":"home-testimonials__grid"} -->
    <div class="wp-block-group home-testimonials__grid">

    <!-- wp:html -->
    <div class="home-testimonial-card">
    <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
    <p class="home-testimonial-card__quote">"The sizing guide was spot on — first ring I've ordered online that fit perfectly. Unboxing felt like a gift to myself."</p>
    <p class="home-testimonial-card__meta">Rachel H. <span>— Austin, TX</span></p>
    </div>
    <!-- /wp:html -->

    <!-- wp:html -->
    <div class="home-testimonial-card">
    <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
    <p class="home-testimonial-card__quote">"Genuinely the nicest packaging I've seen from a jewelry brand. The earthy scent when you open the box is unexpected and lovely."</p>
    <p class="home-testimonial-card__meta">Megan T. <span>— Portland, OR</span></p>
    </div>
    <!-- /wp:html -->

    <!-- wp:html -->
    <div class="home-testimonial-card">
    <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
    <p class="home-testimonial-card__quote">"I was nervous about ring size but their guide made it easy. The hammered band is even better than the photos."</p>
    <p class="home-testimonial-card__meta">Danielle K. <span>— Charleston, SC</span></p>
    </div>
    <!-- /wp:html -->

    </div>
    <!-- /wp:group -->

    </div>
    <!-- /wp:group -->

    </div>
    <!-- /wp:group -->

    <!-- wp:group {"className":"home-instagram"} -->
    <div class="wp-block-group home-instagram">

    <!-- wp:group {"className":"container"} -->
    <div class="wp-block-group container">

    <!-- wp:group {"className":"home-instagram__head"} -->
    <div class="wp-block-group home-instagram__head">

    <!-- wp:html -->
    <h2 class="home-instagram__heading">Join the Community</h2><a href="#" class="home-instagram__handle">@facetbound.jewelry</a>
    <!-- /wp:html -->

    </div>
    <!-- /wp:group -->

    <!-- wp:group {"className":"home-instagram__grid"} -->
    <div class="wp-block-group home-instagram__grid">

    <?php
    for ($n = 1; $n <= 6; $n++) {
        echo facetbound_placeholder_image_block('home-instagram-' . $n, 'lifestyle shot ' . $n, ['width' => 500, 'height' => 500, 'variant' => 'dark', 'class' => 'home-instagram__tile']);
        echo "\n\n";
    }
    ?>

    </div>
    <!-- /wp:group -->

    </div>
    <!-- /wp:group -->

    </div>
    <!-- /wp:group -->
    <?php
    return ob_get_clean();
}

function facetbound_our_story_block_content() {
    $shop_url = esc_url(function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop/'));
    $sustainability_url = esc_url(home_url('/sustainability/'));

    ob_start();

    facetbound_hero([
        'min_height' => 600,
        'padding' => '120px',
        'caption' => "cinematic close-up: raw gemstone from pit + hand-polished silver ring",
        'title' => "Unearthing Sri Lanka's Earth. Shaping Timeless Art.",
        'subtitle' => "The story of how raw natural crystals from ancient riverbeds are transformed into modern artisanal jewellery.",
        'max_width' => 660,
    ]);
    ?>

    <!-- wp:group {"className":"story-genesis"} -->
    <div class="wp-block-group story-genesis">

    <!-- wp:group {"className":"container story-genesis-grid"} -->
    <div class="wp-block-group container story-genesis-grid">

    <?php echo facetbound_placeholder_image_block('story-genesis', 'pit mining scene / gemstone market in Ratnapura', ['width' => 900, 'height' => 900, 'variant' => 'light']); ?>

    <!-- wp:group -->
    <div class="wp-block-group">

    <!-- wp:html -->
    <div class="kicker">The Genesis</div>
    <!-- /wp:html -->

    <!-- wp:heading {"level":2} -->
    <h2>Sri Lanka has been the realm of the world's finest gemstones for centuries.</h2>
    <!-- /wp:heading -->

    <!-- wp:paragraph -->
    <p>Facetbound was founded to offer the world hand-crafted rings that preserve the unique character and soul of each natural stone — standing as an alternative to mass-produced, identical jewelry.</p>
    <!-- /wp:paragraph -->

    </div>
    <!-- /wp:group -->

    </div>
    <!-- /wp:group -->

    </div>
    <!-- /wp:group -->

    <!-- wp:group {"className":"story-philosophy"} -->
    <div class="wp-block-group story-philosophy">

    <!-- wp:group {"className":"container"} -->
    <div class="wp-block-group container">

    <!-- wp:group {"className":"story-philosophy-head"} -->
    <div class="wp-block-group story-philosophy-head">

    <!-- wp:html -->
    <div class="kicker">Our Philosophy</div>
    <!-- /wp:html -->

    <!-- wp:heading {"level":2} -->
    <h2>Raw &amp; Refined</h2>
    <!-- /wp:heading -->

    </div>
    <!-- /wp:group -->

    <!-- wp:group {"className":"story-philosophy-grid"} -->
    <div class="wp-block-group story-philosophy-grid">

    <!-- wp:group {"className":"story-card"} -->
    <div class="wp-block-group story-card">

    <!-- wp:html -->
    <div class="kicker">The Raw</div>
    <!-- /wp:html -->

    <!-- wp:heading {"level":3} -->
    <h3>Earth's Natural State</h3>
    <!-- /wp:heading -->

    <!-- wp:paragraph -->
    <p>A natural gemstone is a creation forged over millions of years under extreme terrestrial pressure and heat. Because of this, every single stone is 100% unique.</p>
    <!-- /wp:paragraph -->

    </div>
    <!-- /wp:group -->

    <!-- wp:group {"className":"story-card"} -->
    <div class="wp-block-group story-card">

    <!-- wp:html -->
    <div class="kicker">The Refined</div>
    <!-- /wp:html -->

    <!-- wp:heading {"level":3} -->
    <h3>Artisanal Craftsmanship</h3>
    <!-- /wp:heading -->

    <!-- wp:paragraph -->
    <p>Local artisan silversmiths bring each raw stone to life using hammered or tree bark textures, tailored to fit its natural shape.</p>
    <!-- /wp:paragraph -->

    </div>
    <!-- /wp:group -->

    </div>
    <!-- /wp:group -->

    </div>
    <!-- /wp:group -->

    </div>
    <!-- /wp:group -->

    <!-- wp:group {"className":"story-ethics"} -->
    <div class="wp-block-group story-ethics">

    <!-- wp:group {"className":"container"} -->
    <div class="wp-block-group container">

    <!-- wp:group {"className":"story-ethics-box"} -->
    <div class="wp-block-group story-ethics-box">

    <!-- wp:html -->
    <div class="kicker">Sustainability</div>
    <!-- /wp:html -->

    <!-- wp:heading {"level":2} -->
    <h2>Ethical Sourcing &amp; Fair Trade</h2>
    <!-- /wp:heading -->

    <!-- wp:group {"className":"story-ethics-points"} -->
    <div class="wp-block-group story-ethics-points">

    <!-- wp:group {"className":"story-ethics-point"} -->
    <div class="wp-block-group story-ethics-point">

    <!-- wp:heading {"level":4} -->
    <h4>No Mass Mining</h4>
    <!-- /wp:heading -->

    <!-- wp:paragraph -->
    <p>Utilizing strictly ethical sourcing methods that protect the environment and ensure fair wages for local miners.</p>
    <!-- /wp:paragraph -->

    </div>
    <!-- /wp:group -->

    <!-- wp:group {"className":"story-ethics-point"} -->
    <div class="wp-block-group story-ethics-point">

    <!-- wp:heading {"level":4} -->
    <h4>Authenticity Guaranteed</h4>
    <!-- /wp:heading -->

    <!-- wp:paragraph -->
    <p>Every ring is delivered with a Gemological Authenticity Certificate and a tag signed by the artisan.</p>
    <!-- /wp:paragraph -->

    </div>
    <!-- /wp:group -->

    </div>
    <!-- /wp:group -->

    </div>
    <!-- /wp:group -->

    </div>
    <!-- /wp:group -->

    </div>
    <!-- /wp:group -->

    <!-- wp:group {"className":"story-artisans"} -->
    <div class="wp-block-group story-artisans">

    <?php echo facetbound_placeholder_image_block('story-artisans', "close-up: silversmith's hands hammering silver", ['width' => 900, 'height' => 900, 'variant' => 'darker']); ?>

    <!-- wp:group {"className":"story-artisans-copy"} -->
    <div class="wp-block-group story-artisans-copy">

    <!-- wp:html -->
    <div class="kicker">Meet the Artisans</div>
    <!-- /wp:html -->

    <!-- wp:heading {"level":2} -->
    <h2>A Human Touch, in Every Setting</h2>
    <!-- /wp:heading -->

    <!-- wp:paragraph -->
    <p>Every Facetbound piece carries a human touch. No machines, no factory lines — just dedicated master craftsmen in Sri Lanka pouring their soul into every texture and setting.</p>
    <!-- /wp:paragraph -->

    </div>
    <!-- /wp:group -->

    </div>
    <!-- /wp:group -->

    <!-- wp:group {"className":"story-packaging"} -->
    <div class="wp-block-group story-packaging">

    <!-- wp:group {"className":"container story-packaging-grid"} -->
    <div class="wp-block-group container story-packaging-grid">

    <!-- wp:group -->
    <div class="wp-block-group">

    <!-- wp:html -->
    <div class="kicker">Unboxing</div>
    <!-- /wp:html -->

    <!-- wp:heading {"level":2} -->
    <h2>Our packaging is completely plastic-free.</h2>
    <!-- /wp:heading -->

    <!-- wp:paragraph -->
    <p>The moment you open the box, the scent of rain-soaked earth (Mitti Attar) immerses you in the authentic experience of a Sri Lankan gemstone mine.</p>
    <!-- /wp:paragraph -->

    </div>
    <!-- /wp:group -->

    <?php echo facetbound_placeholder_image_block('story-packaging', 'octagonal emerald wooden box, terracotta board inserts, mitti attar', ['width' => 900, 'height' => 700, 'variant' => 'terra-dark']); ?>

    </div>
    <!-- /wp:group -->

    </div>
    <!-- /wp:group -->

    <!-- wp:group {"className":"story-cta"} -->
    <div class="wp-block-group story-cta">

    <!-- wp:heading {"level":2} -->
    <h2>Find the Piece That Speaks to You</h2>
    <!-- /wp:heading -->

    <!-- wp:group {"className":"story-cta-buttons"} -->
    <div class="wp-block-group story-cta-buttons">

    <!-- wp:html -->
    <a href="<?php echo $shop_url; ?>" class="btn btn-terracotta">Explore Collections</a>
    <!-- /wp:html -->

    <!-- wp:html -->
    <a href="<?php echo $sustainability_url; ?>" class="btn btn-outline-terracotta">Read Our Ethics</a>
    <!-- /wp:html -->

    </div>
    <!-- /wp:group -->

    </div>
    <!-- /wp:group -->
    <?php
    return ob_get_clean();
}

function facetbound_sustainability_block_content() {
    $shop_url = esc_url(function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop/'));

    ob_start();

    facetbound_hero([
        'min_height' => 520,
        'padding' => '110px',
        'caption' => "hero image: Ratnapura mine landscape + raw Spinel crystal macro",
        'title' => "Ethically Sourced. Earth Consciously Crafted.",
        'subtitle' => "Our commitment to Sri Lanka's heritage, local artisans, and zero-plastic sustainability.",
        'max_width' => 660,
    ]);
    ?>

    <!-- wp:group {"className":"sustain-sourcing"} -->
    <div class="wp-block-group sustain-sourcing">

    <!-- wp:group {"className":"container sustain-sourcing__grid"} -->
    <div class="wp-block-group container sustain-sourcing__grid">

    <?php echo facetbound_placeholder_image_block('sustain-sourcing', 'selecting stones from local miners, Ratnapura gem pit', ['width' => 900, 'height' => 900]); ?>

    <!-- wp:group -->
    <div class="wp-block-group">

    <!-- wp:html -->
    <div class="kicker">Sourcing</div>
    <!-- /wp:html -->

    <!-- wp:heading {"level":2,"className":"sustain-sourcing__title"} -->
    <h2 class="sustain-sourcing__title">Ethical Gem Sourcing</h2>
    <!-- /wp:heading -->

    <!-- wp:html -->
    <div class="sustain-rows">
        <div class="sustain-row">
            <i class="fa-solid fa-hand-holding-heart sustain-row__icon"></i>
            <div>
                <p class="sustain-row__title">Direct Mine-to-Hand</p>
                <p class="sustain-row__desc">Sourcing natural Spinel gemstones directly from Sri Lanka's traditional miners without intermediaries.</p>
            </div>
        </div>
        <div class="sustain-row">
            <i class="fa-solid fa-water sustain-row__icon"></i>
            <div>
                <p class="sustain-row__title">No Industrial Mass Mining</p>
                <p class="sustain-row__desc">Using strictly traditional, artisanal small-scale mining methods that prevent environmental and river damage.</p>
            </div>
        </div>
        <div class="sustain-row">
            <i class="fa-solid fa-gem sustain-row__icon"></i>
            <div>
                <p class="sustain-row__title">Untreated Natural Spinels</p>
                <p class="sustain-row__desc">Utilizing exclusively 100% natural Spinels with zero artificial heat or chemical treatments.</p>
            </div>
        </div>
    </div>
    <!-- /wp:html -->

    </div>
    <!-- /wp:group -->

    </div>
    <!-- /wp:group -->

    </div>
    <!-- /wp:group -->

    <!-- wp:group {"className":"sustain-artisan"} -->
    <div class="wp-block-group sustain-artisan">

    <!-- wp:group {"className":"sustain-artisan__grid"} -->
    <div class="wp-block-group sustain-artisan__grid">

    <?php echo facetbound_placeholder_image_block('sustain-artisan', 'close-up: silversmith handcrafting a ring', ['width' => 900, 'height' => 900, 'variant' => 'darker']); ?>

    <!-- wp:group {"className":"sustain-artisan__copy"} -->
    <div class="wp-block-group sustain-artisan__copy">

    <!-- wp:group -->
    <div class="wp-block-group">

    <!-- wp:html -->
    <div class="kicker">Fair Trade</div>
    <!-- /wp:html -->

    <!-- wp:heading {"level":2,"className":"sustain-artisan__title"} -->
    <h2 class="sustain-artisan__title">Artisan Fair Trade &amp; Craftsmanship</h2>
    <!-- /wp:heading -->

    </div>
    <!-- /wp:group -->

    <!-- wp:group {"className":"sustain-artisan__blocks"} -->
    <div class="wp-block-group sustain-artisan__blocks">

    <!-- wp:html -->
    <div class="sustain-artisan__block">
        <p class="sustain-artisan__block-title">Fair Wages &amp; Respect</p>
        <p class="sustain-artisan__block-desc">Providing fair trade wages and proper compensation to local silversmiths and lapidaries.</p>
    </div>
    <!-- /wp:html -->

    <!-- wp:html -->
    <div class="sustain-artisan__block">
        <p class="sustain-artisan__block-title">Preserving Heritage</p>
        <p class="sustain-artisan__block-desc">Showcasing the generational artisanal heritage of Sri Lankan silversmiths to an international audience.</p>
    </div>
    <!-- /wp:html -->

    </div>
    <!-- /wp:group -->

    </div>
    <!-- /wp:group -->

    </div>
    <!-- /wp:group -->

    </div>
    <!-- /wp:group -->

    <!-- wp:group {"className":"sustain-packaging"} -->
    <div class="wp-block-group sustain-packaging">

    <!-- wp:group {"className":"container"} -->
    <div class="wp-block-group container">

    <!-- wp:group {"className":"sustain-packaging__head"} -->
    <div class="wp-block-group sustain-packaging__head">

    <!-- wp:html -->
    <div class="kicker">Packaging</div>
    <!-- /wp:html -->

    <!-- wp:heading {"level":2,"className":"sustain-packaging__title"} -->
    <h2 class="sustain-packaging__title">100% Plastic-Free Packaging</h2>
    <!-- /wp:heading -->

    </div>
    <!-- /wp:group -->

    <?php echo facetbound_placeholder_image_block('sustain-packaging', 'flat-lay: octagonal wooden box, terracotta board, honeycomb paper wrap', ['width' => 1400, 'height' => 500]); ?>

    <!-- wp:group {"className":"sustain-packaging__grid"} -->
    <div class="wp-block-group sustain-packaging__grid">

    <!-- wp:html -->
    <div class="sustain-card">
        <i class="fa-solid fa-box sustain-card__icon"></i>
        <p class="sustain-card__title">Octagonal Teak Wood Box</p>
        <p class="sustain-card__desc">Reusable octagonal boxes crafted from local teak wood, replacing plastic boxes.</p>
    </div>
    <!-- /wp:html -->

    <!-- wp:html -->
    <div class="sustain-card">
        <i class="fa-solid fa-droplet sustain-card__icon"></i>
        <p class="sustain-card__title">Terracotta &amp; Natural Scent</p>
        <p class="sustain-card__desc">Natural terracotta board and pure Mitti Attar fragrance, replacing plastic foam inserts.</p>
    </div>
    <!-- /wp:html -->

    <!-- wp:html -->
    <div class="sustain-card">
        <i class="fa-solid fa-leaf sustain-card__icon"></i>
        <p class="sustain-card__title">Honeycomb Kraft Wrap</p>
        <p class="sustain-card__desc">100% biodegradable hexagonal paper wrap for secure courier shipping instead of plastic bubble wrap.</p>
    </div>
    <!-- /wp:html -->

    </div>
    <!-- /wp:group -->

    </div>
    <!-- /wp:group -->

    </div>
    <!-- /wp:group -->

    <!-- wp:group {"className":"sustain-promise"} -->
    <div class="wp-block-group sustain-promise">

    <!-- wp:group {"className":"sustain-promise__box"} -->
    <div class="wp-block-group sustain-promise__box">

    <!-- wp:html -->
    <div class="kicker sustain-promise__kicker">Our Sustainability Promise</div>
    <!-- /wp:html -->

    <!-- wp:paragraph {"className":"sustain-promise__text"} -->
    <p class="sustain-promise__text">Every FACETBOUND Spinel ring comes with an Authenticity Card certifying that your piece is 100% natural, ethically mined in Sri Lanka, and packaged without a single grain of single-use plastic.</p>
    <!-- /wp:paragraph -->

    </div>
    <!-- /wp:group -->

    </div>
    <!-- /wp:group -->

    <!-- wp:group {"className":"sustain-cta"} -->
    <div class="wp-block-group sustain-cta">

    <!-- wp:heading {"level":2,"className":"sustain-cta__title"} -->
    <h2 class="sustain-cta__title">Wear Jewelry with a Soul</h2>
    <!-- /wp:heading -->

    <!-- wp:html -->
    <a href="<?php echo $shop_url; ?>" class="btn btn-terracotta">Explore Ethical Spinel Collections</a>
    <!-- /wp:html -->

    </div>
    <!-- /wp:group -->
    <?php
    return ob_get_clean();
}

function facetbound_journal_block_content() {
    ob_start();
    ?>
    <!-- wp:group {"className":"journal-page-header"} -->
    <div class="wp-block-group journal-page-header">

    <!-- wp:heading {"level":1} -->
    <h1>The Facetbound Journal</h1>
    <!-- /wp:heading -->

    <!-- wp:paragraph -->
    <p>Notes on Sri Lankan gemology, artisan silversmithing, and the raw beauty of earth's creations.</p>
    <!-- /wp:paragraph -->

    </div>
    <!-- /wp:group -->

    <!-- wp:group {"className":"journal-featured-section"} -->
    <div class="wp-block-group journal-featured-section">

    <!-- wp:group {"className":"container"} -->
    <div class="wp-block-group container">

    <!-- wp:shortcode -->
    [facetbound_journal_featured]
    <!-- /wp:shortcode -->

    </div>
    <!-- /wp:group -->

    </div>
    <!-- /wp:group -->

    <!-- wp:group {"className":"journal-category-nav-section"} -->
    <div class="wp-block-group journal-category-nav-section">

    <!-- wp:group {"className":"container"} -->
    <div class="wp-block-group container">

    <!-- wp:shortcode -->
    [facetbound_journal_category_nav]
    <!-- /wp:shortcode -->

    </div>
    <!-- /wp:group -->

    </div>
    <!-- /wp:group -->

    <!-- wp:group {"className":"journal-grid-section"} -->
    <div class="wp-block-group journal-grid-section">

    <!-- wp:group {"className":"container"} -->
    <div class="wp-block-group container">

    <!-- wp:shortcode -->
    [facetbound_journal_grid]
    <!-- /wp:shortcode -->

    </div>
    <!-- /wp:group -->

    </div>
    <!-- /wp:group -->

    <!-- wp:group {"className":"journal-newsletter"} -->
    <div class="wp-block-group journal-newsletter">

    <!-- wp:group {"className":"journal-newsletter-inner"} -->
    <div class="wp-block-group journal-newsletter-inner">

    <!-- wp:heading {"level":2} -->
    <h2>Join the Collector's Circle</h2>
    <!-- /wp:heading -->

    <!-- wp:paragraph -->
    <p>Get early access to our rarest raw gemstone drops and exclusive artisan stories directly to your inbox.</p>
    <!-- /wp:paragraph -->

    <!-- wp:html -->
    <form class="journal-newsletter-form" action="#" method="post"><input type="email" name="journal_newsletter_email" placeholder="Your email address" class="journal-newsletter-input" required><button type="submit" class="journal-newsletter-btn">Subscribe</button></form>
    <!-- /wp:html -->

    </div>
    <!-- /wp:group -->

    </div>
    <!-- /wp:group -->
    <?php
    return ob_get_clean();
}

add_action('admin_init', 'facetbound_seed_block_content');
function facetbound_seed_block_content() {
    if (get_option('facetbound_block_content_v1')) {
        return;
    }

    $map = [
        'home' => 'facetbound_home_block_content',
        'our-story' => 'facetbound_our_story_block_content',
        'sustainability' => 'facetbound_sustainability_block_content',
        'journal' => 'facetbound_journal_block_content',
    ];

    foreach ($map as $slug => $builder) {
        $page = get_page_by_path($slug);
        if ($page) {
            wp_update_post([
                'ID' => $page->ID,
                'post_content' => call_user_func($builder),
            ]);
        }
    }

    update_option('facetbound_block_content_v1', 1);
}
