/**
 * Site-wide behaviors: journal category filter is handled by real page
 * navigation (see home.php/single.php), so this file only needs the small
 * cross-page niceties that don't warrant their own enqueue.
 */
(function () {
  'use strict';

  // Footer / newsletter "Join" and "Subscribe" forms are visual-only until
  // an email service (Mailchimp/Klaviyo/etc.) is connected — give the
  // visitor a lightweight confirmation instead of a real page submit.
  document.querySelectorAll('.fb-footer__form, .home-newsletter__form, .journal-newsletter__form, .article-newsletter__form').forEach(function (form) {
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var button = form.querySelector('button[type="submit"], button');
      var input = form.querySelector('input[type="email"]');
      if (!input || !input.value) {
        return;
      }
      if (button) {
        var original = button.textContent;
        button.textContent = 'Joined!';
        button.disabled = true;
        setTimeout(function () {
          button.textContent = original;
          button.disabled = false;
        }, 3000);
      }
      input.value = '';
    });
  });
})();
