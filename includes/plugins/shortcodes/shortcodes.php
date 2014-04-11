<?php
/**
 * Plugin Name: Shortcodes
 * Description: A set of simple shortcodes
 * Version: 1.0.0
 * Author: David Featherston
 *
 */

namespace Mild;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) die;

/* Shortcodes Class */
class Shortcodes {

	/* Variables */
    private $directory_url;

	//  Set up plugin
    public function __construct() {

    	// Set directory url
        $this->directory_url = MILD_PLUGINS_URI . basename( dirname( __FILE__ ) );

		// Include the editor module.
		self::editor();

		// Add shortcodes
		add_shortcode( 'row',       [ $this, 'row' ] );
		add_shortcode( 'col',       [ $this, 'col' ] );
		add_shortcode( 'icon',      [ $this, 'icon' ] );
		add_shortcode( 'button',    [ $this, 'button' ] );
		add_shortcode( 'panel',     [ $this, 'panel' ] );
		add_shortcode( 'align',     [ $this, 'align' ] );
		add_shortcode( 'accordion', [ $this, 'accordion' ] );
		add_shortcode( 'show',      [ $this, 'show' ] );
		add_shortcode( 'sitemap',   [ $this, 'sitemap' ] );
		add_shortcode( 'map',       [ $this, 'map' ] );
		add_shortcode( 'image',     [ $this, 'image' ] );
		add_shortcode( 'link',      [ $this, 'link' ] );

    }

	/*
	* Row shortcode
	*/
	private function editor() {
	        
	    if ( ! is_admin() ) return;
	        
	    // Add admin style sheet.
	    wp_enqueue_style( 'shortcodes', $this->directory_url . '/editor/css/editor.css' );

	    // Add editor js.
	    add_filter( 'mce_external_plugins', function( $plugin_array ) {
	        $plugin_array['mce_editor_shortcodes'] = $this->directory_url . '/editor/editor.js';
	        return $plugin_array;
	    });

	    // Register editor buttons.
	    add_filter( 'mce_buttons_3', function( $buttons ) {
	        array_push( $buttons, 'row', 'icon', 'button', 'panel', 'align', 'accordion', 'show', 'sitemap', 'map' );
	        return $buttons;
	    });

	}
	
	/*
	* Row shortcode
	*/
	public function row( $params, $content = null ) {
	    extract( shortcode_atts([
	        'class' => ''
	    ], $params) );
	    return "<div class='row {$class}'>" . do_shortcode( $content ) . "</div>";
	}
	
	/*
	* Col shortcode
	*/
	public function col( $params, $content = null ) {
	    extract( shortcode_atts([
	        'width' => '1-2',
	        'class' => ''
	    ], $params) );
	    return "<div class='col col-{$width} {$class}'>" . do_shortcode($content) . "</div>";
	}

	/*
	* Icon shortcode
	*/
	public function icon( $params, $content = null ) {
	    extract( shortcode_atts([
	        'color' => '',
	        'size' => '',
	        'icon' => '',
	        'link' => '',
	        'target' => 'self',
	        'class' => ''
	    ], $params) );
	    $html = "<i class='fa fa-{$icon} text-{$color} {$size} {$class}'></i>";
	    return self::wrap_with_anchor( $link, $target, $html );
	}

	/*
	* Button shortcode
	*/
	public function button( $params, $content = null ) {
	    extract( shortcode_atts([
	        'color' => '',
	        'size' => '',
	        'icon' => '',
	        'link' => '',
	        'target' => 'self',
	        'class' => ''
	    ], $params) );
	    $icon = self::create_icon( $icon );
	    $html = "<button type='button' class='button bg-{$color} {$size} {$class}'>{$icon}" . do_shortcode( $content ) . "</button>";
	    return self::wrap_with_anchor( $link, $target, $html );
	}

	/*
	* Panel shortcode
	*/
	public function panel( $params, $content = null ) {
	    extract( shortcode_atts([
	        'color' => '',
	        'size' => '',
	        'icon' => '',
	        'class' => ''
	    ], $params) );
	    $icon = self::create_icon( $icon );
	    return "<div class='panel bg-{$color} {$size} {$class}'>{$icon}" . do_shortcode( $content ) . "</div>";
	}

	/*
	* Align shortcode
	*/
	public function align( $params, $content = null ) {
	    extract( shortcode_atts([
	        'to' => '',
	        'width' => '1-3',
	        'class' => ''
	    ], $params) );
	    return "<div class='align align{$to} col-{$width} {$class}'>" . do_shortcode( $content ) . "</div>";
	}

