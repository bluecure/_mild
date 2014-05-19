<?php
/**
 * The template for displaying three columns.
 *
 * Template Name: 3 Columns
 *
 * @package Mild
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'partials/content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || get_comments_number() != '0' ) comments_template();
				?>

			<?php endwhile; // end of the loop. ?>
			
			<div class="two-cols row">
			    <div class="col col-4-12">
			        <?php echo get_post_meta( $post->ID, 'tc_col_one', true ); ?>
			    </div>
			    <div class="col col-4-12">
			        <?php echo get_post_meta( $post->ID, 'tc_col_two', true ); ?>
			    </div>
			    <div class="col col-4-12">
			        <?php echo get_post_meta( $post->ID, 'tc_col_three', true ); ?>
			    </div>
			</div><!-- .two-cols -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>