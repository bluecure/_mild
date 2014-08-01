<?php
/**
 * The template part for displaying search content.
 *
 * @package Mild
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<?php if ( get_post_type() == 'post' ) : ?>
		<div class="entry-meta">
			<?php Mild\posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
		<?php if ( get_post_type() == 'post' ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( ', ' ) );
				if ( $categories_list && Mild\is_categorized_blog() ) :
			?>
                <span class="cat-links">
                    <?php printf( 'Posted in %1$s', $categories_list ); ?>
                </span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', ', ' );
				if ( $tags_list ) :
			?>
                <span class="tags-links">
                    <?php printf( 'Tagged %1$s', $tags_list ); ?>
                </span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() != '0' ) ) : ?>
		    <span class="comments-link">
		        <?php comments_popup_link( 'Leave a comment', '1 Comment', '% Comments' ); ?>
		      </span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', '_s' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->