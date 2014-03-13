<?php
/**
 * Custom theme meta boxes
 *
 * @package Mild
 */

/**
* Initialize the meta boxes.
*/
add_action( 'admin_init', function() {

    /**
    * Create a custom meta boxes array that we pass to
    * the OptionTree Meta Box API Class.
    */
    $page_meta_box = [
        'id'          => 'page_meta_box',
        'title'       => 'Page Options',
        'desc'        => '',
        'pages'       => [ 'page' ],
        'context'     => 'normal',
        'priority'    => 'high',
        'fields'      => [
            [
                'label'       => 'Background Image',
                'id'          => 'pm_background_image',
                'type'        => 'upload',
                'desc'        => 'This image will be used as the pages background'
            ]
        ]
    ];

    /**
    * Register our meta boxes using the
    * ot_register_meta_box() function.
    */
    ot_register_meta_box( $page_meta_box );

});
