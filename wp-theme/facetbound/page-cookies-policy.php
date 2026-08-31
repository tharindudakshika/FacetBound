<?php
/**
 * Template Name: Cookies Policy
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

facetbound_hero([
    'min_height' => 260,
    'padding' => '56px',
    'kicker' => 'Transparency First',
    'title' => 'Cookies Policy',
    'subtitle' => 'How we use cookies to secure, personalize, and improve your shopping experience.',
    'max_width' => 640,
]);
?>

<section class="policy-page">
    <div class="container policy-page__inner">

        <div class="policy-meta">
            <p><strong>Effective Date:</strong> August 31, 2026</p>
            <p><strong>Brand:</strong> FACETBOUND (Mined by Nature, Shaped by Hand)</p>
            <p><strong>Primary Contact:</strong> <a href="mailto:hello@facetbound.com">hello@facetbound.com</a></p>
        </div>

        <h2>What Are Cookies?</h2>
        <p>At FACETBOUND, we believe in complete transparency regarding how we handle your data and digital interactions. Cookies are small text files placed on your computer, smartphone, or device when you browse our website. They allow our online store to remember your preferences, secure your shopping cart, and personalize your experience while collecting raw gemstone heirlooms.</p>

        <h2>1. Types of Cookies We Use</h2>
        <p>We utilize four primary categories of cookies across our e-commerce platform:</p>

        <h3>A. Essential / Strictly Necessary Cookies</h3>
        <p>These cookies are required for the basic technical operation of our website. Without them, core functions such as maintaining your active cart session, saving currency preferences, and executing encrypted payment checkouts via PayHere Payment Gateway cannot function.</p>

        <h3>B. Analytics &amp; Performance Cookies</h3>
        <p>These cookies collect anonymized information on how visitors navigate our site (e.g., page views, traffic sources, and popular ring collections). We use services like Google Analytics to analyze site performance and continuously enhance our user journey.</p>

        <h3>C. Marketing &amp; Advertising Cookies</h3>
        <p>These cookies track your browsing habits to deliver tailored advertisements on platforms such as Meta (Facebook/Instagram) and Pinterest. They ensure you see relevant FACETBOUND gemstone drops and milestone collection updates rather than irrelevant ads.</p>

        <h3>D. Functional Cookies</h3>
        <p>Functional cookies allow our website to remember your chosen settings, such as your country location and preferred display currency (LKR for Sri Lanka, USD for International), ensuring a seamless experience every time you return.</p>

        <h2>2. Third-Party Services Operating Cookies</h2>
        <p>To deliver a secure global D2C export experience, FACETBOUND partners with trusted third-party service providers who may also set cookies on your browser:</p>
        <ul>
            <li><strong>PayHere Payment Gateway:</strong> Secure payment authentication &amp; fraud prevention.</li>
            <li><strong>Google Analytics:</strong> Website performance and visitor behavior insights.</li>
            <li><strong>Meta Pixel &amp; Pinterest Tag:</strong> Personalized social media marketing and ad tracking.</li>
            <li><strong>DHL Express &amp; FedEx Integration Widgets:</strong> Real-time shipment tracking functionality.</li>
        </ul>

        <h2>3. Managing Your Cookie Preferences &amp; Consent</h2>
        <p>When you first visit FACETBOUND, you will encounter our Cookie Consent Banner. You have full control over your digital footprint:</p>
        <ul>
            <li><strong>Cookie Consent Banner:</strong> You can choose to Accept All cookies or Decline/Reject non-essential (Analytics &amp; Marketing) cookies at any time.</li>
            <li><strong>Browser Settings:</strong> You can modify your internet browser settings (Google Chrome, Safari, Mozilla Firefox, Microsoft Edge) to refuse or clear existing cookies. Please note that disabling essential cookies may impact your ability to place an order or complete checkout on our platform.</li>
        </ul>

        <h2>4. Direct Privacy Questions &amp; Privacy Policy Link</h2>
        <p>If you have any questions, concerns, or inquiries regarding your data privacy, cookie preferences, or data security, our concierge team is available to help immediately.</p>
        <ul>
            <li><strong>Direct Privacy Support:</strong> Contact us directly via Email or WhatsApp for instant privacy inquiries.</li>
            <li><strong>Email:</strong> <a href="mailto:hello@facetbound.com">hello@facetbound.com</a></li>
            <li><strong>Full Privacy Details:</strong> To learn more about how we collect, store, and protect your personal data, please read our full <a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>">Privacy Policy</a>.</li>
        </ul>

    </div>
</section>

<?php
facetbound_concierge_cta();
get_footer();
