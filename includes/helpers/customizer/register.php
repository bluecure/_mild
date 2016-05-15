<?php
/**
 * Customizer
 *
 * Create new customizer sections.
 *
 * @package Bow
 */

namespace Lambry\Bow\Helpers\Customizer;

class Register {

	/* Variables */
	private $customizer;
	/* Clasess */
	private $control;

	/**
	 * Construct
	 *
	 * Set the customizer and include controls.
	 *
	 * @param object $customizer
	 * @param array $contols
	 */
	public function __construct( $customizer, $controls ) {

		// Set variables and classes
        $this->customizer = $customizer;
        $this->control = new Controls( $customizer );

		// Register the controls
        $this->register( $controls );

	}

	/**
	 * Register
	 *
	 * Register the customizer control groups.
	 *
	 * @access private
	 * @param  array $controls
	 * @return null
	 */
	private function register( $controls ) {

		foreach ( $controls as $control ) {

			// Add panel or sections
			if ( isset( $control['sections'] ) ) {
				$this->add_panel( $control );
			} else if ( isset( $control['settings'] ) ) {
				$this->add_sections( [ $control ] );
			}

		}

	}

	/**
	 * Add Panels
	 *
	 * Register the customizer panels.
	 *
	 * @access private
	 * @param  array $panels
	 * @return null
	 */
	private function add_panel( $panel ) {

		$this->customizer->add_panel( $panel['id'], [
			'title'       => $panel['title'],
			'description' => $panel['description'],
			'priority'    => ( isset( $panel['priority'] ) ) ? $panel['priority'] : ''
		] );

		// Add sections
		$this->add_sections( $panel['sections'], $panel['id'] );

	}

	/**
	 * Add Sections
	 *
	 * Register the customizer sections.
	 *
	 * @access private
	 * @param  array $sections
	 * @param  array $panel_id
	 * @return null
	 */
	private function add_sections( $sections, $panel_id = false ) {

		// Set up each customizer section
		foreach ( $sections as $section ) {

			$this->customizer->add_section( $section['id'], [
				'capability'  => 'manage_options',
				'title'       => $section['title'],
				'description' => $section['description'],
				'priority'    => ( isset( $section['priority'] ) ) ? $section['priority'] : '',
				'panel'       => ( $panel_id ) ? $panel_id : false
			] );

			// Add settings
			$this->add_settings( $section['settings'], $section['id'] );

		}

	}

	/**
	 * Add Settings
	 *
	 * Register the customizer settings.
	 *
	 * @access private
	 * @param  array  $settings
	 * @param  string $section_id
	 * @return null
	 */
	private function add_settings( $settings, $section_id ) {

		// Add settings and controls
		foreach ( $settings as $option ) {

			$this->customizer->add_setting( $option['id'], [
				'type'              => 'theme_mod',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'wp_strip_all_tags'
			] );

			// Add control
			$option['section'] = $section_id;
			$this->control->add_control( $option );

		}

	}

}
