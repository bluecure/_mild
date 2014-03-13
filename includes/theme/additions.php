<?php
/**
* Custom post types, taxonomies and user roles
*
* @package Mild
*/

add_action( 'after_setup_theme', function() {
    
    /* 
    * Create new post type
    * @param $post_type, $labels = [], $options = []
    */
    $type = new \MildHelpers\Post_Types( 
        'book', 
        [ 'single' => 'Book', 'plural' => 'Books' ], 
        [ 'menu_icon' => 'dashicons-admin-tools' ]
    );

    /* 
    * Create new taxonomy
    * @param $taxonomy, $post_type = [], $labels = [], $options = []
    */
    $tax = new \MildHelpers\Taxonomies( 
        'genre',
        'book', 
        [ 'single' => 'Genre', 'plural' => 'Genres' ]
    );

    /* 
    * Create new user role
    * @param $role, $display_name, $capabilities = []
    */
    $role = new \MildHelpers\User_Roles( 
        'customer',
        'Customer'
    );

});
