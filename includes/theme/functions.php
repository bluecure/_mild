<?php
/**
 * Custom functions for this theme including:
 *
 * _m_pagination()           | Displays Pagination
 * _m_breadcrumbs()          | Displays Breadcrumbs
 * _m_page_menu()            | Displays Page Menu
 * _m_posts_menu()           | Displays Posts Menu
 * _m_get_attachment_image() | Gets Attachment Image from Source
 * _m_is_user                | Checks user role
 *
 * @package _m
 */

/**
 * Displays pagination links
 *
 * @return String or array of page links
 */
function _m_pagination( $post_type = 'post' ) {
	global $wp_query;

	$args = array(
		'base'      => str_replace( 999999, '%#%', esc_url( get_pagenum_link( 999999 ) ) ),
		'format'    => '?paged=%#%',
		'current'   => max( 1, get_query_var('paged') ),
		'total'     => $wp_query->max_num_pages,
		'prev_next' => True,
		'prev_text' => '<i class="icon icon-angle-double-left"></i>',
		'next_text' => '<i class="icon icon-angle-double-right"></i>'
	);

	$pagination = '<nav class="pagination">' . paginate_links( $args ) . '</nav>';

	echo $pagination;
}

/**
 * Display breadcrumbs
 *
 * @return html or empty string
 */
function _m_breadcrumbs() {
	$html = '';
	global $post;

	$parents = get_post_ancestors( $post->ID );

	if ( $parents ) {
		$html = "<ul class='breadcrumbs'>";
		$html .= "<li><a href='" . get_bloginfo( 'wpurl' ) . "'>Home</a></li>";
		$breadcrumbs = array_reverse( $parents );
		foreach ( $breadcrumbs as $item ) {
			$html .= "<li>";
				$html .= "<a href='" . get_permalink( $item ) . "'>" . get_the_title( $item ) . "</a>";
			$html .= "</li>";
		}
		$html .= "<li>" . get_the_title( $post->ID ) . "</li>";
		$html .= "</ul>";
	}

	echo $html;
}

/**
 * Display sub page menu
 *
 * @return html or empty string
 */
function _m_page_menu() {
	$html = '';
	global $post;

	$parent = ( $post->post_parent !== 0 ) ? $post->post_parent : $post->ID;

	$args = array(
		'child_of'     => $parent,
		'exclude'      => $parent,
		'sort_column'  => 'menu_order',
		'post_type'    => 'page',
	    'post_status'  => 'publish'
	);
	$pages = get_pages( $args );

	if ( $pages ) {
		$html = "<ul class='side-menu'>";
		foreach( $pages as $page ) : setup_postdata( $post );
			$html .= "<li><h4><a href='" . get_permalink() . "'>" . get_the_title() . "</a></h4></li>";
		endforeach; wp_reset_postdata();
		$html .= '</ul>';
	}

	echo $html;
}

/**
 * Display latest posts
 *
 * @return html or empty string
 */
function _m_posts_menu() {
	$html = '';

	$args = array(
		'posts_per_page'   => 10,
		'orderby'          => 'post_date',
		'order'            => 'DESC',
		'post_type'        => 'post',
		'post_status'      => 'publish'
	);
	$posts = get_posts( $args );

	if ( $posts ) {
		$html = "<ul class='side-menu'>";
		foreach ( $posts as $post ) : setup_postdata( $post );
			$html .= "<li><h4><a href='" . get_permalink() . "'>" . get_the_title() . "</a></h4></li>";
		endforeach; wp_reset_postdata();
		$html .= "</ul>";
	}

	echo $html;
}

/**
 * Get custom attachment image by url
 *
 * @return html or empty string
 */
function _m_get_attachment_image( $attachment_url ) {
	$html = '';
	global $wpdb;

	if ( $attachment_url === '' )
		return;

	$upload_dir_paths = wp_upload_dir();

	if ( strpos( $attachment_url, $upload_dir_paths['baseurl'] ) !== false ) {

		$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );
		$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );

		if ( $attachment_id )
			$html = wp_get_attachment_image( $attachment_id, 'slider', 'false', array( 'class' => 'slide-image' ) );

	}

	echo $html;
}

/**
 * Get and check user role
 *
 * @return boolean
 */
function _m_is_user( $role ) {
	$user = wp_get_current_user();
	return ( in_array( $role, $user->roles ) );
}
