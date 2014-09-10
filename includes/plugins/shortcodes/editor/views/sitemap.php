<?php
/**
* Sitemap View
*
*/
require 'inc/header.php'; ?>

<form class="shortcode" data-code="sitemap" data-wrap="no" action="#">
	<div class="row">
		<label for="show"><?php _e( 'Show sitemap for:', 'mild') ?> </label>
		<div class="field">
			<input type="text" name="show" id="show" class="input" placeholder="menus,pages,posts">
		</div>
	</div>
	<div class="row center">
		<button type="submit" class="submit"><?php _e( 'Insert Sitemap', 'mild') ?></button>
	</div>
</form>