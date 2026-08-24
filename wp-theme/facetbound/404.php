<?php
/**
 * 404 template.
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<section class="journal-page-header" style="text-align:center;padding:140px var(--section-x)">
    <h1>Page Not Found</h1>
    <p>The page you're looking for doesn't exist or has moved.</p>
    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-terracotta" style="margin-top:24px">Back to Home</a>
</section>
<?php get_footer(); ?>
