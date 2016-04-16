<?php
/**
 * Fallback functions: to be removed after two major versions.
 *
 * @package Bow
 */

/**
 * Display custom logo, theme support for custom-logo added in 4.5.
 */
if ( ! function_exists( 'the_custom_logo' ) ) :

	function the_custom_logo() {

		$logo = get_theme_mod( 'logo', false );

		if ( $logo ) {
			printf( '<a href="%1$s" class="site-logo" rel="home" itemprop="url"><img src="%2$s"></a>',
			esc_url( home_url( '/' ) ), $logo );
		}

	}

	/**
	* Add logo fallback to customizer.
	*/
   add_action( 'customize_register', function( $customizer ) {

	   $customizer->add_setting( 'logo', [
		   'sanitize_callback' => 'wp_strip_all_tags'
	   ] );

	   $customizer->add_control( new WP_Customize_Image_Control( $customizer, 'logo', [
		   'settings'    => 'logo',
		   'section'     => 'title_tagline',
		   'label'       => __( 'Site Logo', 'bow' )
	   ] ) );

   } );

endif;
