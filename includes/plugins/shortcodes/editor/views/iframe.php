<?php
/**
* iFrame View
*
*/
require 'inc/header.php'; ?>

<form class="shortcode" data-code="iframe" data-wrap="no" action="#">
	<div class="row">
		<label for="url">Url: </label>
		<div class="field">
			<input type="text" name="url" id="url" class="input" placeholder="http://myiframeurl.com">
		</div>
	</div>
	<div class="row">
		<div class="half">
			<label for="width">Width: </label>
			<div class="field">
				<input type="text" name="width" id="width" class="input" placeholder="400">
			</div>
		</div>
		<div class="half">
			<label for="height">Height: </label>
			<div class="field">
				<input type="text" name="height" id="height" class="input" placeholder="300">
			</div>
		</div>
	</div>
	<div class="row center">
		<button type="submit" class="submit">Insert iFrame</button>
	</div>
</form>