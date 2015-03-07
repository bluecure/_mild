<?php
/**
 * Template tags for this theme.
 *
 * site_title()  | Display site title
 * breadcrumbs() | Displays breadcrumbs
 * page_menu()   | Displays page menu
 * post_menu()   | Displays post menu
 * posted_on()   | Displays posted on
 * entry_meta()  | Displays entry meta data
 *
 * @package Mild
 */

namespace Mild;

/**
 * Gets the site title or image.
 *
 * @return null
 */
function site_title() { 

	$logo = theme_option( 'general', 'logo' );  ?>

	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
	    <?php if ( $logo ) : ?>
	        <img src="<?php echo $logo; ?>" alt="<?php bloginfo( 'name' ); ?>" class="site-logo">
	    <?php else: ?>
	        <h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
	    <?php endif; ?>
    </a>

    <?php

}

/**
 * Display the breadcrumbs.
 *
 * @return null
 */
function breadcrumbs() {

	global $post;

	$parents = get_post_ancestors( $post->ID ); ?>

	<ul class="breadcrumbs" role="navigation">
        <li class="breadcrumb"><a href="<?php echo site_url(); ?>"><?php _e( 'Home', 'mild'); ?></a></li>
            <?php if ( $parents ) :
                $breadcrumbs = array_reverse( $parents );
                foreach ( $breadcrumbs as $item ) : ?>
                    <li class="breadcrumb">
                        <a href="<?php echo get_permalink( $item ); ?>"><?php echo get_the_title( $item ); ?></a>
                    </li>
            <?php endforeach; endif; ?>
	    <li class="breadcrumb">
	        <?php echo get_the_title( $post->ID ); ?>
	    </li>
   </ul><!-- .breadcrumbs -->

    <?php

}

/**
 * Display a sub page menu.
 *
 * @return null
 */
function page_menu() {

	global $post;
	$parent = ( $post->post_parent !== 0 ) ? $post->post_parent : $post->ID;

	$args = [
		'child_of'    => $parent,
		'exclude'     => $parent,
		'sort_column' => 'menu_order',
		'post_type'   => 'page',
		'post_status' => 'publish',
		'title_li'    => ''
	]; ?>

	<ul class="side-menu" role="navigation">
        <?php wp_list_pages( $args ); ?>
	</ul>

    <?php

}

/**
 * Displays the latest posts.
 *
 * @return null
 */
function post_menu() {

    global $post;
	$args = [
		'posts_per_page' => 10,
		'orderby'        => 'post_date',
		'order'          => 'DESC',
		'post_type'      => 'post',
		'post_status'    => 'publish'
	];
	$posts = get_posts( $args );

	if ( $posts ) : ?>

		<ul class="side-menu" role="navigation">
		    <?php foreach ( $posts as $post ) : setup_postdata( $post ); ?>
				<li class="post_item"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
			<?php endforeach; wp_reset_postdata(); ?>
		</ul>

	<?php endif;

}

/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @return null
 */
function posted_on() {

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) )
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time> - <time class="updated" datetime="%3$s">%4$s</time>';

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		_x( 'Posted on %s', 'post date', 'mild' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		_x( 'by %s', 'post author', 'mild' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	); ?>

	<span class="posted-on"><?php echo $posted_on; ?></span><span class="byline"><?php echo $byline; ?></span>

    <?php

}

/**
 * Output relevant entry meta data.
 *
 * @return null
 */
function entry_meta() {

    // Show post categories and tags
	if ( get_post_type() === 'post' ) {
		$categories_list = get_the_category_list( __( ', ', 'mild' ) );
		if ( $categories_list ) {
            printf( '<span class="cat-links">' . __( 'Posted in %1$s', 'mild' ) . '</span>', $categories_list );
		}
		$tags_list = get_the_tag_list( '', __( ', ', 'mild' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . __( 'Tagged %1$s', 'mild' ) . '</span>', $tags_list );
		}
	}
    // Show comments link
	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) { ?>
	    <span class="comments-link">
		    <?php comments_popup_link( __( 'Leave a comment', 'mild' ), __( '1 Comment', 'mild' ), __( '% Comments', 'mild' ) ); ?>
		</span>
	<?php }

	edit_post_link( __( 'Edit', 'mild' ), '<span class="edit-link">', '</span>' );

}
