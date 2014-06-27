<?php
/**
 * The template for displaying two columns.
 *
 * Template Name: 2 Columns
 *
 * @package Mild
 */

get_header(); ?>

	<section id="primary" class="site-primary content-area col-12">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'partials/content', 'page' ); ?>

			<?php endwhile; // end of the loop. ?>
			
			<div class="row two-cols">
			    <div class="col-6">
			        <?php echo do_shortcode( get_post_meta( $post->ID, 'two_cols_one', true ) ); ?>
			    </div>
			    <div class="col-6">
			        <?php echo do_shortcode( get_post_meta( $post->ID, 'two_cols_two', true ) ); ?>
			    </div>
			</div><!-- .two-cols -->
			
            <?php
                // If comments are open or we have at least one comment, load up the comment template
                if ( comments_open() || get_comments_number() != '0' ) comments_template();
            ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_footer(); ?>