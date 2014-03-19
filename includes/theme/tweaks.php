<?php
/**
 * Custom tweaks for this theme.
 *
 * @package Mild
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
add_filter( 'wp_page_menu_args', function( $args ) {
    $args['show_home'] = true;
    return $args;
});

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
    if ( $image_default_link !== 'none' ) {
        update_option( 'image_default_link_type', 'none' );
    }
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
    return '<br><a href="' . get_permalink() . '" class="more">Read More...</a>';
});

/**
* Redirect user after login.
*/
add_filter( 'login_redirect', function( $redirect_to, $request, $user ) {
    if( Mild\is_user( 'administrator' ) ) {
        return $redirect_to;
    } else {
        return home_url();
    }
}, 10, 3);

/**
* Redirect user after logout.
*/
add_filter( 'logout_url', function( $logout_url, $redirect = null ) {
    return $logout_url . '&amp;redirect_to=' . urlencode( get_bloginfo('url')  );
});

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
add_filter( 'wp_title', function( $title, $sep ) {
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
        $title .= " $sep " . sprintf( 'Page %s', max( $paged, $page ) );
    }

    return $title;
}, 10, 2);

/**
 * Sets the authordata global when viewing an author archive.
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
add_action( 'wp', function() {
    global $wp_query;

    if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
        $GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
    }
});
