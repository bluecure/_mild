<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Mild
 */
 ?>

	</div><!-- .site-content -->

	<footer class="site-footer row" role="contentinfo">
		<div class="site-info col-12">
		    <?php printf( __( '&copy; %s', '_s' ), date( 'Y' ) ); ?>
			<a href="#" class="to-top float-right"><i class="fa fa-angle-up"></i> <?php _e( 'To Top', 'mild' ); ?></a>
		</div><!-- .site-info -->
	</footer><!-- site-footer -->
	
</div><!-- .site -->

<?php wp_footer(); ?>

</body>
</html>