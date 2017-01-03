<?php
/**
 * The partial for display within the head section.
 *
 * @package Bow
 */

// Get theme mods
$javascript = get_theme_mod( 'javascript' );

/* JavaScript */
if ( $javascript ) : ?>
	<script><?php echo $javascript; ?></script>
<?php endif;
