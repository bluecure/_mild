<?php
/**
 * The partial for displaying search content.
 *
 * @package Mild
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'article-excerpt' ); ?>>

	<header class="entry-header">
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		<?php if ( get_post_type() == 'post' ) : ?>
			<div class="entry-meta">
				<?php Mild\posted_on(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_post_thumbnail( 'thumbnail', [ 'class' => 'alignleft' ] ); ?>
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
		<?php Mild\entry_meta(); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->