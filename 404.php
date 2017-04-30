<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Bow
 */

get_header(); ?>

    <section class="site-primary content-area col-xs-12">
        <main class="site-main" role="main">

            <div class="error-404 not-found">
                <header class="page-header">
                    <h1 class="page-title"><?php _e('Oops! That page can&rsquo;t be found.', 'bow'); ?></h1>
                </header><!-- .page-header -->

                <div class="page-content">
                    <p><?php _e('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'bow'); ?></p>

                    <?php get_search_form(); ?>

                    <?php the_widget('WP_Widget_Recent_Posts'); ?>

                    <div class="widget widget_categories">
                        <h2 class="widget-title"><?php _e('Most Used Categories', 'bow'); ?></h2>
                        <ul>
                            <?php
                                wp_list_categories([
                                    'orderby'    => 'count',
                                    'order'      => 'DESC',
                                    'show_count' => 1,
                                    'title_li'   => '',
                                    'number'     => 10,
                                ]);
                            ?>
                        </ul>
                    </div><!-- .widget -->

                    <?php
                        /* translators: %1$s: smiley */
                        $archive_content = '<p>' . sprintf(__('Try looking in the monthly archives. %1$s', 'bow'), convert_smilies(':)')) . '</p>';
                        the_widget('WP_Widget_Archives', 'dropdown=1', "after_title=</h2> $archive_content");
                    ?>

                    <?php the_widget('WP_Widget_Tag_Cloud'); ?>

                </div><!-- .page-content -->
            </div><!-- .error-404 -->

        </main><!-- .site-main -->
    </section><!-- .site-primary -->

<?php get_footer();
