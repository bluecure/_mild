<?php
/**
* Align View
*
*/
require 'inc/header.php'; ?>

<form class="shortcode" data-code="align" data-wrap="yes" action="#">
	<div class="row">
        <div class="half">
            <label for="align">Align to: </label>
            <div class="field">
                <select name="align" id="align" class="input">
                    <option value="">None</option>
                    <option value="left">Left</option>
                    <option value="right">Right</option>
                    <option value="center">Center</option>
                </select>
            </div>
        </div>
		<div class="half">
		    <label for="width">Width: </label>
			<div class="field">
                <select name="width" id="width" class="input">
                    <?php include 'inc/list-grid.php'; ?>
				</select>
			</div>
		</div>
    </div>
	<div class="row center">
		<button type="submit" class="submit">Insert Alignment</button>
	</div>
</form>