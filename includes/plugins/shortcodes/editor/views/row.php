<?php
/**
* Row View
*
*/
require( 'inc/header.php' );
?>

<form class="shortcode" data-code="row" data-wrap="no" action="#">
	<div id="row-1" class="row">
		<div id="column-1" class="half">
			<label for="col-1">Column 1: </label>
			<div class="field">
				<select name="col[]" id="col-1" class="input">
					<option value="1-2">One Half</option>
					<option value="1-3">One Third</option>
					<option value="2-3">Two Thirds</option>
					<option value="1-4">One Fourth</option>
					<option value="3-4">Three Fourths</option>
					<option value="1-5">One Fifth</option>
					<option value="2-5">Two Fifths</option>
					<option value="3-5">Three Fifths</option>
					<option value="4-5">Four Fifths</option>
				</select>
			</div>
		</div>
		<div id="column-2" class="half">
			<label for="col-2">Column 2: </label>
			<div class="field">
				<select name="col[]" id="col-2" class="input">
					<option value="1-2">One Half</option>
					<option value="1-3">One Third</option>
					<option value="2-3">Two Thirds</option>
					<option value="1-4">One Fourth</option>
					<option value="3-4">Three Fourths</option>
					<option value="1-5">One Fifth</option>
					<option value="2-5">Two Fifths</option>
					<option value="3-5">Three Fifths</option>
					<option value="4-5">Four Fifths</option>
				</select>
			</div>
		</div>
	</div>
	<div id="row-2" class="row"></div>
	<div id="row-3" class="row"></div>
	<div class="row">
		<span class="add-column">Add Column +</span>
		<small>Total Columns must equal One Whole.</small>
	</div>
	<div class="row center">
		<button type="submit" class="submit">Insert Row with Columns</button>
	</div>
</form>