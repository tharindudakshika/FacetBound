<?php
/**
 * Template Name: Contact
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

facetbound_hero([
    'min_height' => 260,
    'padding' => '56px',
    'title' => 'Contact Us',
    'subtitle' => "Questions about sizing, custom engraving, or an order? We're here to help.",
    'max_width' => 640,
]);

$contact_status = isset($_GET['contact']) ? sanitize_key(wp_unslash($_GET['contact'])) : '';
$whatsapp_text = rawurlencode("Hi! I have a question about Facetbound.");
?>

<section class="contact-section">
    <div class="container contact-grid">
        <div class="contact-form-wrap">
            <h2 class="contact-heading">Send a Message</h2>

            <?php if ('success' === $contact_status) : ?>
                <div class="contact-notice contact-notice--success">
                    Thank you &mdash; your message has been sent. We'll get back to you within 24 hours.
                </div>
            <?php elseif ('error' === $contact_status) : ?>
                <div class="contact-notice contact-notice--error">
                    Something went wrong sending your message. Please fill in all required fields, or reach us directly on WhatsApp below.
                </div>
            <?php endif; ?>

            <form class="contact-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                <input type="hidden" name="action" value="facetbound_contact">
                <?php wp_nonce_field('facetbound_contact', 'facetbound_contact_nonce'); ?>
                <div class="contact-form__honeypot" aria-hidden="true">
                    <label for="facetbound_contact_company">Company</label>
                    <input type="text" id="facetbound_contact_company" name="facetbound_contact_company" tabindex="-1" autocomplete="off">
                </div>

                <div class="contact-form__row">
                    <div class="contact-field">
                        <label for="contact_name">Name <span class="contact-field__required">*</span></label>
                        <input type="text" id="contact_name" name="contact_name" required>
                    </div>
                    <div class="contact-field">
                        <label for="contact_email">Email <span class="contact-field__required">*</span></label>
                        <input type="email" id="contact_email" name="contact_email" required>
                    </div>
                </div>

                <div class="contact-field">
                    <label for="contact_subject">Subject</label>
                    <input type="text" id="contact_subject" name="contact_subject" placeholder="e.g. Ring size exchange, order #1024">
                </div>

                <div class="contact-field">
                    <label for="contact_message">Message <span class="contact-field__required">*</span></label>
                    <textarea id="contact_message" name="contact_message" rows="6" required></textarea>
                </div>

                <button type="submit" class="btn btn-terracotta contact-form__submit">Send Message</button>
            </form>
        </div>

        <div class="contact-info">
            <h2 class="contact-heading">Other Ways to Reach Us</h2>
            <p class="contact-info__body">
                For urgent sizing or order questions, WhatsApp is the fastest way to reach our concierge team directly.
            </p>

            <a
                class="btn btn-emerald contact-info__whatsapp"
                href="https://wa.me/?text=<?php echo esc_attr($whatsapp_text); ?>"
                target="_blank"
                rel="noopener noreferrer"
            >
                <i class="fa-brands fa-whatsapp"></i> Chat on WhatsApp
            </a>

            <a class="contact-info__email" href="<?php echo esc_url('mailto:' . get_option('admin_email')); ?>">
                <i class="fa-solid fa-envelope"></i> <?php echo esc_html(get_option('admin_email')); ?>
            </a>

            <div class="contact-info__hours">
                <div class="contact-info__hours-label">Response Time</div>
                <p>We typically reply within 24 hours, Monday&ndash;Saturday.</p>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
