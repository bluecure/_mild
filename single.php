<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Mild
 */

get_header(); ?>

	<div id="primary" class="site-primary content-area col col-8-12">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'partials/content', 'single' ); ?>

			<?php Mild\post_nav(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || get_comments_number() != '0' ) comments_template();
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

    <?php get_sidebar(); ?>

<?php get_footer(); ?>