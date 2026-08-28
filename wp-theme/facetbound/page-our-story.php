<?php
/**
 * Template Name: Our Story
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

facetbound_hero([
    'min_height' => 600,
    'padding' => '120px',
    'caption' => "cinematic close-up: raw gemstone from pit + hand-polished silver ring",
    'kicker' => "Our Heritage &amp; Origins",
    'title' => "Unearthing Sri Lanka&rsquo;s Earth. Shaping Timeless Art.",
    'subtitle' => "The story of how raw natural crystals from ancient riverbeds are handcrafted into modern 925 sterling silver keepsakes — designed to commemorate life’s most cherished milestones.",
    'max_width' => 660,
]);
?>

<!-- The Genesis -->
<section class="story-genesis">
    <div class="container story-genesis-grid">
        <?php facetbound_placeholder('light', "pit mining scene / gemstone market in Ratnapura", ['boxed' => true, 'style' => 'border-radius:14px;min-height:420px']); ?>
        <div>
            <div class="kicker">The Genesis</div>
            <h2>Sri Lanka Has Been the Realm of the World&rsquo;s Finest Gemstones for Centuries.</h2>
            <p>
                Facetbound was founded to offer the world handcrafted 925 sterling silver rings that preserve
                the unique character, raw beauty, and soul of each natural Sri Lankan crystal. Standing as an
                authentic alternative to mass-produced, identical jewelry, every piece is shaped to commemorate
                life&rsquo;s most meaningful personal milestones.
            </p>
        </div>
    </div>
</section>

<!-- Raw & Refined Philosophy -->
<section class="story-philosophy">
    <div class="container">
        <div class="story-philosophy-head">
            <div class="kicker">Our Philosophy</div>
            <h2>Raw &amp; Refined</h2>
        </div>
        <div class="story-philosophy-grid">
            <div class="story-card">
                <div class="kicker">The Raw</div>
                <h3>Earth&rsquo;s Natural State</h3>
                <p>
                    A natural gemstone is a creation forged over millions of years under extreme terrestrial
                    pressure and heat. Because of this, every single stone is 100% unique &mdash; carrying its
                    own natural character to commemorate your special occasion.
                </p>
            </div>
            <div class="story-card">
                <div class="kicker">The Refined</div>
                <h3>Artisanal Craftsmanship</h3>
                <p>
                    Local artisan silversmiths bring each raw stone to life using hand-hammered or tree bark
                    textures in solid 925 sterling silver, tailored to fit its natural shape &mdash; creating a
                    timeless keepsake to mark your personal milestone.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Ethical Sourcing -->
<section class="story-ethics">
    <div class="container">
        <div class="story-ethics-box">
            <div class="kicker">Sustainability</div>
            <h2>Ethical Sourcing &amp; Fair Trade</h2>
            <div class="story-ethics-points">
                <div class="story-ethics-point">
                    <h4>No Mass Mining</h4>
                    <p>
                        Utilizing strictly ethical sourcing methods that protect the environment and ensure fair
                        wages for local miners.
                    </p>
                </div>
                <div class="story-ethics-point">
                    <h4>Authenticity Guaranteed</h4>
                    <p>
                        Every ring is delivered with a Gemological Authenticity Certificate and a tag signed by the
                        artisan.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Meet the Artisans -->
<section class="story-artisans">
    <?php facetbound_placeholder('darker', "close-up: silversmith's hands hammering silver", ['boxed' => true, 'style' => 'min-height:440px']); ?>
    <div class="story-artisans-copy">
        <div class="kicker">Meet the Artisans</div>
        <h2>A Human Touch, in Every Setting</h2>
        <p>
            Every Facetbound piece carries a human touch. No machines, no factory lines &mdash; just dedicated
            master craftsmen in Sri Lanka pouring their soul into every texture and setting.
        </p>
    </div>
</section>

<!-- Earth-Conscious Packaging -->
<section class="story-packaging">
    <div class="container story-packaging-grid">
        <div>
            <div class="kicker">Unboxing</div>
            <h2>Our packaging is completely plastic-free.</h2>
            <p>
                The moment you open the box, the scent of rain-soaked earth (Mitti Attar) immerses you in the
                authentic experience of a Sri Lankan gemstone mine.
            </p>
        </div>
        <?php facetbound_placeholder('terra-dark', "octagonal emerald wooden box, terracotta board inserts, mitti attar", ['boxed' => true, 'style' => 'min-height:400px']); ?>
    </div>
</section>

<!-- CTA -->
<section class="story-cta">
    <h2>Find the Piece That Speaks to You</h2>
    <div class="story-cta-buttons">
        <a href="<?php echo esc_url(function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop/')); ?>" class="btn btn-terracotta">
            Explore Collections
        </a>
        <a href="<?php echo esc_url(home_url('/sustainability/')); ?>" class="btn btn-outline-terracotta">
            Read Our Ethics
        </a>
    </div>
</section>

<?php get_footer(); ?>
