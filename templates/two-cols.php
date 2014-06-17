<?php
/**
 * The template for displaying two columns.
 *
 * Template Name: 2 Columns
 *
 * @package Mild
 */

get_header(); ?>

	<div id="primary" class="site-primary content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'partials/content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || get_comments_number() != '0' ) comments_template();
				?>

			<?php endwhile; // end of the loop. ?>
			
			<div class="two-cols row">
			    <div class="col-6">
			        <?php echo do_shortcode( get_post_meta( $post->ID, 'two_cols_one', true ) ); ?>
			    </div>
			    <div class="col-6">
			        <?php echo do_shortcode( get_post_meta( $post->ID, 'two_cols_two', true ) ); ?>
			    </div>
			</div><!-- .two-cols -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>