<?php
/**
 * Virtual Appointment booking form handler — real submission via
 * admin-post.php, sent with wp_mail() to the site's admin email
 * (Settings > General), mirroring inc/contact-form.php.
 */

if (!defined('ABSPATH')) {
    exit;
}

add_action('admin_post_facetbound_appointment', 'facetbound_handle_appointment_form');
add_action('admin_post_nopriv_facetbound_appointment', 'facetbound_handle_appointment_form');

function facetbound_handle_appointment_form() {
    $redirect = wp_get_referer() ?: home_url('/virtual-appointment/');
    $redirect = strtok($redirect, '#') . '#booking';

    if (
        !isset($_POST['facetbound_appointment_nonce'])
        || !wp_verify_nonce($_POST['facetbound_appointment_nonce'], 'facetbound_appointment')
    ) {
        wp_safe_redirect(add_query_arg('appointment', 'error', $redirect));
        exit;
    }

    // Honeypot: a real visitor never fills this hidden field; bots often do.
    if (!empty($_POST['facetbound_appointment_company'])) {
        wp_safe_redirect(add_query_arg('appointment', 'success', $redirect));
        exit;
    }

    $name = isset($_POST['appointment_name']) ? sanitize_text_field(wp_unslash($_POST['appointment_name'])) : '';
    $email = isset($_POST['appointment_email']) ? sanitize_email(wp_unslash($_POST['appointment_email'])) : '';
    $duration = isset($_POST['appointment_duration']) ? sanitize_text_field(wp_unslash($_POST['appointment_duration'])) : '';
    $date = isset($_POST['appointment_date']) ? sanitize_text_field(wp_unslash($_POST['appointment_date'])) : '';
    $time = isset($_POST['appointment_time']) ? sanitize_text_field(wp_unslash($_POST['appointment_time'])) : '';
    $timezone = isset($_POST['appointment_timezone']) ? sanitize_text_field(wp_unslash($_POST['appointment_timezone'])) : '';
    $interest = isset($_POST['appointment_interest']) ? sanitize_text_field(wp_unslash($_POST['appointment_interest'])) : '';
    $gemstone = isset($_POST['appointment_gemstone']) ? sanitize_text_field(wp_unslash($_POST['appointment_gemstone'])) : '';
    $notes = isset($_POST['appointment_notes']) ? sanitize_textarea_field(wp_unslash($_POST['appointment_notes'])) : '';

    if (!$name || !$email || !is_email($email) || !$duration || !$date || !$time) {
        wp_safe_redirect(add_query_arg('appointment', 'error', $redirect));
        exit;
    }

    $to = get_option('admin_email');
    $mail_subject = sprintf('[Facetbound Virtual Appointment] %s — %s', $name, $duration);
    $body = "A new virtual consultation was requested via the Facetbound Virtual Appointment page.\n\n"
        . "Name: {$name}\n"
        . "Email: {$email}\n"
        . "Session Length: {$duration}\n"
        . "Preferred Date: {$date}\n"
        . "Preferred Time: {$time}\n"
        . "Time Zone: " . ($timezone ?: '(not detected)') . "\n"
        . "Interest: " . ($interest ?: '(none selected)') . "\n"
        . "Preferred Gemstone: " . ($gemstone ?: '(no preference)') . "\n\n"
        . "Notes/Ideas:\n" . ($notes ?: '(none)') . "\n";

    $sent = wp_mail($to, $mail_subject, $body, ['Reply-To: ' . $name . ' <' . $email . '>']);

    wp_safe_redirect(add_query_arg('appointment', $sent ? 'success' : 'error', $redirect));
    exit;
}
