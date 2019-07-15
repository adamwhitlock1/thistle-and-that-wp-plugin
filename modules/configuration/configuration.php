<?php

/**
 * This is an example module with only the basic
 * setup necessary to get it working.
 *
 * @class FLBasicExampleModule
 */
class ThistleThatConfigurationModule extends FLBuilderModule
{

    /**
     * Constructor function for the module. You must pass the
     * name, description, dir and url in an array to the parent class.
     *
     * @method __construct
     */
    public function __construct()
    {
        parent::__construct(array(
            'name'            => __('Configuration (put as first module)', 'fl-builder'),
            'description'     => __('Overview of configuration options', 'fl-builder'),
            'category'        => __('Thistle & That', 'fl-builder'),
            'group'           => __('Thistle & That', 'fl-builder'),
            'dir'             => THISTLE_THAT_MODULES_DIR . 'modules/configuration/',
            'url'             => THISTLE_THAT_MODULES_URL . 'modules/configuration/',
            'editor_export'   => true, // Defaults to true and can be omitted.
             'enabled'         => true, // Defaults to true and can be omitted.
             'partial_refresh' => false,
        ));

    }
}

$all_fields      = []; // final array we will use in BB module field registration
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

// add the main roles to the fields to be selected

$main_roles = ['bridal', 'bridesmaids', 'mothers-grandmothers', 'flower-girl'];

foreach ($main_roles as $role) {
    $role_arr          = array();
    $role_arr['title'] = __($role, 'fl-builder');
    $role_arr['collapsed'] = true;

    foreach ($all_collections as $collection) {
        $role_arr['fields'][$role . '__' . $collection["slug"] . '_select'] = array(
            'type'   => 'suggest',
            'label'  => __('Product for ' . $collection['name'], 'fl-builder'),
            'action' => 'fl_as_posts',
            'data'   => 'product',
            'limit'  => 1,
        );
    }

    array_push($all_fields, $role_arr);
}

// add boutonniere to fields

$boutonniere                                         = [];
$boutonniere['title']                                = __('boutonniere', 'fl-builder');
$boutonniere['collapsed'] = true;
$boutonniere['fields']['boutonniere__master_select'] = array(
    'type'   => 'suggest',
    'label'  => __('Product for Boutonniere', 'fl-builder'),
    'action' => 'fl_as_posts',
    'data'   => 'product',
    'limit'  => 1,
);

array_push($all_fields, $boutonniere);



// candles and other extras. (centerpieces, other arrangements)
$extras = array();

$candle_levels = ['gold', 'silver', 'glass'];

$candles = array(
    'title' => __('Candles','fl-builder'),
    'collapsed' => true,
    'fields' => array(
        'candles__master_select' => array(
            'type'   => 'suggest',
            'label'  => __('Product for Candles', 'fl-builder'),
            'action' => 'fl_as_posts',
            'data'   => 'product',
            'limit'  => 1,
        )
    )
);
array_push($extras,$candles);


$extra_arrangements = [
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

foreach ($extra_arrangements as $arrangement) {
    $arrangement_arr          = array();
    $arrangement_arr['title'] = __($arrangement, 'fl-builder');
    $arrangement_arr['collapsed'] = true;

    foreach ($all_collections as $collection) {
        $arrangement_arr['fields'][$arrangement . '__' . $collection["slug"] . '_select'] = array(
            'type'   => 'suggest',
            'label'  => __('Product for ' . $collection['name'], 'fl-builder'),
            'action' => 'fl_as_posts',
            'data'   => 'product',
            'limit'  => 1,
        );
    }

    array_push($extras, $arrangement_arr);
}


/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('ThistleThatConfigurationModule', array(
    'general' => array( // Tab
         'title'    => __('Arrangements', 'fl-builder'), // Tab title
         'sections' => $all_fields,

    ),

    'extras' => array(
        'title' => __('Candles/Extras/Etc.','fl-builder'),
        'sections' => $extras,
    )
));
