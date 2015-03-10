<?php
/**
 * The partial for display within the head section.
 *
 * @package Mild
 */

// Get General Settings
$general = Mild\theme_section( 'general' );

/* App Icon */
if ( isset( $general['appicon'] ) ) : ?>
	<link rel="icon" sizes="192x192" href="<?php echo $general['appicon']; ?>">
	<link rel="apple-touch-icon" href="<?php echo $general['appicon']; ?>">
	<meta name="msapplication-TileImage" content="<?php echo $general['appicon']; ?>">
<?php endif;

/* Favicon */
if ( isset( $general['favicon'] ) ) : ?>
	<link rel="shortcut icon" href="<?php echo $general['favicon']; ?>">
<?php endif;

/* CSS */
if ( isset( $general['css'] ) ) : ?>
	<style><?php echo $general['css']; ?></style>
<?php endif;

/* JavaScript */
if ( isset( $general['javascript'] ) ) : ?>
	<script><?php echo $general['javascript']; ?></script>
<?php endif;
