<?php
/**
* Login View
*
*/
require 'inc/header.php'; ?>

<form class="shortcode" data-code="login" data-wrap="no" action="#">
	<div class="row">
		<div class="half">
			<label for="url">Redirect to: </label>
			<div class="field">
				<input type="text" name="redirect" id="redirect" class="input" placeholder="http://mysite.com/">
			</div>
		</div>
		<div class="half">
			<label for="url">Style: </label>
			<div class="field">
				<select name="style" id="style" class="input">
					<option value="block">Block</option>
					<option value="block">Inline</option>
				</select>
			</div>
		</div>
	</div>
	<div class="row center">
		<button type="submit" class="submit">Insert Login Form</button>
	</div>
</form>