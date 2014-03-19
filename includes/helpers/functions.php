<?php
/**
 * Custom functions for this theme including:
 *
 * pagination()  | Displays Pagination
 * breadcrumbs() | Displays Breadcrumbs
 * page_menu()   | Displays Page Menu
 * posts_menu()  | Displays Posts Menu
 * is_user()     | Checks user role
 *
 * @package Mild
 */

namespace Mild;

/**
 * Displays pagination links
 *
 * @param string $post_type
 * @return sting $pagination
 */
function pagination( $post_type = 'post' ) {
	global $wp_query;

	$args = [
		'base'      => str_replace( 999999, '%#%', esc_url( get_pagenum_link( 999999 ) ) ),
		'format'    => '?paged=%#%',
		'current'   => max( 1, get_query_var('paged') ),
		'total'     => $wp_query->max_num_pages,
		'prev_next' => True,
		'prev_text' => '<i class="icon icon-angle-double-left"></i>',
		'next_text' => '<i class="icon icon-angle-double-right"></i>'
	];

	$pagination = '<nav class="pagination">' . paginate_links( $args ) . '</nav>';

	echo $pagination;
}

/**
 * Display breadcrumbs
 *
 * @return string
 */
function breadcrumbs() {
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
 * @return string
 */
function page_menu() {
	$html = '';
	global $post;

	$parent = ( $post->post_parent !== 0 ) ? $post->post_parent : $post->ID;

	$args = [
		'child_of'     => $parent,
		'exclude'      => $parent,
		'sort_column'  => 'menu_order',
		'post_type'    => 'page',
	    'post_status'  => 'publish'
	];
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
 * @return string
 */
function posts_menu() {
	$html = '';

	$args = [
		'posts_per_page'   => 10,
		'orderby'          => 'post_date',
		'order'            => 'DESC',
		'post_type'        => 'post',
		'post_status'      => 'publish'
	];
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
 * Get and check user role
 *
 * @return boolean
 */
function is_user( $role ) {
	$user = wp_get_current_user();
	return ( in_array( $role, $user->roles ) );
}
