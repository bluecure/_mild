<?php
/**
 * The template for displaying four columns.
 *
 * Template Name: 4 Columns
 *
 * @package Mild
 */

get_header(); ?>

	<section id="primary" class="site-primary content-area col-12">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'partials/content', 'page' ); ?>

			<?php endwhile; // end of the loop. ?>
			
			<div class="row four-cols">
			    <div class="col-3 md-6">
			        <?php echo do_shortcode( get_post_meta( $post->ID, 'four_cols_one', true ) ); ?>
			    </div>
			    <div class="col-3 md-6">
			        <?php echo do_shortcode( get_post_meta( $post->ID, 'four_cols_two', true ) ); ?>
			    </div>
			    <div class="col-3 md-6">
			        <?php echo do_shortcode( get_post_meta( $post->ID, 'four_cols_three', true ) ); ?>
			    </div>
			    <div class="col-3 md-6">
			        <?php echo do_shortcode( get_post_meta( $post->ID, 'four_cols_four', true ) ); ?>
			    </div>
			</div><!-- .four-cols -->
			
            <?php
                // If comments are open or we have at least one comment, load up the comment template
                if ( comments_open() || get_comments_number() != '0' ) comments_template();
            ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_footer(); ?>