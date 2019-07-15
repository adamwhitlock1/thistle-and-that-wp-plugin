<?php

/**
 * This is an example module with only the basic
 * setup necessary to get it working.
 *
 * @class FLBasicExampleModule
 */
class ThistleThatVideosPageModule extends FLBuilderModule
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
            'name'            => __('Videos Page Content', 'fl-builder'),
            'description'     => __('Gated Content, As a shortcode wrapper', 'fl-builder'),
            'category'        => __('Thistle & That', 'fl-builder'),
            'group'           => __('Thistle & That', 'fl-builder'),
            'dir'             => THISTLE_THAT_MODULES_DIR . 'modules/videospage/',
            'url'             => THISTLE_THAT_MODULES_URL . 'modules/videospage/',
            'editor_export'   => true, // Defaults to true and can be omitted.
             'enabled'         => true, // Defaults to true and can be omitted.
             'partial_refresh' => false,
        ));

    }
}


/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('ThistleThatVideosPageModule', array(
    'general' => array( // Tab
        'title'    => __('Videos Shortcode', 'fl-builder'), // Tab title
        'sections' => array(
            'shortcode-section'  => array(
                'title'            => __( 'Add your content shortcode', 'fl-builder' ),
                'fields'        => array(
                    'videos_page_shortcode'     => array(
                        'type'          => 'text',
                        'label'         => __( 'Shortcode (with brackets)', 'fl-builder' ),
                    ),

                    'number_of_days'     => array(
                        'type'          => 'unit',
                        'label'         => __( 'Number of days before event to show videos.', 'fl-builder' ),
                        'description'   => 'days'
                    ),
                )
            )
        ),
    )
));
