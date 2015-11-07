<?php
/**
 * Template tags for this theme.
 *
 * site_title()  | Display site title
 * breadcrumbs() | Displays breadcrumbs
 * posted_on()   | Displays posted on
 * entry_meta()  | Displays entry meta data
 *
 * @package Bow
 */

namespace Lambry\Bow;

/**
 * Gets the site title or image.
 *
 * @param bool $description
 * @return null
 */
function site_title( $description = false ) {

	$logo = get_theme_mod( 'logo' ); ?>

	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<?php if ( $logo ) : ?>
			<img src="<?php echo $logo; ?>" alt="<?php bloginfo( 'name' ); ?>" class="site-logo">
		<?php else: ?>
			<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
		<?php endif; ?>
	</a>

	<?php if ( $description ) : ?>
		<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
	<?php endif;

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
		<li class="breadcrumb"><a href="<?php echo site_url(); ?>"><?php _e( 'Home', 'bow' ); ?></a></li>
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
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @return null
 */
function posted_on() {

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time> - <time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf( _x( '<i class="fa fa-clock-o"></i> %s', 'post date', 'bow' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>' );

	$byline = sprintf( _x( '<i class="fa fa-user"></i> %s', 'post author', 'bow' ),
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
		$categories_list = get_the_category_list( __( ', ', 'bow' ) );
		if ( $categories_list ) {
			printf( '<span class="cat-links">' . __( '<i class="fa fa-folder-open-o"></i> %1$s', 'bow' ) . '</span>', $categories_list );
		}
		$tags_list = get_the_tag_list( '', __( ', ', 'bow' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . __( '<i class="fa fa-tags"></i> %1$s', 'bow' ) . '</span>', $tags_list );
		}
	}

	// Show comments link
	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) { ?>
		<span class="comments-link">
		    <?php comments_popup_link(
				__( '<i class="fa fa-comments"></i> Leave a comment', 'bow' ),
				__( '<i class="fa fa-comments"></i> 1 Comment', 'bow' ),
				__( '<i class="fa fa-comments"></i> % Comments', 'bow' )
			); ?>
		</span>
	<?php }

	edit_post_link( __( 'Edit', 'bow' ), '<span class="edit-link">', '</span>' );

}
