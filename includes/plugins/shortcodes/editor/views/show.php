<?php
/**
* Show View
*
*/
require 'inc/header.php'; ?>

<form class="shortcode" data-code="show" data-wrap="no" action="#">
	<div class="row">
		<div class="half">
			<label for="cat"><?php _e( 'Categories:', 'mild') ?> </label>
			<div class="field">
				<input type="text" name="cat" id="cat" class="input" placeholder="i.e. news,other">
			</div>
		</div>
		<div class="half">
			<label for="tag"><?php _e( 'Tags:', 'mild') ?> </label>
			<div class="field">
				<input type="text" name="tag" id="tag" class="input" placeholder="i.e. featured">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="half">
			<label for="no"><?php _e( 'Number:', 'mild') ?> </label>
			<div class="field">
				<input type="text" name="no" id="no" class="input" placeholder="5">
			</div>
		</div>
		<div class="half">
			<label for="type"><?php _e( 'Type:', 'mild') ?> </label>
			<div class="field">
				<input type="text" name="type" id="type" class="input" placeholder="post">
			</div>
		</div>
	</div>

	<div class="row">
		<div class="half">
			<label for="date"><?php _e( 'Date:', 'mild') ?> </label>
			<div class="field">
				<?php _e( 'Yes', 'mild') ?> <input type="radio" name="date" value="true" id="date-on" class="radio">
				<?php _e( 'No', 'mild') ?> <input type="radio" name="date" value="false" id="date-off" class="radio">
			</div>
		</div>
		<div class="half">
			<label for="image"><?php _e( 'Image:', 'mild') ?> </label>
			<div class="field">
				<?php _e( 'Yes', 'mild') ?> <input type="radio" name="image" value="true" id="image-on" class="radio">
				<?php _e( 'No', 'mild') ?> <input type="radio" name="image" value="false" id="image-off" class="radio">
			</div>
		</div>
	</div>
	<div class="row center">
		<button type="submit" class="submit"><?php _e( 'Insert Posts', 'mild') ?></button>
	</div>
</form>