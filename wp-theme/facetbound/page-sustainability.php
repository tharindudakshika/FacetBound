<?php
/**
 * Template Name: Sustainability
 *
 * All content lives in the "Sustainability" page's real block editor
 * content (edit it in wp-admin) — this file is intentionally a thin
 * wrapper.
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

get_footer();
