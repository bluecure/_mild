<?php
/**
 * The template for displaying anything.
 *
 * @package Bow
 */

get_header(); ?>

	<section class="site-primary content-area col-8">
		<main class="site-main" role="main">

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'partials/content', get_post_format() ); ?>

				<?php endwhile; ?><!-- have_posts() -->

				<?php the_posts_pagination( [
					'prev_text' => '<i class="fa fa-angle-double-left"></i>',
					'next_text' => '<i class="fa fa-angle-double-right"></i>'
				] ); ?>

			<?php else : ?>

				<?php get_template_part( 'partials/content', 'none' ); ?>

			<?php endif; ?>

		</main><!-- .site-main -->
	</section><!-- .site-primary -->

	<?php get_sidebar(); ?>

<?php get_footer(); ?>