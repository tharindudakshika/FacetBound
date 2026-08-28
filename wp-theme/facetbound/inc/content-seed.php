<?php
/**
 * One-time content seeding on theme activation: pages, nav menu, journal
 * categories + posts, and the WooCommerce product catalog (as variable
 * products with a real "Ring Size" attribute/variations). Idempotent —
 * guarded by option flags so re-activating the theme won't duplicate data.
 *
 * Run order on the live site: activate WooCommerce FIRST, then activate
 * this theme, so the product-seeding step below can find WooCommerce's
 * product functions. If the theme is activated first, page/menu/journal
 * seeding still runs; product seeding quietly retries on the next
 * `admin_init` until WooCommerce is active.
 */

if (!defined('ABSPATH')) {
    exit;
}

add_action('after_switch_theme', 'facetbound_seed_all');
add_action('admin_init', 'facetbound_seed_products_when_ready');

function facetbound_seed_all() {
    facetbound_seed_pages();
    facetbound_seed_menu();
    facetbound_seed_journal();
    facetbound_seed_products_when_ready();
}

function facetbound_page_exists_by_slug($slug) {
    $page = get_page_by_path($slug);
    return $page ? $page->ID : 0;
}

/* -----------------------------------------------------------------------
 * Pages: Home (front page), Journal (posts page), Our Story, Sustainability
 * --------------------------------------------------------------------- */
function facetbound_seed_pages() {
    if (get_option('facetbound_pages_seeded')) {
        return;
    }

    $home_id = facetbound_page_exists_by_slug('home') ?: wp_insert_post([
        'post_title' => 'Home',
        'post_name' => 'home',
        'post_status' => 'publish',
        'post_type' => 'page',
        'post_content' => '',
    ]);

    $journal_id = facetbound_page_exists_by_slug('journal') ?: wp_insert_post([
        'post_title' => 'Journal',
        'post_name' => 'journal',
        'post_status' => 'publish',
        'post_type' => 'page',
        'post_content' => '',
    ]);

    $our_story_id = facetbound_page_exists_by_slug('our-story') ?: wp_insert_post([
        'post_title' => 'Our Story',
        'post_name' => 'our-story',
        'post_status' => 'publish',
        'post_type' => 'page',
        'post_content' => '',
    ]);
    update_post_meta($our_story_id, '_wp_page_template', 'page-our-story.php');

    $sustainability_id = facetbound_page_exists_by_slug('sustainability') ?: wp_insert_post([
        'post_title' => 'Sustainability',
        'post_name' => 'sustainability',
        'post_status' => 'publish',
        'post_type' => 'page',
        'post_content' => '',
    ]);
    update_post_meta($sustainability_id, '_wp_page_template', 'page-sustainability.php');

    $contact_id = facetbound_page_exists_by_slug('contact') ?: wp_insert_post([
        'post_title' => 'Contact Us',
        'post_name' => 'contact',
        'post_status' => 'publish',
        'post_type' => 'page',
        'post_content' => '',
    ]);
    update_post_meta($contact_id, '_wp_page_template', 'page-contact.php');

    update_option('show_on_front', 'page');
    update_option('page_on_front', $home_id);
    update_option('page_for_posts', $journal_id);
    update_option('permalink_structure', '/%postname%/');

    update_option('facetbound_pages_seeded', 1);
}

/* -----------------------------------------------------------------------
 * Primary nav menu
 * --------------------------------------------------------------------- */
function facetbound_seed_menu() {
    if (get_option('facetbound_menu_seeded')) {
        return;
    }

    $menu_name = 'Primary Navigation';
    $menu_id = wp_get_nav_menu_object($menu_name);
    if (!$menu_id) {
        $menu_id = wp_create_nav_menu($menu_name);
    } else {
        $menu_id = $menu_id->term_id;
    }

    $shop_url = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop/');
    $items = [
        ['title' => 'Shop', 'url' => $shop_url],
        ['title' => 'Our Story', 'url' => home_url('/our-story/')],
        ['title' => 'Sustainability', 'url' => home_url('/sustainability/')],
        ['title' => 'Journal', 'url' => home_url('/journal/')],
        ['title' => 'Contact Us', 'url' => home_url('/contact/')],
    ];
    foreach ($items as $item) {
        wp_update_nav_menu_item($menu_id, 0, [
            'menu-item-title' => $item['title'],
            'menu-item-url' => $item['url'],
            'menu-item-status' => 'publish',
        ]);
    }

    $locations = get_theme_mod('nav_menu_locations');
    $locations['primary'] = $menu_id;
    set_theme_mod('nav_menu_locations', $locations);

    update_option('facetbound_menu_seeded', 1);
}

/* -----------------------------------------------------------------------
 * Journal: categories + the 6 posts (data mirrors src/data/journal.js)
 * --------------------------------------------------------------------- */
