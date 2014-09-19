<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 *
 * @package Mild
 */

get_header(); ?>

	<section class="site-primary content-area col-12">
		<main class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'partials/content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || get_comments_number() != '0' )
                        comments_template();
				?>

			<?php endwhile; ?><!-- have_posts() -->

		</main><!-- .site-main -->
	</section><!-- .site-primary -->
    
<?php get_footer(); ?>