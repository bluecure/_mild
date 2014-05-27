<?php
/**
 * The template for displaying Archive pages.
 *
 * @package Mild
 */

get_header(); ?>

	<section id="primary" class="site-primary with-secondary content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php
						if ( is_category() ) :
							single_cat_title();

						elseif ( is_tag() ) :
							single_tag_title();

						elseif ( is_author() ) :
							printf( 'Author: %s', '<span class="vcard">' . get_the_author() . '</span>' );

						elseif ( is_day() ) :
							printf( 'Day: %s', '<span>' . get_the_date() . '</span>' );

						elseif ( is_month() ) :
							printf( 'Month: %s', '<span>' . get_the_date( 'F Y', 'monthly archives date format' ) . '</span>' );

						elseif ( is_year() ) :
							printf( 'Year: %s', 'mild', '<span>' . get_the_date( 'Y', 'yearly archives date format' ) . '</span>' );

						elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
							echo 'Asides';

						elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
							echo 'Galleries';

						elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
							echo 'Images';

						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
							echo 'Videos';

						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
							echo 'Quotes';

						elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
							echo 'Links';

						elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
							echo 'Statuses';

						elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
							echo 'Audios';

						elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
							echo 'Chats';

						else :
							echo 'Archives';

						endif;
					?>
				</h1>
				<?php
					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) :
						printf( '<div class="taxonomy-description">%s</div>', $term_description );
					endif;
				?>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'partials/content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php Mild\paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'partials/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

    <?php get_sidebar(); ?>
    
<?php get_footer(); ?>