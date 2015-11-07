<?php
/**
 * Fallback functions: to be removed after two major versions.
 *
 * @package Bow
 */

/**
 * Display custom icons, wp_site_icon added in 4.3.
 */
if ( ! function_exists( 'has_site_icon' ) ) :

	/**
	 * Add fallback icon options to customizer.
	 */
	add_action( 'customize_register', function( $customizer ) {

		$customizer->add_setting( 'favicon', [
			'sanitize_callback' => 'wp_strip_all_tags'
		] );

		$customizer->add_setting( 'appicon', [
			'sanitize_callback' => 'wp_strip_all_tags'
		] );

		$customizer->add_control( new WP_Customize_Image_Control( $customizer, 'favicon', [
			'settings'    => 'favicon',
			'section'     => 'images',
			'label'       => __( 'Favicon', 'bow' )
		] ) );

		$customizer->add_control( new WP_Customize_Image_Control( $customizer, 'appicon', [
			'settings'    => 'appicon',
			'section'     => 'images',
			'label'       => __( 'App Icon', 'bow' )
		] ) );

	} );


	/**
	 * Add fallback icons to head.
	 */
	add_action( 'wp_head', function() {

		// Get theme mods
		$appicon = get_theme_mod( 'appicon' );
		$favicon = get_theme_mod( 'favicon' );

		/* App Icon */
		if ( $appicon ) : ?>
			<link rel="icon" sizes="192x192" href="<?php echo $appicon; ?>">
			<link rel="apple-touch-icon" href="<?php echo $appicon; ?>">
			<meta name="msapplication-TileImage" content="<?php echo $appicon; ?>">
		<?php endif;

		/* Favicon */
		if ( $favicon ) : ?>
			<link rel="shortcut icon" href="<?php echo $favicon; ?>">
		<?php endif;

	} );

endif;
