<?php
/**
 * The main template file.
 *
 * Used to display a page when nothing more specific matches a query.
 *
 * @package Mild
 */

get_header(); ?>

	<section class="site-primary content-area col-8">
		<main class="site-main" role="main">

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'partials/content', get_post_format() ); ?>

				<?php endwhile; ?><!-- have_posts() -->

				<?php Mild\pagination(); ?>

			<?php else : ?>

				<?php get_template_part( 'partials/content', 'none' ); ?>

			<?php endif; ?>

		</main><!-- .site-main -->
	</section><!-- .site-primary -->
    
    <?php get_sidebar(); ?>    
    
<?php get_footer(); ?>