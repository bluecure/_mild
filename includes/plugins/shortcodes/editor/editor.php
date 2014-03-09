<?php
/**
 * Load editor shortcode buttons
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

// Init
function ss_shortcode_buttons() {
    if ( is_admin() ) {
    	add_filter( 'mce_external_plugins', 'add_mce_plugins' );
    	add_filter( 'mce_buttons_3', 'register_mce_buttons' );
    	wp_enqueue_style( 'ss-editor', SIMPLE_SHORTCODES_DIRECTORY . '/editor/css/editor.css' );
    }
}
// Add plugin
function add_mce_plugins( $plugin_array ) {
	$plugin_array['mce_editor_shortcodes'] = SIMPLE_SHORTCODES_DIRECTORY . '/editor/editor.js';
	return $plugin_array;
}
// Register buttons
function register_mce_buttons( $buttons ) {
	array_push( $buttons, 'row', 'icon', 'button', 'panel', 'align', 'accordion', 'show', 'sitemap', 'map' );
	return $buttons;
}
add_action( 'init', 'ss_shortcode_buttons' );
