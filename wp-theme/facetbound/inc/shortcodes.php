<?php
/**
 * Dynamic, WooCommerce/post-backed sections embedded as shortcodes inside
 * the otherwise block-editable Home and Journal page content — so these
 * stay live/automatic while the surrounding copy is freely editable.
 *
 * Each one prefers a REAL uploaded image (product image, category
 * thumbnail, or post featured image) when present, falling back to the
 * design's striped placeholder only until real photography is added —
 * so uploading a photo the normal WordPress/WooCommerce way is all it
 * takes to replace it, no code or re-seeding required.
 */

if (!defined('ABSPATH')) {
    exit;
}

add_shortcode('facetbound_curated_collections', 'facetbound_sc_curated_collections');
function facetbound_sc_curated_collections() {
    if (!class_exists('WooCommerce')) {
        return '';
    }
    $captions = [
        'blue-topaz-collection' => 'blue topaz ring, studio shot',
        'artisan-textured-bands' => 'hammered & tree bark texture band',
        'minimalist-solitaires' => 'minimalist solitaire ring',
    ];
    $terms = get_terms([
        'taxonomy' => 'product_cat',
        'hide_empty' => false,
        'slug' => array_keys($captions),
    ]);
    if (is_wp_error($terms) || empty($terms)) {
        return '';
    }
    usort($terms, function ($a, $b) use ($captions) {
        return array_search($a->slug, array_keys($captions)) <=> array_search($b->slug, array_keys($captions));
    });

    ob_start();
    ?>
    <div class="home-collections__grid">
        <?php foreach ($terms as $term) :
            $thumb_id = get_term_meta($term->term_id, 'thumbnail_id', true);
            ?>
            <a href="<?php echo esc_url(get_term_link($term)); ?>">
                <div class="home-collection-card__img-wrap">
                    <?php if ($thumb_id) : ?>
                        <?php echo wp_get_attachment_image($thumb_id, 'large', false, ['style' => 'width:100%;height:340px;object-fit:cover;display:block']); ?>
                    <?php else : ?>
                        <?php facetbound_placeholder('light', $captions[$term->slug] ?? $term->name); ?>
                    <?php endif; ?>
                </div>
                <p class="home-collection-card__title"><?php echo esc_html($term->name); ?></p>
            </a>
        <?php endforeach; ?>
    </div>
    <?php
    return ob_get_clean();
}

add_shortcode('facetbound_featured_products', 'facetbound_sc_featured_products');
function facetbound_sc_featured_products() {
    if (!class_exists('WooCommerce') || !function_exists('wc_get_products')) {
        return '';
    }
    $products = wc_get_products(['limit' => 8, 'status' => 'publish', 'orderby' => 'date', 'order' => 'ASC']);
    if (empty($products)) {
        return '';
    }
    ob_start();
    ?>
    <div class="home-featured__grid">
        <?php foreach ($products as $product) : ?>
            <div class="home-product-card">
                <a href="<?php echo esc_url(get_permalink($product->get_id())); ?>" class="home-product-img-wrap">
                    <?php if ($product->get_image_id()) : ?>
                        <?php echo wp_get_attachment_image($product->get_image_id(), 'large', false, ['style' => 'width:100%;height:260px;object-fit:cover;display:block']); ?>
                    <?php else : ?>
                        <?php facetbound_placeholder('light', $product->get_name() . ', product photo'); ?>
                    <?php endif; ?>
                    <span class="home-product-quickview">
                        <svg width="15" height="15" viewBox="0 0 18 18" fill="none"><circle cx="8" cy="8" r="6" stroke="#0F2E23" stroke-width="1.6"/><line x1="12.5" y1="12.5" x2="17" y2="17" stroke="#0F2E23" stroke-width="1.6" stroke-linecap="round"/></svg>
                    </span>
                </a>
                <p class="home-product-name"><?php echo esc_html($product->get_name()); ?></p>
                <div class="home-product-price"><?php echo wp_kses_post($product->get_price_html()); ?></div>
                <div class="home-product-actions">
                    <a href="<?php echo esc_url(get_permalink($product->get_id())); ?>" class="home-btn-sm home-btn-outline-emerald">Add to Cart</a>
                    <a href="https://wa.me/?text=<?php echo rawurlencode("Hi! I'm interested in the " . $product->get_name()); ?>" target="_blank" rel="noopener noreferrer" class="home-btn-sm home-btn-whatsapp">
                        <i class="fa-brands fa-whatsapp"></i> WhatsApp
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php
    return ob_get_clean();
}

