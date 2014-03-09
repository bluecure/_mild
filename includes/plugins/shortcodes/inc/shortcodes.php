<?php
/**
 * Simple Shortcodes
 *
 */

//[row]
function ss_row( $params, $content = null ) {
    return "<div class='row'>" . do_shortcode( $content ) . "</div>";
}
add_shortcode( 'row', 'ss_row' );

//[col]
function ss_col( $params, $content = null ) {
    extract( shortcode_atts(array(
        'width' => '1-2'
    ), $params) );
    return "<div class='col col-{$width}'>" . do_shortcode($content) . "</div>";
}
add_shortcode( 'col', 'ss_col' );

//[icon]
function ss_icon( $params, $content = null ) {
    extract( shortcode_atts(array(
        'color' => '',
        'size' => '',
        'icon' => '',
        'link' => '',
        'target' => 'self'
    ), $params) );
    $html = "<i class='fa fa-{$icon} text-{$color} {$size}'></i>";
    return ss_wrap_a( $link, $target, $html );
}
add_shortcode( 'icon', 'ss_icon' );

//[button]
function ss_button( $params, $content = null ) {
    extract( shortcode_atts(array(
        'color' => '',
        'size' => '',
        'icon' => '',
        'link' => '',
        'target' => 'self'
    ), $params) );
    $html = "<button class='button bg-{$color} {$size}'><i class='fa fa-{$icon}'></i>" . do_shortcode( $content ) . "</button>";
    return ss_wrap_a( $link, $target, $html );
}
add_shortcode( 'button', 'ss_button' );

//[panel]
function ss_panel( $params, $content = null ) {
    extract( shortcode_atts(array(
        'color' => '',
        'size' => '',
        'icon' => ''
    ), $params) );
    return "<div class='panel bg-{$color} {$size}'><i class='fa fa-{$icon}'></i>" . do_shortcode( $content ) . "</div>";
}
add_shortcode( 'panel', 'ss_panel' );

//[align]
function ss_align( $params, $content = null ) {
    extract( shortcode_atts(array(
        'to' => '',
        'width' => '1-3'
    ), $params) );
    return "<div class='align align{$to} col-{$width}'>" . do_shortcode( $content ) . "</div>";
}
add_shortcode( 'align', 'ss_align' );

//[accordion]
function ss_accordion( $params, $content = null ) {
    extract( shortcode_atts(array(
        'title' => '',
        'icon' => ''
    ), $params) );
    wp_enqueue_script( 'ss-accordion-js', SIMPLE_SHORTCODES_DIRECTORY . '/js/accordion.js', array('jquery'), '1.0', true );
    return "<div class='accordion'><h3 class='accordion-title'>
            <i class='fa fa-{$icon}'></i>{$title}<i class='fa fa-plus'></i></h3>
            <div class='accordion-content'>" . do_shortcode($content) . "</div></div>";
}
add_shortcode( 'accordion', 'ss_accordion' );

//[show]
function ss_show( $params, $content = null ) {
    extract( shortcode_atts(array(
        'cat' => '',
        'tag' => '',
        'no' => '5',
        'type' => 'post',
        'date' => false,
        'image' => false
    ), $params) );

    $args = array(
        'category_name' => $cat,
        'tag' => $tag,
        'post_type' => $type,
        'posts_per_page' => $no
    );
    $query = new WP_Query( $args );

    $html = "<div class='show-posts show-{$type}'>";
        while( $query->have_posts() ) : $query->the_post();
            $id = $query->post->ID;
            $html .= "<div class='post'>
                        <h4 class='post-title'><a href='" . get_permalink() . "'>" . get_the_title() . "</a></h4>";
            if ( $date ) $html .= "<div class='post-date'>" . get_the_date() . "</div>";
            if ( $image ) $html .= "<a href='" . get_permalink() . " class='post-image''>" . get_the_post_thumbnail( $id, 'thumbnail' ) . "</a>";
            $html .= "<div class='post-content'>" . get_the_excerpt() . "</div></div>";
        endwhile;
        wp_reset_query();
    $html .= '</div>';

    return $html;
}
add_shortcode( 'show', 'ss_show' );

//[sitemap]
function ss_sitemap( $params, $content = null ) {
    extract( shortcode_atts(array(
        'show' => 'menus,pages,posts'
    ), $params) );
    $html = '';

    if ( strpos( $show, 'pages' ) !== false ) {
        $pages = get_pages();
        $html .= "<h4>Pages</h4>";
        $html .= "<ul class='sitemap sitemap-pages'>";
            foreach ( $pages as $page ) {
                $html .= "<li><a href='" . get_permalink( $page->ID ) . "'>";
                $html .= $page->post_title;
                $html .= "</a></li>";
            }
        $html .= "</ul>";
    }

    if ( strpos( $show, 'posts' ) !== false ) {
        $posts = get_posts();
        $html .= "<h4>Posts</h4>";
        $html .= "<ul class='sitemap sitemap-posts'>";
            foreach ( $posts as $post ) {
                $html .= "<li><a href='" . get_permalink( $post->ID ) . "'>";
                $html .= $post->post_title;
                $html .= "</a></li>";
            }
        $html .= "</ul>";
    }

    if ( strpos( $show,'menus' ) !== false ) {
        $menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
        $html .= "<h4>Menus</h4>";
        foreach ( $menus as $menu ) {
            $html .= wp_nav_menu( array( 'menu' => $menu->name, 'echo' => false ) );
        }
    }

    return $html;
}
add_shortcode( 'sitemap', 'ss_sitemap' );

//[map]
function ss_map( $params, $content = null ) {
    extract( shortcode_atts(array(
        'width' => '400px',
        'height' => '300px',
        'location' => 'Australia'
    ), $params) );
    $location = str_replace( ' ', '+', $location );
    return "<div class='fluid-iframe'><iframe src='https://maps.google.com/maps?q={$location}&output=embed' frameborder='0' scrolling='no' marginheight='0' marginwidth='0' width='{$width}' height='{$height}'></iframe></div>";
}
add_shortcode( 'map', 'ss_map' );

//[image]
function ss_image ($params, $content = null ) {
    extract( shortcode_atts(array(
        'url' => '',
        'align' => 'one',
        'link' => '',
        'target' => 'self'
    ), $params) );
    $html = "<img src='{$url}' class='align{$align}'>";
    return ss_wrap_a( $link, $target, $html );
}
add_shortcode( 'image', 'ss_image' );

//[link]
function ss_link( $params, $content = null ) {
    extract( shortcode_atts(array(
        'url' => '#',
        'target' => 'self'
    ), $params) );
    return "<a href='{$url}' target='_{$target}'>" . do_shortcode($content) . "</a>";
}
add_shortcode( 'link', 'ss_link' );

/* Shortcode Helper functions */

function ss_wrap_a( $link, $target, $html ) {
    return ( $link !== '' ) ? "<a href='{$link}' target='_{$target}' class='a-wrap'>{$html}</a>" : $html;
}
