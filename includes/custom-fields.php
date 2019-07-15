<?php
function custom_cats(){

  if( function_exists('acf_add_local_field_group') ):

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
  $fields = array();

  foreach ($main_roles as $role) {

    $tab = array(
        'key' => 'field_' . $role . '_tab',
        'label' => $role . ' products',
        'name' => $role . '_tab',
        'type' => 'accordion',
        'open' => 1,
        'multi-expand' => 1,
        'endpoint' => 0,
    );

    array_push($fields, $tab);

    foreach ($all_collections as $collection) {
      $field = array(
        'key' => 'field_' . $role . '_' . $collection["slug"],
        'label' => $role . " " . $collection["slug"],
        'name' => $role . $collection["slug"],
        'type' => 'post_object',
        'instructions' => '',
        'required' => 1,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '33',
          'class' => '',
          'id' => '',
        ),
        'post_type' => array(
          0 => 'product',
        ),
        'taxonomy' => array(
          0 => 'product_cat:' . $collection["slug"],
        ),
        'allow_null' => 0,
        'multiple' => 0,
        'return_format' => 'object',
        'ui' => 1,
      );

      array_push($fields, $field);
    }
  }

  acf_add_local_field_group(array(
    'key' => 'group_bridal',
    'title' => 'Bridal Party',
    'fields' => $fields,
    'location' => array(
      array(
        array(
          'param' => 'options_page',
          'operator' => '==',
          'value' => 'thistle-general-settings',
        ),
      ),
    ),
    'menu_order' => 2,
    'position' => 'acf_after_title',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => 1,
    'description' => 'Settings',
  ));

  // END BRIDAL PARTY

  // candles/linens/chairs
  acf_add_local_field_group(array(
    'key' => 'group_candles',
    'title' => 'Candles/Linens/Chairs',
    'fields' => array(
      array(
        'key' => 'field_candles',
        'label' => 'Select Candles Product',
        'name' => 'candles',
        'type' => 'post_object',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'post_type' => array(
          0 => 'product',
        ),
        'taxonomy' => '',
        'allow_null' => 0,
        'multiple' => 0,
        'return_format' => 'object',
        'ui' => 1,
      ),
      array(
        'key' => 'field_poly_table_linens',
        'label' => 'Select Poly Table Linens Product',
        'name' => 'poly_table_linens',
        'type' => 'post_object',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'post_type' => array(
          0 => 'product',
        ),
        'taxonomy' => '',
        'allow_null' => 0,
        'multiple' => 0,
        'return_format' => 'object',
        'ui' => 1,
      ),
      array(
        'key' => 'field_poly_sequined_cake_table_linens',
        'label' => 'Select Sequined Cake Table Product',
        'name' => 'poly_sequined_cake_table_linens',
        'type' => 'post_object',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'post_type' => array(
          0 => 'product',
        ),
        'taxonomy' => '',
        'allow_null' => 0,
        'multiple' => 0,
        'return_format' => 'object',
        'ui' => 1,
      ),
      array(
        'key' => 'field_poly_table_runners',
        'label' => 'Select Poly Table Runners Product',
        'name' => 'poly_table_runners',
        'type' => 'post_object',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'post_type' => array(
          0 => 'product',
        ),
        'taxonomy' => '',
        'allow_null' => 0,
        'multiple' => 0,
        'return_format' => 'object',
        'ui' => 1,
      ),
      array(
        'key' => 'field_sequined_table_runners',
        'label' => 'Select Sequined Table Runners Product',
        'name' => 'sequined_table_runners',
        'type' => 'post_object',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'post_type' => array(
          0 => 'product',
        ),
        'taxonomy' => '',
        'allow_null' => 0,
        'multiple' => 0,
        'return_format' => 'object',
        'ui' => 1,
      ),
      array(
        'key' => 'field_poly_napkins',
        'label' => 'Select Poly Napkins Product',
        'name' => 'poly_napkins',
        'type' => 'post_object',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'post_type' => array(
          0 => 'product',
        ),
        'taxonomy' => '',
        'allow_null' => 0,
        'multiple' => 0,
        'return_format' => 'object',
        'ui' => 1,
      ),
      array(
        'key' => 'field_chairs',
        'label' => 'Select Chairs Product',
        'name' => 'chairs',
        'type' => 'post_object',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'post_type' => array(
          0 => 'product',
        ),
        'taxonomy' => '',
        'allow_null' => 0,
        'multiple' => 0,
        'return_format' => 'object',
        'ui' => 1,
      )
    ),
    'location' => array(
      array(
        array(
          'param' => 'options_page',
          'operator' => '==',
          'value' => 'thistle-general-settings',
        ),
      ),
    ),
    'menu_order' => 3,
    'position' => 'acf_after_title',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => 1,
    'description' => 'Settings',
  ));
  // END CANDLES

  // BOUTONNIERE
  acf_add_local_field_group(array(
    'key' => 'group_boutonniere',
    'title' => 'Boutonnieres',
    'fields' => array(
      array(
        'key' => 'field_boutonniere',
        'label' => 'Select Boutonniere Product',
        'name' => 'boutonniere',
        'type' => 'post_object',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'post_type' => array(
          0 => 'product',
        ),
        'taxonomy' => '',
        'allow_null' => 0,
        'multiple' => 0,
        'return_format' => 'object',
        'ui' => 1,
      )
    ),
    'location' => array(
      array(
        array(
          'param' => 'options_page',
          'operator' => '==',
          'value' => 'thistle-general-settings',
        ),
      ),
    ),
    'menu_order' => 1,
    'position' => 'acf_after_title',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => 1,
    'description' => 'Settings',
  ));
  // END BOUTONNIERE

  // CENTERPIECES & ARRANGEMENTS
  $arrangements = [
    'wood_centerpiece',
    'urn_centerpiece',
    'glassbowl_centerpiece',
    'multivase_centerpiece',
    'tallglassfoam_arrangement',
    'tallglasswater_arrangement',
    'metalstandfoam_arrangement',
    'largebuffet_arrangement',
    'arch_arrangement'
];

  $arrangements_fields = array();

  foreach ($arrangements as $role) {

    $tab = array(
        'key' => 'field_' . $role . '_tab',
        'label' => $role . ' products',
        'name' => $role . '_tab',
        'type' => 'accordion',
        'open' => 0,
        'multi-expand' => 1,
        'endpoint' => 0,
    );

    array_push($arrangements_fields, $tab);

    foreach ($all_collections as $collection) {
      $field = array(
        'key' => 'field_' . $role . $collection["slug"],
        'label' => $role . " " . $collection["slug"],
        'name' => $role . $collection["slug"],
        'type' => 'post_object',
        'instructions' => '',
        'required' => 1,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '33',
          'class' => '',
          'id' => '',
        ),
        'post_type' => array(
          0 => 'product',
        ),
        'taxonomy' => array(
          0 => 'product_cat:' . $collection["slug"],
        ),
        'allow_null' => 0,
        'multiple' => 0,
        'return_format' => 'object',
        'ui' => 1,
      );

      array_push($arrangements_fields, $field);
    }
  }

  $candelabra_tab = array(
    'key' => 'field_candelabra_tab',
    'label' =>  'candelabra product',
    'name' => 'candelabra_tab',
    'type' => 'accordion',
    'open' => 0,
    'multi-expand' => 1,
    'endpoint' => 0,
);

