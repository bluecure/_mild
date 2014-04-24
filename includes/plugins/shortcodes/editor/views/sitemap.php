<?php
/**
* Sitemap View
*
*/
require( 'inc/header.php' );
?>
<form class="shortcode" data-code="sitemap" data-wrap="no" action="#">
	<div class="row">
		<label for="show">Show sitemap for: </label>
		<div class="field">
			<input type="text" name="show" id="show" class="input" placeholder="menus,pages,posts">
		</div>
	</div>
	<div class="row center">
		<button type="submit" class="submit">Insert Sitemap</button>
	</div>
</form>