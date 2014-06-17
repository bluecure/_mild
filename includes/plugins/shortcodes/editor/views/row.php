<?php
/**
* Row View
*
*/
require 'inc/header.php'; ?>

<form class="shortcode" data-code="row" data-wrap="no" action="#">
	<div id="row" class="row">
		<div id="column-1" class="half">
			<label for="col-1">Column 1: </label>
			<div class="field">
				<select name="col[]" id="col-1" class="input">
					<option value="1">One Twelth</option>
					<option value="2">Two Twelths</option>
					<option value="3">Three Twelths</option>
					<option value="4">Four Twelths</option>
					<option value="5">Five Twelths</option>
					<option value="6" selected>Six Twelths</option>
					<option value="7">Seven Twelths</option>
					<option value="8">Eight Twelths</option>
					<option value="9">Nine Twelths</option>
					<option value="10">Ten Twelths</option>
					<option value="11">Eleven Twelths</option>
					<option value="12">Twelve Twelths</option>
				</select>
			</div>
		</div>
		<div id="column-2" class="half">
			<label for="col-2">Column 2: </label>
			<div class="field">
				<select name="col[]" id="col-2" class="input">
                    <option value="1">One Twelth</option>
					<option value="2">Two Twelths</option>
					<option value="3">Three Twelths</option>
					<option value="4">Four Twelths</option>
					<option value="5">Five Twelths</option>
					<option value="6" selected>Six Twelths</option>
					<option value="7">Seven Twelths</option>
					<option value="8">Eight Twelths</option>
					<option value="9">Nine Twelths</option>
					<option value="10">Ten Twelths</option>
					<option value="11">Eleven Twelths</option>
					<option value="12">Twelve Twelths</option>
				</select>
			</div>
		</div>
	</div>
	<div class="row">
		<span class="add-column">Add Column +</span>
		<small>Total columns must equal twelve.</small>
	</div>
	<div class="row center">
		<button type="submit" class="submit">Insert Row with Columns</button>
	</div>
</form>