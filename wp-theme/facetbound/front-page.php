<?php
/**
 * Homepage — WordPress auto-selects this for the site's front page.
 * All content lives in the "Home" page's real block editor content
 * (edit it at wp-admin/post.php?post=<home_id>&action=edit); the
 * Curated Collections / Featured Products sections are embedded as
 * shortcodes so they always reflect live WooCommerce data. This file
 * is intentionally just a thin wrapper — do not add page markup here.
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

if (have_posts()) {
    while (have_posts()) {
        the_post();
        the_content();
    }
}

facetbound_concierge_cta();

get_footer();