	/*
	* Accordian shortcode
	*/
	public function accordion( $params, $content = null ) {
	    extract( shortcode_atts([
	        'title' => '',
	        'icon' => '',
	        'class' => ''
	    ], $params) );
	    $icon = self::create_icon( $icon );
	    $icon_plus = self::create_icon( 'plus' );
	    return "<div class='accordion {$class}'>
		    		<h3 class='accordion-title'>{$icon}{$title}{$icon_plus}</h3>
		            <div class='accordion-content'>" . do_shortcode($content) . "</div>
	            </div>";
	}

	/*
	* Show shortcode
	*/
	public function show( $params, $content = null ) {
	    extract( shortcode_atts([
	        'cat' => '',
	        'tag' => '',
	        'no' => '5',
	        'type' => 'post',
	        'date' => false,
	        'image' => false,
	        'class' => ''
	    ], $params) );

	    $args = [
	        'category_name' => $cat,
	        'tag' => $tag,
	        'post_type' => $type,
	        'posts_per_page' => $no
	    ];
	    $query = new \WP_Query( $args );

	    $html = "<div class='show-posts show-{$type} {$class}'>";
	        while( $query->have_posts() ) : $query->the_post();
	            $id = $query->post->ID;
	            $html .= "<div class='post'>
	                        <h4 class='post-title'><a href='" . get_permalink() . "'>" . get_the_title() . "</a></h4>";
	            if ( $date ) $html .= "<div class='post-date'>" . get_the_date() . "</div>";
	            if ( $image ) $html .= "<a href='" . get_permalink() . "' class='post-image'>" . get_the_post_thumbnail( $id, 'thumbnail' ) . "</a>";
	            $html .= "<div class='post-content'>" . get_the_excerpt() . "</div></div>";
	        endwhile;
	        wp_reset_query();
	    $html .= '</div>';

	    return $html;
	}

	/*
	* Sitemap shortcode
	*/
	public function sitemap( $params, $content = null ) {
	    extract( shortcode_atts([
	        'show' => 'menus,pages,posts',
	        'class' => ''
	    ], $params) );
	    
	    $html = "<nav class='site-map {$class}'>";
	    
	    if ( strpos( $show, 'menus' ) !== false ) {
	        $menus = get_terms( 'nav_menu', [ 'hide_empty' => true ] );
	        $html .= "<h4>Menus</h4>";
	        foreach ( $menus as $menu ) {
	            $html .= wp_nav_menu( [ 'menu' => $menu->name, 'echo' => false ] );
	        }
	    }

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
	    
	    $html .= "</nav>";

	    return $html;
	}

	/*
	* Map shortcode
	*/
	public function map( $params, $content = null ) {
	    extract( shortcode_atts([
	        'width' => '400',
	        'height' => '300',
	        'location' => 'Australia',
	        'class' => ''
	    ], $params) );
	    $location = str_replace( ' ', '+', $location );
	    return "<div class='fluid-iframe {$class}'><iframe src='https://maps.google.com/maps?q={$location}&output=embed' frameborder='0' scrolling='no' marginheight='0' marginwidth='0' width='{$width}px' height='{$height}px'></iframe></div>";
	}

	/*
	* Image shortcode
	*/
	public function image ($params, $content = null ) {
	    extract( shortcode_atts([
	        'url' => '',
	        'align' => 'one',
	        'link' => '',
	        'target' => 'self',
	        'class' => ''
	    ], $params) );
	    $html = "<img src='{$url}' class='align{$align} {$class}'>";
	    return self::wrap_with_anchor( $link, $target, $html );
	}

	/*
	* Link shortcode
	*/
	public function link( $params, $content = null ) {
	    extract( shortcode_atts([
	        'url' => '#',
	        'target' => 'self',
	        'class' => ''
	    ], $params) );
	    return "<a href='{$url}' target='_{$target} {$class}'>" . do_shortcode($content) . "</a>";
	}

	/*
	* Wrap with anchor helper
	*/
	private function wrap_with_anchor( $link, $target, $html ) {
	    return ( $link ) ? "<a href='{$link}' target='_{$target}' class='a-wrap'>{$html}</a>" : $html;
	}

	/*
	* Create icon helper
	*/
	private function create_icon( $icon ) {
	    return ( $icon ) ? "<i class='fa fa-{$icon}'></i>" : '';
	}

}

// Register Shortcodes.
add_action( 'init', function() {
    new Shortcodes;
});
