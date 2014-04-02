<?php
/**
* Icon View
*
*/
require( 'inc/header.php' );
?>

<form class="shortcode" data-code="icon" data-wrap="no" action="#">
	<h2>Icon Shortcode</h2>
	<div class="row">
		<div class="half">
			<label for="color">Color: </label>
			<div class="field">
				<select name="color" id="color" class="input">
					<?php include 'inc/list-colors.php'; ?>
				</select>
			</div>
		</div>
		<div class="half">
			<label for="size">Size: </label>
			<div class="field">
				<select name="size" id="size" class="input">
					<?php include 'inc/list-sizes.php'; ?>
				</select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="half">
			<label for="icon">Icon: </label>
			<div class="field">
				<select name="icon" id="icon" class="input">
					<?php include 'inc/list-icons.php'; ?>
				</select>
			</div>
		</div>
		<div class="half">
			<label for="link">Icon Ref: </label>
			<div class="field">
				<a href="http://fontawesome.io/icons/" target="_blank">fontawesome.io</a>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="half">
			<label for="link">Link: </label>
			<div class="field">
				<input type="text" name="link" id="link" class="input">
			</div>
		</div>
		<div class="half">
		<label for="target">Target: </label>
			<div class="field">
				<select name="target" id="target" class="input">
					<option value="">Default</option>
					<option value="blank">New window</option>
				</select>
			</div>
		</div>
	</div>
	<div class="row center">
		<button type="submit" class="submit">Insert Icon</button>
	</div>
</form>