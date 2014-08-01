<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Mild
 */
 
$copyright = ot_get_option( 'ot_copyright', '' ); ?>

	</div><!-- .site-content -->

	<footer class="site-footer row" role="contentinfo">
		<div class="site-info col-12">
			<?php echo ( $copyright ? $copyright : '&copy; ' . date( 'Y' ) . ' ' . get_bloginfo( 'name' ) ); ?>
			<a href="#" class="to-top"><i class="fa fa-angle-up"></i> To Top</a>
		</div><!-- .site-info -->
	</footer><!-- site-footer -->
	
</div><!-- .site -->

<?php wp_footer(); ?>

</body>
</html>