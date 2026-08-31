(function () {
  var CONFIG = window.facetboundConsentConfig || {};
  var COOKIE_NAME = CONFIG.cookieName || 'facetbound_consent';
  var CATEGORIES = ['analytics', 'marketing', 'functional'];

  function getCookie(name) {
    var match = document.cookie.match(new RegExp('(?:^|; )' + name.replace(/([.$?*|{}()[\]\\/+^])/g, '\\$1') + '=([^;]*)'));
    return match ? decodeURIComponent(match[1]) : null;
  }

  function setCookie(name, value, days) {
    var expires = new Date(Date.now() + days * 24 * 60 * 60 * 1000).toUTCString();
    document.cookie = name + '=' + encodeURIComponent(value) + '; expires=' + expires + '; path=/; SameSite=Lax';
  }

  function readConsent() {
    var raw = getCookie(COOKIE_NAME);
    if (!raw) {
      return null;
    }
    try {
      var parsed = JSON.parse(raw);
      var consent = { essential: true };
      CATEGORIES.forEach(function (cat) {
        consent[cat] = !!parsed[cat];
      });
      return consent;
    } catch (e) {
      return null;
    }
  }

  function writeConsent(consent) {
    setCookie(COOKIE_NAME, JSON.stringify(consent), 365);
    document.dispatchEvent(new CustomEvent('facetbound:consent-updated', { detail: consent }));
  }

  var banner = document.getElementById('cookie-consent-banner');
  var panel = document.getElementById('cookie-consent-panel');
  if (!banner || !panel) {
    return;
  }

  function showBanner() {
    banner.hidden = false;
  }
  function hideBanner() {
    banner.hidden = true;
  }
  function showPanel() {
    var current = readConsent() || { essential: true, analytics: false, marketing: false, functional: false };
    CATEGORIES.forEach(function (cat) {
      var input = panel.querySelector('[data-cookie-category="' + cat + '"]');
      if (input) {
        input.checked = !!current[cat];
      }
    });
    panel.hidden = false;
  }
  function hidePanel() {
    panel.hidden = true;
  }

  function acceptAll() {
    writeConsent({ essential: true, analytics: true, marketing: true, functional: true });
    hideBanner();
    hidePanel();
  }

  function rejectNonEssential() {
    writeConsent({ essential: true, analytics: false, marketing: false, functional: false });
    hideBanner();
    hidePanel();
  }

  function savePreferences() {
    var consent = { essential: true };
    CATEGORIES.forEach(function (cat) {
      var input = panel.querySelector('[data-cookie-category="' + cat + '"]');
      consent[cat] = !!(input && input.checked);
    });
    writeConsent(consent);
    hideBanner();
    hidePanel();
  }

  document.addEventListener('click', function (e) {
    var action = e.target.closest ? e.target.closest('[data-cookie-consent]') : null;
    if (!action) {
      return;
    }
    switch (action.getAttribute('data-cookie-consent')) {
      case 'accept':
        acceptAll();
        break;
      case 'reject':
        rejectNonEssential();
        break;
      case 'manage':
        hideBanner();
        showPanel();
        break;
      case 'save':
        savePreferences();
        break;
      case 'close':
        hidePanel();
        if (!readConsent()) {
          showBanner();
        }
        break;
      case 'open-settings':
        e.preventDefault();
        showPanel();
        break;
    }
  });

  if (!CONFIG.hasDecision && !readConsent()) {
    showBanner();
  }
})();
