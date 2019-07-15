<?php

function prod_obj($prod_id) {
  $prod = wc_get_product($prod_id);
  $obj  = (object) [
      'name'       => $prod->get_name(),
      'desc'       => $prod->get_description(),
      'prod_type'  => $prod->get_type(),
      'avail_vars' => $prod->get_available_variations(),
      'prod_id'    => (int) $prod_id
  ];
   return $obj;
}

function prod_single($prod_id) {
  $prod = wc_get_product($prod_id);
   $obj = (object) [
      'name'      => $prod->get_name(),
      'desc'      => $prod->get_description(),
      'prod_type' => $prod->get_type(),
      'price'     => $prod->get_price(),
      'img'       => get_the_post_thumbnail_url($prod->get_id(), 'full'),
      'prod_id'   => (int) $prod_id,
   ];
  return $obj;
}

  function options_prod_data($set){

    $fields = array();

    $all_collections = [];

    $taxonomy     = 'product_cat';
    $orderby      = 'name';
    $show_count   = 0; // 1 for yes, 0 for no
    $pad_counts   = 0; // 1 for yes, 0 for no
    $hierarchical = 1; // 1 for yes, 0 for no
    $title        = '';
    $empty        = 0;

    $args = array(
        'taxonomy'     => $taxonomy,
        'orderby'      => $orderby,
        'show_count'   => $show_count,
        'pad_counts'   => $pad_counts,
        'hierarchical' => $hierarchical,
        'title_li'     => $title,
        'hide_empty'   => $empty,
    );

    $all_categories = get_categories($args);
    foreach ($all_categories as $cat) {
        if ($cat->category_parent == 0 && $cat->slug == 'collections') {
            $category_id = $cat->term_id;
            $args2       = array(
                'taxonomy'     => $taxonomy,
                'child_of'     => 0,
                'parent'       => $category_id,
                'orderby'      => $orderby,
                'show_count'   => $show_count,
                'pad_counts'   => $pad_counts,
                'hierarchical' => $hierarchical,
                'title_li'     => $title,
                'hide_empty'   => $empty,
            );
            $sub_cats = get_categories($args2);
            // Loop through categories to create an array of javascript objects
            if ($sub_cats) {

                foreach ($sub_cats as $sub_category) {
                    $current_collection = [
                        'parent' => $sub_category->parent,
                        'name'   => $sub_category->name,
                        'slug'   => $sub_category->slug,
                        'cat_ID' => $sub_category->cat_ID,
                        'count'  => $sub_category->count,
                    ];
                    array_push($all_collections, $current_collection);
                }
            }
        }
    }
    // end creating array of all collections


    // bridal party members
    $main_roles = ['bridal', 'bridesmaids', 'mothers', 'flowergirl'];

    $role_fields = array();
    foreach ($main_roles as $role) {
      $role_fields[$role . "Info"] = array();
      foreach ($all_collections as $collection) {
        if ($role == "mothers") {
          $field_key = "field_" . $role  . "_". $collection["slug"];
          $field = prod_obj(get_field($field_key, 'option')->ID);
          $role_fields["mothersInfo"][0][$collection["slug"]] = $field;
        } elseif ($role == "flowergirl") {
          $field_key = "field_" . $role  . "_". $collection["slug"];
          $field = prod_single(get_field($field_key, 'option')->ID);
          $role_fields["flowergirlInfo"][0][$collection["slug"]] = $field;
        } else {
          $field_key = "field_" . $role  . "_". $collection["slug"];
          $field = prod_obj(get_field($field_key, 'option')->ID);
          $role_fields[$role . "Info"][0][$collection["slug"]] = $field;
        }
      }
      if ($role == 'boutonniere'){
        $field = prod_obj(get_field('field_boutonniere', 'option')->ID);
        $role_fields[$role . "Info"][0]['master'] = $field;
      }

      if ($role == 'candles'){
        $field = prod_obj(get_field('field_candles', 'option')->ID);
        $role_fields[$role . "Info"][0]['master'] = $field;
      }
    }

    $single_prod_roles = ["boutonniere", "candles", "poly_table_linens", "poly_sequined_cake_table_linens", "poly_table_runners", "sequined_table_runners", "poly_napkins",  "chairs", 'candelabra'];

    foreach ($single_prod_roles as $prod_role) {
      $prod_field_key = "field_" . $prod_role;
      $prod_field = prod_obj(get_field($prod_field_key, 'option')->ID);
      $role_fields[$prod_role . "Info"][0]['master'] = $prod_field;
    }

    // arrangements
    $arr_roles_2 = ['wood_centerpiece',
    'urn_centerpiece',
    'glassbowl_centerpiece',
    'multivase_centerpiece',
    'tallglassfoam_arrangement',
    'tallglasswater_arrangement',
    'metalstandfoam_arrangement',
    'largebuffet_arrangement',
    'arch_arrangement'
    ];

    foreach ($arr_roles_2 as $role) {
      $role_fields[$role . "Info"] = array();
      foreach ($all_collections as $collection) {
          $field_key = "field_" . $role . $collection["slug"];
          $field = prod_obj(get_field($field_key, 'option')->ID);
          $role_fields[$role . "Info"][0][$collection["slug"]] = $field;

          add_action( 'graphql_register_types', function($field_key) {

            $post_types = WPGraphQL::$allowed_post_types;

            if ( ! empty( $post_types ) && is_array( $post_types ) ) {
              foreach ( $post_types as $post_type ) {
                $post_type_object = get_post_type_object( $post_type );

                register_graphql_field( $post_type_object->graphql_single_name, $field_key, [
                  'type' => 'String',
                  'description' => __( 'prod id', 'wp-graphql' ),
                    'resolve' => function( $field_key ) {
                      $prod_id = get_field($field_key, 'option')->ID;
                      return ! empty( $prod_id ) ? $prod_id : 'none';
                   }
                ] );

              }
            }
          });
      }
    }

    // add smilex as its own section since it is the only truly single style product in application
    $smilex_field = prod_single(get_field('field_smilex', 'option')->ID);
    $role_fields["smilexInfo"][0]['master'] = $smilex_field;

  array_push($fields, $role_fields);

  return json_encode($fields);

}

function gen_data() {
  $uploads_path = wp_upload_dir();
  $save_path = $uploads_path['basedir'];
  $prod_data_file = fopen($save_path . '/prod_data.json', "w");
  fwrite($prod_data_file, options_prod_data(1));
  fclose($prod_data_file);
}


add_action('acf/save_post', 'gen_data', 20);

