<?php
/**
* iFrame View
*
*/
require 'inc/header.php'; ?>

<form class="shortcode" data-code="iframe" data-wrap="no" action="#">
	<div class="row">
		<label for="url"><?php _e( 'Url:', 'mild') ?> </label>
		<div class="field">
			<input type="text" name="url" id="url" class="input" placeholder="http://myiframeurl.com">
		</div>
	</div>
	<div class="row">
		<div class="half">
			<label for="width"><?php _e( 'Width:', 'mild') ?> </label>
			<div class="field">
				<input type="text" name="width" id="width" class="input" placeholder="400">
			</div>
		</div>
		<div class="half">
			<label for="height"><?php _e( 'Height:', 'mild') ?> </label>
			<div class="field">
				<input type="text" name="height" id="height" class="input" placeholder="300">
			</div>
		</div>
	</div>
	<div class="row center">
		<button type="submit" class="submit"><?php _e( 'Insert iFrame', 'mild') ?></button>
	</div>
</form>