add_shortcode('facetbound_journal_featured', 'facetbound_sc_journal_featured');
function facetbound_sc_journal_featured() {
    $featured_post = get_page_by_path('journey-of-a-natural-spinel', OBJECT, 'post');
    if (!$featured_post) {
        return '';
    }
    ob_start();
    ?>
    <div class="journal-featured">
        <?php if (has_post_thumbnail($featured_post)) : ?>
            <?php echo get_the_post_thumbnail($featured_post, 'large', ['style' => 'width:100%;height:100%;min-height:440px;object-fit:cover;display:block']); ?>
        <?php else : ?>
            <?php facetbound_placeholder('light', 'gem pit / raw gemstone glistening in natural light', ['boxed' => true, 'style' => 'min-height:440px']); ?>
        <?php endif; ?>
        <div class="journal-featured-body">
            <span class="journal-featured-badge">Ethical Sourcing</span>
            <h2><?php echo esc_html(get_the_title($featured_post)); ?></h2>
            <p><?php echo esc_html(get_the_excerpt($featured_post)); ?></p>
            <a href="<?php echo esc_url(get_permalink($featured_post)); ?>" class="btn btn-terracotta journal-featured-cta">
                Read the Full Story
            </a>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

add_shortcode('facetbound_journal_category_nav', 'facetbound_sc_journal_category_nav');
function facetbound_sc_journal_category_nav() {
    $journal_url = get_permalink(get_option('page_for_posts'));
    $categories = get_categories(['hide_empty' => false]);
    ob_start();
    ?>
    <nav class="journal-category-nav">
        <a href="<?php echo esc_url($journal_url); ?>" class="journal-category-item<?php echo is_home() ? ' journal-category-item--active' : ''; ?>">
            All Stories
        </a>
        <?php foreach ($categories as $cat) : ?>
            <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>" class="journal-category-item<?php echo is_category($cat->term_id) ? ' journal-category-item--active' : ''; ?>">
                <?php echo esc_html($cat->name); ?>
            </a>
        <?php endforeach; ?>
    </nav>
    <?php
    return ob_get_clean();
}

add_shortcode('facetbound_journal_grid', 'facetbound_sc_journal_grid');
function facetbound_sc_journal_grid() {
    $featured_post = get_page_by_path('journey-of-a-natural-spinel', OBJECT, 'post');
    $featured_id = $featured_post ? $featured_post->ID : 0;

    $query = new WP_Query([
        'post__not_in' => [$featured_id],
        'posts_per_page' => 6,
    ]);
    if (!$query->have_posts()) {
        return '';
    }

    ob_start();
    ?>
    <div class="journal-grid">
        <?php
        while ($query->have_posts()) :
            $query->the_post();
            $cats = get_the_category();
            $primary_cat = !empty($cats) ? $cats[0]->name : '';
            ?>
            <a href="<?php the_permalink(); ?>" class="journal-card">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('large', ['style' => 'width:100%;height:240px;object-fit:cover;border-radius:12px;display:block']); ?>
                <?php else : ?>
                    <?php facetbound_placeholder('light', get_the_title() . ' photo', ['style' => 'border-radius:12px;height:240px']); ?>
                <?php endif; ?>
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
    <?php
    wp_reset_postdata();
    return ob_get_clean();
}
