<?php
/**
* Row View
*
*/
require( 'inc/header.php' );
?>

<form class="shortcode" data-code="row" data-wrap="no" action="#">
	<div id="row" class="row">
		<div id="column-1" class="half">
			<label for="col-1">Column 1: </label>
			<div class="field">
				<select name="col[]" id="col-1" class="input">
					<option value="1-12">One Twelth</option>
					<option value="2-12">Two Twelths</option>
					<option value="3-12">Three Twelths</option>
					<option value="4-12">Four Twelths</option>
					<option value="5-12">Five Twelths</option>
					<option value="6-12" selected>Six Twelths</option>
					<option value="7-12">Seven Twelths</option>
					<option value="8-12">Eight Twelths</option>
					<option value="9-12">Nine Twelths</option>
					<option value="10-12">Ten Twelths</option>
					<option value="11-12">Eleven Twelths</option>
					<option value="12-12">Twelve Twelths</option>
				</select>
			</div>
		</div>
		<div id="column-2" class="half">
			<label for="col-2">Column 2: </label>
			<div class="field">
				<select name="col[]" id="col-2" class="input">
                    <option value="1-12">One Twelth</option>
					<option value="2-12">Two Twelths</option>
					<option value="3-12">Three Twelths</option>
					<option value="4-12">Four Twelths</option>
					<option value="5-12">Five Twelths</option>
					<option value="6-12" selected>Six Twelths</option>
					<option value="7-12">Seven Twelths</option>
					<option value="8-12">Eight Twelths</option>
					<option value="9-12">Nine Twelths</option>
					<option value="10-12">Ten Twelths</option>
					<option value="11-12">Eleven Twelths</option>
					<option value="12-12">Twelve Twelths</option>
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