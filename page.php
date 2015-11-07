<?php
/**
 * The template for displaying all pages.
 *
 * @package Bow
 */

get_header(); ?>

	<section class="site-primary content-area col-12">
		<main class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'partials/content', 'page' ); ?>

				<?php
					// Load up the comment template
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				?>

			<?php endwhile; ?><!-- have_posts() -->

		</main><!-- .site-main -->
	</section><!-- .site-primary -->

	<?php get_template_part( 'partials/section', 'bottom' ); ?>

<?php get_footer(); ?>