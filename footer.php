<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @package Mild
 */
 ?>

	</div><!-- .site-content -->

	<footer class="site-footer row" role="contentinfo">

		<div class="site-social col-6 md-6">
			<?php get_template_part( 'partials/social', 'links' ); ?>
		</div>
		<div class="site-info col-6 md-6">
		    <?php printf( __( '&copy; %s - %s', '_s' ), date( 'Y' ), get_bloginfo( 'name' ) ); ?> 
			<a href="#" class="to-top"><i class="fa fa-angle-up"></i> <?php _e( 'To Top', 'mild' ); ?></a>
		</div><!-- .site-info -->

	</footer><!-- .site-footer -->
	
</div><!-- .site -->

<?php wp_footer(); ?>

</body>
</html>