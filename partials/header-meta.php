<?php
/**
 * The partial for display within the head section
 *
 * @package Mild
 */

// Get Options
$favicon = ot_get_option( 'ot_favicon', '' );
$app_icon = ot_get_option( 'ot_app_icon', '' );
$css = ot_get_option( 'ot_css', '' );
$analytics = ot_get_option( 'ot_analytics', '' ); ?>

<!-- Favicon -->
<?php if ( $favicon ) : ?>
	<link rel="shortcut icon" href="<?php echo $favicon; ?>" type="image/x-icon" />
<?php endif; ?>

<!-- App Icons -->
<?php if ( $app_icon ) : ?>
	<link rel="apple-touch-icon" href="<?php echo $app_icon; ?>" />
	<meta name="msapplication-TileImage" content="<?php echo $app_icon; ?>"/>
<?php endif; ?>

<?php
// Header extras
if ( $css ) echo "<style>{$css}</style>";
if ( $analytics ) echo "<script>{$analytics}</script>";
