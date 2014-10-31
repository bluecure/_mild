<?php
/**
 * The partial used for displaying page content.
 *
 * @package Mild
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( [
				'before' => '<div class="page-links">' . __( 'Pages:', 'mild' ),
				'after'  => '</div>'
			] );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php Mild\entry_meta(); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->