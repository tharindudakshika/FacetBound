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

  // Header search: click the icon to open a Journal search popup, click the
  // backdrop (or the close button, or press Escape) to close it again.
  // aria-expanded/aria-hidden track open state for screen readers, and
  // focus moves into the input on open and back to the toggle button on
  // close so keyboard users don't lose their place.
  var searchWrap = document.querySelector('.fb-header__search');
  if (searchWrap) {
    var toggle = searchWrap.querySelector('.fb-header__search-toggle');
    var overlay = searchWrap.querySelector('.fb-header__search-overlay');
    var closeBtn = searchWrap.querySelector('.fb-header__search-close');
    var input = searchWrap.querySelector('.fb-header__search-input');
    toggle.setAttribute('aria-expanded', 'false');
    overlay.setAttribute('aria-hidden', 'true');

    function openSearch() {
      searchWrap.classList.add('fb-header__search--open');
      toggle.setAttribute('aria-expanded', 'true');
      overlay.setAttribute('aria-hidden', 'false');
      input.focus();
    }
    function closeSearch() {
      searchWrap.classList.remove('fb-header__search--open');
      toggle.setAttribute('aria-expanded', 'false');
      overlay.setAttribute('aria-hidden', 'true');
      toggle.focus();
    }

    toggle.addEventListener('click', function (e) {
      e.stopPropagation();
      openSearch();
    });
    closeBtn.addEventListener('click', closeSearch);
    overlay.addEventListener('click', function (e) {
      if (e.target === overlay) {
        closeSearch();
      }
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && searchWrap.classList.contains('fb-header__search--open')) {
        closeSearch();
      }
    });
  }

  // Mobile nav: hamburger opens a slide-in drawer with the same menu links;
  // backdrop click, the close button, Escape, or picking a link closes it.
  // Same aria-expanded/aria-hidden + focus-management treatment as search.
  var menuToggle = document.querySelector('.fb-header__menu-toggle');
  var drawer = document.querySelector('.fb-header__drawer');
  if (menuToggle && drawer) {
    var drawerClose = drawer.querySelector('.fb-header__drawer-close');
    menuToggle.setAttribute('aria-expanded', 'false');
    drawer.setAttribute('aria-hidden', 'true');

    function openDrawer() {
      drawer.classList.add('fb-header__drawer--open');
      menuToggle.setAttribute('aria-expanded', 'true');
      drawer.setAttribute('aria-hidden', 'false');
      if (drawerClose) {
        drawerClose.focus();
      }
    }
    function closeDrawer() {
      drawer.classList.remove('fb-header__drawer--open');
      menuToggle.setAttribute('aria-expanded', 'false');
      drawer.setAttribute('aria-hidden', 'true');
      menuToggle.focus();
    }

    menuToggle.addEventListener('click', openDrawer);
    if (drawerClose) {
      drawerClose.addEventListener('click', closeDrawer);
    }
    drawer.addEventListener('click', function (e) {
      if (e.target === drawer) {
        closeDrawer();
      }
    });
    drawer.querySelectorAll('.fb-header__link').forEach(function (link) {
      link.addEventListener('click', closeDrawer);
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && drawer.classList.contains('fb-header__drawer--open')) {
        closeDrawer();
      }
    });
  }

  // FAQ accordion: one item open at a time; clicking the open item closes it.
  var faqItems = document.querySelectorAll('.faq-item');
  faqItems.forEach(function (item) {
    var question = item.querySelector('.faq-question');
    var icon = item.querySelector('.faq-icon');
    if (!question) {
      return;
    }
    question.addEventListener('click', function () {
      var isOpen = item.classList.contains('faq-item--open');
      faqItems.forEach(function (other) {
        other.classList.remove('faq-item--open');
        var otherQuestion = other.querySelector('.faq-question');
        var otherIcon = other.querySelector('.faq-icon');
        if (otherQuestion) {
          otherQuestion.setAttribute('aria-expanded', 'false');
        }
        if (otherIcon) {
          otherIcon.classList.remove('fa-minus');
          otherIcon.classList.add('fa-plus');
        }
      });
      if (!isOpen) {
        item.classList.add('faq-item--open');
        question.setAttribute('aria-expanded', 'true');
        if (icon) {
          icon.classList.remove('fa-plus');
          icon.classList.add('fa-minus');
        }
      }
    });
  });
})();
