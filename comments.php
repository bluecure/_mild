<?php
/**
 * The template for displaying comments.
 *
 * @package Bow
 */

if ( post_password_required() ) return; ?>

<div id="comments" class="comments-area">

	<?php if (have_comments()) : ?>

		<h3 class="comments-title">
			<?php
				printf(
					_nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'bow' ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>'
				);
			?>
		</h3><!-- .comments-title -->

		<ol class="comment-list">
			<?php
				wp_list_comments( [
					'style' => 'ol',
					'short_ping' => true,
				] );
			?>
		</ol><!-- .comment-list -->

		<?php the_comments_navigation(); ?>

	<?php endif; ?><!-- have_comments() -->

	<?php if ( ! comments_open() && get_comments_number() != '0' && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'bow' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>

</div><!-- .comments-area -->
