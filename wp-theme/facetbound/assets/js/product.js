/**
 * Product Detail page interactivity: gallery lightbox + details tabs.
 * Plain vanilla JS (no jQuery, no framework) — WooCommerce's own AJAX
 * add-to-cart / variation-selection scripts run independently of this file.
 */
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        initLightbox();
        initTabs();
        initGemCertificateLink();
    });

    /* --------------------------------------------------------------
     * Gem Certificate link — swaps to the selected variation's PDF.
     * Bridges to WooCommerce's own jQuery-based variation form events
     * (found_variation / reset_data), since that's the only way those
     * fire; everything else in this file stays plain JS.
     * ------------------------------------------------------------ */
    function initGemCertificateLink() {
        var link = document.getElementById('pdp-gem-certificate-link');
        if (!link || typeof window.jQuery === 'undefined') {
            return;
        }
        var $form = window.jQuery('.variations_form');
        if (!$form.length) {
            return;
        }
        $form.on('found_variation', function (event, variation) {
            var url = variation && variation.facetbound_gem_certificate_url;
            if (url) {
                link.href = url;
                link.style.display = '';
            } else {
                link.removeAttribute('href');
                link.style.display = 'none';
            }
        });
        $form.on('reset_data', function () {
            link.removeAttribute('href');
            link.style.display = 'none';
        });
    }

    function escapeHtml(str) {
        var div = document.createElement('div');
        div.textContent = str == null ? '' : String(str);
        return div.innerHTML;
    }

    /* --------------------------------------------------------------
     * Gallery lightbox
     * ------------------------------------------------------------ */
    function initLightbox() {
        var tiles = Array.prototype.slice.call(document.querySelectorAll('[data-lightbox-index]'));
        var lightbox = document.getElementById('pdp-lightbox');
        if (!tiles.length || !lightbox) {
            return;
        }

        var mediaEl = document.getElementById('pdp-lightbox-media');
        var closeBtn = document.getElementById('pdp-lightbox-close');
        var prevBtn = document.getElementById('pdp-lightbox-prev');
        var nextBtn = document.getElementById('pdp-lightbox-next');
        var currentIndex = 0;

        function render(index) {
            var count = tiles.length;
            currentIndex = ((index % count) + count) % count;
            var tile = tiles[currentIndex];
            var src = tile.getAttribute('data-lightbox-src');
            var caption = tile.getAttribute('data-lightbox-caption') || '';

            if (src) {
                mediaEl.innerHTML =
                    '<img src="' + escapeHtml(src) + '" alt="' + escapeHtml(caption) + '" ' +
                    'style="width:100%;height:100%;object-fit:cover;border-radius:14px;display:block;">';
            } else {
                mediaEl.innerHTML =
                    '<div class="ph ph-light" style="width:100%;height:100%;border-radius:14px;">' +
                    (caption ? '<div class="ph-caption">[ ' + escapeHtml(caption) + ' ]</div>' : '') +
                    '</div>';
            }
        }

        function open(index) {
            render(index);
            lightbox.style.display = 'flex';
        }

        function close() {
            lightbox.style.display = 'none';
        }

        tiles.forEach(function (tile, i) {
            tile.addEventListener('click', function () {
                open(i);
            });
        });

        if (closeBtn) {
            closeBtn.addEventListener('click', close);
        }
        if (prevBtn) {
            prevBtn.addEventListener('click', function () {
                render(currentIndex - 1);
            });
        }
        if (nextBtn) {
            nextBtn.addEventListener('click', function () {
                render(currentIndex + 1);
            });
        }

        // Click on the dark backdrop (but not on the media panel or nav buttons) closes it.
        lightbox.addEventListener('click', function (e) {
            if (e.target === lightbox) {
                close();
            }
        });

        document.addEventListener('keydown', function (e) {
            if (lightbox.style.display !== 'flex') {
                return;
            }
            if (e.key === 'Escape') {
                close();
            } else if (e.key === 'ArrowLeft') {
                render(currentIndex - 1);
            } else if (e.key === 'ArrowRight') {
                render(currentIndex + 1);
            }
        });
    }

    /* --------------------------------------------------------------
     * Details tabs
     * ------------------------------------------------------------ */
    function initTabs() {
        var triggers = Array.prototype.slice.call(document.querySelectorAll('[data-tab]'));
        var panels = Array.prototype.slice.call(document.querySelectorAll('[data-tab-panel]'));
        if (!triggers.length || !panels.length) {
            return;
        }

        triggers.forEach(function (trigger) {
            trigger.addEventListener('click', function () {
                var target = trigger.getAttribute('data-tab');

                triggers.forEach(function (t) {
                    t.classList.remove('pdp-tab--active');
                });
                trigger.classList.add('pdp-tab--active');

                panels.forEach(function (panel) {
                    panel.style.display = panel.getAttribute('data-tab-panel') === target ? '' : 'none';
                });
            });
        });
    }
})();
