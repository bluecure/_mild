<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Mild
 */
?>
<aside id="secondary" class="site-secondary widget-area col-4" role="complementary">
    <?php if ( ! dynamic_sidebar( 'Sidebar' ) ) : ?>

        <div id="search" class="widget widget_search">
            <?php get_search_form(); ?>
        </div>

        <div id="archives" class="widget">
            <h1 class="widget-title">Archives</h1>
            <ul>
                <?php wp_get_archives( [ 'type' => 'monthly' ] ); ?>
            </ul>
        </div>

        <div id="meta" class="widget">
            <h1 class="widget-title">Meta</h1>
            <ul>
                <?php wp_register(); ?>
                <li><?php wp_loginout(); ?></li>
                <?php wp_meta(); ?>
            </ul>
        </div>

    <?php endif; // end sidebar widget area ?>
</aside><!-- #secondary -->