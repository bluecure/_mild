<?php
/**
 * Custom functions for this theme including:
 *
 * is_user()          | Checks user role
 * is_blog()          | Checks if is blog page
 * is_categorized_blog() | Check for multiple categories
 *
 * @package Mild
 */

namespace Mild;

/**
 * Get and check user role
 *
 * @return boolean
 */
function is_user( $role ) {
	$user = wp_get_current_user();
	return ( in_array( $role, $user->roles ) );
}

/**
 * Check whether current page is a blog page
 *
 * @return boolean
 */
function is_blog() {
    global $post;
    $post_type = get_post_type( $post );
    return ( ( is_home() || is_archive() || is_single() ) && ( $post_type == 'post') ) ? true : false;
}

/**
 * Returns true if a blog has more than 1 category.
 */
function is_categorized_blog() {
	if ( ( $categories = get_transient( 'mild_categories' ) ) === false ) {
		// Create an array of all the categories that are attached to posts.
		$categories = get_categories( array(
			'hide_empty' => 1,
		) );
		// Count the number of categories that are attached to the posts.
		$categories = count( $categories );
		set_transient( 'mild_categories', $categories );
	}
	// If this blog has more than 1 category return true.
	if ( $categories !== '1' ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Flush out the transients used in categorized_blog.
 */
function category_transient_flusher() {
	delete_transient( 'mild_categories' );
}
add_action( 'edit_category', 'Mild\category_transient_flusher' );
add_action( 'save_post',     'Mild\category_transient_flusher' );