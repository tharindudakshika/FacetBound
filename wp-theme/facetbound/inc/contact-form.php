<?php
/**
 * Contact page form handler — real submission via admin-post.php, sent
 * with wp_mail() to the site's admin email (Settings > General).
 */

if (!defined('ABSPATH')) {
    exit;
}

add_action('admin_post_facetbound_contact', 'facetbound_handle_contact_form');
add_action('admin_post_nopriv_facetbound_contact', 'facetbound_handle_contact_form');

function facetbound_handle_contact_form() {
    $redirect = wp_get_referer() ?: home_url('/contact/');

    if (
        !isset($_POST['facetbound_contact_nonce'])
        || !wp_verify_nonce($_POST['facetbound_contact_nonce'], 'facetbound_contact')
    ) {
        wp_safe_redirect(add_query_arg('contact', 'error', $redirect));
        exit;
    }

    // Honeypot: a real visitor never fills this hidden field; bots often do.
    if (!empty($_POST['facetbound_contact_company'])) {
        wp_safe_redirect(add_query_arg('contact', 'success', $redirect));
        exit;
    }

    $name = isset($_POST['contact_name']) ? sanitize_text_field(wp_unslash($_POST['contact_name'])) : '';
    $email = isset($_POST['contact_email']) ? sanitize_email(wp_unslash($_POST['contact_email'])) : '';
    $subject = isset($_POST['contact_subject']) ? sanitize_text_field(wp_unslash($_POST['contact_subject'])) : '';
    $message = isset($_POST['contact_message']) ? sanitize_textarea_field(wp_unslash($_POST['contact_message'])) : '';

    if (!$name || !$email || !is_email($email) || !$message) {
        wp_safe_redirect(add_query_arg('contact', 'error', $redirect));
        exit;
    }

    $to = get_option('admin_email');
    $mail_subject = sprintf('[Facetbound Contact] %s', $subject ?: 'New message from ' . $name);
    $body = "You've received a new message via the Facetbound Contact page.\n\n"
        . "Name: {$name}\n"
        . "Email: {$email}\n"
        . "Subject: " . ($subject ?: '(none)') . "\n\n"
        . "Message:\n{$message}\n";

    $sent = wp_mail($to, $mail_subject, $body, ['Reply-To: ' . $name . ' <' . $email . '>']);

    wp_safe_redirect(add_query_arg('contact', $sent ? 'success' : 'error', $redirect));
    exit;
}
