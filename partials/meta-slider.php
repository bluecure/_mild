<?php
/**
 * The partial for displaying the main slider
 *
 * @package Mild
 */

// Get slides
$slides = get_post_meta( $post->ID, 'pm_slider', true ); ?>

<?php if ( ! empty( $slides ) ) : ?>
	<div class="meta-slider">
		<?php foreach ( $slides as $slide ) : ?>
			<div class="slide">
				<img src="<?php echo $slide['image']; ?>" class="slide-image" alt="<?php echo $slide['title']; ?>" />
				<div class="slide-content">
					<?php if ( $slide['title'] ) : ?>
						<h3 class="slide-title"><?php echo $slide['title']; ?></h3>
					<?php endif; ?>
					<?php if ( $slide['description'] ) : ?>
					    <p class="slide-description"><?php echo $slide['description']; ?></p>
					<?php endif; ?>
					<?php if ( $slide['link'] ) : ?>
						<a href="<?php echo $slide['link']; ?>" class="slide-more">Read more</a>
					<?php endif; ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
<?php endif; ?>