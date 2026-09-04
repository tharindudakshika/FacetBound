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

$faq_categories = [
    [
        'slug' => 'general',
        'title' => 'General',
        'items' => [
            [
                'question' => 'What makes FACETBOUND jewelry unique?',
                'answer' => 'FACETBOUND combines 100% natural, ethically sourced Sri Lankan gemstones with artisan-textured 925 sterling silver. Every piece is individually handcrafted, ensuring no two rings are identical.',
            ],
            [
                'question' => 'Where are your gemstones sourced and crafted?',
                'answer' => 'Our gemstones are ethically sourced straight from the riverbeds and mines of Ratnapura, Sri Lanka, and handcrafted by local master silversmiths.',
            ],
            [
                'question' => 'How can I contact customer concierge for urgent order help?',
                'answer' => 'You can reach our Concierge team instantly via Email at hello@facetbound.com or via our WhatsApp VIP Concierge. We respond within 12 hours.',
            ],
        ],
    ],
    [
        'slug' => 'warranty-authenticity',
        'title' => 'Warranty &amp; Authenticity',
        'items' => [
            [
                'question' => 'Do your rings come with a warranty?',
                'answer' => 'Yes! We offer a 1-Year Limited Craftsmanship Warranty covering manufacturing faults, loose gemstone settings, and premature plating defects under normal wear.',
            ],
            [
                'question' => 'Are your gemstones natural and certified?',
                'answer' => '100% natural. Every gemstone ring includes an official GIC (Gemological Institute of Colombo) Authenticity Certificate guaranteeing its natural origin for life.',
            ],
            [
                'question' => 'What is not covered under the warranty?',
                'answer' => 'Accidental gemstone breakage from severe impact, harsh chemical exposure (perfumes, chlorine), normal wear cosmetic scratches, or third-party silversmith alterations automatically void the warranty.',
            ],
        ],
    ],
    [
        'slug' => 'stores-services',
        'title' => 'Stores &amp; Services',
        'items' => [
            [
                'question' => 'Do you have physical retail stores?',
                'answer' => 'We operate as a direct-to-consumer (D2C) studio based in Sri Lanka. By selling exclusively online, we deliver premium artisanal jewelry directly to you without traditional retail markups.',
            ],
            [
                'question' => 'Do you offer custom ring design or gem sourcing services?',
                'answer' => 'Yes! If you are looking for a rare Spinel shade or bespoke gemstone cut, reach out to concierge@facetbound.com or chat with us on WhatsApp to co-create a one-of-a-kind piece.',
            ],
            [
                'question' => 'Can I get custom inside-band engraving on my ring?',
                'answer' => 'Absolutely. We offer complimentary custom inside-band engraving (names, dates, or symbols) upon request during checkout. (Note: Engraved rings are final sale).',
            ],
        ],
    ],
    [
        'slug' => 'piercing-services',
        'title' => 'Piercing Services',
        'items' => [
            [
                'question' => 'Do you offer in-store or online body piercing services?',
                'answer' => 'We do not offer body piercing services. FACETBOUND focuses exclusively on hand-carved sterling silver rings and fine gemstone keepsakes.',
            ],
            [
                'question' => 'Do you craft piercing jewelry (e.g., nose rings or body studs)?',
                'answer' => 'Currently, our collections consist solely of fine artisan rings set in 925 sterling silver.',
            ],
        ],
    ],
    [
        'slug' => 'orders-shipping',
        'title' => 'Orders &amp; Shipping',
        'items' => [
            [
                'question' => 'Do you ship internationally, and how much does it cost?',
                'answer' => 'We offer 100% Complimentary Express Worldwide Shipping on all international orders via DHL Express or FedEx.',
            ],
            [
                'question' => 'How long does shipping take to reach the US, UK, or Europe?',
                'answer' => 'Ready-to-ship rings dispatch within 1–3 business days. Courier transit time takes 5–7 business days with full door-to-door tracking and insurance.',
            ],
            [
                'question' => 'Will I have to pay import duties or customs taxes?',
                'answer' => "International shipments may be subject to local import duties or VAT determined by your country's customs regulations. These charges are the recipient's responsibility.",
            ],
        ],
    ],
    [
        'slug' => 'returns-exchanges',
        'title' => 'Returns &amp; Exchanges',
        'items' => [
            [
                'question' => 'What is your return policy?',
                'answer' => 'We offer a 14-day return and exchange window from the date of delivery. The ring must be unworn, undamaged, and returned with its original packaging (Teak box, Mitti Attar vial, certificates).',
            ],
            [
                'question' => 'What if I order the wrong US ring size?',
                'answer' => "If you consulted our Customer Support before ordering and the ring doesn't fit, we cover the replacement shipping fees. If ordered without consultation, return shipping costs back to our Sri Lanka studio are covered by the buyer.",
            ],
            [
                'question' => 'How long do refunds take to process?',
                'answer' => 'Once inspected at our studio, refunds are processed back to your original payment method within 7 business days.',
            ],
        ],
    ],
    [
        'slug' => 'membership-vip',
        'title' => 'Membership &amp; VIP Community',
        'items' => [
            [
                'question' => 'What is the FACETBOUND Collector\'s Circle?',
                'answer' => "The Collector's Circle is our exclusive client community. Members gain 48-hour early access to rare gemstone drops, password-protected private vault sales, and co-creation voting rights.",
            ],
            [
                'question' => 'How do I join the VIP Community?',
                'answer' => 'You are automatically invited via email or WhatsApp upon completing your first purchase. You can also subscribe to our Journal newsletter on the site.',
            ],
            [
                'question' => 'Are there membership fees?',
                'answer' => 'No, membership is 100% free for all FACETBOUND clients and crystal enthusiasts.',
            ],
        ],
    ],
    [
        'slug' => 'product-care',
        'title' => 'Product Information &amp; Ring Care',
        'items' => [
            [
                'question' => 'How do I find my US Ring Size?',
                'answer' => 'You can reference the US/UK Ring Size Guide on our product pages. We also offer open-gap adjustable rings (fitting US sizes 6–8) for a zero-size-risk experience.',
            ],
            [
                'question' => 'Will 925 Sterling Silver tarnish over time?',
                'answer' => 'Pure silver naturally oxidizes when exposed to air. However, our high-polish rings are finished with Heavy Rhodium Plating to prevent tarnishing. Every parcel also includes a complimentary silver polishing cloth.',
            ],
            [
                'question' => 'Are your gemstones natural or lab-created?',
                'answer' => 'All gemstones (Spinel, Blue Topaz, Amethyst, Moonstone) are 100% mined from nature and untreated. We do not sell synthetic or glass-filled stones.',
            ],
        ],
    ],
    [
        'slug' => 'sustainability',
        'title' => 'Sustainability &amp; Ethical Sourcing',
        'items' => [
            [
                'question' => 'Are your gemstones ethically sourced?',
                'answer' => 'Yes. We source rough stones directly from licensed, traditional pit miners in Ratnapura, Sri Lanka, supporting artisanal mining communities without industrial ecosystem destruction.',
            ],
            [
                'question' => 'Is your packaging eco-friendly and plastic-free?',
                'answer' => '100% plastic-free. Every ring arrives in an Octagonal Teak Wood Box with a terracotta insert, unbleached cotton pouches, and eco-friendly honeycomb wrap.',
            ],
        ],
    ],
    [
        'slug' => 'payment-options',
        'title' => 'Payment Options',
        'items' => [
            [
                'question' => 'Which payment methods do you accept?',
                'answer' => 'All website checkout transactions are processed securely via PayHere Payment Gateway. We accept Visa, MasterCard, American Express, and major international credit/debit cards.',
            ],
            [
                'question' => 'Is checkout safe and secure on your website?',
                'answer' => 'Yes, our platform uses 256-Bit SSL Encryption. FACETBOUND never stores or views your full credit card credentials.',
            ],
            [
                'question' => 'What currencies can I pay in?',
                'answer' => 'Prices are displayed in USD for international buyers and LKR for domestic Sri Lankan clients based on regional IP location.',
            ],
        ],
    ],
];

