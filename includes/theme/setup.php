<?php
/**
 * Theme setup
 *
 * @package _m
 */

/**
* Setup Theme Options Framework.
*/
add_filter( 'ot_show_pages', '__return_false' );
add_filter( 'ot_show_new_layout', '__return_false' );
add_filter( 'ot_theme_mode', '__return_true' );
require _m_OPTION_TREE . 'ot-loader.php';

/**
 * Set the content width.
 */
if ( ! isset( $content_width ) ) {
    $content_width = 1140;
}

if ( ! function_exists( '_m_setup' ) ) {
    /**
     * Sets up theme defaults and register support for various WordPress features.
     */
    function _m_setup() {

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        // Add theme suport for woocommerce
        add_theme_support( 'woocommerce' );

        // Enable support for Post Thumbnails on posts and pages.
        add_theme_support( 'post-thumbnails' );

        // Enable support for HTML5 markup.
        add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form', 'gallery' ) );

        // Enable support for Page excerpts.
        add_post_type_support( 'page', 'excerpt' );

        // Enable support for Post Formats.
        add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'primary' => __( 'Primary Menu', '_m' ),
        ) );

    }
}
add_action( 'after_setup_theme', '_m_setup' );

/**
 * Register widgetized areas.
 */
function _m_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Sidebar', '_m' ),
        'id'            => 'sidebar-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', '_m_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function _m_scripts() {
    wp_enqueue_style( '_m-style', get_stylesheet_uri() );

    wp_enqueue_script( '_m-scripts', get_template_directory_uri() . '/assets/scripts/scripts.min.js', array('jquery'), '20120206', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', '_m_scripts' );
