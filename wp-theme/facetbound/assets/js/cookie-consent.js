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

  var panelTriggerEl = null;

  function focusableIn(container) {
    return Array.prototype.slice
      .call(container.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'))
      .filter(function (el) {
        return !el.disabled && el.tabIndex !== -1 && el.offsetParent !== null;
      });
  }

  function trapFocus(e) {
    if (e.key !== 'Tab') {
      return;
    }
    var focusable = focusableIn(panel);
    if (!focusable.length) {
      return;
    }
    var first = focusable[0];
    var last = focusable[focusable.length - 1];
    if (e.shiftKey && document.activeElement === first) {
      e.preventDefault();
      last.focus();
    } else if (!e.shiftKey && document.activeElement === last) {
      e.preventDefault();
      first.focus();
    }
  }

  function panelKeydown(e) {
    if (e.key === 'Escape') {
      e.preventDefault();
      hidePanel();
      return;
    }
    trapFocus(e);
  }

  function showBanner() {
    banner.hidden = false;
  }
  function hideBanner() {
    banner.hidden = true;
  }

  function showPanel(triggerEl) {
    panelTriggerEl = triggerEl || document.activeElement;
    var current = readConsent() || { essential: true, analytics: false, marketing: false, functional: false };
    CATEGORIES.forEach(function (cat) {
      var input = panel.querySelector('[data-cookie-category="' + cat + '"]');
      if (input) {
        input.checked = !!current[cat];
      }
    });
    panel.hidden = false;
    document.addEventListener('keydown', panelKeydown, true);
    var focusable = focusableIn(panel);
    if (focusable.length) {
      focusable[0].focus();
    }
  }

  function hidePanel() {
    if (panel.hidden) {
      return;
    }
    panel.hidden = true;
    document.removeEventListener('keydown', panelKeydown, true);
    var returnTo = panelTriggerEl && document.contains(panelTriggerEl) ? panelTriggerEl : null;
    panelTriggerEl = null;
    if (returnTo && typeof returnTo.focus === 'function') {
      returnTo.focus();
    }
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
        showPanel(action);
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
        showPanel(action);
        break;
    }
  });

  if (!CONFIG.hasDecision && !readConsent()) {
    showBanner();
  }
})();
