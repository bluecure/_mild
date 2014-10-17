<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Mild
 */

get_header(); ?>

	<section class="site-primary content-area col-8">
		<main class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'partials/content', 'single' ); ?>

			<?php Mild\post_nav(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || get_comments_number() ) 
                    comments_template();
			?>

		<?php endwhile; ?><!-- have_posts() -->

		</main><!-- .site-main -->
	</section><!-- .site-primary -->

    <?php get_sidebar(); ?>

<?php get_footer(); ?>