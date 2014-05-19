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
                'id'          => 'pm_slider',
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
                'id'          => 'tc_col_one',
                'type'        => 'textarea'
            ], [
                'label'       => 'Column Two',
                'id'          => 'tc_col_two',
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
                'id'          => 'tc_col_one',
                'type'        => 'textarea'
            ], [
                'label'       => 'Column Two',
                'id'          => 'tc_col_two',
                'type'        => 'textarea'
            ], [
                'label'       => 'Column Three',
                'id'          => 'tc_col_three',
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
    
    if ($template_file === 'templates/slider.php')
        ot_register_meta_box( $mb_slider );

    if ($template_file === 'templates/two-cols.php')
        ot_register_meta_box( $mb_two_cols );
        
        
    if ($template_file === 'templates/three-cols.php')
        ot_register_meta_box( $mb_three_cols );


});
