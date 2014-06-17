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
 * posted_on()   | Displays posted on
 *
 * @package Mild
 */

namespace Mild;

/**
 * Displays pagination links
 *
 * @param  string $post_type
 * @return void
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
	]; ?>

	<nav class="pagination"><?php echo paginate_links( $args ); ?></nav>
	
<?php
}

/**
 * Display breadcrumbs
 *
 * @return void
 */
function breadcrumbs() {
	global $post;

	$parents = get_post_ancestors( $post->ID ); ?>
	
	<ul class='breadcrumbs'>
        <li><a href="<?php echo site_url(); ?>">Home</a></li>

        <?php if ( $parents ) :
            $breadcrumbs = array_reverse( $parents );
            foreach ( $breadcrumbs as $item ) : ?>

                <li><a href="<?php echo get_permalink( $item ); ?>"><?php echo get_the_title( $item ); ?></a></li>

        <?php endforeach; endif; ?>
        
	    <li><?php echo get_the_title( $post->ID ); ?></li>
   </ul>

<?php
}

/**
 * Display sub page menu
 *
 * @return void
 */
function page_menu() {
	global $post;
	$parent = ( $post->post_parent !== 0 ) ? $post->post_parent : $post->ID;

	$args = [
		'child_of'     => $parent,
		'exclude'      => $parent,
		'sort_column'  => 'menu_order',
		'post_type'    => 'page',
	    'post_status'  => 'publish',
		'title_li'     => ''
	]; ?>

	<ul class='side-menu'>
        <?php wp_list_pages( $args ); ?>
	</ul>

<?php
}

/**
 * Display latest posts
 *
 * @return void
 */
function posts_menu() {
	$args = [
		'posts_per_page'   => 10,
		'orderby'          => 'post_date',
		'order'            => 'DESC',
		'post_type'        => 'post',
		'post_status'      => 'publish'
	];
	$posts = get_posts( $args );

	if ( $posts ) : ?>
		
		<ul class='side-menu'>
		    <?php foreach ( $posts as $post ) : setup_postdata( $post ); ?>
                <li class="post_item"><a href="<?php echo $post->guid; ?>"><?php echo $post->post_title; ?></a></li>
            <?php endforeach; wp_reset_postdata(); ?>
		</ul>
		
	<?php endif;
}

/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @return void
 */
function paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 )
		return;	?>
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

	if ( ! $next && ! $previous )
		return;	?>
		
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
