<?php
/**
 * Created by PhpStorm.
 * User: adamwhitlock
 * Date: 9/10/18
 * Time: 9:30 AM
 */

/**
 * AJAX Callback
 * Always Echos and Exits
 */
function ajax_user_profile_callback()
{

  // Ensure we have the data we need to continue
  if (!isset($_POST) || empty($_POST) || !is_user_logged_in()) {
    // If we don't - return custom error message and exit
    header('HTTP/1.1 400 Empty POST Values');
    echo 'Could Not Verify POST Values.';
    exit;
  }

  $user_id = get_current_user_id();                            // Get our current user ID
  $user_profile = $_POST['user_profile'];
  $field_to_update = $_POST['field_to_update'];

  if ($field_to_update !== 'all' && $field_to_update !== 'multi' && $field_to_update !== 'clear') {

    if ($field_to_update == 'first_name') {
      // handle first name updating billing and shipping first name as well
      update_user_meta($user_id, $field_to_update, $user_profile[$field_to_update]);
      update_user_meta($user_id, 'billing_first_name', $user_profile[$field_to_update]);
      update_user_meta($user_id, 'shipping_first_name', $user_profile[$field_to_update]);
      echo $field_to_update . " and billing_first_name has been updated \n";
    } else if ($field_to_update == 'last_name') {
      // handle last name updating billing and shipping last name as well
      update_user_meta($user_id, $field_to_update, $user_profile[$field_to_update]);
      update_user_meta($user_id, 'billing_last_name', $user_profile[$field_to_update]);
      update_user_meta($user_id, 'shipping_last_name', $user_profile[$field_to_update]);
      echo $field_to_update . " and billing_last_name has been updated \n";
    } else {
      update_user_meta($user_id, $field_to_update, $user_profile[$field_to_update]);
      echo $field_to_update . " has been updated \n";
    }
  } else if ($field_to_update == 'multi') {
    // multi field update is used to update a specific member's arrangement selections
    $resp = [];
    foreach ($_POST['memberData'] as $key => $value) {
      if ($key == 'collection') {
        // if key is collection - update the collection of the specified member
        update_user_meta($user_id, 'selected_collection', $_POST['memberData']['collection']);
      } else {
        // the wedding member's section of profile with corresponding value
        update_user_meta($user_id, $_POST['member'] . '_' . $key, $value);
        array_push($resp, [$_POST['member'] . '_' . $key, $value]);
      }
    }
    echo json_encode($resp);
  } else {

    // updating ALL profile and selection fields in user profile of WP
    $field_arr = [
      'first_name',
      'billing_first_name',
      'last_name',
      'billing_last_name',
      'fiances_name',
      'billing_address_1',
      'billing_address_2',
      'billing_city',
      'billing_state',
      'billing_postcode',
      'billing_email',
      'phone_number',
      'wedding_venue',
      'wedding_date',

      'bridal_qty',
      'bridesmaids_qty',
      'mothers_qty',
      'grandmothers_qty',
      'flowergirl_qty',
      'groom_qty',
      'groomsmen_qty',
      'fathers_qty',
      'grandfathers_qty',
      'ring_bearer_qty',
      'centerpieces_qty',
      'candles_qty',
      'vases_qty',
      'linens_qty',
      'budget',
      'selected_collection',

    ];

    // for anything that was posted in as activeSelections, we combine the keys and nested items to get underscored string
    // underscore based string is then used for the update_user_meta call
    if ($field_to_update === 'all') {
      foreach ( $_POST['user_profile']['activeSelections'] as $key => $value ) {
        foreach ( $value[0] as $key2 => $value2 ) {
          update_user_meta($user_id, $key . "_" . $key2, $value2);
        }
      }
    } elseif ($field_to_update === 'clear') {
      foreach ( $_POST['user_profile']['activeSelections'] as $key => $value ) {
        foreach ( $value[0] as $key2 => $value2 ) {
          update_user_meta($user_id, $key . "_" . $key2, " ");
        }
      }
    } elseif ( $field_to_update === 'all_chunk' ) {

    }


    // for loop to update the main user profile data
    foreach ($field_arr as $field_name) {
      // check if field is of a numeric type
      if (strpos($field_name, '_qty') || strpos($field_name, 'billing_postcode') || strpos($field_name, 'budget') || strpos($field_name, '_id') || strpos($field_name, '_price') || strpos($field_name, '_index') !== false) {

        // sanitize value to numerical
        $safe_field_value = intval($user_profile[$field_name]);

        // if there isnt an int value then set to empty
        if (!$safe_field_value) {
          $safe_field_value = '';
        }

        // sanitize length
        if (strlen($safe_field_value) > 20) {
          $safe_field_value = substr($safe_field_value, 0, 20);
        }

        update_user_meta($user_id, $field_name, $safe_field_value);
      } else {

        switch ($field_name) {
          case 'billing_email':
            // sanitize email address
            $safe_field_value = sanitize_email($user_profile[$field_name]);
          default:
            // sanitize a text field
            $safe_field_value = sanitize_text_field($user_profile[$field_name]);
        }

        update_user_meta($user_id, $field_name, $safe_field_value);
      }

      if ($field_to_update === 'clear') {
        update_user_meta($user_id, 'selected_collection', "");
      }

      }

    echo "ALL fields updated";
  }
  exit;
}
add_action('wp_ajax_nopriv_update_profile', 'ajax_user_profile_callback');
add_action('wp_ajax_update_profile', 'ajax_user_profile_callback');
