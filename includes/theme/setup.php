<?php
/**
 * Theme setup.
 *
 * @package Bow
 */

use Lambry\Bow\Theme\Functions;
use Lambry\Bow\Helpers\Sidebars;

/**
 * Set the content width.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1140;
}

/**
 * Set up defaults, add theme supports and menus.
 */
add_action( 'after_setup_theme', function() {

	// Make theme available for translation
	load_theme_textdomain( 'bow', get_template_directory() . '/includes/languages' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Add theme support for the title tag
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages
	add_theme_support( 'post-thumbnails' );

	// Enable support for Page excerpts
	add_post_type_support( 'page', 'excerpt' );

	// Add theme support for WooCommerce
	add_theme_support( 'woocommerce' );

	// Enable support for HTML5 markup
	add_theme_support( 'html5', [
		'comment-list', 'comment-form', 'search-form', 'gallery', 'caption'
	] );

	// Enable support for Post Formats
	add_theme_support( 'post-formats', [
		'aside', 'image', 'gallery', 'video', 'audio', 'quote', 'status', 'link'
	] );

	// Register nav menus
	register_nav_menus( [
		'primary' => __( 'Primary Menu', 'bow' )
	] );

	// Add support for custom logos
	add_theme_support( 'custom-logo', [
		'height'     => 200,
		'width'      => 400,
		'flex-width' => true
	] );

} );

/**
 * Register widgetized areas.
 */
add_action( 'widgets_init', function() {

	// Register sidebars
	new Sidebars( [
		[ 'name' => __( 'Sidebar', 'bow' ) ]
	] );

} );

/**
 * Enqueue scripts and styles.
 */
add_action( 'wp_enqueue_scripts', function() {

	// Load main css file
	wp_enqueue_style( 'bow-styles', get_stylesheet_uri(), [], '1.0.0' );
	// Add customizer styles
	Functions::customizer_styles();
	// Load main js file
	wp_enqueue_script( 'bow-scripts', get_template_directory_uri() . '/assets/scripts/script.min.js', [ 'jquery' ], '1.0.0', true );

	// Load comment script
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

} );
