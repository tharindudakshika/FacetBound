<?php
/**
 * Title: Checkout Express Payment Banner
 * Slug: facetbound/checkout-express-banner
 * Categories: facetbound
 * Description: PayPal / Apple Pay / Google Pay express-checkout preview row + divider, shown above the Checkout block. Insert it just above the WooCommerce Checkout block on the Checkout template via the Site Editor. Buttons activate automatically once the matching payment gateway plugin is installed and configured.
 */
?>
<!-- wp:group {"className":"checkout-express","layout":{"type":"flex","flexWrap":"wrap"}} -->
<div class="wp-block-group checkout-express">

<!-- wp:html -->
<button type="button" class="checkout-express__paypal" disabled>Express Checkout with PayPal</button>
<!-- /wp:html -->

<!-- wp:html -->
<button type="button" class="checkout-express__wallet" disabled>
    <i class="fa-brands fa-apple"></i> <span> / </span> <i class="fa-brands fa-google"></i>
    <span>Express Checkout with Apple Pay / Google Pay</span>
</button>
<!-- /wp:html -->

</div>
<!-- /wp:group -->

<!-- wp:group {"className":"checkout-divider","layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-group checkout-divider">
<span></span>
<!-- wp:paragraph -->
<p>OR CONTINUE WITH STANDARD CHECKOUT</p>
<!-- /wp:paragraph -->
<span></span>
</div>
<!-- /wp:group -->
