<?php
/**
 * The template for displaying three columns.
 *
 * Template Name: 3 Columns
 *
 * @package Mild
 */

get_header(); ?>

	<div id="primary" class="site-primary content-area col-12">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'partials/content', 'page' ); ?>

			<?php endwhile; // end of the loop. ?>
			
			<div class="row three-cols">
			    <div class="col-4">
			        <?php echo do_shortcode( get_post_meta( $post->ID, 'three_cols_one', true ) ); ?>
			    </div>
			    <div class="col-4">
			        <?php echo do_shortcode( get_post_meta( $post->ID, 'three_cols_two', true ) ); ?>
			    </div>
			    <div class="col-4">
			        <?php echo do_shortcode( get_post_meta( $post->ID, 'three_cols_three', true ) ); ?>
			    </div>
			</div><!-- .three-cols -->
			
			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || get_comments_number() != '0' ) comments_template();
            ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>