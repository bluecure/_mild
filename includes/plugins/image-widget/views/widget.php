<?php
/**
 * Widget output template.
 */

// Get Image
$image_src = wp_get_attachment_image_src( $iw_image, 'thumbnail' )[0];
?>

<?php if ( ! empty( $iw_link ) ) { ?>
	<a href="<?php echo $iw_link; ?>">
<?php } ?>

<?php if ( ! empty( $title ) ) {
	echo $before_title . apply_filters( 'widget_title', $title ) . $after_title;
} ?>

<?php if ( ! empty( $image_src ) ) { ?>
	<img class="image-widget-image" src="<?php echo $image_src; ?>" />
<?php } ?>

<?php if ( ! empty( $iw_description ) ) { ?>
	<div class="image-widget-description"><?php echo $iw_description; ?></div>
<?php } ?>

<?php if ( ! empty( $iw_link ) ) { ?>
	</a>
<?php } ?>
