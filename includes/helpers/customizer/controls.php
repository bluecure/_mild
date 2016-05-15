<?php
/**
 * Customizer
 *
 * Create new customizer controls.
 *
 * @package Bow
 */

namespace Lambry\Bow\Helpers\Customizer;

class Controls {

	/* Variables */
	private $customizer;

    /**
     * Construct
     *
     * Set the customizer.
     *
     * @param object $customizer
     */
    public function __construct( $customizer ) {

        $this->customizer = $customizer;

    }

	/**
	 * Add Control
	 *
	 * Adds the appropriate control type.
	 *
	 * @access public
	 * @param  array $control
	 * @return null
	 */
	public function add_control( $control ) {

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