array_push($arrangements_fields, $candelabra_tab);

  $candelabra_field = array(
    'key' => 'field_candelabra',
    'label' => 'Candelabra Product',
    'name' => 'candelabra',
    'type' => 'post_object',
    'instructions' => '',
    'required' => 1,
    'conditional_logic' => 0,
    'wrapper' => array(
      'width' => '33',
      'class' => '',
      'id' => '',
    ),
    'post_type' => array(
      0 => 'product',
    ),
    'taxonomy' => '',
    'allow_null' => 0,
    'multiple' => 0,
    'return_format' => 'object',
    'ui' => 1,
  );

  array_push($arrangements_fields, $candelabra_field);

  $smilex_tab = array(
    'key' => 'field_smilex_tab',
    'label' =>  'smilex product',
    'name' => 'smilex_tab',
    'type' => 'accordion',
    'open' => 0,
    'multi-expand' => 1,
    'endpoint' => 0,
);

array_push($arrangements_fields, $smilex_tab);

  $smilex_field = array(
    'key' => 'field_smilex',
    'label' => 'Smilex Product',
    'name' => 'smilex',
    'type' => 'post_object',
    'instructions' => '',
    'required' => 1,
    'conditional_logic' => 0,
    'wrapper' => array(
      'width' => '33',
      'class' => '',
      'id' => '',
    ),
    'post_type' => array(
      0 => 'product',
    ),
    'taxonomy' => '',
    'allow_null' => 0,
    'multiple' => 0,
    'return_format' => 'object',
    'ui' => 1,
  );

  array_push($arrangements_fields, $smilex_field);

  acf_add_local_field_group(array(
    'key' => 'group_arrangements',
    'title' => 'Centerpieces and Arrangements',
    'fields' => $arrangements_fields,
    'location' => array(
      array(
        array(
          'param' => 'options_page',
          'operator' => '==',
          'value' => 'thistle-general-settings',
        ),
      ),
    ),
    'menu_order' => 4,
    'position' => 'acf_after_title',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => 1,
    'description' => 'Settings',
  ));

  // END BRIDAL PARTY

    // DAYS BEFORE EVENT TO OPEN UP VIDEOS PAGE TO A CUSTOMER
    acf_add_local_field_group(array(
      'key' => 'group_days_before_videos',
      'title' => 'Number of days before event to open videos page.',
      'fields' => array(
        array(
          'key' => 'field_days_before_videos',
          'label' => 'Enter Number of Days',
          'name' => 'days_before_videos',
          'type' => 'number',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'default_value' => '',
          'placeholder' => '',
          'prepend' => '',
          'append' => '',
          'min' => '',
          'max' => '',
          'step' => '',
        ),
      ),
      'location' => array(
        array(
          array(
            'param' => 'options_page',
            'operator' => '==',
            'value' => 'thistle-general-settings',
          ),
        ),
      ),
      'menu_order' => 0,
      'position' => 'acf_after_title',
      'style' => 'default',
      'label_placement' => 'top',
      'instruction_placement' => 'label',
      'hide_on_screen' => '',
      'active' => 1,
      'description' => 'Settings',
    ));
    // END DAYS BEFORE EVENT TO OPEN VIDEOS PAGES


    endif;
  }

  add_action('init', 'custom_cats', 99);