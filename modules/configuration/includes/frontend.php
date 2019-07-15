<?php
// start a script variable to generate a string of all "seed data" used in the app
// append to this script variable when adding seed data
$script = '<script class="test-script">' . "\n";

if (is_user_logged_in()) {
    $current_user = wp_get_current_user();
    $uid = get_current_user_id();
    $user_meta = get_user_meta($uid);
    $nonce = wp_create_nonce( 'wp_rest' );
    // variable for if user is logged in or not
    $script .= 'let isUserLoggedIn = true;' . "\n";
    $script .= 'let userId = ' . $uid . ";\n";
    $script .= "let userNonce = '" . $nonce . "'; \n";
} else {
    $script .= 'let isUserLoggedIn = false;' . "\n";
    $script .= "let userNonce = 'none'; \n";
    $script .= "let userId = 'none'; \n";
}

// create an array of all product categories
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


// loop through all product categories
// if category is a top level category/has no parent categories and
// the category slug is 'collection' then loop through it's child categories
foreach ($all_categories as $cat) {
    if ($cat->category_parent == 0 && $cat->slug == 'collections') {
        $category_id = $cat->term_id;
        $args2 = array(
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
        // Loop through sub categories to create an array of javascript objects
        if ($sub_cats) {
            $script .= 'let collection_cats = [' . "\n";
            foreach ($sub_cats as $sub_category) {
                // var_dump($sub_category);
                $script .= '{' . "\n";
                foreach (get_object_vars($sub_category) as $key => $value) {
                    $script .= '"' . $key . '":"' . $value . '",' . "\n";
                }
                $script .= '"attachment_image":"' . wp_get_attachment_image_src(get_woocommerce_term_meta($sub_category->cat_ID, 'thumbnail_id', true), 'medium')[0] . '"' . "\n";
                $script .= '},' . "\n";

                $all_collections[$sub_category->slug]['slug']             = $sub_category->slug;
                $all_collections[$sub_category->slug]['name']             = $sub_category->name;
                $all_collections[$sub_category->slug]['cat_ID']           = $sub_category->cat_ID;
                $all_collections[$sub_category->slug]['attachment_image'] = wp_get_attachment_image_src(get_woocommerce_term_meta($sub_category->cat_ID, 'thumbnail_id', true), 'medium')[0];
                $all_collections[$sub_category->slug]['count']            = $sub_category->count;
            }
            $script .= '];' . "\n";
        }
        array_push($all_collections, $sub_category->slug);
    }
}

// DO NOT ADD ANY MORE DATA TO SCRIPT VARIABLE AFTER THIS
// final script appending which adds the closing </script> tag to the string
// $script .= "console.log('Init User Data:');console.log(userData);console.log('prod info')</script>";
$script .= "</script>";
echo $script;
echo do_shortcode("[vue-app]", true);
?>


