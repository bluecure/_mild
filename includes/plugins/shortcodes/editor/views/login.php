<?php
/**
* Login View
*
*/
require 'inc/header.php'; ?>

<form class="shortcode" data-code="login" data-wrap="no" action="#">
	<div class="row">
		<div class="half">
			<label for="url"><?php _e( 'Redirect to:', 'mild') ?> </label>
			<div class="field">
				<input type="text" name="redirect" id="redirect" class="input" placeholder="http://mysite.com/">
			</div>
		</div>
		<div class="half">
			<label for="url"><?php _e( 'Width:', 'mild') ?>Style: </label>
			<div class="field">
				<select name="style" id="style" class="input">
					<option value="block"><?php _e( 'Block', 'mild') ?></option>
					<option value="inline"><?php _e( 'Inline', 'mild') ?></option>
				</select>
			</div>
		</div>
	</div>
	<div class="row center">
		<button type="submit" class="submit"><?php _e( 'Insert Login Form', 'mild') ?></button>
	</div>
</form>