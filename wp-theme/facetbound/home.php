<?php
/**
 * Journal index / listing template — WordPress auto-selects this file for
 * the site's "Posts page" (page_for_posts, slug `journal`). Mirrors
 * src/pages/Journal.jsx, adapted to real WP_Query loops.
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

$journal_url = get_permalink(get_option('page_for_posts'));

$featured_post = get_page_by_path('journey-of-a-natural-spinel', OBJECT, 'post');
$featured_id = $featured_post ? $featured_post->ID : 0;

$categories = get_categories(['hide_empty' => false]);
?>

<!-- Page Header -->
<?php
facetbound_hero([
    'min_height' => 260,
    'padding' => '56px',
    'caption' => 'hero image: artisan workbench, loose gemstones and silversmithing tools',
    'kicker' => 'The Facetbound Journal',
    'title' => 'Notes From the Mine &amp; Studio',
    'subtitle' => 'Insights on natural Sri Lankan gemology, ethical silversmithing, and how to choose the perfect gemstone ring to commemorate your life’s meaningful milestones.',
    'max_width' => 640,
]);
?>

<?php if ($featured_post) : ?>
<!-- Featured Article -->
<section class="journal-featured-section">
    <div class="container">
        <div class="journal-featured">
            <?php facetbound_placeholder('light', 'gem pit / raw gemstone glistening in natural light', ['boxed' => true, 'style' => 'min-height:440px']); ?>
            <div class="journal-featured-body">
                <span class="journal-featured-badge">Ethical Sourcing</span>
                <h2><?php echo esc_html(get_the_title($featured_post)); ?></h2>
                <p><?php echo esc_html(get_the_excerpt($featured_post)); ?></p>
                <a href="<?php echo esc_url(get_permalink($featured_post)); ?>" class="btn btn-terracotta journal-featured-cta">
                    Read the Full Story
                </a>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Category Nav -->
<section class="journal-category-nav-section">
    <div class="container">
        <nav class="journal-category-nav">
            <a href="<?php echo esc_url($journal_url); ?>" class="journal-category-item<?php echo is_home() ? ' journal-category-item--active' : ''; ?>">
                All Stories
            </a>
            <?php foreach ($categories as $cat) : ?>
                <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>" class="journal-category-item">
                    <?php echo esc_html($cat->name); ?>
                </a>
            <?php endforeach; ?>
        </nav>
    </div>
</section>

<!-- Journal Grid -->
<section class="journal-grid-section">
    <div class="container">
        <div class="journal-grid">
            <?php
            $journal_query = new WP_Query([
                'post__not_in' => [$featured_id],
                'posts_per_page' => 6,
            ]);
            if ($journal_query->have_posts()) :
                while ($journal_query->have_posts()) : $journal_query->the_post();
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
                <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
</section>

<?php facetbound_concierge_cta(); ?>

<?php get_footer(); ?>
