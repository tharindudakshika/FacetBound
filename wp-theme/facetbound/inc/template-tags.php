<?php
/**
 * Small reusable output helpers shared across templates — PHP equivalents
 * of the React <Placeholder>, star rating, and <ConciergeCTA> components.
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Striped placeholder-image block. Mirrors src/components/Placeholder.jsx.
 * variant: light | dark | darker | terra-dark | warm
 */
function facetbound_placeholder($variant, $caption = '', $args = []) {
    $boxed = !empty($args['boxed']);
    $class = trim('ph ph-' . $variant . ' ' . ($boxed ? 'ph-boxed' : '') . ' ' . ($args['class'] ?? ''));
    $style = '';
    if (!empty($args['style'])) {
        $style = ' style="' . esc_attr($args['style']) . '"';
    }
    printf('<div class="%s"%s>', esc_attr($class), $style);
    if ($caption) {
        printf('<div class="ph-caption">[ %s ]</div>', esc_html($caption));
    }
    echo '</div>';
}

function facetbound_stars($count = 5, $size = 14) {
    echo '<div class="stars">';
    for ($i = 0; $i < $count; $i++) {
        printf('<i class="fa-solid fa-star" style="font-size:%dpx"></i>', (int) $size);
    }
    echo '</div>';
}

/**
 * The "Collector Concierge" CTA block. Mirrors src/components/ConciergeCTA.jsx.
 * Appears on Home, Shop, Product, Checkout, My Account — not Our Story.
 */
function facetbound_concierge_cta() {
    ?>
    <section class="concierge">
        <div class="concierge__inner">
            <div class="kicker">Collector Concierge</div>
            <h2>Need a Adjustment, Custom Engraving, or Milestone Query?</h2>
            <p class="concierge__desc">Whether crafting a bespoke piece to commemorate a milestone or fine-tuning your fit, our lead gemologist is here to help.</p>
            <div class="concierge__buttons">
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-terracotta">
                    <i class="fa-solid fa-envelope"></i> Contact Lead Gemologist
                </a>
                <a href="https://wa.me/?text=<?php echo rawurlencode('Hi! I have a sizing or engraving question.'); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-emerald">
                    <i class="fa-brands fa-whatsapp" style="font-size:16px"></i> Chat on WhatsApp
                </a>
            </div>
            <a href="#" class="concierge__link">
                <i class="fa-solid fa-download" style="font-size:12px"></i> Download Silver Care &amp; Polishing Guide
            </a>
        </div>
    </section>
    <?php
}

/**
 * Shared dark hero pattern. Mirrors src/components/Hero.jsx.
 */
function facetbound_hero($args) {
    $min_height = $args['min_height'] ?? 420;
    $padding = $args['padding'] ?? '80px';
    $caption = $args['caption'] ?? '';
    $kicker = $args['kicker'] ?? '';
    $title = $args['title'] ?? '';
    $subtitle = $args['subtitle'] ?? '';
    $max_width = $args['max_width'] ?? 640;
    ?>
    <section class="fb-hero" style="min-height:<?php echo (int) $min_height; ?>px">
        <div class="fb-hero__media">
            <?php facetbound_placeholder('dark', '', []); ?>
            <div class="fb-hero__scrim"></div>
        </div>
        <?php if ($caption) : ?>
            <div class="fb-hero__caption">[ <?php echo esc_html($caption); ?> ]</div>
        <?php endif; ?>
        <div class="container fb-hero__content" style="padding:<?php echo esc_attr($padding); ?> var(--section-x)">
            <div style="max-width:<?php echo (int) $max_width; ?>px">
                <?php if ($kicker) : ?>
                    <div class="kicker"><?php echo esc_html($kicker); ?></div>
                <?php endif; ?>
                <h1 class="fb-hero__title"><?php echo wp_kses_post($title); ?></h1>
                <?php if ($subtitle) : ?>
                    <p class="fb-hero__subtitle"><?php echo esc_html($subtitle); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php
}

function facetbound_read_time($post_id) {
    $custom = get_post_meta($post_id, 'facetbound_read_time', true);
    return $custom ?: '5 min read';
}
