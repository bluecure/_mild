<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Mild
 */
?>
<div id="secondary" class="site-secondary widget-area col-4" role="complementary">
    <?php if ( ! dynamic_sidebar( 'Sidebar' ) ) : ?>

        <aside id="search" class="widget widget_search">
            <?php get_search_form(); ?>
        </aside>

        <aside id="archives" class="widget">
            <h1 class="widget-title">Archives</h1>
            <ul>
                <?php wp_get_archives( [ 'type' => 'monthly' ] ); ?>
            </ul>
        </aside>

        <aside id="meta" class="widget">
            <h1 class="widget-title">Meta</h1>
            <ul>
                <?php wp_register(); ?>
                <li><?php wp_loginout(); ?></li>
                <?php wp_meta(); ?>
            </ul>
        </aside>

    <?php endif; // end sidebar widget area ?>
</div><!-- #secondary -->