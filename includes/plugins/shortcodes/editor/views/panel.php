<?php
/**
* Panel View
*
*/
require 'inc/header.php'; ?>

<form class="shortcode" data-code="panel" data-wrap="yes" action="#">
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
	<div class="row center">
		<button type="submit" class="submit"><?php _e( 'Insert Panel', 'mild') ?></button>
	</div>
</form>