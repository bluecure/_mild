<?php
/**
* Align View
*
*/
require 'inc/header.php'; ?>

<form class="shortcode" data-code="align" data-wrap="yes" action="#">
	<div class="row">
        <div class="half">
            <label for="align"><?php _e( 'Align to:', 'mild') ?> </label>
            <div class="field">
                <select name="align" id="align" class="input">
                    <option value=""><?php _e( 'None', 'mild') ?></option>
                    <option value="left"><?php _e( 'Left', 'mild') ?></option>
                    <option value="right"><?php _e( 'Right', 'mild') ?></option>
                    <option value="center"><?php _e( 'Center', 'mild') ?></option>
                </select>
            </div>
        </div>
		<div class="half">
           <label for="width"><?php _e( 'Width:', 'mild') ?> </label>
            <div class="field">
                <select name="width" id="width" class="input">
                    <?php include 'inc/list-grid.php'; ?>
                </select>
            </div>
		</div>
    </div>
	<div class="row center">
		<button type="submit" class="submit"><?php _e( 'Insert Alignment', 'mild') ?></button>
	</div>
</form>