<?php
/**
 * Template tags for this theme.
 * 
 * pagination()  | Displays pagination
 * breadcrumbs() | Displays breadcrumbs
 * page_menu()   | Displays page menu
 * posts_menu()  | Displays posts menu
 * paging_nav()  | Displays paging nav
 * post_nav()    | Displays post nav
 * comments()    | Displays comments
 * posted_on()   | Displays posted on
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

	$parent = ( 0 !== $post->post_parent ) ? $post->post_parent : $post->ID;

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
 * Display navigation to next/previous set of posts when applicable.
 *
 * @return void
 */
function paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text">Posts navigation</h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( '<span class="meta-nav">&larr;</span> Older posts' ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( 'Newer posts <span class="meta-nav">&rarr;</span>' ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}

/**
 * Display navigation to next/previous post when applicable.
 *
 * @return void
 */
function post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text">Post navigation</h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">&larr;</span> %title', 'Previous post link' );
				next_post_link(     '<div class="nav-next">%link</div>',     '%title <span class="meta-nav">&rarr;</span>', 'Next post link' );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}

/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body">
			Pingback: <?php comment_author_link(); ?> <?php edit_comment_link( 'Edit', '<span class="edit-link">', '</span>' ); ?>
		</div>

	<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php if ( 0 != $args['avatar_size'] ) { echo get_avatar( $comment, $args['avatar_size'] ); } ?>
					<?php printf( '%s <span class="says">says:</span>', sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				</div><!-- .comment-author -->

				<div class="comment-metadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<time datetime="<?php comment_time( 'c' ); ?>">
							<?php printf( '%1$s at %2$s', get_comment_date(), get_comment_time() ); ?>
						</time>
					</a>
					<?php edit_comment_link( 'Edit', '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-metadata -->

				<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation">Your comment is awaiting moderation.</p>
				<?php endif; ?>
			</footer><!-- .comment-meta -->

			<div class="comment-content">
				<?php comment_text(); ?>
			</div><!-- .comment-content -->

			<?php
				comment_reply_link( array_merge( $args, [
					'add_below' => 'div-comment',
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
					'before'    => '<div class="reply">',
					'after'     => '</div>',
				] ) );
			?>
		</article><!-- .comment-body -->

	<?php
	endif;
}

/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	printf('<span class="posted-on">Posted on %1$s</span><span class="byline"> by %2$s</span>',
		sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink() ),
			$time_string
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		)
	);
}
