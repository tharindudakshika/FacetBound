<?php
/**
 * Journal index/listing — WordPress auto-selects this for the site's
 * "Posts page" (page_for_posts, slug `journal`). The page header copy
 * and newsletter section live in the "Journal" page's real block editor
 * content (edit it in wp-admin); the featured article, category nav,
 * and post grid are embedded as shortcodes so they always reflect live
 * content. This file is intentionally a thin wrapper.
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

$journal_page = get_post(get_option('page_for_posts'));
if ($journal_page) {
    echo apply_filters('the_content', $journal_page->post_content);
}

get_footer();
