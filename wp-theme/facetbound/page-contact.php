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
    'kicker' => "We're Here to Help",
    'title' => 'Questions About Sizing, Custom Engraving, or Your Milestone Order?',
    'subtitle' => 'Whether fine-tuning your fit or crafting a bespoke piece of Sri Lankan earth, our team is here to assist your personal journey.',
    'max_width' => 640,
]);

$contact_status = isset($_GET['contact']) ? sanitize_key(wp_unslash($_GET['contact'])) : '';

$contact_email_groups = [
    [
        'title' => 'General & Customer Support',
        'email' => 'hello@facetbound.com',
        'note' => 'Order tracking, ring size inquiries',
    ],
    [
        'title' => 'VIP & Custom Gem Sourcing',
        'email' => 'concierge@facetbound.com',
        'note' => 'Custom orders, rare spinel drops',
    ],
];

$contact_social_links = [
    ['icon' => 'fa-instagram', 'label' => '@facetbound.jewelry', 'url' => '#'],
    ['icon' => 'fa-facebook-f', 'label' => 'Facebook', 'url' => '#'],
    ['icon' => 'fa-pinterest-p', 'label' => 'Pinterest', 'url' => '#'],
];

$contact_subjects = ['General Inquiry', 'Order Support', 'VIP & Custom Gem Sourcing', 'Press & Partnerships', 'Other'];

$contact_faqs = [
    [
        'question' => 'How long does international delivery take via DHL/FedEx?',
        'answer' => 'Orders ship free within 5–7 business days via fully insured DHL or FedEx express courier, with a tracking number sent the moment your parcel leaves the studio.',
    ],
    [
        'question' => 'What if I order the wrong ring size?',
        'answer' => "We offer an easy 30-day size exchange — just reach out via WhatsApp or the form above with your order number, and we'll arrange a free resize or replacement.",
    ],
    [
        'question' => 'Do your gems come with authenticity certificates?',
        'answer' => "Yes — every piece includes a Gemologist Authenticity Certificate confirming your stone's natural origin, cut, and carat weight.",
    ],
];
?>

<section class="contact-section">
    <div class="container contact-grid">
        <div class="contact-info">
            <div class="contact-info__group">
                <div class="kicker">Email Assistance</div>
                <?php foreach ($contact_email_groups as $group) : ?>
                    <div class="contact-info__row">
                        <i class="fa-solid fa-envelope contact-info__icon"></i>
                        <div>
                            <div class="contact-info__title"><?php echo esc_html($group['title']); ?></div>
                            <a class="contact-info__link" href="<?php echo esc_url('mailto:' . $group['email']); ?>"><?php echo esc_html($group['email']); ?></a>
                            <div class="contact-info__note"><?php echo esc_html($group['note']); ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="contact-info__group">
                <div class="kicker">Studio &amp; Workshop</div>
                <div class="contact-info__row">
                    <i class="fa-solid fa-location-dot contact-info__icon"></i>
                    <div>
                        <div class="contact-info__title">Ratnapura / Colombo, Sri Lanka</div>
                        <div class="contact-info__note">Our gems are selected at the pit and set by Sri Lankan artisans in our own workshop &mdash; not sourced through a warehouse.</div>
                    </div>
                </div>
            </div>

            <div class="contact-info__group">
                <div class="kicker">Operating Hours</div>
                <div class="contact-info__row">
                    <i class="fa-solid fa-clock contact-info__icon"></i>
                    <div>
                        <div class="contact-info__title">Monday &ndash; Saturday &middot; 9:00 AM &ndash; 6:00 PM</div>
                        <div class="contact-info__note">IST / GMT +5:30</div>
                        <div class="contact-info__note">We reply to all international inquiries within 12 hours.</div>
                    </div>
                </div>
            </div>

            <div class="contact-info__group contact-info__group--last">
                <div class="kicker">Follow the Studio</div>
                <?php foreach ($contact_social_links as $social) : ?>
                    <a class="contact-info__social" href="<?php echo esc_url($social['url']); ?>">
                        <span class="contact-info__social-icon"><i class="fa-brands <?php echo esc_attr($social['icon']); ?>"></i></span>
                        <?php echo esc_html($social['label']); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="contact-form-card">
            <h2 class="contact-heading">Send Us a Message</h2>

            <?php if ('success' === $contact_status) : ?>
                <div class="contact-notice contact-notice--success">
                    Thank you &mdash; your message has been sent. We'll get back to you within 24 hours.
                </div>
            <?php elseif ('error' === $contact_status) : ?>
                <div class="contact-notice contact-notice--error">
                    Something went wrong sending your message. Please fill in all required fields.
                </div>
            <?php endif; ?>

            <form class="contact-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                <input type="hidden" name="action" value="facetbound_contact">
                <?php wp_nonce_field('facetbound_contact', 'facetbound_contact_nonce'); ?>
                <div class="contact-form__honeypot" aria-hidden="true">
                    <label for="facetbound_contact_company">Company</label>
                    <input type="text" id="facetbound_contact_company" name="facetbound_contact_company" tabindex="-1" autocomplete="off">
                </div>

                <div class="contact-field">
                    <label for="contact_name">Full Name</label>
                    <input type="text" id="contact_name" name="contact_name" placeholder="First &amp; Last Name" required>
                </div>

                <div class="contact-field">
                    <label for="contact_email">Email Address</label>
                    <input type="email" id="contact_email" name="contact_email" placeholder="Email address" required>
                </div>

                <div class="contact-field">
                    <label for="contact_subject">Subject</label>
                    <select id="contact_subject" name="contact_subject">
                        <?php foreach ($contact_subjects as $subject) : ?>
                            <option value="<?php echo esc_attr($subject); ?>"><?php echo esc_html($subject); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="contact-field">
                    <label for="contact_message">Message</label>
                    <textarea id="contact_message" name="contact_message" rows="6" placeholder="How can we help you today?" required></textarea>
                </div>

                <button type="submit" class="btn btn-terracotta contact-form__submit">Send Message</button>
            </form>
        </div>
    </div>
</section>

<!-- WhatsApp VIP Concierge -->
<section class="contact-whatsapp">
    <div class="container">
        <div class="contact-whatsapp__card">
            <div class="contact-whatsapp__text">
                <div class="kicker">WhatsApp VIP Concierge</div>
                <h2 class="contact-whatsapp__title">Need Quick Guidance on Sizing or Custom Milestone Orders?</h2>
                <p class="contact-whatsapp__body">Connect directly with our lead gemologist to fine-tune your fit or craft a custom piece &mdash; typical response inside studio hours is under an hour.</p>
            </div>
            <a
                class="btn btn-emerald contact-whatsapp__btn"
                href="https://wa.me/?text=<?php echo esc_attr(rawurlencode('Hi! I have a sizing or custom order question.')); ?>"
                target="_blank"
                rel="noopener noreferrer"
            >
                <i class="fa-brands fa-whatsapp"></i> Chat with Lead Gemologist
            </a>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="contact-faq">
    <div class="container">
        <div class="section-head">
            <div class="kicker" style="text-align:center">Before You Write</div>
            <h2>Frequently Asked Questions</h2>
        </div>
        <div class="faq-list">
            <?php foreach ($contact_faqs as $faq_index => $faq) : ?>
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
    </div>
</section>

<?php facetbound_concierge_cta(); ?>

<?php get_footer(); ?>
