<?php
/**
 * The partial for displaying the various social links.
 *
 * @package Bow
 */

// Get theme mods
$facebook = get_theme_mod( 'facebook' );
$twitter = get_theme_mod( 'twitter' );
$google_plus = get_theme_mod( 'google_plus' );
$linkedin = get_theme_mod( 'linkedin' );
$flickr = get_theme_mod( 'flickr' );
$instagram = get_theme_mod( 'instagram' );
$youtube = get_theme_mod( 'youtube' );
$vimeo = get_theme_mod( 'vimeo' ); ?>

<div class="social-links">
	<?php if ( $facebook ) : ?>
		<a href="<?php echo $facebook; ?>" class="fa fa-facebook" target="_blank"></a>
	<?php endif;
	if ( $twitter ) : ?>
		<a href="<?php echo $twitter; ?>" class="fa fa-twitter" target="_blank"></a>
	<?php endif;
	if ( $google_plus ) : ?>
		<a href="<?php echo $google_plus; ?>" class="fa fa-google-plus" target="_blank"></a>
	<?php endif;
	if ( $linkedin ) : ?>
		<a href="<?php echo $linkedin; ?>" class="fa fa-linkedin" target="_blank"></a>
	<?php endif;
	if ( $flickr ) : ?>
		<a href="<?php echo $flickr; ?>" class="fa fa-flickr" target="_blank"></a>
	<?php endif;
	if ( $instagram ) : ?>
		<a href="<?php echo $instagram; ?>" class="fa fa-instagram" target="_blank"></a>
	<?php endif;
	if ( $youtube ) : ?>
		<a href="<?php echo $youtube; ?>" class="fa fa-youtube" target="_blank"></a>
	<?php endif;
	if ( $vimeo ) : ?>
		<a href="<?php echo $vimeo; ?>" class="fa fa-vimeo-square" target="_blank"></a>
	<?php endif; ?>
</div><!-- .social-links -->
