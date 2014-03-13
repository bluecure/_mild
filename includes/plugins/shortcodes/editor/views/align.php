<?php
/**
* Align View
*
*/
require( 'inc/header.php' );
?>
<form class="shortcode" data-code="align" data-wrap="yes" action="#">
	<h2>Align Shortcode</h2>
	<div class="row">
		<label for="show">Align content to: </label>
		<div class="field">
			<select name="to" id="to" class="input">
				<option value="left">Left</option>
				<option value="right">Right</option>
				<option value="center">Center</option>
			</select>
		</div>
	</div>
	<div class="row center">
		<button type="submit" class="submit">Insert Alignment</button>
	</div>
</form>