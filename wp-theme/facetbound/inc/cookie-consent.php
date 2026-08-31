<?php
/**
 * Cookie consent banner + preference center, referenced by the Cookies
 * Policy page ("Cookie Consent Banner: you can choose to Accept All or
 * Decline/Reject non-essential cookies at any time"). Stores the
 * visitor's choice in a first-party cookie (facetbound_consent, JSON,
 * 1 year) so both this JS and any future PHP-side script enqueues
 * (Google Analytics, Meta Pixel, etc.) can check it before running —
 * essential cookies (cart/session/checkout) are never gated since the
 * store cannot function without them.
 */

if (!defined('ABSPATH')) {
    exit;
}

define('FACETBOUND_CONSENT_COOKIE', 'facetbound_consent');
define('FACETBOUND_CONSENT_CATEGORIES', ['analytics', 'marketing', 'functional']);

/**
 * The visitor's stored consent choice, or null if they haven't decided
 * yet (banner should still be showing client-side). Essential is
 * always true — it's not a real choice, just included for convenience.
 */
function facetbound_get_cookie_consent() {
    if (empty($_COOKIE[FACETBOUND_CONSENT_COOKIE])) {
        return null;
    }
    $decoded = json_decode(wp_unslash($_COOKIE[FACETBOUND_CONSENT_COOKIE]), true);
    if (!is_array($decoded)) {
        return null;
    }
    $consent = ['essential' => true];
    foreach (FACETBOUND_CONSENT_CATEGORIES as $category) {
        $consent[$category] = !empty($decoded[$category]);
    }
    return $consent;
}

/**
 * Whether the visitor has granted a specific cookie category. Use this
 * to gate any future non-essential script enqueue, e.g.:
 *   if (facetbound_has_consent('analytics')) { wp_enqueue_script(...); }
 */
function facetbound_has_consent($category) {
    if ($category === 'essential') {
        return true;
    }
    $consent = facetbound_get_cookie_consent();
    return $consent !== null && !empty($consent[$category]);
}

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('facetbound-cookie-consent', FACETBOUND_URI . '/assets/css/cookie-consent.css', ['facetbound-components'], facetbound_asset_version('/assets/css/cookie-consent.css'));
    wp_enqueue_script('facetbound-cookie-consent', FACETBOUND_URI . '/assets/js/cookie-consent.js', [], facetbound_asset_version('/assets/js/cookie-consent.js'), true);
    wp_localize_script('facetbound-cookie-consent', 'facetboundConsentConfig', [
        'cookieName' => FACETBOUND_CONSENT_COOKIE,
        'policyUrl' => home_url('/cookies-policy/'),
        'hasDecision' => facetbound_get_cookie_consent() !== null,
    ]);
});

add_action('wp_footer', function () {
    ?>
    <div id="cookie-consent-banner" class="cookie-consent-banner" role="dialog" aria-live="polite" aria-label="Cookie consent" hidden>
        <div class="cookie-consent-banner__inner">
            <p class="cookie-consent-banner__text">
                We use cookies to keep your cart secure, understand how collectors browse, and show you relevant milestone collections. Read our
                <a href="<?php echo esc_url(home_url('/cookies-policy/')); ?>">Cookies Policy</a>.
            </p>
            <div class="cookie-consent-banner__actions">
                <button type="button" class="cookie-consent-btn cookie-consent-btn-outline" data-cookie-consent="manage">Manage Preferences</button>
                <button type="button" class="cookie-consent-btn cookie-consent-btn-outline" data-cookie-consent="reject">Reject Non-Essential</button>
                <button type="button" class="cookie-consent-btn cookie-consent-btn-solid" data-cookie-consent="accept">Accept All</button>
            </div>
        </div>
    </div>

    <div id="cookie-consent-panel" class="cookie-consent-panel" role="dialog" aria-modal="true" aria-labelledby="cookie-consent-panel-title" hidden>
        <div class="cookie-consent-panel__backdrop" data-cookie-consent="close"></div>
        <div class="cookie-consent-panel__box">
            <h2 id="cookie-consent-panel-title">Cookie Preferences</h2>
            <p class="cookie-consent-panel__intro">Choose which categories of cookies you're comfortable with. Essential cookies keep your cart and checkout working, so they can't be turned off.</p>

            <div class="cookie-consent-toggle">
                <div>
                    <div class="cookie-consent-toggle__title">Essential</div>
                    <div class="cookie-consent-toggle__desc">Cart, session, and secure PayHere checkout. Always on.</div>
                </div>
                <input type="checkbox" checked disabled aria-label="Essential cookies (always on)">
            </div>
            <div class="cookie-consent-toggle">
                <div>
                    <div class="cookie-consent-toggle__title">Analytics &amp; Performance</div>
                    <div class="cookie-consent-toggle__desc">Helps us understand which collections and pages resonate with visitors.</div>
                </div>
                <input type="checkbox" id="cookie-consent-cat-analytics" data-cookie-category="analytics">
            </div>
            <div class="cookie-consent-toggle">
                <div>
                    <div class="cookie-consent-toggle__title">Marketing &amp; Advertising</div>
                    <div class="cookie-consent-toggle__desc">Shows you relevant Facetbound gemstone drops on social platforms.</div>
                </div>
                <input type="checkbox" id="cookie-consent-cat-marketing" data-cookie-category="marketing">
            </div>
            <div class="cookie-consent-toggle">
                <div>
                    <div class="cookie-consent-toggle__title">Functional</div>
                    <div class="cookie-consent-toggle__desc">Remembers your country and preferred currency between visits.</div>
                </div>
                <input type="checkbox" id="cookie-consent-cat-functional" data-cookie-category="functional">
            </div>

            <div class="cookie-consent-panel__actions">
                <button type="button" class="cookie-consent-btn cookie-consent-btn-outline" data-cookie-consent="reject">Reject Non-Essential</button>
                <button type="button" class="cookie-consent-btn cookie-consent-btn-solid" data-cookie-consent="save">Save Preferences</button>
            </div>
        </div>
    </div>
    <?php
});
