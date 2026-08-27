<?php
/**
 * The mandatory fallback template every classic WordPress theme must
 * have. Used for: category/tag archives (Journal's "Gemology 101" /
 * "Artisan Craft" / "Care Guides" links, since this theme has no
 * dedicated category.php), search results, author archives, and any
 * other request none of the more specific templates in this theme
 * (front-page.php, home.php, single.php, page-*.php, woocommerce/*.php)
 * claim. Reuses the Journal grid's classes/pattern for a consistent look.
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<?php
if (is_search()) {
    $hero_title = 'Search Results';
    $hero_subtitle = sprintf(
        /* translators: 1: number of results, 2: search query */
        __('%1$s results found for "%2$s"', 'facetbound'),
        (int) $wp_query->found_posts,
        get_search_query()
    );
} elseif (is_category() || is_tag() || is_tax()) {
    $hero_title = single_term_title('', false);
    $hero_subtitle = term_description() ? wp_strip_all_tags(term_description()) : '';
} elseif (is_author()) {
    $hero_title = get_the_author();
    $hero_subtitle = '';
} elseif (is_day() || is_month() || is_year()) {
    $hero_title = get_the_archive_title();
    $hero_subtitle = '';
} else {
    $hero_title = get_bloginfo('name');
    $hero_subtitle = '';
}

facetbound_hero([
    'min_height' => 260,
    'padding' => '56px',
    'title' => $hero_title,
    'subtitle' => $hero_subtitle,
    'max_width' => 640,
]);
?>

<?php if (is_category() || is_tag() || is_tax('category')) : ?>
<section class="journal-category-nav-section">
    <div class="container">
        <nav class="journal-category-nav">
            <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="journal-category-item">
                All Stories
            </a>
            <?php foreach (get_categories(['hide_empty' => false]) as $cat) : ?>
                <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>" class="journal-category-item<?php echo is_category($cat->term_id) ? ' journal-category-item--active' : ''; ?>">
                    <?php echo esc_html($cat->name); ?>
                </a>
            <?php endforeach; ?>
        </nav>
    </div>
</section>
<?php endif; ?>

<section class="journal-grid-section">
    <div class="container">
        <?php if (have_posts()) : ?>
            <div class="journal-grid">
                <?php
                while (have_posts()) :
                    the_post();
                    if (get_post_type() === 'product') {
                        // A product ended up in a generic loop (e.g. product
                        // tag archive) — hand it to WooCommerce's own card
                        // partial instead of the Journal card markup.
                        wc_get_template_part('content', 'product');
                        continue;
                    }
                    $cats = get_the_category();
                    $primary_cat = !empty($cats) ? $cats[0]->name : '';
                    ?>
                    <a href="<?php the_permalink(); ?>" class="journal-card">
                        <?php facetbound_placeholder('light', get_the_title() . ' photo', ['style' => 'border-radius:12px;height:240px']); ?>
                        <div class="journal-card-body">
                            <span class="journal-card-meta">
                                <?php echo esc_html(get_the_date('F j, Y')); ?>
                                <?php if ($primary_cat) : ?>
                                    &bull; <?php echo esc_html($primary_cat); ?>
                                <?php endif; ?>
                            </span>
                            <h3><?php the_title(); ?></h3>
                            <span class="journal-card-link">
                                Read <i class="fa-solid fa-arrow-right"></i>
                            </span>
                        </div>
                    </a>
                <?php endwhile; ?>
            </div>
            <?php the_posts_pagination(); ?>
        <?php else : ?>
            <p><?php esc_html_e('Nothing found here yet.', 'facetbound'); ?></p>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
