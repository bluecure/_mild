<?php
/**
 * Customizer
 *
 * Create new customizer sections and controls.
 *
 * @package Bow
 */

namespace Lambry\Bow;

class Customizer {

	/* Variables */
	private $customizer;
	private $controls;

	/**
	 * Construct
	 *
	 * Register new customizer and load assets.
	 *
	 * @param array $controls
	 */
	public function __construct( $controls ) {

		// Set options
		$this->controls = $controls;

		// Register Customizer
		add_action( 'customize_register', function( $customizer ) {

			$this->customizer = $customizer;
			$this->customizer->get_setting( 'blogname' )->transport = 'postMessage';
			$this->customizer->get_setting( 'blogdescription' )->transport = 'postMessage';
			$this->register_customizer();

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

	/**
	 * Register Customizer
	 *
	 * Register customizer panels, sections, settings and controls.
	 *
	 * @access private
	 * @return null
	 */
	private function register_customizer() {

		// Set up each customizer panel
		foreach ( $this->controls as $panel ) {

			$this->customizer->add_panel( $panel['id'], [
				'title'       => $panel['title'],
				'description' => $panel['description'],
				'priority'    => ( isset( $panel['priority'] ) ) ? $panel['priority'] : ''
			] );

			// Set up each customizer section
			foreach ( $panel['sections'] as $section ) {

				$this->customizer->add_section( $section['id'], [
					'title'       => $section['title'],
					'description' => $section['description'],
					'priority'    => ( isset( $section['priority'] ) ) ? $section['priority'] : '',
					'panel'       => $panel['id'],
				] );

				// Add settings and controls
				foreach ( $section['settings'] as $option ) {

					// Add setting
					$this->customizer->add_setting( $option['id'], [
						'transport'         => 'postMessage',
						'sanitize_callback' => 'wp_strip_all_tags'
					] );

					// Add control
					$option['section'] = $section['id'];
					$this->add_control( $option );

				}

			}

		}

	}

	/**
	 * Add Control
	 *
	 * Adds the appropriate control type.
	 *
	 * @access private
	 * @param  array $control
	 * @return null
	 */
	private function add_control( $control ) {

		switch ( $control['type'] ) {

			case 'color':
				$this->color( $control );
				break;

			case 'image':
				$this->image( $control );
				break;

			case 'upload':
				$this->upload( $control );
				break;

			default:
				$this->control( $control );
				break;
		}

	}

	/**
	 * Control
	 *
	 * Generates a text field / checkbox / radio buttons / select box.
	 *
	 * @access private
	 * @param  array $control
	 * @return null
	 */
	private function control( $control ) {

		$this->customizer->add_control( new \WP_Customize_Control( $this->customizer, $control['id'], [
			'settings'    => $control['id'],
			'section'     => $control['section'],
			'label'       => $control['label'],
			'type'        => ( isset( $control['type'] ) ) ? $control['type'] : 'text',
			'choices'     => ( isset( $control['choices'] ) ) ? $control['choices'] : '',
			'description' => ( isset( $control['description'] ) ) ? $control['description'] : ''
		] ) );

	}

	/**
	 * Color
	 *
	 * Generates a color picker.
	 *
	 * @access private
	 * @param  array $control
	 * @return null
	 */
	private function color( $control ) {

		$this->customizer->add_control( new \WP_Customize_Color_Control( $this->customizer, $control['id'], [
			'settings'    => $control['id'],
			'section'     => $control['section'],
			'label'       => $control['label'],
			'description' => ( isset( $control['description'] ) ) ? $control['description'] : ''
		] ) );

	}

	/**
	 * Image
	 *
	 * Generates an image upload field.
	 *
	 * @access private
	 * @param  array $control
	 * @return null
	 */
	private function image( $control ) {

		$this->customizer->add_control( new \WP_Customize_Image_Control( $this->customizer, $control['id'], [
			'settings'    => $control['id'],
			'section'     => $control['section'],
			'label'       => $control['label'],
			'description' => ( isset( $control['description'] ) ) ? $control['description'] : ''
		] ) );

	}

	/**
	 * Upload
	 *
	 * Generates an upload field.
	 *
	 * @access private
	 * @param  array $control
	 * @return null
	 */
	private function upload( $control ) {

		$this->customizer->add_control( new \WP_Customize_Upload_Control( $this->customizer, $control['id'], [
			'settings'    => $control['id'],
			'section'     => $control['section'],
			'label'       => $control['label'],
			'description' => ( isset( $control['description'] ) ) ? $control['description'] : ''
		] ) );

	}

}