function facetbound_seed_journal() {
    if (get_option('facetbound_journal_seeded')) {
        return;
    }

    $categories = ['Gemology 101', 'Artisan Craft', 'Care Guides'];
    $cat_ids = [];
    foreach ($categories as $cat) {
        $term = term_exists($cat, 'category');
        $cat_ids[$cat] = $term ? (int) $term['term_id'] : (int) wp_insert_term($cat, 'category')['term_id'];
    }

    $posts = [
        [
            'slug' => 'journey-of-a-natural-spinel',
            'title' => 'The Journey of a Natural Spinel: From Ratnapura Mining to Handcrafted Silver Ring',
            'category' => 'Gemology 101',
            'excerpt' => "We followed one stone the whole way — out of a hand-dug pit in Ratnapura, across a lapidary's wheel, and into a hammered silver bezel. What the journey reveals about why no two natural Spinels ever match.",
            'content' => facetbound_spinel_article_content(),
            'date' => '2026-08-01 09:00:00',
        ],
        [
            'slug' => 'why-your-aura-deserves-natural-gemstones',
            'title' => 'Why Your Aura Deserves Natural Gemstones',
            'category' => 'Care Guides',
            'excerpt' => 'Notes on why a natural, untreated stone carries a different presence than a lab-corrected one.',
            'content' => '<p>Notes on why a natural, untreated stone carries a different presence than a lab-corrected one — and how to choose a gem that matches your everyday wear.</p>',
            'date' => '2026-08-24 09:00:00',
        ],
        [
            'slug' => 'how-to-clean-sterling-silver-rings-at-home',
            'title' => 'How to Clean Sterling Silver Rings at Home',
            'category' => 'Care Guides',
            'excerpt' => 'A gentle, five-minute routine for keeping a hand-hammered 925 silver band bright between wears.',
            'content' => '<p>A gentle, five-minute routine for keeping a hand-hammered 925 silver band bright between wears — using nothing more than a soft cloth and mild soap.</p>',
            'date' => '2026-08-12 09:00:00',
        ],
        [
            'slug' => 'reading-a-spinel-inclusions-colour-zones-fire',
            'title' => 'Reading a Spinel: Inclusions, Colour Zones, Fire',
            'category' => 'Gemology 101',
            'excerpt' => 'How to read the internal character of a natural Spinel like a gemologist does.',
            'content' => '<p>How to read the internal character of a natural Spinel like a gemologist does — what inclusions tell you, and why colour zoning is a feature, not a flaw.</p>',
            'date' => '2026-07-30 09:00:00',
            'read_time' => '6 min read',
        ],
        [
            'slug' => 'the-hammer-and-the-anvil',
            'title' => 'The Hammer and the Anvil: Making a Textured Band',
            'category' => 'Artisan Craft',
            'excerpt' => 'Inside the strike-by-strike process of raising a hammered texture into solid 925 sterling silver.',
            'content' => '<p>Inside the strike-by-strike process of raising a hammered texture into solid 925 sterling silver, from a plain length of wire to a finished band.</p>',
            'date' => '2026-07-18 09:00:00',
            'read_time' => '4 min read',
        ],
        [
            'slug' => 'unheated-vs-treated',
            'title' => 'Unheated vs. Treated: What "Natural" Really Means',
            'category' => 'Gemology 101',
            'excerpt' => 'A plain-language guide to gemstone treatment disclosures, and why Facetbound only sets unheated stones.',
            'content' => '<p>A plain-language guide to gemstone treatment disclosures, and why Facetbound only sets unheated stones.</p>',
            'date' => '2026-06-27 09:00:00',
        ],
        [
            'slug' => 'open-back-bezels',
            'title' => 'Open-Back Bezels and Why We Set Them That Way',
            'category' => 'Artisan Craft',
            'excerpt' => 'Why an open-back bezel setting maximizes light transmission through a natural stone — and lets it touch your skin.',
            'content' => '<p>Why an open-back bezel setting maximizes light transmission through a natural stone — and lets it touch your skin directly, the way antique-cut stones were traditionally worn.</p>',
            'date' => '2026-06-09 09:00:00',
            'read_time' => '5 min read',
        ],
    ];

    foreach ($posts as $p) {
        if (facetbound_page_exists_by_slug($p['slug'])) {
            continue;
        }
        $post_id = wp_insert_post([
            'post_title' => $p['title'],
            'post_name' => $p['slug'],
            'post_status' => 'publish',
            'post_type' => 'post',
            'post_content' => $p['content'],
            'post_excerpt' => $p['excerpt'],
            'post_date' => $p['date'],
            'post_category' => [$cat_ids[$p['category']]],
        ]);
        if (!empty($p['read_time'])) {
            update_post_meta($post_id, 'facetbound_read_time', $p['read_time']);
        }
    }

    update_option('facetbound_journal_seeded', 1);
}

