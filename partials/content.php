<?php
/**
 * The generic content template.
 *
 * @package Mild
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
	    <h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<?php if ( get_post_type() === 'post' ) : ?>
            <div class="entry-meta">
                <?php Mild\posted_on(); ?>
            </div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( is_search() || Mild\is_blog() ) : // Only display excerpts for Search and Blog ?>
        <div class="entry-summary">
            <?php the_post_thumbnail( 'thumbnail', ['class' => 'alignleft'] ); ?>
            <?php the_excerpt(); ?>
        </div><!-- .entry-summary -->
	<?php else : ?>
        <div class="entry-content">
            <?php the_content( 'Continue reading <span class="meta-nav">&rarr;</span>' ); ?>
            <?php
                wp_link_pages( [
                    'before' => '<div class="page-links">' . 'Pages:',
                    'after'  => '</div>',
                ] );
            ?>
        </div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-footer">
		<?php Mild\entry_meta(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
