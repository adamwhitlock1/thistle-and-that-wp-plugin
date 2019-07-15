<?php
/**
 * Created by PhpStorm.
 * User: adamwhitlock
 * Date: 12/28/18
 * Time: 10:12 AM
 */

/**
 * AJAX Callback
 * Always Echos and Exits
 */
function ajax_remove_composite_callback() {

	// Ensure we have the data we need to continue
	if( ! isset( $_POST ) || empty( $_POST ) || ! is_user_logged_in() ) {
		// If we don't - return custom error message and exit
		header( 'HTTP/1.1 400 Empty POST Values' );
		echo 'Could Not Verify POST Values.';
		exit;
  }

	$user_id = get_current_user_id(); // Get our current user ID
  $cart_item_key = $_POST['cart_item_key'];
  $comp_removed = WC()->cart->remove_cart_item($cart_item_key);
  $cart_item_number = WC()->cart->get_cart_contents_count();

// echo json_encode($_POST);

echo json_encode([
    'removed' => $comp_added,
    'cart_items' => $cart_item_number
  ]);

  exit;
}


  // only need this loaded if the user is logged in
add_action( 'wp_ajax_nopriv_remove_composite', 'ajax_remove_composite_callback' );
add_action( 'wp_ajax_remove_composite', 'ajax_remove_composite_callback' );

