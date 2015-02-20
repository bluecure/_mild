<?php
/**
 * The partial for displaying the various social links.
 *
 * @package Mild
 */
$social = Mild\theme_section( 'social' ); ?>

<div class="social-links">
	<?php
        if ( ! empty( $social['facebook'] ) ) echo "<a href='{$social['facebook']}' class='fa fa-facebook' target='_blank'></a>";
		if ( ! empty( $social['twitter'] ) ) echo "<a href='{$social['twitter']}' class='fa fa-twitter' target='_blank'></a>";
		if ( ! empty( $social['google-plus'] ) ) echo "<a href='{$social['google-plus']}' class='fa fa-google-plus' target='_blank'></a>";
		if ( ! empty( $social['linkedin'] ) ) echo "<a href='{$social['linkedin']}' class='fa fa-linkedin' target='_blank'></a>";
		if ( ! empty( $social['flickr'] ) ) echo "<a href='{$social['flickr']}' class='fa fa-flickr' target='_blank'></a>";
		if ( ! empty( $social['instagram'] ) ) echo "<a href='{$social['instagram']}' class='fa fa-instagram' target='_blank'></a>";
		if ( ! empty( $social['youtube'] ) ) echo "<a href='{$social['youtube']}' class='fa fa-youtube' target='_blank'></a>";
		if ( ! empty( $social['vimeo'] ) ) echo "<a href='{$social['vimeo']}' class='fa fa-vimeo-square' target='_blank'></a>";
	?>
</div>