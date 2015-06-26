<?php
/**
 * Custom functions for this theme including:
 *
 * theme_section() | Get a sections settings
 * theme_option()  | Get a settings option
 * is_user()       | Checks user role
 * is_blog()       | Checks if is blog page
 *
 * @package Mild
 */

namespace Mild;

/**
 * Helper function to get theme option section.
 *
 * @param string $section
 * @return array $section
 */
function theme_section( $section ) {

	return Settings::get_settings( 'theme-options', $section );

}

/**
 * Helper function to get a theme options value.
 *
 * @param string $section
 * @param string $field
 * @return string $field
 */
function theme_option( $section, $field ) {

	return Settings::get_setting( 'theme-options', $section, $field );

}

/**
 * Get and check user role.
 *
 * @param string $role
 * @return boolean
 */
function is_user( $role ) {

	$user = wp_get_current_user();

	return ( in_array( $role, $user->roles ) );

}

/**
 * Check whether current page is a blog page.
 *
 * @return boolean
 */
function is_blog() {

	global $post;

	return ( ( is_home() || is_archive() || is_single() ) && ( $post->post_type === 'post' ) ) ? true : false;

}
