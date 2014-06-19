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
					<?php include 'inc/list-grid.php'; ?>
				</select>
			</div>
		</div>
		<div id="column-2" class="half">
			<label for="col-2">Column 2: </label>
			<div class="field">
				<select name="col[]" id="col-2" class="input">
                    <?php include 'inc/list-grid.php'; ?>
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