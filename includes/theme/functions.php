<?php
/**
 * Custom functions for this theme including:
 *
 * the_field()         | Display a meta value
 * get_field()         | Get a meta value
 * customizer_styles() | Checks and displays custom styles
 *
 * @package Bow
 */

namespace Lambry\Bow;

/**
 * Helper function to display a meta value.
 *
 * @param string $key
 * @param int $id
 * @return void
 */
function the_field( $key, $id = 0 ) {

	echo get_field( $key, $id );

}

/**
 * Helper function to get a meta value.
 *
 * @param string $key
 * @param int $id
 * @return mixed $value
 */
function get_field( $key, $id = 0 ) {

	if ( ! $id ) {
		global $post;
		$id = $post->ID;
	}

	return get_post_meta( $id, '_' . $key, true );

}

/**
 * Checks and displays customizer styles.
 *
 * @return void
 */
function customizer_styles() {

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
		wp_add_inline_style( 'bow-style', $styles );
	}

}
