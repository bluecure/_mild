<?php
/**
 * The template for displaying Archive pages.
 *
 * @package Mild
 */

get_header(); ?>

	<section class="site-primary content-area col-8">
		<main class="site-main" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title">
						<?php
							if ( is_category() ) :
								single_cat_title();

							elseif ( is_tag() ) :
								single_tag_title();

							elseif ( is_author() ) :
								printf( __( 'Author: %s', 'mild' ), '<span class="vcard">' . get_the_author() . '</span>' );

							elseif ( is_day() ) :
								printf( __( 'Day: %s', 'mild' ), '<span>' . get_the_date() . '</span>' );

							elseif ( is_month() ) :
								printf( __( 'Month: %s', 'mild' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'mild' ) ) . '</span>' );

							elseif ( is_year() ) :
								printf( __( 'Year: %s', 'mild' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'mild' ) ) . '</span>' );

							elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
								_e( 'Asides', 'mild' );

							elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
								_e( 'Galleries', 'mild' );

							elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
								_e( 'Images', 'mild' );

							elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
								_e( 'Videos', 'mild' );

							elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
								_e( 'Quotes', 'mild' );

							elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
								_e( 'Links', 'mild' );

							elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
								_e( 'Statuses', 'mild' );

							elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
								_e( 'Audios', 'mild' );

							elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
								_e( 'Chats', 'mild' );

							else :
								_e( 'Archives', 'mild' );

							endif;
						?>
					</h1>
					<?php
						// Show term description.
						$term_description = term_description();
						if ( ! empty( $term_description ) ) :
							printf( '<div class="taxonomy-description">%s</div>', $term_description );
						endif;
					?>
				</header><!-- .page-header -->

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