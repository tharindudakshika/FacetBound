<?php
/**
 * Mirrors src/components/Footer.jsx.
 */
if (!defined('ABSPATH')) {
    exit;
}
?>
<footer class="fb-footer">
    <div class="container fb-footer__top">
        <div class="fb-footer__brand">
            <div class="fb-footer__wordmark">Facetbound</div>
            <p>Organic luxury, hand-shaped. Ethically sourced Sri Lankan gemstones in 925 sterling silver.</p>
            <div class="fb-footer__social">
                <a href="#" class="fb-footer__social-icon" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" class="fb-footer__social-icon" aria-label="Pinterest"><i class="fa-brands fa-pinterest-p"></i></a>
                <a href="#" class="fb-footer__social-icon" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
            </div>
        </div>
        <div class="fb-footer__col">
            <div class="fb-footer__label">Policies</div>
            <a href="<?php echo esc_url(home_url('/shipping-policy/')); ?>" class="fb-footer__policy-link">Shipping Policy</a>
            <a href="<?php echo esc_url(home_url('/returns-exchanges/')); ?>" class="fb-footer__policy-link">Returns &amp; Exchanges</a>
            <a href="<?php echo esc_url(home_url('/warranty-policy/')); ?>" class="fb-footer__policy-link">Warranty Policy</a>
            <a href="<?php echo esc_url(home_url('/accessibility-policy/')); ?>" class="fb-footer__policy-link">Accessibility Policy</a>
            <a href="<?php echo esc_url(home_url('/cookies-policy/')); ?>" class="fb-footer__policy-link">Cookies Policy</a>
            <a href="#" class="fb-footer__policy-link">Ring Size Guide</a>
            <a href="#" class="fb-footer__policy-link">FAQ</a>
        </div>
        <div class="fb-footer__col">
            <div class="fb-footer__label">Join the Circle</div>
            <p class="fb-footer__copy">Early access to new drops and 10% off your first order.</p>
            <form class="fb-footer__form" action="#" method="post">
                <input type="email" name="fb_newsletter_email" placeholder="Email address" aria-label="Email address" required>
                <button type="submit">Join</button>
            </form>
        </div>
    </div>
    <div class="container fb-footer__bottom">
        <div class="fb-footer__copyright">&copy; <?php echo esc_html(date('Y')); ?> Facetbound. All rights reserved.</div>
        <div class="fb-footer__payments">
            <div class="fb-footer__badge"><i class="fa-brands fa-cc-paypal"></i><span>PayPal</span></div>
            <div class="fb-footer__badge"><i class="fa-brands fa-cc-visa"></i><span>Visa</span></div>
            <div class="fb-footer__badge"><i class="fa-brands fa-cc-mastercard"></i><span>Mastercard</span></div>
        </div>
        <a href="#" class="fb-footer__policy-link" data-cookie-consent="open-settings">Cookie Settings</a>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
