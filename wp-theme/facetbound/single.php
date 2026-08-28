<?php
/**
 * Individual Journal Article template — WordPress auto-selects this file
 * for all single posts. Mirrors src/pages/JournalArticle.jsx, adapted to
 * a real dynamic post (the_content()) instead of a hardcoded article.
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

$shop_url = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop/');

while (have_posts()) : the_post();
    $post_id = get_the_ID();
    $cats = get_the_category();
    $primary_cat = !empty($cats) ? $cats[0]->name : '';
    ?>

    <!-- Article Header -->
    <section class="article-header">
        <span class="article-badge"><?php echo has_category('Gemology 101') ? 'Ethical Sourcing &middot; Gemology 101' : esc_html($primary_cat); ?></span>
        <h1><?php the_title(); ?></h1>
        <div class="article-meta">
            By FACETBOUND Lead Gemologist &bull; <?php echo esc_html(get_the_date('F Y')); ?> &bull; <?php echo esc_html(facetbound_read_time($post_id)); ?>
        </div>
    </section>

    <!-- Banner -->
    <section class="article-banner-section">
        <div class="container">
            <?php facetbound_placeholder('light', 'banner: ' . get_the_title(), ['boxed' => true, 'style' => 'border-radius:16px;height:460px']); ?>
        </div>
    </section>

    <!-- Body + Sidebar -->
    <section class="article-body-section">
        <div class="container article-body-grid">
            <article class="article-content">
                <?php the_content(); ?>

                <div class="article-product-embed">
                    <?php facetbound_placeholder('light', 'macro: Spinel ring', ['style' => 'border-radius:10px;width:132px;height:132px;flex-shrink:0']); ?>
                    <div class="article-product-info">
                        <span class="article-product-kicker">Featured Piece</span>
                        <h3 class="article-product-title">The Artisanal Raw-Edge Spinel Ring</h3>
                        <p class="article-product-sub">
                            925 Sterling Silver &middot; Natural Untreated Spinel
                        </p>
                        <a href="<?php echo esc_url($shop_url); ?>" class="btn btn-terracotta article-product-cta">
                            View Ring Details
                        </a>
                    </div>
                </div>

                <div class="article-share-row">
                    <div class="article-share-label">Share this story</div>
                    <div class="article-share-chips">
                        <a href="#" class="article-share-chip">
                            <i class="fa-brands fa-pinterest-p"></i> Pinterest
                        </a>
                        <a href="#" class="article-share-chip">
                            <i class="fa-brands fa-facebook-f"></i> Facebook
                        </a>
                        <a href="#" class="article-share-chip">
                            <i class="fa-brands fa-x-twitter"></i> X
                        </a>
                        <a href="#" class="article-share-chip">
                            <i class="fa-solid fa-envelope"></i> Email
                        </a>
                    </div>
                </div>

                <div class="article-author-bio">
                    <div class="article-author-avatar">
                        <i class="fa-solid fa-gem"></i>
                    </div>
                    <div class="article-author-info">
                        <span class="article-author-kicker">Written by</span>
                        <div class="article-author-name">FACETBOUND Gemological Team</div>
                        <p class="article-author-text">
                            Our gemologists and master silversmiths in Sri Lanka is sharing expert insights
                            on the untreated gemstones we source and the 925 sterling silver bands we shape
                            by hand to commemorate life&rsquo;s most cherished milestones.
                        </p>
                    </div>
                </div>
            </article>

            <aside class="article-sidebar">
                <div class="article-widget">
                    <div class="article-widget-wordmark">Facetbound</div>
                    <p class="article-widget-blurb">
                        Mined by Nature, Shaped by Hand. Ethically sourced Sri Lankan gemstones set in 925
                        sterling silver to celebrate your cherished personal milestones.
                    </p>
                    <a href="<?php echo esc_url(home_url('/our-story/')); ?>" class="article-widget-link">
                        Our Story <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>

                <div class="article-widget article-widget--ethics">
                    <span class="article-widget-kicker">Ethics &amp; Packaging</span>
                    <h3 class="article-widget-title">100% plastic-free, start to finish.</h3>
                    <ul class="article-widget-bullets">
                        <li>
                            <span class="article-dot"></span>
                            Octagonal teak wood keepsake box
                        </li>
                        <li>
                            <span class="article-dot"></span>
                            Terracotta board insert, no plastic foam
                        </li>
                        <li>
                            <span class="article-dot"></span>
                            Mitti Attar &mdash; the scent of rain on earth
                        </li>
                    </ul>
                </div>

                <div class="article-widget">
                    <span class="article-widget-label">Related Gem Guides</span>
                    <div class="article-widget-links">
                        <a href="#" class="article-widget-guide-link">
                            How to Care for 925 Sterling Silver Rings
                        </a>
                        <a href="#" class="article-widget-guide-link">
                            Spinel vs Sapphire: Which Gem Suits Your Energy?
                        </a>
                    </div>
                </div>
            </aside>
        </div>
    </section>

    <!-- Related Articles -->
    <section class="article-related-section">
        <div class="container">
            <h2 class="article-related-heading">
                Explore More Stories from the Mine &amp; Studio
            </h2>
            <div class="article-related-grid">
                <?php
                $related_query = new WP_Query([
                    'post__not_in' => [$post_id],
                    'posts_per_page' => 3,
                    'orderby' => 'rand',
                ]);
                if ($related_query->have_posts()) :
                    while ($related_query->have_posts()) : $related_query->the_post();
                        ?>
                        <a href="<?php the_permalink(); ?>" class="article-related-card">
                            <?php facetbound_placeholder('light', get_the_title(), ['style' => 'border-radius:12px;height:220px']); ?>
                            <div class="article-related-body">
                                <h3><?php the_title(); ?></h3>
                                <span class="article-related-readtime"><?php echo esc_html(facetbound_read_time(get_the_ID())); ?></span>
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

<?php
endwhile;

get_footer();
