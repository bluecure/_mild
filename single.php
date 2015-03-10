<?php
/**
 * The template for displaying all single posts.
 *
 * @package Mild
 */

get_header(); ?>

	<section class="site-primary content-area col-8">
		<main class="site-main" role="main">

			<?php while (have_posts()) : the_post(); ?>

				<?php get_template_part( 'partials/content', 'single' ); ?>

				<?php the_post_navigation( [
					'prev_text' => '<i class="fa fa-angle-double-left"></i> %title',
					'next_text' => '%title <i class="fa fa-angle-double-right"></i>'
				] ); ?>

				<?php
					// Load up the comment template
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				?>

			<?php endwhile; ?><!-- have_posts() -->

		</main><!-- .site-main -->
	</section><!-- .site-primary -->

	<?php get_sidebar(); ?>

<?php get_footer(); ?>