<?php
/**
 * The template for displaying the footer.
 *
 * @package Bow
 */
?>

            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .site-content -->

    <footer id="colophon" class="site-footer" role="contentinfo">
        <div class="container-fluid">
            <div class="row">

                <div class="site-social col-xs-12 col-sm-6">
                    <?php get_template_part('partials/social', 'links'); ?>
                </div><!-- .site-social -->

                <div class="site-info col-xs-12 col-sm-6">
                    <?php printf(__('&copy; %d - %s', 'bow'), date('Y'), get_bloginfo('name')); ?>
                    <a href="#" class="to-top fadeOut"><i class="fa fa-angle-up"></i></a>
                </div><!-- .site-info -->

            </div><!-- .row -->
        </div><!-- .container -->
    </footer><!-- .site-footer -->


</div><!-- .site -->

<?php wp_footer(); ?>

</body>
</html>
