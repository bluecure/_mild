<?php
/**
 * The partial for displaying the bottom section.
 *
 * @package Bow
 */

$tiles = Lambry\Bow\get_field( 'bottom_tiles' );

if ( $tiles ) : ?>

	<section class="bottom-section tiles row">
		<?php foreach ( $tiles as $tile ) : ?>
			<div class="tile col-4 md-6">
				<?php if ( $tile['image'] ) : ?>
					<img src="<?php echo $tile['image'] ?>" class="tile-image">
				<?php endif; ?>
				<?php if ( $tile['title'] ) : ?>
					<h3 class="tile-title">
						<?php echo $tile['title'] ?>
					</h3>
				<?php endif; ?>
				<?php if ( $tile['content'] ) : ?>
					<div class="tile-content">
						<?php echo $tile['content'] ?>
					</div>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
	</section>

<?php endif;
