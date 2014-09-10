<?php
/**
* Row View
*
*/
require 'inc/header.php'; ?>

<form class="shortcode" data-code="row" data-wrap="no" action="#">
	<div id="row" class="row">
		<div id="column-1" class="half">
			<label for="col-1"><?php _e( 'Column 1:', 'mild') ?> </label>
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
		<span class="add-column"><?php _e( 'Add Column +', 'mild') ?></span>
		<small><?php _e( 'Total columns must equal twelve.', 'mild') ?></small>
	</div>
	<div class="row center">
		<button type="submit" class="submit"><?php _e( 'Insert Row with Columns', 'mild') ?></button>
	</div>
</form>