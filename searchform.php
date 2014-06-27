<?php
/**
 * The template for displaying search forms in mild
 *
 * @package Mild
 */
?>
<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
	<label>
		<span class="screen-reader-text">Search for</span>
		<input type="search" class="search-field" placeholder="Search&hellip;" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
	</label>
	<button type="submit" class="search-submit">Search</button>
</form>