function facetbound_spinel_article_content() {
    return '<p>Sri Lanka has been called Ratna-Dweepa — the Island of Gems — for well over two thousand years. Its riverbeds and alluvial pits still give up sapphire, garnet, moonstone and, most quietly prized of all, Spinel: a stone long mistaken for ruby, and one that almost never requires treatment to reach its finest colour.</p>
<p>That last detail matters more than it sounds. A natural, unheated Spinel is exactly what the earth made — its colour, its inclusions, its faint internal weather all original. Nothing about it has been corrected.</p>
<h2>Artisanal Mining vs Industrial Mass Production</h2>
<p>The pits around Ratnapura are dug by hand, timbered by hand, and worked by small teams who have often held the same claim for generations. A shaft is narrow, seasonal, and refilled when it is spent. Nothing is dredged; no riverbank is stripped; no tailings pond is left behind.</p>
<p>Industrial extraction works the opposite way — volume first, landscape second. We buy only from traditional small-scale miners, in person, at the pit or the morning market, because it is the only method that leaves the river as it was and pays the person who found the stone.</p>
<blockquote class="article-pull-quote"><p>Every natural Spinel carries the fingerprint of the earth — no two rings will ever be identical.</p></blockquote>
<h2>The Art of Hand-Hammering 925 Sterling Silver</h2>
<p>A hammered band begins as a plain length of 925 sterling. The silversmith works it over a polished steel stake, strike by strike, until the surface holds hundreds of shallow facets that catch light from every angle. The pattern cannot be programmed — the rhythm of the hand is what makes it read as handmade.</p>
<p>Tree bark texture is slower still: the band is scored, annealed, and re-worked so the ridges run with the grain of the metal rather than across it. Only then is the bezel raised and the stone set open-backed, so light passes straight through the Spinel and onto the skin.</p>
<p>From pit to finger the stone passes perhaps six pairs of hands, all of them local, none of them a machine. That is the whole argument for making jewellery this way: the result is slower, scarcer, and unrepeatable.</p>';
}

/* -----------------------------------------------------------------------
 * WooCommerce catalog: 8 variable products (data mirrors src/data/products.js
 * shopProducts), each with a real "Ring Size" attribute + variations.
 * --------------------------------------------------------------------- */
