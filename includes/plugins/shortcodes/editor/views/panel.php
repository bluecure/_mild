<?php
/**
* Panel View
*
*/
require( 'inc/header.php' );
?>

<form class="shortcode" data-code="panel" data-wrap="yes" action="#">
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
	<div class="row center">
		<button type="submit" class="submit">Insert Panel</button>
	</div>
</form>