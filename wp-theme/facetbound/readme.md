# Facetbound — WordPress block theme

A full site editing (FSE) WooCommerce theme for Facetbound, built so every
page can be edited visually in the WordPress **Site Editor** (Appearance →
Editor) — no third-party page-builder plugin, no license fees, no lock-in.
This is WordPress's own native "page builder": the block editor.

## Architecture

- **`theme.json`** — the design system (colors, type, spacing, button/link
  styles) as editor-native settings. Every value here shows up as a picker
  in the block editor's own UI (e.g. the Emerald/Terracotta/Cream palette).
- **`templates/*.html`** and **`parts/*.html`** — block-markup templates,
  editable in Appearance → Editor → Templates/Template Parts. These control
  the *wrapper* around each page type (header, footer, layout).
- **The actual page copy** (Home, Our Story, Sustainability, Journal) lives
  in each Page's own block-editor content — edit it the normal way, from
  Pages → [page] → Edit, exactly like editing any WordPress page. Photos
  are real Image blocks (seeded as placeholder JPEGs) — click "Replace" to
  swap in real photography, no code changes needed.
- **Shop, Product, Cart, Checkout** intentionally have **no override
  template files** in this theme. WooCommerce auto-generates its own block
  templates for these when a block theme has none — that keeps them fully
  visual-editable via Appearance → Editor → Templates → "WooCommerce
  Templates" and automatically compatible with every new WooCommerce
  Blocks release. This theme skins them via
  `assets/css/woocommerce-blocks.css` instead of overriding their markup.
  If you want to adjust their *layout* (not just color/type), open the
  template in the Site Editor and drag blocks around — that's the
  page-builder workflow WooCommerce ships for these flows.
- **My Account** is a normal Page containing WooCommerce's
  `[woocommerce_my_account]` shortcode (WooCommerce hasn't fully
  blockified My Account yet) — still skinned by CSS, still just a Page.
- **`patterns/*.php`** — reusable block patterns available from the
  inserter's "Facetbound" category in any page/template:
  - *Concierge CTA* — already placed on Home; drag it onto Shop, Product,
    Checkout or My Account if you want it there too.
  - *Checkout Express Payment Banner* — the PayPal/Apple Pay/Google Pay
    preview row; drag it above the Checkout block if desired.
- **`inc/blocks.php`** — three tiny server-rendered blocks that do what a
  few lines of PHP used to do directly in header.php/footer.php/home.php
  (static `.html` template files can't run PHP): the search/account/SSL
  icon row, the footer copyright year, and rendering the Journal page's
  own content on the blog index template.

## What still works unchanged

- `inc/content-seed.php` — one-time seeding of pages, the Journal's 7
  posts, and 8 variable WooCommerce products (Ring Size attribute +
  variations) on theme activation.
- `inc/shortcodes.php` — the live WooCommerce/post-backed sections
  embedded in Home/Journal content (curated collections, featured
  products, journal grid, etc.) — these prefer a real uploaded photo and
  fall back to the placeholder only until one exists.
- `inc/my-account.php` — the "My Vault" account tab and dashboard welcome
  banner, via standard WooCommerce action hooks.
- `inc/woocommerce-support.php` — the free inside-band engraving field and
  breadcrumb styling.
- `inc/placeholder-media.php` — generates real Media Library placeholder
  images so every photo slot is a genuine, replaceable Image block.

## First-time setup on a live site

1. Install and activate **WooCommerce** first.
2. Install and activate this theme (**Appearance → Themes → Add New →
   Upload**, then Activate). Page/menu/journal/product content seeds
   automatically on activation.
3. **Settings → Permalinks** → click Save once (flushes rewrite rules for
   the `/my-account/vault/` endpoint).
4. Open **Appearance → Editor** to review/adjust templates visually.
5. Replace placeholder photography: open any page in the editor and click
   the Image block → Replace, or go to Products/Journal posts and set a
   featured image.
6. Configure real payment gateways (Stripe/PayPal/etc.) in **WooCommerce →
   Settings → Payments** — the Express Payment Banner pattern is a static
   preview until a matching gateway plugin is active.

See the repo-root `INSTALL.md` for the full deployment walkthrough.
