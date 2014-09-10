<?php
/**
* Accordion View
*
*/
require 'inc/header.php'; ?>

<form class="shortcode" data-code="accordion" data-wrap="yes" action="#">
	<div class="row">
		<label for="title"><?php _e( 'Title:', 'mild') ?> </label>
		<div class="field">
			<input type="text" name="title" id="title" class="input">
		</div>
	</div>
	<div class="row">
		<div class="half">
			<?php include 'inc/list-icons.php'; ?>
		</div>
		<div class="half">
			<?php include 'inc/icon-ref.php'; ?>
		</div>
	</div>
	<div class="row center">
		<button type="submit" class="submit"><?php _e( 'Insert Accordion', 'mild') ?></button>
	</div>
</form>