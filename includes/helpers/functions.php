<?php
/**
 * Custom functions for this theme including:
 *
 * is_user()          | Checks user role
 * is_blog()          | Checks if is blog page
 * categorized_blog() | Check for multiple categories
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
function categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( [
			'hide_empty' => 1,
		] );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in categorized_blog.
 */
function category_transient_flusher() {
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'Mild\category_transient_flusher' );
add_action( 'save_post',     'Mild\category_transient_flusher' );
