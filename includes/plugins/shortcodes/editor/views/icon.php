<?php
/**
* Icon View
*
*/
require 'inc/header.php'; ?>

<form class="shortcode" data-code="icon" data-wrap="no" action="#">
	<div class="row">
		<div class="half">
			<?php include 'inc/list-colors.php'; ?>
		</div>
		<div class="half">
            <?php include 'inc/list-sizes.php'; ?>
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
	<div class="row">
		<div class="half">
			<label for="link"><?php _e( 'Link:', 'mild') ?> </label>
			<div class="field">
				<input type="text" name="link" id="link" class="input">
			</div>
		</div>
		<div class="half">
            <?php include 'inc/list-target.php'; ?>
		</div>
	</div>
	<div class="row center">
		<button type="submit" class="submit"><?php _e( 'Insert Icon', 'mild') ?></button>
	</div>
</form>