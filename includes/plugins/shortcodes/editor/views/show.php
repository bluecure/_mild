<?php
/**
* Show View
*
*/
require 'inc/header.php'; ?>

<form class="shortcode" data-code="show" data-wrap="no" action="#">
	<div class="row">
		<div class="half">
			<label for="cat">Categories: </label>
			<div class="field">
				<input type="text" name="cat" id="cat" class="input" placeholder="i.e. news,other">
			</div>
		</div>
		<div class="half">
			<label for="tag">Tags: </label>
			<div class="field">
				<input type="text" name="tag" id="tag" class="input" placeholder="i.e. featured">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="half">
			<label for="no">Number: </label>
			<div class="field">
				<input type="text" name="no" id="no" class="input" placeholder="5">
			</div>
		</div>
		<div class="half">
			<label for="type">Type: </label>
			<div class="field">
				<input type="text" name="type" id="type" class="input" placeholder="post">
			</div>
		</div>
	</div>

	<div class="row">
		<div class="half">
			<label for="date">Date: </label>
			<div class="field">
				Yes <input type="radio" name="date" value="true" id="date-on" class="radio">
				No <input type="radio" name="date" value="false" id="date-off" class="radio">
			</div>
		</div>
		<div class="half">
			<label for="image">Image: </label>
			<div class="field">
				Yes <input type="radio" name="image" value="true" id="image-on" class="radio">
				No <input type="radio" name="image" value="false" id="image-off" class="radio">
			</div>
		</div>
	</div>
	<div class="row center">
		<button type="submit" class="submit">Insert Posts</button>
	</div>
</form>