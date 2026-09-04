<?php
/**
 * Template Name: FAQ
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

facetbound_hero([
    'min_height' => 260,
    'padding' => '56px',
    'kicker' => 'Help Center',
    'title' => 'Frequently Asked Questions',
    'subtitle' => 'Everything you need to know about our gemstones, sizing, shipping, and care — in one place.',
    'max_width' => 640,
]);

// Content to be supplied and populated in a follow-up edit.
$page_faqs = [];
?>

<section class="contact-faq">
    <div class="container">
        <?php if ($page_faqs) : ?>
            <div class="faq-list">
                <?php foreach ($page_faqs as $faq_index => $faq) : ?>
                    <div class="faq-item<?php echo 0 === $faq_index ? ' faq-item--open' : ''; ?>">
                        <button type="button" class="faq-question" aria-expanded="<?php echo 0 === $faq_index ? 'true' : 'false'; ?>" aria-controls="faq-answer-<?php echo (int) $faq_index; ?>">
                            <span><?php echo esc_html($faq['question']); ?></span>
                            <i class="fa-solid <?php echo 0 === $faq_index ? 'fa-minus' : 'fa-plus'; ?> faq-icon" aria-hidden="true"></i>
                        </button>
                        <div class="faq-answer" id="faq-answer-<?php echo (int) $faq_index; ?>">
                            <p><?php echo esc_html($faq['answer']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <p style="text-align:center;color:var(--slate-text)">Our full FAQ list is being finalized — check back soon, or reach out via the <a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact page</a> in the meantime.</p>
        <?php endif; ?>
    </div>
</section>

<?php
facetbound_concierge_cta();
get_footer();
