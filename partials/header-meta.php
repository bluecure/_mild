<?php
/**
 * The partial for display within the head section
 *
 * @package Mild
 */

// Get Options
$icon = ot_get_option( 'ot_icon', '' );
$css = ot_get_option( 'ot_css', '' );
$javascript = ot_get_option( 'ot_javascript', '' ); ?>

<!-- Icons -->
<?php if ( $icon ) : ?>
	<link rel="shortcut icon" href="<?php echo $icon; ?>">
	<link rel="apple-touch-icon" href="<?php echo $icon; ?>">
	<meta name="msapplication-TileImage" content="<?php echo $icon; ?>">
<?php endif; ?>

<!-- Custom CSS/JS -->
<?php
if ( $css ) echo "<style>{$css}</style>";
if ( $javascript ) echo "<script>{$javascript}</script>";
