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
  var searchWrap = document.querySelector('.fb-header__search');
  if (searchWrap) {
    var toggle = searchWrap.querySelector('.fb-header__search-toggle');
    var overlay = searchWrap.querySelector('.fb-header__search-overlay');
    var closeBtn = searchWrap.querySelector('.fb-header__search-close');
    var input = searchWrap.querySelector('.fb-header__search-input');

    function openSearch() {
      searchWrap.classList.add('fb-header__search--open');
      input.focus();
    }
    function closeSearch() {
      searchWrap.classList.remove('fb-header__search--open');
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
      if (e.key === 'Escape') {
        closeSearch();
      }
    });
  }

  // Mobile nav: hamburger opens a slide-in drawer with the same menu links;
  // backdrop click, the close button, Escape, or picking a link closes it.
  var menuToggle = document.querySelector('.fb-header__menu-toggle');
  var drawer = document.querySelector('.fb-header__drawer');
  if (menuToggle && drawer) {
    var drawerClose = drawer.querySelector('.fb-header__drawer-close');

    function openDrawer() {
      drawer.classList.add('fb-header__drawer--open');
    }
    function closeDrawer() {
      drawer.classList.remove('fb-header__drawer--open');
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
      if (e.key === 'Escape') {
        closeDrawer();
      }
    });
  }
})();
