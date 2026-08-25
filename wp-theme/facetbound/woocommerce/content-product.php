<?php
/**
 * Product card partial rendered once per product inside the Shop loop
 * (woocommerce/archive-product.php). Mirrors the <ProductCard> component
 * in src/pages/ShopCollection.jsx. WooCommerce sets up $product for us
 * on each iteration of the loop before calling wc_get_template_part().
 */

if (!defined('ABSPATH')) {
    exit;
}

global $product;

if (!$product instanceof WC_Product) {
    $product = wc_get_product(get_the_ID());
}

if (!$product || !$product->is_visible()) {
    return;
}

$name = $product->get_name();
$badge = has_term('ethically-sourced', 'product_tag', $product->get_id()) ? 'Ethically Sourced' : 'Natural Stone';

// Both layered placeholders fill the .shopcol-card-img box (position:relative,
// overflow:hidden, height:360px in pages.css); pages.css only defines the
// opacity/transition rules for .shopcol-img-base / .shopcol-img-hover, so the
// absolute-fill positioning (matching the original inline style in
// ShopCollection.jsx) is supplied here inline.
$layer_style = 'position:absolute;inset:0;';
?>
<div class="shopcol-card">
    <a href="<?php echo esc_url(get_permalink()); ?>" class="shopcol-card-img">
        <?php
        $gallery_ids = $product->get_gallery_image_ids();
        $base_id = $product->get_image_id();
        $hover_id = !empty($gallery_ids) ? $gallery_ids[0] : 0;

        if ($base_id) {
            echo wp_get_attachment_image($base_id, 'large', false, ['class' => 'shopcol-img-base', 'style' => $layer_style . 'width:100%;height:100%;object-fit:cover']);
        } else {
            facetbound_placeholder('light', $name . ', lifestyle shot', [
                'class' => 'shopcol-img-base',
                'style' => $layer_style,
            ]);
        }

        if ($hover_id) {
            echo wp_get_attachment_image($hover_id, 'large', false, ['class' => 'shopcol-img-hover', 'style' => $layer_style . 'width:100%;height:100%;object-fit:cover']);
        } else {
            facetbound_placeholder('warm', $name . ', on-finger close-up', [
                'class' => 'shopcol-img-hover',
                'style' => $layer_style,
            ]);
        }
        ?>
        <span class="shopcol-badge"><?php echo esc_html($badge); ?></span>
    </a>

    <h3 class="shopcol-card-name"><?php echo esc_html($name); ?></h3>
    <p class="shopcol-card-detail"><?php echo esc_html($product->get_short_description()); ?></p>
    <p class="shopcol-card-price"><?php echo $product->get_price_html(); ?></p>

    <div class="shopcol-card-actions">
        <a href="<?php echo esc_url(get_permalink()); ?>" class="shopcol-btn shopcol-btn-outline-emerald">
            Add to Cart
        </a>
        <a
            class="shopcol-btn shopcol-btn-whatsapp"
            href="https://wa.me/?text=<?php echo esc_attr(rawurlencode("Hi! I'm interested in the " . $name)); ?>"
            target="_blank"
            rel="noopener noreferrer"
        >
            <i class="fa-brands fa-whatsapp"></i>
            WhatsApp
        </a>
    </div>
</div>
