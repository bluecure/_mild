<?php
/**
 * The partial for displaying the various social links
 *
 * @package _m
 */

// Get social links
$facebook = ot_get_option( 'ot_facebook', '' );
$twitter = ot_get_option( 'ot_twitter', '' );
$google_plus = ot_get_option( 'ot_google_plus', '' );
$linkedin = ot_get_option( 'ot_linkedin', '' );
$pinterest = ot_get_option( 'ot_pinterest', '' );
$flickr = ot_get_option( 'ot_flickr', '' );
$instagram = ot_get_option( 'ot_instagram', '' );
$youtube = ot_get_option( 'ot_youtube', '' );
$vimeo = ot_get_option( 'ot_vimeo', '' );
?>
<div class="social-links">
	<?php
        if ( $facebook ) echo "<a href='{$facebook}' class='fa fa-facebook' target='_blank'></a>";
		if ( $twitter ) echo "<a href='{$twitter}' class='fa fa-twitter' target='_blank'></a>";
		if ( $google_plus ) echo "<a href='{$google_plus}' class='fa fa-google-plus' target='_blank'></a>";
		if ( $linkedin ) echo "<a href='{$linkedin}' class='fa fa-linkedin' target='_blank'></a>";
		if ( $pinterest ) echo "<a href='{$pinterest}' class='fa fa-pinterest' target='_blank'></a>";
		if ( $flickr ) echo "<a href='{$flickr}' class='fa fa-flickr' target='_blank'></a>";
		if ( $instagram ) echo "<a href='{$instagram}' class='fa fa-instagram' target='_blank'></a>";
		if ( $youtube ) echo "<a href='{$youtube}' class='fa fa-youtube' target='_blank'></a>";
		if ( $vimeo ) echo "<a href='{$vimeo}' class='fa fa-vimeo' target='_blank'></a>";
	?>
</div>
