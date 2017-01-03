<?php
/**
 * Customizer
 *
 * Setup new customizer instance.
 *
 * @package Bow
 */

namespace Lambry\Bow\Helpers\Customizer;

class Customizer {

	/* Variables */
	private $controls;

	/**
	 * Construct
	 *
	 * Register new customizer and load assets.
	 *
	 * @param array $controls
	 */
	public function __construct( $controls ) {

		$this->controls = $controls;

		// Register Customizer
		add_action( 'customize_register', function( $customizer ) {

			$customizer->get_setting( 'blogname' )->transport = 'postMessage';
			$customizer->get_setting( 'blogdescription' )->transport = 'postMessage';

			$register = new Register( $customizer, $this->controls );

		} );

		// Load customizer scripts
		add_action( 'customize_preview_init', [ $this, 'load_customizer_scripts' ] );

		// Load control scripts
		add_action( 'customize_controls_enqueue_scripts', [ $this, 'load_control_scripts' ] );

	}

	/**
	 * Load Customizer Scripts
	 *
	 * Loads all customizer scripts.
	 *
	 * @access public
	 * @return null
	 */
	public function load_customizer_scripts() {

		wp_enqueue_script( 'bow-customizer', get_template_directory_uri() . '/assets/admin/scripts/customizer.js', [
			'jquery',
			'customize-preview'
		], '1.0.0', true );

	}

	/**
	 * Load Control Scripts
	 *
	 * Loads all control scripts.
	 *
	 * @access public
	 * @return null
	 */
	public function load_control_scripts() {

		wp_enqueue_script( 'bow-controls', get_template_directory_uri() . '/assets/admin/scripts/controls.js', [ 'jquery' ], '1.0.0', true );

	}

}