function facetbound_seed_products_when_ready() {
    if (get_option('facetbound_products_seeded')) {
        return;
    }
    if (!class_exists('WooCommerce') || !function_exists('wc_get_product')) {
        return; // WooCommerce not active yet — will retry on next admin_init.
    }

    $size_terms = ['US 5', 'US 6', 'US 7', 'US 8', 'US 9', 'Open-Gap'];
    facetbound_ensure_attribute('ring-size', 'Ring Size', $size_terms);

    $collections = [
        'birthdays-personal-milestones' => ['name' => 'Birthdays & Personal Milestones', 'description' => 'Celebrating another year of growth.'],
        'anniversaries-commitments' => ['name' => 'Anniversaries & Commitments', 'description' => 'Hand-hammered rustic silver bands representing enduring journeys.'],
        'self-reward-achievements' => ['name' => 'Self-Reward & Achievements', 'description' => 'Graduations, promotions, or self-love treats to honor personal progress.'],
    ];
    $cat_ids = [];
    foreach ($collections as $slug => $collection) {
        $term = term_exists($slug, 'product_cat');
        $cat_ids[$slug] = $term ? (int) $term['term_id'] : (int) wp_insert_term($collection['name'], 'product_cat', ['slug' => $slug, 'description' => $collection['description']])['term_id'];
    }

    $products = [
        ['slug' => 'raw-edge-blue-topaz-solitaire', 'name' => 'The Raw-Edge Blue Topaz Solitaire Ring', 'gem' => 'Natural Blue Topaz', 'low' => 150, 'high' => 175, 'badge' => 'Ethically Sourced', 'cat' => 'birthdays-personal-milestones', 'featured' => true],
        ['slug' => 'hammered-spinel-band', 'name' => 'Hammered Spinel Band', 'gem' => 'Natural Spinel', 'low' => 155, 'high' => 170, 'badge' => 'Natural Stone', 'cat' => 'anniversaries-commitments'],
        ['slug' => 'tree-bark-amethyst-ring', 'name' => 'Tree Bark Amethyst Ring', 'gem' => 'Natural Amethyst', 'low' => 160, 'high' => 175, 'badge' => 'Ethically Sourced', 'cat' => 'anniversaries-commitments'],
        ['slug' => 'open-gap-moonstone-ring', 'name' => 'Open-Gap Moonstone Ring', 'gem' => 'Natural Moonstone', 'low' => 150, 'high' => 165, 'badge' => 'Natural Stone', 'cat' => 'self-reward-achievements'],
        ['slug' => 'high-polish-tourmaline-solitaire', 'name' => 'High-Polish Tourmaline Solitaire', 'gem' => 'Natural Tourmaline', 'low' => 165, 'high' => 175, 'badge' => 'Ethically Sourced', 'cat' => 'self-reward-achievements'],
        ['slug' => 'textured-band-blue-topaz-ring', 'name' => 'Textured Band Blue Topaz Ring', 'gem' => 'Natural Blue Topaz', 'low' => 158, 'high' => 172, 'badge' => 'Natural Stone', 'cat' => 'birthdays-personal-milestones'],
        ['slug' => 'hammered-amethyst-solitaire', 'name' => 'Hammered Amethyst Solitaire', 'gem' => 'Natural Amethyst', 'low' => 150, 'high' => 168, 'badge' => 'Ethically Sourced', 'cat' => 'anniversaries-commitments'],
        ['slug' => 'adjustable-spinel-band', 'name' => 'Adjustable Spinel Band', 'gem' => 'Natural Spinel', 'low' => 155, 'high' => 175, 'badge' => 'Natural Stone', 'cat' => 'anniversaries-commitments'],
    ];

    foreach ($products as $p) {
        $existing = get_page_by_path($p['slug'], OBJECT, 'product');
        if ($existing) {
            continue;
        }

        $product = new WC_Product_Variable();
        $product->set_name($p['name']);
        $product->set_slug($p['slug']);
        $product->set_status('publish');
        $product->set_catalog_visibility('visible');
        $product->set_description(sprintf(
            'Handcrafted 925 Sterling Silver ring with an artisanal finish, holding a natural, ethically sourced Sri Lankan %s.',
            $p['gem']
        ));
        $product->set_short_description(sprintf('%s | 925 Sterling Silver', $p['gem']));
        $product->set_category_ids([$cat_ids[$p['cat']]]);

        $attribute = new WC_Product_Attribute();
        $tax = wc_attribute_taxonomy_name('ring-size');
        $attribute->set_id(wc_attribute_taxonomy_id_by_name('ring-size'));
        $attribute->set_name($tax);
        $attribute->set_options(facetbound_term_ids($tax, $size_terms));
        $attribute->set_position(0);
        $attribute->set_visible(true);
        $attribute->set_variation(true);
        $product->set_attributes([$attribute]);

        $tag_slug = $p['badge'] === 'Ethically Sourced' ? 'ethically-sourced' : 'natural-stone';
        wp_set_post_terms($product->get_id() ?: 0, [], 'product_tag'); // no-op until saved
        $product_id = $product->save();
        wp_set_object_terms($product_id, [$tag_slug], 'product_tag');
        if (!empty($p['featured'])) {
            wp_set_object_terms($product_id, ['featured'], 'product_tag', true);
            update_post_meta($product_id, '_featured', 'yes');
        }

        $step = ($p['high'] - $p['low']) / max(1, count($size_terms) - 1);
        foreach ($size_terms as $i => $size) {
            $variation = new WC_Product_Variation();
            $variation->set_parent_id($product_id);
            $variation->set_attributes([$tax => sanitize_title($size)]);
            $price = round($p['low'] + ($step * $i));
            $variation->set_regular_price($price);
            $variation->set_manage_stock(false);
            $variation->set_stock_status('instock');
            $variation->save();
        }

        wc_delete_product_transients($product_id);
    }

    update_option('facetbound_products_seeded', 1);
}

function facetbound_ensure_attribute($slug, $label, $terms) {
    if (!taxonomy_exists(wc_attribute_taxonomy_name($slug))) {
        wc_create_attribute([
            'name' => $label,
            'slug' => $slug,
            'type' => 'select',
            'order_by' => 'menu_order',
            'has_archives' => false,
        ]);
        // Attribute taxonomies must be (re)registered before terms can be inserted.
        $taxonomies = wc_get_attribute_taxonomies();
        foreach ($taxonomies as $tax) {
            register_taxonomy(
                wc_attribute_taxonomy_name($tax->attribute_name),
                ['product'],
                ['hierarchical' => false]
            );
        }
    }
    $tax = wc_attribute_taxonomy_name($slug);
    foreach ($terms as $i => $term) {
        if (!term_exists($term, $tax)) {
            wp_insert_term($term, $tax, ['slug' => sanitize_title($term)]);
        }
    }
}

function facetbound_term_ids($tax, $terms) {
    $ids = [];
    foreach ($terms as $term) {
        $t = get_term_by('name', $term, $tax);
        if ($t) {
            $ids[] = $t->term_id;
        }
    }
    return $ids;
}
