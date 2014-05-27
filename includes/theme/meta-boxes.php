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

    /* Slider */
    $mb_slider = [
        'id'          => 'mb_slider',
        'title'       => 'Slider',
        'pages'       => [ 'page' ],
        'context'     => 'normal',
        'priority'    => 'high',
        'fields'      => [
            [
                'label'       => 'Slider',
                'id'          => 'slider',
                'type'        => 'slider'
            ]
        ]
    ];
    /* Two Cols */
    $mb_two_cols = [
        'id'          => 'mb_two_cols',
        'title'       => 'Columns',
        'pages'       => [ 'page' ],
        'context'     => 'normal',
        'priority'    => 'high',
        'fields'      => [
            [
                'label'       => 'Column One',
                'id'          => 'two_cols_one',
                'type'        => 'textarea'
            ], [
                'label'       => 'Column Two',
                'id'          => 'two_cols_two',
                'type'        => 'textarea'
            ]
        ]
    ];
    /* Three Cols */
    $mb_three_cols = [
        'id'          => 'mb_three_cols',
        'title'       => 'Columns',
        'pages'       => [ 'page' ],
        'context'     => 'normal',
        'priority'    => 'high',
        'fields'      => [
            [
                'label'       => 'Column One',
                'id'          => 'three_cols_one',
                'type'        => 'textarea'
            ], [
                'label'       => 'Column Two',
                'id'          => 'three_cols_two',
                'type'        => 'textarea'
            ], [
                'label'       => 'Column Three',
                'id'          => 'three_cols_three',
                'type'        => 'textarea'
            ]
        ]
    ];
    /* Four Cols */
    $mb_four_cols = [
        'id'          => 'mb_four_cols',
        'title'       => 'Columns',
        'pages'       => [ 'page' ],
        'context'     => 'normal',
        'priority'    => 'high',
        'fields'      => [
            [
                'label'       => 'Column One',
                'id'          => 'four_cols_one',
                'type'        => 'textarea'
            ], [
                'label'       => 'Column Two',
                'id'          => 'four_cols_two',
                'type'        => 'textarea'
            ], [
                'label'       => 'Column Three',
                'id'          => 'four_cols_three',
                'type'        => 'textarea'
            ], [
                'label'       => 'Column Four',
                'id'          => 'four_cols_four',
                'type'        => 'textarea'
            ]
        ]
    ];

    /**
    * Register our meta boxes using the
    * ot_register_meta_box() function.
    */
    $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'];
    $template_file = get_post_meta( $post_id, '_wp_page_template', TRUE );
    
    if ( $template_file === 'templates/slider.php' )
        ot_register_meta_box( $mb_slider );

    if ( $template_file === 'templates/two-cols.php' )
        ot_register_meta_box( $mb_two_cols );
        
        
    if ( $template_file === 'templates/three-cols.php' )
        ot_register_meta_box( $mb_three_cols );


});
