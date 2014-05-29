<?php
/**
 * The template for displaying a page without with login form.
 *
 * Template Name: Login Form
 *
 * @package Mild
 */

get_header(); ?>

	<div id="primary" class="site-primary with-secondary content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'partials/content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || get_comments_number() != '0' ) comments_template();
				?>

			<?php endwhile; // end of the loop. ?>
			
			<?php
				if ( ! is_user_logged_in() ) {
					wp_login_form(); 
                } else {
					echo '<a href="' . wp_logout_url() .'" title="Logout" class="button">Logout</a>';
                }
			?>
			
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>