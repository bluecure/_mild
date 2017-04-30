<?php
/**
 * Template
 *
 * Template tags for this theme.
 *
 * @package Bow
 */

namespace Lambry\Bow\Theme;

class Template {

	/**
	 * Breadcrumbs
	 *
	 * Display the breadcrumbs.
	 *
	 * @access public
	 * @return null
	 */
	public static function breadcrumbs() {

		global $post;

		$parents = get_post_ancestors( $post->ID ); ?>

		<ul class="breadcrumbs" role="navigation">
			<li class="breadcrumb"><a href="<?php echo site_url(); ?>"><?php _e( 'Home', 'bow' ); ?></a></li>
			<?php if ( $parents ) :
				$breadcrumbs = array_reverse( $parents );
				foreach ( $breadcrumbs as $item ) : ?>
					<li class="breadcrumb">
						<a href="<?php echo get_permalink( $item ); ?>"><?php echo get_the_title( $item ); ?></a>
					</li>
				<?php endforeach; endif; ?>
			<li class="breadcrumb">
				<?php echo get_the_title( $post->ID ); ?>
			</li>
		</ul><!-- .breadcrumbs -->

	<?php

	}

	/**
	 * Posted On
	 *
	 * Prints HTML with meta information for the current post-date/time and author.
	 *
	 * @access public
	 * @return null
	 */
	public static function posted_on() {

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time> - <time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf( _x( '<i class="fa fa-clock-o"></i> %s', 'post date', 'bow' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>' );

		$byline = sprintf( _x( '<i class="fa fa-user"></i> %s', 'post author', 'bow' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		); ?>

		<span class="posted-on"><?php echo $posted_on; ?></span><span class="byline"><?php echo $byline; ?></span>

	<?php

	}

	/**
	 * Entry Meta
	 *
	 * Output the relevant entry meta data.
	 *
	 * @access public
	 * @return null
	 */
	public static function entry_meta() {

		// Show post categories and tags
		if ( get_post_type() === 'post' ) {
			$categories_list = get_the_category_list( __( ', ', 'bow' ) );
			if ( $categories_list ) {
				printf( '<span class="cat-links">' . __( '<i class="fa fa-folder-open-o"></i> %1$s', 'bow' ) . '</span>', $categories_list );
			}
			$tags_list = get_the_tag_list( '', __( ', ', 'bow' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links">' . __( '<i class="fa fa-tags"></i> %1$s', 'bow' ) . '</span>', $tags_list );
			}
		}

		// Show comments link
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
			<span class="comments-link"><i class="fa fa-comments"></i>
			    <?php comments_popup_link(
					__( 'Leave a comment', 'bow' ),
					__( '1 Comment', 'bow' ),
					__( '% Comments', 'bow' )
				); ?>
			</span>
		<?php endif;

		edit_post_link( __( 'Edit', 'bow' ), '<span class="edit-link">', '</span>' );

	}

    /**
     * Customizer Styles
     *
     * Checks and displays customizer styles.
     *
     * @access public
     * @return void
     */
    public static function customizer_styles() {

        $styles = '';
        $mods = [
            'header_text'  => [ '.site-header', 'color' ],
            'content_text' => [ '.site-content', 'color' ],
            'footer_text'  => [ '.site-footer', 'color' ],
            'header_links' => [ '.site-header a', 'color' ],
            'content_links'      => [ '.site-content a', 'color' ],
            'footer_links'       => [ '.site-footer a', 'color' ],
            'header_background'  => [ '.site-header', 'background-color' ],
            'content_background' => [ '.site-content', 'background-color' ],
            'footer_background'  => [ '.site-footer', 'background-color' ]
        ];

        foreach ($mods as $mod => $option) {
            $value = get_theme_mod($mod, false);
            if ($value) {
                $styles .= "{$option[0]} { {$option[1]}: {$value}; }";
            }
        }

        if ($styles) {
            wp_add_inline_style('bow-styles', $styles);
        }

    }

}
