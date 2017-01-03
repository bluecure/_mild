<?php
/**
 * Meta Boxes
 *
 * Create new meta boxes.
 *
 * @package Bow
 */

namespace Lambry\Bow\Helpers\Meta_Boxes;

class Meta_Boxes {

	/**
	 * Construct
	 *
	 * Register new meta boxes and load assets.
	 *
	 * @param array $meta_boxes
	 * @param array $post_types
	 */
	public function __construct( $meta_boxes, $post_types = [ 'page' ] ) {

		// Register meta boxes
		$register = new Register( $meta_boxes, $post_types );

		// Add admin assets
		add_action( 'admin_enqueue_scripts', [ $this, 'load_assets' ] );

	}

	/**
	 * Load Assets
	 *
	 * Loads all assets.
	 *
	 * @access public
	 * @param  string $hook
	 * @return null
	 */
	public function load_assets( $hook ) {

		// Check if we should load assets
		if ( $hook !== 'post-new.php' && $hook !== 'post.php' ) return;

		// Load settings css
		wp_enqueue_style( 'bow-meta-styles', get_template_directory_uri() . '/assets/admin/styles/meta-boxes.css', [ 'wp-color-picker' ], '1.0.0' );
		// Load media assets
		wp_enqueue_media();
		// Load settings js
		wp_enqueue_script( 'bow-meta-scripts', get_template_directory_uri() . '/assets/admin/scripts/meta-boxes.js', [ 'jquery', 'wp-color-picker' ], '1.0.0', true );

	}

}
