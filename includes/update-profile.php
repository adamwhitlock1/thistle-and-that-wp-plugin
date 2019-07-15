<?php
/**
 * Created by PhpStorm.
 * User: adamwhitlock
 * Date: 9/24/18
 * Time: 2:48 PM
 */

/* Recheck if user is logged in just to be sure, this should have been done already */
if (!is_user_logged_in()) {
    wp_redirect(home_url());
    exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['action']) && $_POST['action'] == 'update-user') {
    $current_user = wp_get_current_user();
    /* Check nonce first to see if this is a legit request */
    if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'update-user')) {
        wp_redirect(get_permalink() . '?validation=unknown');
        exit;
    }
    /* Check honeypot for autmated requests */
    if (!empty($_POST['honey-name'])) {
        wp_redirect(get_permalink() . '?validation=unknown');
        exit;
    }
    /* Update profile fields */

    if (!empty($_POST['first-name'])) {
        $display_name = esc_attr($_POST['first-name']);
        update_user_meta($current_user->ID, 'first_name', esc_attr($_POST['first-name']));
    }
    if (!empty($_POST['last-name'])) {
        $display_name .= ' ' . esc_attr($_POST['last-name']);
        update_user_meta($current_user->ID, 'last_name', esc_attr($_POST['last-name']));
    }

    // FIANCES NAME
    if (!empty($_POST['fiances_name'])) {
        update_user_meta($current_user->ID, 'fiances_name', esc_attr($_POST['fiances_name']));
    }

    // BILLING ADDRESS 1
    if (!empty($_POST['billing_address_1'])) {
        update_user_meta($current_user->ID, 'billing_address_1', esc_attr($_POST['billing_address_1']));
    }

    // BILLING ADDRESS 2
    if (!empty($_POST['billing_address_2'])) {
        update_user_meta($current_user->ID, 'billing_address_2', esc_attr($_POST['billing_address_2']));
    }

    // BILLING CITY NAME
    if (!empty($_POST['billing_city'])) {
        update_user_meta($current_user->ID, 'billing_city', esc_attr($_POST['billing_city']));
    }

    // BILLING STATE
    if (!empty($_POST['state'])) {
        update_user_meta($current_user->ID, 'billing_state', esc_attr($_POST['state']));
        update_user_meta($current_user->ID, 'billing_country', "US");
    }

    // BILLING ZIP CODE
    if (!empty($_POST['billing_postcode'])) {
        update_user_meta($current_user->ID, 'billing_postcode', esc_attr($_POST['billing_postcode']));
    }

    // PHONE NUMBER
    if (!empty($_POST['phone_number'])) {
        update_user_meta($current_user->ID, 'phone_number', esc_attr($_POST['phone_number']));
    }

    // EMAIL
    if (!empty($_POST['email'])) {
        $posted_email = esc_attr($_POST['email']);
        if (!is_email($posted_email)) {
            wp_redirect(get_permalink() . '?validation=emailnotvalid');
            exit;
        } elseif (email_exists($posted_email) && (email_exists($posted_email) != $current_user->ID)) {
            wp_redirect(get_permalink() . '?validation=emailexists');
            exit;
        } else {
            wp_update_user(array('ID' => $current_user->ID, 'user_email' => $posted_email));
        }
    }

    // WEDDING DATE
    if (!empty($_POST['wedding_date'])) {
        update_user_meta($current_user->ID, 'wedding_date', esc_attr($_POST['wedding_date']));
    }

    // VENUE - LOCATION
    if (!empty($_POST['venue'])) {
        update_user_meta($current_user->ID, 'venue', esc_attr($_POST['venue']));
    }

    /* Let plugins hook in, like ACF who is handling the profile picture all by itself. Got to love the Elliot */
    do_action('edit_user_profile_update', $current_user->ID);
    /* We got here, assuming everything went OK */
    wp_redirect(get_permalink() . '?updated=true');
    exit;
}
