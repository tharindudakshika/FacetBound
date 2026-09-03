<?php
/**
 * Template Name: Virtual Appointment
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

facetbound_hero([
    'min_height' => 480,
    'padding' => '100px',
    'caption' => 'gemologist inspecting a stone with a 10x loupe during a live Zoom consultation',
    'kicker' => '1-on-1 VIP Gem Concierge',
    'title' => 'Book a Virtual Consultation with Our Lead Gemologist',
    'subtitle' => 'Experience our Ratnapura studio from anywhere in the world. Inspect raw gemstones in natural light, discuss custom ring sizing, or craft a bespoke milestone keepsake.',
    'max_width' => 680,
    'cta' => [
        'text' => 'Schedule Your Private Session',
        'url' => '#booking',
    ],
]);

$appointment_status = isset($_GET['appointment']) ? sanitize_key(wp_unslash($_GET['appointment'])) : '';

$va_value_cards = [
    [
        'icon' => 'fa-solid fa-gem',
        'title' => 'Live Gem Inspection',
        'desc' => 'See your natural Spinel or Topaz stone held under natural Sri Lankan sunlight before it gets set into silver.',
    ],
    [
        'icon' => 'fa-solid fa-ruler',
        'title' => 'Perfect US Ring Fit',
        'desc' => "Unsure of your size? We guide you live step-by-step through our ring sizing chart to ensure a 100% precision fit.",
    ],
    [
        'icon' => 'fa-solid fa-hammer',
        'title' => 'Bespoke Custom Crafting',
        'desc' => 'Have a unique design or custom engraving idea? Co-create your ring texture and setting directly with our artisans.',
    ],
];

$va_steps = [
    [
        'title' => 'Select Your Time',
        'desc' => 'Pick a convenient date and time — our scheduling works around US, UK, and EU time zones.',
    ],
    [
        'title' => 'Tell Us Your Vision',
        'desc' => 'Fill out a quick form: your gem preference, ring style, or the milestone you\'re celebrating.',
    ],
    [
        'title' => 'Join the Live Session',
        'desc' => "We'll confirm your private Google Meet / Zoom link by email and meet your studio team live.",
    ],
];

// 30-minute slots across studio hours (Mon–Sat, 9 AM–6 PM IST).
$va_time_slots = [];
for ($va_minutes = 9 * 60; $va_minutes <= 17 * 60 + 30; $va_minutes += 30) {
    $va_time_slots[] = date('g:i A', mktime(0, $va_minutes));
}

$va_trust = [
    [
        'icon' => 'fa-solid fa-lock',
        'title' => '100% Private &amp; No Obligation',
        'desc' => 'No pressure to purchase simply by attending the session.',
    ],
    [
        'icon' => 'fa-solid fa-earth-americas',
        'title' => 'Global Time Zone Friendly',
        'desc' => 'We work around US, UK, EU, and AU time zones.',
    ],
    [
        'icon' => 'fa-solid fa-scroll',
        'title' => 'Certified Natural Gems Guaranteed',
        'desc' => 'Every stone comes with a Gemologist Authenticity Certificate.',
    ],
];
?>

<!-- Why Book a Virtual Session -->
<section class="va-value">
    <div class="container">
        <div class="section-head">
            <div class="kicker" style="text-align:center">Why Book a Virtual Session?</div>
            <h2>A Private Window Into Our Ratnapura Studio</h2>
        </div>
        <div class="va-value__grid">
            <?php foreach ($va_value_cards as $card) : ?>
                <div class="va-value-card">
                    <i class="<?php echo esc_attr($card['icon']); ?> va-value-card__icon"></i>
                    <p class="va-value-card__title"><?php echo esc_html($card['title']); ?></p>
                    <p class="va-value-card__desc"><?php echo esc_html($card['desc']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- How It Works -->
<section class="va-steps">
    <div class="container">
        <div class="section-head">
            <div class="kicker" style="text-align:center">How It Works</div>
            <h2>Three Steps to Your Private Session</h2>
        </div>
        <div class="va-steps__grid">
            <?php foreach ($va_steps as $step_index => $step) : ?>
                <div class="va-step">
                    <div class="va-step__number"><?php echo esc_html((string) ($step_index + 1)); ?></div>
                    <p class="va-step__title"><?php echo esc_html($step['title']); ?></p>
                    <p class="va-step__desc"><?php echo esc_html($step['desc']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Booking / Quick Intake Form -->
<section class="va-booking" id="booking">
    <div class="container va-booking__inner">
        <div class="section-head">
            <div class="kicker" style="text-align:center">Reserve Your Slot</div>
            <h2>Schedule Your Session</h2>
            <p class="section-head__body">Pick a preferred date and time, share a few details, and we'll confirm your private video link by email — typically within a few hours during studio hours (Mon&ndash;Sat, 9 AM&ndash;6 PM IST).</p>
        </div>

        <?php if ('success' === $appointment_status) : ?>
            <div class="contact-notice contact-notice--success">
                Thank you &mdash; your session request has been sent. We'll email you a confirmed time and video link shortly.
            </div>
        <?php elseif ('error' === $appointment_status) : ?>
            <div class="contact-notice contact-notice--error">
                Something went wrong sending your request. Please fill in all required fields and try again.
            </div>
        <?php endif; ?>

        <form class="contact-form va-booking__form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
            <input type="hidden" name="action" value="facetbound_appointment">
            <input type="hidden" id="appointment_timezone" name="appointment_timezone" value="">
            <?php wp_nonce_field('facetbound_appointment', 'facetbound_appointment_nonce'); ?>
            <div class="contact-form__honeypot" aria-hidden="true">
                <label for="facetbound_appointment_company">Company</label>
                <input type="text" id="facetbound_appointment_company" name="facetbound_appointment_company" tabindex="-1" autocomplete="off">
            </div>

            <div class="va-booking__row">
                <div class="contact-field">
                    <label for="appointment_name">Full Name</label>
                    <input type="text" id="appointment_name" name="appointment_name" placeholder="First &amp; Last Name" required>
                </div>
                <div class="contact-field">
                    <label for="appointment_email">Email Address</label>
                    <input type="email" id="appointment_email" name="appointment_email" placeholder="Email address" required>
                </div>
            </div>

            <div class="va-booking__row">
                <div class="contact-field">
                    <label for="appointment_date">Preferred Date</label>
                    <input type="date" id="appointment_date" name="appointment_date" required>
                </div>
                <div class="contact-field">
                    <label for="appointment_time">Preferred Time</label>
                    <select id="appointment_time" name="appointment_time" required>
                        <option value="">Select a time</option>
                        <?php foreach ($va_time_slots as $slot) : ?>
                            <option value="<?php echo esc_attr($slot); ?>"><?php echo esc_html($slot); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="contact-field">
                <label for="appointment_notes">Notes / Ideas</label>
                <textarea id="appointment_notes" name="appointment_notes" rows="4" placeholder="Tell us about your custom request or any questions you have"></textarea>
            </div>

            <button type="submit" class="btn btn-terracotta contact-form__submit">Request My Session</button>
        </form>
    </div>
</section>

<!-- Virtual Experience Testimonial -->
<section class="va-testimonial">
    <div class="container">
        <div class="va-testimonial-card">
            <?php facetbound_stars(5, 15); ?>
            <p class="va-testimonial-card__quote">&ldquo;I was hesitant about ordering a custom Spinel ring from Sri Lanka to London, but the virtual consultation changed everything. Seeing the gem in live sunlight made me order instantly!&rdquo;</p>
            <p class="va-testimonial-card__meta">Sarah M., UK &mdash; <span>Verified VIP Client</span></p>
        </div>
    </div>
</section>

<!-- Guarantee & Trust Banner -->
<section class="va-trust">
    <div class="container va-trust__grid">
        <?php foreach ($va_trust as $trust_item) : ?>
            <div class="va-trust-item">
                <i class="<?php echo esc_attr($trust_item['icon']); ?> va-trust-item__icon"></i>
                <div>
                    <p class="va-trust-item__title"><?php echo wp_kses_post($trust_item['title']); ?></p>
                    <p class="va-trust-item__desc"><?php echo esc_html($trust_item['desc']); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<script>
(function () {
    var input = document.getElementById('appointment_timezone');
    if (!input || typeof Intl === 'undefined' || !Intl.DateTimeFormat) {
        return;
    }
    try {
        input.value = Intl.DateTimeFormat().resolvedOptions().timeZone || '';
    } catch (e) {
        input.value = '';
    }
})();
</script>

<?php
facetbound_concierge_cta();
get_footer();
