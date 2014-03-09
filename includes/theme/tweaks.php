<?php
/**
 * Custom tweaks for this theme.
 *
 * @package _m
 */

/**
 * Stop file editing.
 */
define ( 'DISALLOW_FILE_EDIT', true );

/**
* Clean up auto p's for shortcodes.
*/
remove_filter( 'the_content', 'wpautop' );
add_filter( 'the_content', 'wpautop' , 12 );

/**
* Run shortcodes in widgets.
*/
add_filter( 'widget_text', 'do_shortcode' );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function _m_page_menu_args( $args ) {
    $args['show_home'] = true;
    return $args;
}
add_filter( 'wp_page_menu_args', '_m_page_menu_args' );

/**
* Enable core buttons.
*/
function _m_core_buttons( $buttons ) {
    $buttons[] = 'hr';
    return $buttons;
}
add_filter( 'mce_buttons_2', '_m_core_buttons' );

/**
* Set default image link to none.
*/
function _m_image_defaults() {
    $image_default_link = get_option( 'image_default_link_type' );
    if ( $image_default_link !== 'none' ) {
        update_option( 'image_default_link_type', 'none' );
    }
}
add_action( 'admin_init', '_m_image_defaults', 10 );

/**
* Allow SVG uploads.
*/
function _m_mime_types( $mimes ){
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', '_m_mime_types' );

/**
* Alter the excerpt more.
*/
function _m_excerpt_more( $more ) {
	return '<br><a href="' . get_permalink() . '" class="more">Read More...</a>';
}
add_filter( 'excerpt_more', '_m_excerpt_more' );

/**
* Redirect user after login.
*/
function _m_login_redirect( $redirect_to, $request, $user ) {
    global $user;
    if( isset( $user->roles ) && is_array( $user->roles ) ) {
        if( ! in_array( "administrator", $user->roles ) ) {
            return home_url();
        } else {
            return $redirect_to;
        }
    } else {
        return $redirect_to;
    }
}
add_filter( 'login_redirect', '_m_login_redirect', 10, 3 );

/**
* Redirect user after logout.
*/
function _m_logout_redirect( $logout_url, $redirect = null ) {
    return $logout_url . '&amp;redirect_to=' . urlencode( get_bloginfo('url')  );
}
add_filter( 'logout_url', '_m_logout_redirect', 10, 3 );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed. (via: _s)
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function _m_wp_title( $title, $sep ) {
    global $page, $paged;

    if ( is_feed() ) {
        return $title;
    }

    // Add the blog name
    $title .= get_bloginfo( 'name' );

    // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) ) {
        $title .= " $sep $site_description";
    }

    // Add a page number if necessary:
    if ( $paged >= 2 || $page >= 2 ) {
        $title .= " $sep " . sprintf( __( 'Page %s', '_m' ), max( $paged, $page ) );
    }

    return $title;
}
add_filter( 'wp_title', '_m_wp_title', 10, 2 );

/**
 * Sets the authordata global when viewing an author archive. (via: _s)
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function _m_setup_author() {
    global $wp_query;

    if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
        $GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
    }
}
add_action( 'wp', '_m_setup_author' );
