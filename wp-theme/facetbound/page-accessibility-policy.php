<?php
/**
 * Template Name: Accessibility Policy
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

facetbound_hero([
    'min_height' => 260,
    'padding' => '56px',
    'kicker' => 'Digital Accessibility',
    'title' => 'Website Accessibility Statement',
    'subtitle' => 'Fostering inclusivity, diversity, and accessibility in every part of the Facetbound experience.',
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

        <h2>Our Commitment to Digital Accessibility</h2>
        <p>At FACETBOUND, we are dedicated to fostering inclusivity, diversity, and accessibility in every aspect of our artisan jewelry experience. We believe that every individual&mdash;regardless of visual, auditory, cognitive, or motor abilities&mdash;should be able to effortlessly explore our handcrafted Sri Lankan gemstone collections and navigate our online space with dignity and ease.</p>

        <h2>Conformance Standard &amp; Goals</h2>
        <p>We strive to align our website performance with the Web Content Accessibility Guidelines (WCAG) 2.1 Level AA standards and comply with the Americans with Disabilities Act (ADA) requirements. These guidelines outline best practices to make digital content accessible for individuals with disabilities and user-friendly for everyone.</p>

        <h2>Key Accessibility Features Built Into Our Website</h2>
        <p>To ensure a seamless shopping journey for all collectors, our website incorporates the following design and technical measures:</p>
        <ul>
            <li><strong>Screen Reader Compatibility:</strong> Structural HTML tags, ARIA attributes, and detailed alternative text (Alt Text) are implemented across product images, raw gemstone shots, and navigational elements.</li>
            <li><strong>Keyboard Navigation:</strong> Our online store can be navigated seamlessly using only a keyboard (via Tab, Shift+Tab, and Enter keys) without getting trapped in interactive elements.</li>
            <li><strong>Color Contrast &amp; Visual Legibility:</strong> Designed using our signature high-contrast palette&mdash;including Deep Emerald Green (<code>#0F2E23</code>), Muted Terracotta (<code>#C88A75</code>), and Bright Sterling (<code>#E2E8F0</code>)&mdash;to ensure high visibility and readable text contrast ratios.</li>
            <li><strong>Clean Typography Hierarchy:</strong> Utilizing crisp, highly readable Google Fonts (Playfair Display for headers and Montserrat/Inter for body descriptions) that resize clearly across desktop and mobile displays.</li>
            <li><strong>Responsive Layouts:</strong> Our site adapts dynamically to zoom controls, custom font adjustments, and screen rotation without breaking the site structure or hiding essential purchase options.</li>
        </ul>

        <h2>Third-Party Features &amp; External Gateways</h2>
        <p>While we strive to ensure that all pages under our direct control meet strict accessibility standards, our website integrates third-party tools to facilitate secure global operations:</p>
        <ul>
            <li>PayHere Payment Gateway &amp; Express Checkouts</li>
            <li>DHL &amp; FedEx Logistics Tracking Widgets</li>
        </ul>
        <p>Please note that certain elements provided by these third-party services are outside our direct development control. However, we continuously work with our software partners to advocate for maximum accessibility compliance across all checkout portals.</p>

        <h2>Immediate Support &amp; Assistance Guarantee</h2>
        <p>If you experience any difficulty accessing content, navigating a collection page, or completing a checkout due to a disability, our dedicated team is here to assist you immediately.</p>
        <ul>
            <li><strong>Response Guarantee:</strong> We treat accessibility inquiries with maximum urgency. Our Concierge team will respond to your accessibility feedback within 1 hour during active studio hours.</li>
        </ul>

        <p><strong>Contact Our Accessibility Support Team:</strong></p>
        <ul>
            <li><strong>Email:</strong> <a href="mailto:hello@facetbound.com">hello@facetbound.com</a></li>
            <li><strong>WhatsApp VIP Concierge:</strong> Direct 1-on-1 assistance with our Lead Gemologist</li>
            <li><strong>Studio Hours:</strong> Monday &ndash; Saturday | 9:00 AM &ndash; 6:00 PM (IST / GMT +5:30)</li>
        </ul>

        <p>If you encounter an issue, please specify the web page URL and the exact nature of the problem so we can resolve it for you without delay.</p>

    </div>
</section>

<?php
facetbound_concierge_cta();
get_footer();
