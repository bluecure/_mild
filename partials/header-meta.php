<?php
/**
 * The partial for display within the head section
 *
 * @package Mild
 */

// Get Icon
$icon = Mild\the_option( 'theme-options', 'general', 'icon' ); ?>

<!-- Icons -->
<?php if ( $icon ) : ?>
	<link rel="icon" href="<?php echo $icon; ?>">
	<link rel="apple-touch-icon" href="<?php echo $icon; ?>">
	<meta name="msapplication-TileImage" content="<?php echo $icon; ?>">
<?php endif; ?>
