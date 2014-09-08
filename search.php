<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Mild
 */

get_header(); ?>

	<section class="site-primary content-area col-8">
		<main class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'mild' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'partials/content', 'search' ); ?>

			<?php endwhile; ?><!-- have_posts() -->

			<?php Mild\pagination(); ?>

		<?php else : ?>

			<?php get_template_part( 'partials/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- .site-main -->
	</section><!-- .site-primary -->

    <?php get_sidebar(); ?>
    
<?php get_footer(); ?>