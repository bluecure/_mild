<?php
/**
* Map View
*
*/
require( 'inc/header.php' );
?>

<form class="shortcode" data-code="map" data-wrap="no" action="#">
	<h2>Map Shortcode</h2>
	<div class="row">
		<label for="url">Location: </label>
		<div class="field">
			<input type="text" name="location" id="location" class="input" placeholder="i.e. 5 Lee Street, Brunswick, Melbourne">
		</div>
	</div>
	<div class="row">
		<div class="half">
			<label for="width">Width: </label>
			<div class="field">
				<input type="text" name="width" id="width" class="input" placeholder="400px">
			</div>
		</div>
		<div class="half">
			<label for="height">Height: </label>
			<div class="field">
				<input type="text" name="height" id="height" class="input" placeholder="300px">
			</div>
		</div>
	</div>
	<div class="row center">
		<button type="submit" class="submit">Insert Map</button>
	</div>
</form>