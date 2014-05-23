<?php
/**
 * Widget output template.
 */

// Get Images and create galley preview
$gallery = '';
if( $gw_images && $gw_images !== 0 ) {
    $imageIDs = explode( ',', $gw_images );
    foreach ( $imageIDs as $imageID ) {
    	$gallery .= wp_get_attachment_link( $imageID, 'thumbnail' );
    }
} ?>

<?php if ( ! empty( $title ) ) {
	echo $before_title . apply_filters( 'widget_title', $title ) . $after_title;
} ?>

<?php if ( ! empty( $gallery ) ) { ?>
	<div class="gallery-widget-images"><?php echo $gallery; ?></div>
<?php } ?>

<?php if ( ! empty( $gw_description ) ) { ?>
	<div class="gallery-widget-description"><?php echo $gw_description; ?></div>
<?php } ?>

<?php if ( ! empty( $gw_link ) ) { ?>
	<a href="<?php echo $gw_link; ?>" class="gallery-widget-link"> - View More - </a>
<?php } ?>
