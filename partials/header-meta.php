<?php
/**
 * The partial for display within the head section
 *
 * @package Mild
 */
$assest_dir = get_bloginfo( 'template_url' ) . '/assets/images/';
?>
<link rel="shortcut icon" href="<?php echo $assest_dir; ?>favicon.ico" type="image/x-icon" />
<!-- Apple Touch Icons -->
<link rel="apple-touch-icon" href="<?php echo $assest_dir; ?>apple-touch-icon.png" />
<link rel="apple-touch-icon" sizes="57x57" href="<?php echo $assest_dir; ?>apple-touch-icon-57x57.png" />
<link rel="apple-touch-icon" sizes="57x57" href="<?php echo $assest_dir; ?>apple-touch-icon-60x60.png" />
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $assest_dir; ?>apple-touch-icon-72x72.png" />
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $assest_dir; ?>apple-touch-icon-76x76.png" />
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $assest_dir; ?>apple-touch-icon-114x114.png" />
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $assest_dir; ?>apple-touch-icon-120x120.png" />
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo $assest_dir; ?>apple-touch-icon-144x144.png" />
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo $assest_dir; ?>apple-touch-icon-152x152.png" />
<!-- Windows 8 Tile Icons -->
<meta name="msapplication-square70x70logo" content="<?php echo $assest_dir; ?>smalltile.png" />
<meta name="msapplication-square150x150logo" content="<?php echo $assest_dir; ?>mediumtile.png" />
<meta name="msapplication-square310x310logo" content="<?php echo $assest_dir; ?>largetile.png" />
<meta name="msapplication-wide310x150logo" content="<?php echo $assest_dir; ?>widetile.png" />

<?php
// Get header extras
$css = ot_get_option( 'ot_css', '' );
$analytics = ot_get_option( 'ot_analytics', '' );

if ( $css ) echo "<style>{$css}</style>";
if ( $analytics ) echo "<script>{$analytics}</script>";