$faq_running_index = 0;
?>

<section class="contact-faq">
    <div class="container">
        <?php foreach ($faq_categories as $faq_category) : ?>
            <div class="faq-category" id="faq-cat-<?php echo esc_attr($faq_category['slug']); ?>">
                <h2 class="faq-category__title"><?php echo wp_kses_post($faq_category['title']); ?></h2>
                <div class="faq-list">
                    <?php foreach ($faq_category['items'] as $faq) :
                        $faq_running_index++;
                        $faq_is_first = 1 === $faq_running_index;
                        ?>
                        <div class="faq-item<?php echo $faq_is_first ? ' faq-item--open' : ''; ?>">
                            <button type="button" class="faq-question" aria-expanded="<?php echo $faq_is_first ? 'true' : 'false'; ?>" aria-controls="faq-answer-<?php echo (int) $faq_running_index; ?>">
                                <span><?php echo esc_html($faq['question']); ?></span>
                                <i class="fa-solid <?php echo $faq_is_first ? 'fa-minus' : 'fa-plus'; ?> faq-icon" aria-hidden="true"></i>
                            </button>
                            <div class="faq-answer" id="faq-answer-<?php echo (int) $faq_running_index; ?>">
                                <p><?php echo esc_html($faq['answer']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php
facetbound_concierge_cta();
get_footer();
