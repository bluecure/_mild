<?php
/**
 * The template for displaying a page with a sidebar.
 *
 * Template Name: With Sidebar
 *
 * @package Mild
 */

get_header(); ?>

	<section id="primary" class="site-primary content-area col-8">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'partials/content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || get_comments_number() != '0' ) comments_template();
				?>

			<?php endwhile; // end of the loop. ?>
			
		</main><!-- #main -->
	</section><!-- #primary -->

    <?php get_sidebar(); ?>
    
<?php get_footer(); ?>