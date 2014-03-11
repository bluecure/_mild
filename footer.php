<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Mild
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<?php do_action( 'mild_credits' ); ?>
			&copy; <?php echo date( 'Y' ) ?> <?php bloginfo( 'name' ); ?>
			<a href="#" class="to-top"><i class="fa fa-angle-up"></i> To Top</a>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>