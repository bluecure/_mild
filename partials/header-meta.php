<?php
/**
 * The partial for display within the head section.
 *
 * @package Bow
 */

// Get theme mods
$css = get_theme_mod( 'css' );
$javascript = get_theme_mod( 'javascript' );

/* CSS */
if ( $css ) : ?>
	<style><?php echo $css; ?></style>
<?php endif;

/* JavaScript */
if ( $javascript ) : ?>
	<script><?php echo $javascript; ?></script>
<?php endif;
