<?php
/**
 * Custom theme meta boxes
 *
 * @package _m
 */

/**
* Initialize the meta boxes.
*/
add_action( 'admin_init', '_m_meta_boxes' );

function _m_meta_boxes() {

    /**
    * Create a custom meta boxes array that we pass to
    * the OptionTree Meta Box API Class.
    */
    $page_meta_box = array(
        'id'          => 'page_meta_box',
        'title'       => 'Page Options',
        'desc'        => '',
        'pages'       => array( 'page' ),
        'context'     => 'normal',
        'priority'    => 'high',
        'fields'      => array(
            array(
                'label'       => 'Background Image',
                'id'          => 'pm_background_image',
                'type'        => 'upload',
                'desc'        => 'This image will be used as the pages background'
            )
        )
    );

    /**
    * Register our meta boxes using the
    * ot_register_meta_box() function.
    */
    ot_register_meta_box( $page_meta_box );

}
