# Installing the Facetbound WordPress theme

`wp-theme/facetbound` is a WordPress **block theme** (full site editing) for
WooCommerce. No page-builder plugin is required — WordPress's built-in
block/Site Editor is the page builder. See `wp-theme/facetbound/readme.md`
for how the theme is put together.

## 1. Requirements

- WordPress 6.4+
- PHP 7.4+
- The **WooCommerce** plugin (free, from wordpress.org)
- A host with GD support for PHP (used once, to generate placeholder
  product/section photos on theme activation — nearly all hosts have this)

## 2. Get the theme onto your site

**Option A — from this repo (recommended if you're already set up here):**

```bash
cd wp-theme
zip -r facetbound.zip facetbound -x '*.DS_Store'
```

**Option B — download the zip** if it was sent to you directly.

Then in wp-admin:

1. **Plugins → Add New → search "WooCommerce" → Install → Activate.**
   Skip/dismiss the WooCommerce setup wizard for now (the theme seeds its
   own catalog).
2. **Appearance → Themes → Add New → Upload Theme** → choose
   `facetbound.zip` → Install → **Activate**.

Activating the theme automatically:
- Creates the Home, Our Story, Sustainability, and Journal pages with
  real block-editor content (placeholder photos included).
- Sets Home as the front page and Journal as the posts page.
- Creates 7 Journal blog posts across 3 categories.
- Creates 8 variable WooCommerce products (with a Ring Size attribute +
  variations) across 3 product categories.
- Creates the Shop, Cart, Checkout, and My Account pages (via
  WooCommerce's own installer, which runs automatically once WooCommerce
  is active).

## 3. One-time cleanup after activation

1. **Settings → Permalinks** → click **Save Changes** once. This flushes
   rewrite rules so the custom `/my-account/vault/` endpoint (My Vault
   tab) resolves correctly.
2. **Settings → General** → confirm Site Title is "Facetbound" (used by
   the header's Site Title block).
3. Skip or complete WooCommerce's setup wizard for tax/shipping/currency
   settings appropriate to your store.

## 4. Editing content (the "page builder")

- **Appearance → Editor** — edit any template (Header, Footer, Front
  Page, Single Post, and WooCommerce's own Shop/Product/Cart/Checkout
  templates) visually, block by block.
- **Pages → Home / Our Story / Sustainability / Journal → Edit** — edit
  the actual page copy and photos the normal WordPress way.
- **Appearance → Editor → Patterns** — the "Facetbound" category has a
  *Concierge CTA* and a *Checkout Express Payment Banner* pattern you can
  drag onto any template that doesn't already include them.
- **Products → All Products** — edit price, description, images,
  variations per product; **Products → Categories** — set a category
  thumbnail for the "Curated Collections" section on Home.
- **Posts → Journal categories/posts** — edit or add Journal articles; set
  a Featured Image on each for it to appear on the article and its cards.

## 5. Real photography

Every "photo" on Home/Our Story/Sustainability is a real WordPress Image
block pointing at a generated placeholder in the Media Library. Click the
image → **Replace** → upload the real photo. No code or re-seeding needed.

## 6. Payment gateways

The Express Payment Banner (PayPal / Apple Pay / Google Pay preview) is a
disabled visual preview until you install and configure the matching
official gateway plugin under **WooCommerce → Settings → Payments**.

## 7. Local development / preview without hosting

If you just want to see the theme running before deploying:

```bash
# any local WP + WooCommerce environment works, e.g.:
# - LocalWP (localwp.com)
# - wp-env (https://developer.wordpress.org/block-editor/reference-guides/packages/packages-env/)
```

Point it at a fresh WP install, install WooCommerce, then follow step 2
above with your local site's wp-admin.
