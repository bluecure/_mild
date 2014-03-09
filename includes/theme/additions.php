<?php
/**
* Custom post types, taxonomies and user roles
*
* @package _m
*/

/* 
* Create new post types 
* @param $post_type, $labels = [], $options = []
*/
function _m_post_types() {

    require_once _m_HELPERS . 'class-create-post-type.php';

    // Create books post type
    $projects = new Create_Post_Type( 
        'book', 
        [ 'single' => 'Book', 'plural' => 'Books' ], 
        [ 'menu_icon' => 'dashicons-admin-tools' ]
    );

}
add_action( 'after_setup_theme', '_m_post_types' );

/* 
* Create new taxonomies
* @param $taxonomy, $post_type = [], $labels = [], $options = []
*/
function _m_taxonomies() {

    require_once _m_HELPERS . 'class-create-taxonomy.php';

    // Create genre taxonomy
    $fields = new Create_Taxonomy( 
        'genre',
        'book', 
        [ 'single' => 'Genre', 'plural' => 'Genres' ]
    );

}
add_action( 'after_setup_theme', '_m_taxonomies' );

/* 
* Create new user role
* @param $role, $display_name, $capabilities = []
*/
function _m_user_roles() {

    require_once _m_HELPERS . 'class-create-user-role.php';

    // Create genre taxonomy
    $fields = new Create_User_Role( 
        'customer',
        'Customer'
    );

}
add_action( 'after_setup_theme', '_m_user_roles' );
