<?php
/**
* Accordion View
*
*/
require( 'inc/header.php' );
?>

<form class="shortcode" data-code="accordion" data-wrap="yes" action="#">
	<h2>Accordion Shortcode</h2>
	<div class="row">
		<label for="title">Title: </label>
		<div class="field">
			<input type="text" name="title" id="title" class="input">
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
		<button type="submit" class="submit">Insert Accordion</button>
	</div>
</form>