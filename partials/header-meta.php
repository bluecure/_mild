<?php
/**
 * The partial for display within the head section
 *
 * @package Mild
 */

// Get General Settings
$general = Mild\the_section( 'theme-options', 'general' ); ?>

<!-- Icons -->
<?php
/* Favicon */
 if ( isset( $general['favicon'] ) ) : ?>
	<link rel="shortcut icon" href="<?php echo $general['favicon']; ?>">
<?php endif;

/* App Icon */
if ( isset( $general['app-icon'] ) ) : ?>
	<link rel="icon" sizes="192x192" href="<?php echo $general['app-icon']; ?>">
	<link rel="apple-touch-icon" href="<?php echo $general['app-icon']; ?>">
	<meta name="msapplication-TileImage" content="<?php echo $general['app-icon']; ?>">
<?php endif; 

/* JavaScript */
if ( isset( $general['javascript'] ) ) {
    echo $general['javascript'];
}
