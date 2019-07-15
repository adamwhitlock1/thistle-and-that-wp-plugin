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
function ajax_add_composite_callback()
{

  // Ensure we have the data we need to continue
  if (!isset($_POST) || empty($_POST) || !is_user_logged_in()) {
    // If we don't - return custom error message and exit
    header('HTTP/1.1 400 Empty POST Values');
    echo 'Could Not Verify POST Values.';
    exit;
  }

  $user_id = get_current_user_id(); // Get our current user ID
  // Sanitize our user meta value
  $bridal_prod_id = (int)$_POST['bridal_prod_id'];
  $bridal_variant_id = (int)$_POST['bridal_variant_id'];
  $bridal_qty = (int)$_POST['bridal_qty'];
  // $bridal_ribbon_color = $_POST['bridal_ribbon_color'];
  $bridal_level =  ucfirst($_POST['bridal_level']);

  $bridesmaids_prod_id = (int)$_POST['bridesmaids_prod_id'];
  $bridesmaids_variant_id = (int)$_POST['bridesmaids_variant_id'];
  $bridesmaids_qty = (int)$_POST['bridesmaids_qty'];
  // $bridesmaids_ribbon_color = $_POST['bridesmaids_ribbon_color'];
  $bridesmaids_level = ucfirst($_POST['bridesmaids_level']);

  $boutonniere_prod_id = (int)$_POST['boutonniere_prod_id'];
  $boutonniere_variant_id = (int)$_POST['boutonniere_variant_id'];
  $boutonniere_qty = (int)$_POST['boutonniere_qty'];
  $boutonniere_level = ucfirst($_POST['boutonniere_level']);

  $mothers_prod_id = (int)$_POST['mothers_prod_id'];
  $mothers_variant_id = (int)$_POST['mothers_variant_id'];
  $mothers_qty = (int)$_POST['mothers_qty'];
  // $mothers_ribbon_color = $_POST['mothers_ribbon_color'];
  $mothers_level = ucfirst($_POST['mothers_level']);

  $flower_girl_prod_id = (int)$_POST['flowergirl_prod_id'];
  $flower_girl_qty = (int)$_POST['flowergirl_qty'];
  // $flower_girl_ribbon_color = $_POST['flower_girl_ribbon_color'];

  $candles_prod_id = (int)$_POST['candles_prod_id'];
  $candles_variant_id = (int)$_POST['candles_variant_id'];
  $candles_qty = (int)$_POST['candles_qty'];
  $candles_style = $_POST['candles_style'];
  $candles_type = $_POST['candles_type'];

  // centerpieces

  $wood_centerpiece_prod_id = (int)$_POST['wood_centerpiece_prod_id'];
  $wood_centerpiece_variant_id = (int)$_POST['wood_centerpiece_variant_id'];
  $wood_centerpiece_qty = (int)$_POST['wood_centerpiece_qty'];
  $wood_centerpiece_level = ucfirst($_POST['wood_centerpiece_level']);
  $wood_centerpiece_color = ucfirst($_POST['wood_centerpiece_color']);

  $urn_centerpiece_prod_id = (int)$_POST['urn_centerpiece_prod_id'];
  $urn_centerpiece_variant_id = (int)$_POST['urn_centerpiece_variant_id'];
  $urn_centerpiece_qty = (int)$_POST['urn_centerpiece_qty'];
  $urn_centerpiece_level = ucfirst($_POST['urn_centerpiece_level']);
  $urn_centerpiece_color = ucfirst($_POST['urn_centerpiece_color']);

  $multivase_centerpiece_prod_id = (int)$_POST['multivase_centerpiece_prod_id'];
  $multivase_centerpiece_variant_id = (int)$_POST['multivase_centerpiece_variant_id'];
  $multivase_centerpiece_qty = (int)$_POST['multivase_centerpiece_qty'];
  $multivase_centerpiece_level = ucfirst($_POST['multivase_centerpiece_level']);

  $glassbowl_centerpiece_prod_id = (int)$_POST['glassbowl_centerpiece_prod_id'];
  $glassbowl_centerpiece_variant_id = (int)$_POST['glassbowl_centerpiece_variant_id'];
  $glassbowl_centerpiece_qty = (int)$_POST['glassbowl_centerpiece_qty'];
  $glassbowl_centerpiece_level = ucfirst($_POST['glassbowl_centerpiece_level']);

  // arrangements

  $arch_arrangement_prod_id = (int)$_POST['arch_arrangement_prod_id'];
  $arch_arrangement_variant_id = (int)$_POST['arch_arrangement_variant_id'];
  $arch_arrangement_qty = (int)$_POST['arch_arrangement_qty'];
  $arch_arrangement_level = ucfirst($_POST['arch_arrangement_level']);

  $largebuffet_arrangement_prod_id    = (int)$_POST['largebuffet_arrangement_prod_id'];
  $largebuffet_arrangement_variant_id = (int)$_POST['largebuffet_arrangement_variant_id'];
  $largebuffet_arrangement_qty        = (int)$_POST['largebuffet_arrangement_qty'];
  $largebuffet_arrangement_level      = ucfirst($_POST['largebuffet_arrangement_level']);
  $largebuffet_arrangement_color      = ucfirst($_POST['largebuffet_arrangement_color']);

  $metalstandfoam_arrangement_prod_id    = (int)$_POST['metalstandfoam_arrangement_prod_id'];
  $metalstandfoam_arrangement_variant_id = (int)$_POST['metalstandfoam_arrangement_variant_id'];
  $metalstandfoam_arrangement_qty        = (int)$_POST['metalstandfoam_arrangement_qty'];
  $metalstandfoam_arrangement_level      = ucfirst($_POST['metalstandfoam_arrangement_level']);
  $metalstandfoam_arrangement_color      = ucfirst($_POST['metalstandfoam_arrangement_color']);

  $tallglassfoam_arrangement_prod_id    = (int)$_POST['tallglassfoam_arrangement_prod_id'];
  $tallglassfoam_arrangement_variant_id = (int)$_POST['tallglassfoam_arrangement_variant_id'];
  $tallglassfoam_arrangement_qty        = (int)$_POST['tallglassfoam_arrangement_qty'];
  $tallglassfoam_arrangement_level      = ucfirst($_POST['tallglassfoam_arrangement_level']);
  $tallglassfoam_arrangement_color      = ucfirst($_POST['tallglassfoam_arrangement_color']);

  $candelabra_prod_id    = (int)$_POST['candelabra_prod_id'];
  $candelabra_variant_id = (int)$_POST['candelabra_variant_id'];
  $candelabra_qty        = (int)$_POST['candelabra_qty'];
  $candelabra_style      = $_POST['candelabra_style'];

  $smilex_prod_id    = (int)$_POST['smilex_prod_id'];
  $smilex_qty        = (int)$_POST['smilex_qty'];



  $args = array(

    1545839531 => array(
      'product_id' => $bridal_prod_id,
      'variation_id' => $bridal_variant_id,
      'quantity' => $bridal_qty,
      'attributes' => array(
        'attribute_bouquet-options' => $bridal_level
      )
    ),

    1545839533 => array(
      'product_id' => $boutonniere_prod_id,
      'quantity' => $boutonniere_qty,
      'variation_id' => $boutonniere_prod_id,
      'attributes' => array(
        'attribute_options' => $boutonniere_level
      )
    ),

    1547120577 => array(
      'product_id' => $bridesmaids_prod_id,
      'variation_id' => $bridesmaids_variant_id,
      'quantity' => $bridesmaids_qty,
      'attributes' => array(
        'attribute_bouquet-options' => $bridesmaids_level
      )
    ),

    1547120578 => array(
      'product_id' => $mothers_prod_id,
      'variation_id' => $mothers_variant_id,
      'quantity' => $mothers_qty,
      'attributes' => array(
        'attribute_bouquet-options' => $mothers_level
      )
    ),

    1547131151 => array(
      'product_id' => $flower_girl_prod_id,
      'quantity' => $flower_girl_qty
    ),



    1556793470 => array(
      'product_id' =>  $wood_centerpiece_prod_id,
      'variation_id' =>  $wood_centerpiece_variant_id,
      'quantity' => $wood_centerpiece_qty,
      'attributes' => array(
        'attribute_options' => $wood_centerpiece_level,
        'attribute_color' => $wood_centerpiece_color
      )
    ),

    1557088719 => array(
      'product_id' =>  $urn_centerpiece_prod_id,
      'variation_id' =>  $urn_centerpiece_variant_id,
      'quantity' => $urn_centerpiece_qty,
      'attributes' => array(
        'attribute_options' => $urn_centerpiece_level,
        'attribute_color' => $urn_centerpiece_color
      )
    ),

    1557088239 => array(
      'product_id' =>  $multivase_centerpiece_prod_id,
      'variation_id' =>  $multivase_centerpiece_variant_id,
      'quantity' => $multivase_centerpiece_qty,
      'attributes' => array(
        'attribute_options' => $multivase_centerpiece_level,
      )
    ),

    1557088720 => array(
      'product_id' =>  $glassbowl_centerpiece_prod_id,
      'variation_id' =>  $glassbowl_centerpiece_variant_id,
      'quantity' => $glassbowl_centerpiece_qty,
      'attributes' => array(
        'attribute_options' => $glassbowl_centerpiece_level,
      )
    ),

    1556793386 => array(
      'product_id' => $candles_prod_id,
      'variation_id' => $candles_variant_id,
      'quantity' => $candles_qty,
      'attributes' => array(
        'attribute_style' => $candles_style,
        'attribute_candle-type' => $candles_type,
      )
    ),

    1557088723 => array(
      'product_id' => $metalstandfoam_arrangement_prod_id,
      'variation_id' => $metalstandfoam_arrangement_variant_id,
      'quantity' => $metalstandfoam_arrangement_qty,
      'attributes' => array(
        'attribute_options' => $metalstandfoam_arrangement_level,
        'attribute_color' => $metalstandfoam_arrangement_color
      )
    ),

    1557088724 => array(
      'product_id' => $tallglassfoam_arrangement_prod_id,
      'variation_id' => $tallglassfoam_arrangement_variant_id,
      'quantity' => $tallglassfoam_arrangement_qty,
      'attributes' => array(
        'attribute_options' => $tallglassfoam_arrangement_level,
        'attribute_color' => $tallglassfoam_arrangement_color
      )
    ),

    1557088721 => array(
      'product_id' => $arch_arrangement_prod_id,
      'variation_id' => $arch_arrangement_variant_id,
      'quantity' => $arch_arrangement_qty,
      'attributes' => array(
        'attribute_options' => $arch_arrangement_level,
      )
    ),

    1557088722 => array(
      'product_id' => $largebuffet_arrangement_prod_id,
      'variation_id' => $largebuffet_arrangement_variant_id,
      'quantity' => $largebuffet_arrangement_qty,
      'attributes' => array(
        'attribute_options' => $largebuffet_arrangement_level,
        'attribute_color' => $largebuffet_arrangement_color
      )
    ),

    1561722243 => array(
      'product_id' => $candelabra_prod_id,
      'variation_id' => $candelabra_variant_id,
      'quantity' => $candelabra_qty,
      'attributes' => array(
        'attribute_style' => $candelabra_style,
      )
    ),

    1562654709 => array(
      'product_id' => $smilex_prod_id,
      'quantity' => $smilex_qty,
    )



  );


  function gen_cart_data($args)
  {
    $uploads_path = wp_upload_dir();
    $save_path = $uploads_path['basedir'];
    $cart_data_file = fopen($save_path . '/cart_data.json', "w");
    fwrite($cart_data_file, json_encode($args));
    fclose($cart_data_file);
  }

  gen_cart_data($args);

  $comp_added = WC_CP()->cart->add_composite_to_cart(1246, 1, $args);
  $cart_item_number = WC()->cart->get_cart_contents_count();

  // echo json_encode($_POST);

  echo json_encode([
    'added' => $comp_added,
    'cart_items' => $cart_item_number
  ]);

  exit;
}


// only need this loaded if the user is logged in
add_action('wp_ajax_nopriv_add_composite', 'ajax_add_composite_callback');
add_action('wp_ajax_add_composite', 'ajax_add_composite_callback');
