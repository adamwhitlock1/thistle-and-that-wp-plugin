<?php
function rest_auth(WP_REST_Request $request)
{
  $nonce = check_ajax_referer('wp_rest', '_wpnonce');
  if ($nonce) {
    $user_id = $request['user'];
    $selected_collection = get_the_author_meta("selected_collection", $user_id);

    function returnString($variable)
    {
      return (!isset($variable) || is_null($variable)) ? "" : $variable;
    }

    function returnNum($variable)
    {
      return (!isset($variable) || is_null($variable)) ? 0 : floatval($variable);
    }

    $overviewForm = [
      "first_name" => returnString(get_the_author_meta('first_name', $user_id)),
      "last_name" => returnString(get_the_author_meta('last_name', $user_id)),
      "fiances_name" => returnString(get_the_author_meta('fiances_name', $user_id)),
      "selected_collection" => returnString(get_the_author_meta('selected_collection', $user_id)),
      "billing_address_1" => returnString(get_the_author_meta('billing_address_1', $user_id)),
      "billing_address_2" => returnString(get_the_author_meta('billing_address_2', $user_id)),
      "billing_city" => returnString(get_the_author_meta('billing_city', $user_id)),
      "billing_state" => returnString(get_the_author_meta('billing_state', $user_id)),
      "billing_postcode" => returnString(get_the_author_meta('billing_postcode', $user_id)),
      "phone_number" => returnString(get_the_author_meta('billing_phone', $user_id)),
      "billing_email" => returnString(get_the_author_meta('billing_email', $user_id)),
      "wedding_date" => returnString(get_the_author_meta('wedding_date', $user_id)),
      "wedding_venue" => returnString(get_the_author_meta('wedding_venue', $user_id)),
      "budget" => returnNum(get_the_author_meta('budget', $user_id)),
      "bridal_qty" => returnNum(get_the_author_meta('bridal_qty', $user_id)),
      "bridesmaids_qty" => returnNum(get_the_author_meta('bridesmaids_qty', $user_id)),
      "mothers_qty" => returnNum(get_the_author_meta('mothers_qty', $user_id)),
      "grandmothers_qty" => returnNum(get_the_author_meta('grandmothers_qty', $user_id)),
      "flowergirl_qty" => returnNum(get_the_author_meta('flowergirl_qty', $user_id)),
      "groom_qty" => returnNum(get_the_author_meta('groom_qty', $user_id)),
      "groomsmen_qty" => returnNum(get_the_author_meta('groomsmen_qty', $user_id)),
      "fathers_qty" => returnNum(get_the_author_meta('fathers_qty', $user_id)),
      "grandfathers_qty" => returnNum(get_the_author_meta('grandfathers_qty', $user_id)),
      "ring_bearer_qty" => returnNum(get_the_author_meta('ring_bearer_qty', $user_id)),
      "centerpieces_qty" => returnNum(get_the_author_meta('centerpieces_qty', $user_id)),
      "candles_qty" => returnNum(get_the_author_meta('candles_qty', $user_id)),
      "vases_qty" => returnNum(get_the_author_meta('vases_qty', $user_id)),
      "linens_qty" => returnNum(get_the_author_meta('linens_qty', $user_id)),
      "current_total" => returnNum(get_the_author_meta('current_total', $user_id)),
    ];

    $currentSelections = [
      "boutonniere" => array(
        array(
          "collection" => returnString(get_the_author_meta('selected_collection', $user_id)),
          "level" => returnString(get_the_author_meta('boutonniere_level', $user_id)),
          "level_index" => returnNum(get_the_author_meta('boutonniere_level_index', $user_id)),
          "price" => returnNum(get_the_author_meta('boutonniere_price', $user_id)),
          "prod_id" => returnNum(get_the_author_meta('boutonniere_prod_id', $user_id)),
          "ribbon_color" => returnString(get_the_author_meta('boutonniere_ribbon_color', $user_id)),
          "ribbon_color_name" => returnString(get_the_author_meta('boutonniere_ribbon_color_name', $user_id)),
          "variant_id" => returnNum(get_the_author_meta('boutonniere_variant_id', $user_id)),
          "img" => returnString(get_the_author_meta('boutonniere_img', $user_id)),
          "desc" => returnString(get_the_author_meta('boutonniere_desc', $user_id)),
        )
      ),
      "bridal" => array(
        array(
          "collection" => returnString(get_the_author_meta('selected_collection', $user_id)),
          "level" => returnString(get_the_author_meta('bridal_level', $user_id)),
          "level_index" => returnNum(get_the_author_meta('bridal_level_index', $user_id)),
          "price" => returnNum(get_the_author_meta('bridal_price', $user_id)),
          "prod_id" => returnNum(get_the_author_meta('bridal_prod_id', $user_id)),
          "ribbon_color" => returnString(get_the_author_meta('bridal_ribbon_color', $user_id)),
          "ribbon_color_name" => returnString(get_the_author_meta('bridal_ribbon_color_name', $user_id)),
          "variant_id" => returnNum(get_the_author_meta('bridal_variant_id', $user_id)),
          "img" => returnString(get_the_author_meta('bridal_img', $user_id)),
          "desc" => returnString(get_the_author_meta('bridal_desc', $user_id))
        )
      ),
      "bridesmaids" => array(
        array(
          "collection" => returnString(get_the_author_meta('selected_collection', $user_id)),
          "level" => returnString(get_the_author_meta('bridesmaids_level', $user_id)),
          "level_index" => returnNum(get_the_author_meta('bridesmaids_level_index', $user_id)),
          "price" => returnNum(get_the_author_meta('bridesmaids_price', $user_id)),
          "prod_id" => returnNum(get_the_author_meta('bridesmaids_prod_id', $user_id)),
          "ribbon_color" => returnString(get_the_author_meta('bridesmaids_ribbon_color', $user_id)),
          "ribbon_color_name" => returnString(get_the_author_meta('bridesmaids_ribbon_color_name', $user_id)),
          "variant_id" => returnNum(get_the_author_meta('bridesmaids_variant_id', $user_id)),
          "img" => returnString(get_the_author_meta('bridesmaids_img', $user_id)),
          "desc" => returnString(get_the_author_meta('bridesmaids_desc', $user_id))
        )
      ),
      "candles" => array(
        array(
          "collection" => returnString(get_the_author_meta('selected_collection', $user_id)),
          "level" => returnString(get_the_author_meta('candles_level', $user_id)),
          "level_index" => returnNum(get_the_author_meta('candles_level_index', $user_id)),
          "price" => returnNum(get_the_author_meta('candles_price', $user_id)),
          "prod_id" => returnNum(get_the_author_meta('candles_prod_id', $user_id)),
          "ribbon_color" => returnString(get_the_author_meta('candles_ribbon_color', $user_id)),
          "ribbon_color_name" => returnString(get_the_author_meta('candles_ribbon_color_name', $user_id)),
          "style" => returnString(get_the_author_meta('candles_style', $user_id)),
          "type" => returnString(get_the_author_meta('candles_type', $user_id)),
          "variant_id" => returnNum(get_the_author_meta('candles_variant_id', $user_id)),
          "img" => returnString(get_the_author_meta('candles_img', $user_id)),
          "desc" => returnString(get_the_author_meta('candles_desc', $user_id))
        )
      ),
      "flowergirl" => array(
        array(
          "collection" => returnString(get_the_author_meta('selected_collection', $user_id)),
          "level" => returnString(get_the_author_meta('flowergirl_level', $user_id)),
          "level_index" => returnNum(get_the_author_meta('flowergirl_level_index', $user_id)),
          "price" => returnNum(get_the_author_meta('flowergirl_price', $user_id)),
          "prod_id" => returnNum(get_the_author_meta('flowergirl_prod_id', $user_id)),
          "ribbon_color" => returnString(get_the_author_meta('flowergirl_ribbon_color', $user_id)),
          "ribbon_color_name" => returnString(get_the_author_meta('flowergirl_ribbon_color_name', $user_id)),
          "variant_id" => returnNum(get_the_author_meta('flowergirl_variant_id', $user_id)),
          "img" => returnString(get_the_author_meta('flowergirl_img', $user_id)),
          "desc" => returnString(get_the_author_meta('flowergirl_desc', $user_id))
        )
      ),
      "mothers" => array(
        array(
          "collection" => returnString(get_the_author_meta('selected_collection', $user_id)),
          "level" => returnString(get_the_author_meta('mothers_level', $user_id)),
          "level_index" => returnNum(get_the_author_meta('mothers_level_index', $user_id)),
          "price" => returnNum(get_the_author_meta('mothers_price', $user_id)),
          "prod_id" => returnNum(get_the_author_meta('mothers_prod_id', $user_id)),
          "ribbon_color" => returnString(get_the_author_meta('mothers_ribbon_color', $user_id)),
          "ribbon_color_name" => returnString(get_the_author_meta('mothers_ribbon_color_name', $user_id)),
          "variant_id" => returnNum(get_the_author_meta('mothers_variant_id', $user_id)),
          "img" => returnString(get_the_author_meta('mothers_img', $user_id)),
          "desc" => returnString(get_the_author_meta('mothers_desc', $user_id))
        )
      ),
      "wood_centerpiece" => array(
        array(
          "collection" => returnString(get_the_author_meta('selected_collection', $user_id)),
          "level" => returnString(get_the_author_meta('wood_centerpiece_level', $user_id)),
          "level_index" => returnNum(get_the_author_meta('wood_centerpiece_level_index', $user_id)),
          "name" => returnString(get_the_author_meta('wood_centerpiece_name', $user_id)),
          "price" => returnNum(get_the_author_meta('wood_centerpiece_price', $user_id)),
          "prod_id" => returnNum(get_the_author_meta('wood_centerpiece_prod_id', $user_id)),
          "ribbon_color" => returnString(get_the_author_meta('wood_centerpiece_ribbon_color', $user_id)),
          "ribbon_color_name" => returnString(get_the_author_meta('wood_centerpiece_ribbon_color_name', $user_id)),
          "variant_id" => returnNum(get_the_author_meta('wood_centerpiece_variant_id', $user_id)),
          "img" => returnString(get_the_author_meta('wood_centerpiece_img', $user_id)),
          "desc" => returnString(get_the_author_meta('wood_centerpiece_desc', $user_id)),
          "qty" => returnString(get_the_author_meta('wood_centerpiece_qty', $user_id)),
          "color" => returnString(get_the_author_meta('wood_centerpiece_color', $user_id))
        )
      ),
      "glassbowl_centerpiece" => array(
        array(
          "collection" => returnString(get_the_author_meta('selected_collection', $user_id)),
          "level" => returnString(get_the_author_meta('glassbowl_centerpiece_level', $user_id)),
          "level_index" => returnNum(get_the_author_meta('glassbowl_centerpiece_level_index', $user_id)),
          "name" => returnString(get_the_author_meta('glassbowl_centerpiece_name', $user_id)),
          "price" => returnNum(get_the_author_meta('glassbowl_centerpiece_price', $user_id)),
          "prod_id" => returnNum(get_the_author_meta('glassbowl_centerpiece_prod_id', $user_id)),
          "ribbon_color" => returnString(get_the_author_meta('glassbowl_centerpiece_ribbon_color', $user_id)),
          "ribbon_color_name" => returnString(get_the_author_meta('glassbowl_centerpiece_ribbon_color_name', $user_id)),
          "variant_id" => returnNum(get_the_author_meta('glassbowl_centerpiece_variant_id', $user_id)),
          "img" => returnString(get_the_author_meta('glassbowl_centerpiece_img', $user_id)),
          "desc" => returnString(get_the_author_meta('glassbowl_centerpiece_desc', $user_id)),
          "qty" => returnString(get_the_author_meta('glassbowl_centerpiece_qty', $user_id))
        )
      ),
      "urn_centerpiece" => array(
        array(
          "collection" => returnString(get_the_author_meta('selected_collection', $user_id)),
          "level" => returnString(get_the_author_meta('urn_centerpiece_level', $user_id)),
          "level_index" => returnNum(get_the_author_meta('urn_centerpiece_level_index', $user_id)),
          "name" => returnString(get_the_author_meta('urn_centerpiece_name', $user_id)),
          "price" => returnNum(get_the_author_meta('urn_centerpiece_price', $user_id)),
          "prod_id" => returnNum(get_the_author_meta('urn_centerpiece_prod_id', $user_id)),
          "ribbon_color" => returnString(get_the_author_meta('urn_centerpiece_ribbon_color', $user_id)),
          "ribbon_color_name" => returnString(get_the_author_meta('urn_centerpiece_ribbon_color_name', $user_id)),
          "variant_id" => returnNum(get_the_author_meta('urn_centerpiece_variant_id', $user_id)),
          "img" => returnString(get_the_author_meta('urn_centerpiece_img', $user_id)),
          "desc" => returnString(get_the_author_meta('urn_centerpiece_desc', $user_id)),
          "qty" => returnString(get_the_author_meta('urn_centerpiece_qty', $user_id)),
          "color" => returnString(get_the_author_meta('urn_centerpiece_color', $user_id))
        )
      ),
      "multivase_centerpiece" => array(
        array(
          "collection" => returnString(get_the_author_meta('selected_collection', $user_id)),
          "level" => returnString(get_the_author_meta('multivase_centerpiece_level', $user_id)),
          "level_index" => returnNum(get_the_author_meta('multivase_centerpiece_level_index', $user_id)),
          "name" => returnString(get_the_author_meta('multivase_centerpiece_name', $user_id)),
          "price" => returnNum(get_the_author_meta('multivase_centerpiece_price', $user_id)),
          "prod_id" => returnNum(get_the_author_meta('multivase_centerpiece_prod_id', $user_id)),
          "ribbon_color" => returnString(get_the_author_meta('multivase_centerpiece_ribbon_color', $user_id)),
          "ribbon_color_name" => returnString(get_the_author_meta('multivase_centerpiece_ribbon_color_name', $user_id)),
          "variant_id" => returnNum(get_the_author_meta('multivase_centerpiece_variant_id', $user_id)),
          "img" => returnString(get_the_author_meta('multivase_centerpiece_img', $user_id)),
          "desc" => returnString(get_the_author_meta('multivase_centerpiece_desc', $user_id)),
          "qty" => returnString(get_the_author_meta('multivase_centerpiece_qty', $user_id))
        )
      ),
      "arch_arrangement" => array(
        array(
          "collection" => returnString(get_the_author_meta('selected_collection', $user_id)),
          "level" => returnString(get_the_author_meta('arch_arrangement_level', $user_id)),
          "level_index" => returnNum(get_the_author_meta('arch_arrangement_level_index', $user_id)),
          "price" => returnNum(get_the_author_meta('arch_arrangement_price', $user_id)),
          "prod_id" => returnNum(get_the_author_meta('arch_arrangement_prod_id', $user_id)),
          "variant_id" => returnNum(get_the_author_meta('arch_arrangement_variant_id', $user_id)),
          "img" => returnString(get_the_author_meta('arch_arrangement_img', $user_id)),
          "desc" => returnString(get_the_author_meta('arch_arrangement_desc', $user_id)),
          "qty" => returnString(get_the_author_meta('arch_arrangement_qty', $user_id))
        )
      ),
      "largebuffet_arrangement" => array(
        array(
          "collection" => returnString(get_the_author_meta('selected_collection', $user_id)),
          "level" => returnString(get_the_author_meta('largebuffet_arrangement_level', $user_id)),
          "level_index" => returnNum(get_the_author_meta('largebuffet_arrangement_level_index', $user_id)),
          "price" => returnNum(get_the_author_meta('largebuffet_arrangement_price', $user_id)),
          "prod_id" => returnNum(get_the_author_meta('largebuffet_arrangement_prod_id', $user_id)),
          "variant_id" => returnNum(get_the_author_meta('largebuffet_arrangement_variant_id', $user_id)),
          "img" => returnString(get_the_author_meta('largebuffet_arrangement_img', $user_id)),
          "desc" => returnString(get_the_author_meta('largebuffet_arrangement_desc', $user_id)),
          "qty" => returnString(get_the_author_meta('largebuffet_arrangement_qty', $user_id)),
          "color" => returnString(get_the_author_meta('largebuffet_arrangement_color', $user_id)),
        )
      ),
      "metalstandfoam_arrangement" => array(
        array(
          "collection" => returnString(get_the_author_meta('selected_collection', $user_id)),
          "level" => returnString(get_the_author_meta('metalstandfoam_arrangement_level', $user_id)),
          "level_index" => returnNum(get_the_author_meta('metalstandfoam_arrangement_level_index', $user_id)),
          "price" => returnNum(get_the_author_meta('metalstandfoam_arrangement_price', $user_id)),
          "prod_id" => returnNum(get_the_author_meta('metalstandfoam_arrangement_prod_id', $user_id)),
          "variant_id" => returnNum(get_the_author_meta('metalstandfoam_arrangement_variant_id', $user_id)),
          "img" => returnString(get_the_author_meta('metalstandfoam_arrangement_img', $user_id)),
          "desc" => returnString(get_the_author_meta('metalstandfoam_arrangement_desc', $user_id)),
          "qty" => returnString(get_the_author_meta('metalstandfoam_arrangement_qty', $user_id)),
          "color" => returnString(get_the_author_meta('metalstandfoam_arrangement_color', $user_id)),
        )
      ),
      "tallglassfoam_arrangement" => array(
        array(
          "collection" => returnString(get_the_author_meta('selected_collection', $user_id)),
          "level" => returnString(get_the_author_meta('tallglassfoam_arrangement_level', $user_id)),
          "level_index" => returnNum(get_the_author_meta('tallglassfoam_arrangement_level_index', $user_id)),
          "price" => returnNum(get_the_author_meta('tallglassfoam_arrangement_price', $user_id)),
          "prod_id" => returnNum(get_the_author_meta('tallglassfoam_arrangement_prod_id', $user_id)),
          "variant_id" => returnNum(get_the_author_meta('tallglassfoam_arrangement_variant_id', $user_id)),
          "img" => returnString(get_the_author_meta('tallglassfoam_arrangement_img', $user_id)),
          "desc" => returnString(get_the_author_meta('tallglassfoam_arrangement_desc', $user_id)),
          "qty" => returnString(get_the_author_meta('tallglassfoam_arrangement_qty', $user_id))
        )
      ),
      "tallglasswater_arrangement" => array(
        array(
          "collection" => returnString(get_the_author_meta('selected_collection', $user_id)),
          "level" => returnString(get_the_author_meta('tallglasswater_arrangement_level', $user_id)),
          "level_index" => returnNum(get_the_author_meta('tallglasswater_arrangement_level_index', $user_id)),
          "price" => returnNum(get_the_author_meta('tallglasswater_arrangement_price', $user_id)),
          "prod_id" => returnNum(get_the_author_meta('tallglasswater_arrangement_prod_id', $user_id)),
          "variant_id" => returnNum(get_the_author_meta('tallglasswater_arrangement_variant_id', $user_id)),
          "img" => returnString(get_the_author_meta('tallglasswater_arrangement_img', $user_id)),
          "desc" => returnString(get_the_author_meta('tallglasswater_arrangement_desc', $user_id)),
          "qty" => returnString(get_the_author_meta('tallglasswater_arrangement_qty', $user_id))
        )
        ),
        "candelabra" => array(
          array(
            "collection" => returnString(get_the_author_meta('selected_collection', $user_id)),
            "level" => returnString(get_the_author_meta('candelabra_level', $user_id)),
            "level_index" => returnNum(get_the_author_meta('candelabra_level_index', $user_id)),
            "price" => returnNum(get_the_author_meta('candelabra_price', $user_id)),
            "prod_id" => returnNum(get_the_author_meta('candelabra_prod_id', $user_id)),
            "variant_id" => returnNum(get_the_author_meta('candelabra_variant_id', $user_id)),
            "img" => returnString(get_the_author_meta('candelabra_img', $user_id)),
            "desc" => returnString(get_the_author_meta('candelabra_desc', $user_id)),
            "qty" => returnString(get_the_author_meta('candelabra_qty', $user_id))
          )
          ),
        "smilex" => array(
          array(
            "collection" => returnString(get_the_author_meta('selected_collection', $user_id)),
            "level" => returnString(get_the_author_meta('smilex_level', $user_id)),
            "level_index" => returnNum(get_the_author_meta('smilex_level_index', $user_id)),
            "price" => returnNum(get_the_author_meta('smilex_price', $user_id)),
            "prod_id" => returnNum(get_the_author_meta('smilex_prod_id', $user_id)),
            "variant_id" => returnNum(get_the_author_meta('smilex_variant_id', $user_id)),
            "img" => returnString(get_the_author_meta('smilex_img', $user_id)),
            "desc" => returnString(get_the_author_meta('smilex_desc', $user_id)),
            "qty" => returnString(get_the_author_meta('smilex_qty', $user_id))
          )
        )
    ];

    return json_encode(['overviewForm' => $overviewForm, 'activeSelections' => $currentSelections]);
  } else {
    $response = new WP_REST_Response(['result' => "Error: Not Authorized"]);
    $response->set_status(403);
    return $response;
  }
}

add_action('rest_api_init', function () {
  register_rest_route('thistle/v1', '/userdata', array(
    'methods' => 'GET',
    'callback' => 'rest_auth'
  ));
});
