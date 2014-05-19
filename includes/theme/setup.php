<?php
/**
 * Theme setup
 *
 * @package Mild
 */

/**
* Setup Theme Options Framework.
*/
add_filter( 'ot_show_pages', '__return_false' );
add_filter( 'ot_show_new_layout', '__return_false' );
add_filter( 'ot_theme_mode', '__return_true' );
require MILD_OPTIONS . 'ot-loader.php';

/**
 * Set the content width.
 */
if ( ! isset( $content_width ) )
    $content_width = 1140;

/**
 * Sets up defaults, add theme support, register post types, taxonomies, roles, ect.
 */
add_action( 'after_setup_theme', function() {

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    // Add theme suport for woocommerce
    add_theme_support( 'woocommerce' );

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support( 'post-thumbnails' );

    // Enable support for HTML5 markup.
    add_theme_support( 'html5', [ 'comment-list', 'search-form', 'comment-form', 'gallery', 'caption' ] );

    // Enable support for Page excerpts.
    add_post_type_support( 'page', 'excerpt' );

    // Enable support for Post Formats.
    add_theme_support( 'post-formats', [ 'aside', 'image', 'video', 'quote', 'link' ] );
    
    // Add banner size.
    //add_image_size( 'banner', 1140, 475, true );

    // Register nav menus.
    register_nav_menus( [
        'primary' => 'Primary Menu'
    ] );

    // Register user roles.
    // $roles = new Mild\User_Roles( [
    //     [ 'name' => 'Customer' ]        
    // ] );

    // Register post types.
    // $types = new Mild\Post_Types( [
    //     [ 'name' => 'Book' ]
    // ] );

    // Register taxonomies.
    // $taxonomies = new Mild\Taxonomies( [
    //     [ 'name' => 'Genre', 'post_types' => [ 'Book' ] ]
    // ] );

});

/**
 * Register widgetized areas.
 */
add_action( 'widgets_init', function () {

    // Register sidebars.
    $sidebars = new Mild\Sidebars( [
        [ 'name' => 'Sidebar' ]
    ] );

});

/**
 * Enqueue scripts and styles.
 */
add_action( 'wp_enqueue_scripts', function() {

    // Load main css file.
    wp_enqueue_style( 'mild-style', get_stylesheet_uri() );
    // Load main js file.
    wp_enqueue_script( 'mild-scripts', get_template_directory_uri() . '/assets/scripts/scripts.min.js', ['jquery'], '20120206', true );
    // Load comment script.
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
        wp_enqueue_script( 'comment-reply' );
    
});
