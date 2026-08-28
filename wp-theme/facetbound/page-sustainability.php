<?php
/**
 * Template Name: Sustainability
 */

if (!defined('ABSPATH')) {
    exit;
}

$facetbound_sourcing_rows = [
    [
        'icon' => 'fa-solid fa-hand-holding-heart',
        'title' => 'Direct Mine-to-Hand',
        'desc' => "Sourcing natural Spinel gemstones directly from Sri Lanka's traditional miners without intermediaries.",
    ],
    [
        'icon' => 'fa-solid fa-water',
        'title' => 'No Industrial Mass Mining',
        'desc' => 'Using strictly traditional, artisanal small-scale mining methods that prevent environmental and river damage.',
    ],
    [
        'icon' => 'fa-solid fa-gem',
        'title' => 'Untreated Natural Spinels',
        'desc' => 'Utilizing exclusively 100% natural Spinels with zero artificial heat or chemical treatments.',
    ],
];

$facetbound_artisan_blocks = [
    [
        'title' => 'Fair Wages & Respect',
        'desc' => 'Providing fair trade wages and proper compensation to local silversmiths and lapidaries.',
    ],
    [
        'title' => 'Preserving Heritage',
        'desc' => 'Showcasing the generational artisanal heritage of Sri Lankan silversmiths to an international audience.',
    ],
];

$facetbound_packaging_cards = [
    [
        'icon' => 'fa-solid fa-box',
        'title' => 'Octagonal Teak Wood Box',
        'desc' => 'Reusable octagonal boxes crafted from local teak wood, replacing traditional plastic boxes to provide a lifetime keepsake for your milestone ring.',
    ],
    [
        'icon' => 'fa-solid fa-droplet',
        'title' => 'Terracotta & Natural Scent',
        'desc' => 'Natural terracotta board and pure Mitti Attar fragrance (the scent of rain-soaked earth), replacing plastic foam inserts with authentic Sri Lankan elements.',
    ],
    [
        'icon' => 'fa-solid fa-leaf',
        'title' => 'Honeycomb Kraft Wrap',
        'desc' => '100% biodegradable hexagonal paper wrap for secure courier shipping, eliminating single-use plastic bubble wrap completely.',
    ],
];

get_header();

facetbound_hero([
    'min_height' => 520,
    'padding' => '110px',
    'caption' => "hero image: Ratnapura mine landscape + raw Spinel crystal macro",
    'title' => "Ethically Sourced. Earth Consciously Crafted.",
    'subtitle' => "Our commitment to Sri Lanka's heritage, local artisans, and zero-plastic sustainability.",
    'max_width' => 660,
]);
?>

<!-- Ethical Gem Sourcing -->
<section class="sustain-sourcing">
    <div class="container sustain-sourcing__grid">
        <?php facetbound_placeholder('light', "selecting stones from local miners, Ratnapura gem pit", ['boxed' => true, 'style' => 'border-radius:14px;min-height:440px']); ?>
        <div>
            <div class="kicker">Sourcing</div>
            <h2 class="sustain-sourcing__title">Ethical Gem Sourcing</h2>
            <div class="sustain-rows">
                <?php foreach ($facetbound_sourcing_rows as $row) : ?>
                    <div class="sustain-row">
                        <i class="<?php echo esc_attr($row['icon']); ?> sustain-row__icon"></i>
                        <div>
                            <p class="sustain-row__title"><?php echo esc_html($row['title']); ?></p>
                            <p class="sustain-row__desc"><?php echo esc_html($row['desc']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- Artisan Fair Trade -->
<section class="sustain-artisan">
    <div class="sustain-artisan__grid">
        <?php facetbound_placeholder('darker', "close-up: silversmith handcrafting a ring", ['boxed' => true, 'style' => 'min-height:480px']); ?>
        <div class="sustain-artisan__copy">
            <div>
                <div class="kicker">Fair Trade</div>
                <h2 class="sustain-artisan__title">Artisan Fair Trade &amp; Craftsmanship</h2>
            </div>
            <div class="sustain-artisan__blocks">
                <?php foreach ($facetbound_artisan_blocks as $block) : ?>
                    <div class="sustain-artisan__block">
                        <p class="sustain-artisan__block-title"><?php echo esc_html($block['title']); ?></p>
                        <p class="sustain-artisan__block-desc"><?php echo esc_html($block['desc']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- 100% Plastic-Free Packaging -->
<section class="sustain-packaging">
    <div class="container">
        <div class="sustain-packaging__head">
            <div class="kicker">Packaging</div>
            <h2 class="sustain-packaging__title">100% Plastic-Free Packaging</h2>
            <p class="sustain-packaging__desc">Designed to safely deliver and honor your most cherished milestones, every order is presented in 100% plastic-free, sustainably crafted packaging.</p>
        </div>
        <?php facetbound_placeholder('light', "flat-lay: octagonal wooden box, terracotta board, honeycomb paper wrap", ['boxed' => true, 'style' => 'border-radius:16px;height:380px;margin-bottom:32px']); ?>
        <div class="sustain-packaging__grid">
            <?php foreach ($facetbound_packaging_cards as $card) : ?>
                <div class="sustain-card">
                    <i class="<?php echo esc_attr($card['icon']); ?> sustain-card__icon"></i>
                    <p class="sustain-card__title"><?php echo esc_html($card['title']); ?></p>
                    <p class="sustain-card__desc"><?php echo esc_html($card['desc']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Sustainability Promise -->
<section class="sustain-promise">
    <div class="sustain-promise__box">
        <div class="kicker sustain-promise__kicker">Our Sustainability Promise</div>
        <p class="sustain-promise__text">
            Every FACETBOUND ring comes with a Gemological Authenticity Card certifying that your piece is 100%
            natural, ethically mined in Sri Lanka, and packaged without a single grain of single use plastic
            &mdash; creating a conflict free keepsake to commemorate life&rsquo;s most cherished milestones.
        </p>
    </div>
</section>

<!-- Closing CTA -->
<section class="sustain-cta">
    <div class="kicker" style="text-align:center">Committed to the Earth</div>
    <h2 class="sustain-cta__title">Wear Jewelry with a Soul</h2>
    <p class="sustain-cta__desc">Choose 100% ethically sourced Sri Lankan earth set in solid 925 sterling silver &mdash; presented in plastic-free packaging to honor your most cherished milestones.</p>
    <a href="<?php echo esc_url(function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop/')); ?>" class="btn btn-terracotta">
        Explore Ethical Gem Collections
    </a>
</section>

<?php get_footer(); ?>
