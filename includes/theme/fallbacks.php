<?php
/**
 * Fallback functions: to be removed after two major versions.
 *
 * @package Bow
 */

/**
 * Display custom icons, wp_site_icon added in 4.3.
 */
if ( ! function_exists( 'the_comments_navigation' ) ) :

	function the_comments_navigation() {

		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
				<h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'bow' ); ?></h2>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'bow' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'bow' ) ); ?></div>
			</nav><!-- .comment-navigation -->
		<?php endif;

	}

endif;

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
