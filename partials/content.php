<?php
/**
 * The generic content partial.
 *
 * @package Bow
 */

use Lambry\Bow\Theme\Template; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('article-excerpt'); ?>>

    <header class="entry-header">
        <h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
        <?php if (get_post_type() === 'post') : ?>
            <div class="entry-meta">
                <?php Template::posted_on(); ?>
            </div><!-- .entry-meta -->
        <?php endif; ?>
    </header><!-- .entry-header -->

    <?php if (is_search() || ! get_theme_mod('archive_full', false)) : // Display excerpts ?>
        <div class="entry-summary">
            <?php the_post_thumbnail('thumbnail', [ 'class' => 'alignleft' ]); ?>
            <?php the_excerpt(); ?>
        </div><!-- .entry-summary -->
    <?php else : ?>
        <div class="entry-content">
            <?php
                the_content(sprintf(
                    __('Continue reading %s <span class="meta-nav">&rarr;</span>', 'bow'),
                    the_title('<span class="screen-reader-text">"', '"</span>', false)
                ));
            ?>
            <?php
                wp_link_pages([
                    'before' => '<div class="page-links">' . __('Pages:', 'bow'),
                    'after'  => '</div>'
                ]);
            ?>
        </div><!-- .entry-content -->
    <?php endif; ?>

    <footer class="entry-footer">
        <?php Template::entry_meta(); ?>
    </footer><!-- .entry-footer -->

</article><!-- #post-## -->
