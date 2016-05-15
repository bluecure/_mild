<?php
/**
 * Sidebars
 *
 * Create new sidebars i.e. widgets areas.
 *
 * @package Bow
 */

namespace Lambry\Bow\Helpers;

class Sidebars {

	/* Variables */
	public $sidebars = [];

	/**
	 * Construct
	 *
	 * Creates new sidebars.
	 *
	 * @param array $sidebars
	 */
	public function __construct( $sidebars = [] ) {

		// Set variables
		$this->sidebars = $sidebars;

		// Register
		$this->register();

	}

	/**
	 * Register
	 *
	 * Register the new sidebars.
	 *
	 * @access private
	 * @return null
	 */
	private function register() {

		foreach ( $this->sidebars as $sidebar ) {

			// Set options
			$options = wp_parse_args( $sidebar, $this->default_options() );

			// Register sidebar
			register_sidebar( [
				'name'          => $options['name'],
				'id'            => sanitize_title_with_dashes( $options['name'] ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s ' . $options['classes'] . '">',
				'after_widget'  => '</aside>',
				'before_title'  => '<' . $options['header'] . ' class="widget-title">',
				'after_title'   => '</' . $options['header'] . '>'
			] );

		}

	}

	/**
	 * Default Options
	 *
	 * Setup the default options.
	 *
	 * @access private
	 * @return array $default_options
	 */
	private function default_options() {

		return [
			'name'    => 'Sidebar',
			'header'  => 'h3',
			'classes' => ''
		];

	}

}
