<?php
/**
 * Functions
 *
 * Custom functions for this theme.
 *
 * @package Bow
 */

namespace Lambry\Bow\Theme;

class Functions {

	/**
	 * The Field
	 *
	 * Helper function to display a meta value.
	 *
	 * @access public
	 * @param string $key
	 * @param int $id
	 * @return void
	 */
	public static function the_field( $key, $id = 0 ) {

		echo get_field( $key, $id );

	}

	/**
	 * Get Field
	 *
	 * Helper function to get a meta value.
	 *
	 * @access public
	 * @param string $key
	 * @param int $id
	 * @return mixed $value
	 */
	public static function get_field( $key, $id = 0 ) {

		if ( ! $id ) {
			global $post;
			$id = $post->ID;
		}

		return get_post_meta( $id, '_' . $key, true );

	}

	/**
	 * Customizer Styles
	 *
	 * Checks and displays customizer styles.
	 *
	 * @access public
	 * @return void
	 */
	public static function customizer_styles() {

		$styles = '';
		$mods = [
			'header_text'  => [ '.site-header', 'color' ],
			'content_text' => [ '.site-content', 'color' ],
			'footer_text'  => [ '.site-footer', 'color' ],
			'header_links' => [ '.site-header a', 'color' ],
			'content_links'      => [ '.site-content a', 'color' ],
			'footer_links'       => [ '.site-footer a', 'color' ],
			'header_background'  => [ '.site-header', 'background-color' ],
			'content_background' => [ '.site-content', 'background-color' ],
			'footer_background'  => [ '.site-footer', 'background-color' ]
		];

		foreach ( $mods as $mod => $option ) {
			$value = get_theme_mod( $mod, false );
			if ( $value ) {
				$styles .= "{$option[0]} { {$option[1]}: {$value}; }";
			}
		}

		if ( $styles ) {
			wp_add_inline_style( 'bow-styles', $styles );
		}

	}

}
