<?php
/**
 * Custom tweaks for this theme.
 *
 * @package Mild
 */

/*
 * Stop file editing.
 */
define ( 'DISALLOW_FILE_EDIT', true );

/**
 * Run shortcodes in widgets.
 */
add_filter( 'widget_text', 'do_shortcode' );

/**
 * Clean up auto p's for shortcodes.
 */
remove_filter( 'the_content', 'wpautop' );
add_filter( 'the_content', 'wpautop' , 11 );

/**
 * Enable core buttons.
 */
add_filter( 'mce_buttons_2', function( $buttons ) {
    $buttons[] = 'hr';
    return $buttons;
});

/**
 * Set default image link to none.
 */
add_action( 'admin_init', function() {
    $image_default_link = get_option( 'image_default_link_type' );
    if ( $image_default_link !== 'none' )
        update_option( 'image_default_link_type', 'none' );
});

/**
 * Allow SVG uploads.
 */
add_filter( 'upload_mimes', function( $mimes ) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
});

/**
 * Alter the excerpt more.
 */
add_filter( 'excerpt_more', function( $more ) {
    return '<br><a href="' . get_permalink() . '" class="more"> ' . __( 'Read More...', 'mild' ) . '</a>';
});

/**
 * Redirect user after logout.
 */
add_filter( 'logout_url', function( $logout_url, $redirect = null ) {
    return $logout_url . '&amp;redirect_to=' . urlencode( home_url()  );
});

/**
 * Sets the authordata global on author archives.
 */
add_action( 'wp', function() {
    global $wp_query;
    if ( $wp_query->is_author() && isset( $wp_query->post ) )
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
});
