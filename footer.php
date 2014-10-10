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
		<div class="site-info col-6">
		    <?php printf( __( '&copy; %s - %s', '_s' ), date( 'Y' ), get_bloginfo( 'name' ) ); ?> 
			<a href="#" class="to-top small"><i class="fa fa-angle-up"></i> <?php _e( 'To Top', 'mild' ); ?></a>
		</div><!-- .site-info -->
		<div class="col-6 text-right">
			<?php get_template_part( 'partials/social', 'links' ); ?>
		</div>
	</footer><!-- site-footer -->
	
</div><!-- .site -->

<?php wp_footer(); ?>

</body>
</html>