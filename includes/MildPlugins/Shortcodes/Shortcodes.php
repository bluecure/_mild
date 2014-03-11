<?php
/**
 * Plugin Name: Shortcodes
 * Description: A set of simple shortcodes
 * Version: 1.0
 * Author: David Featherston
 *
 */

// Plugins namespace.
namespace MildPlugins;

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
	    return "<div class='row'>" . do_shortcode( $content ) . "</div>";
	}
	
	/*
	* Col shortcode
	*/
	public function col( $params, $content = null ) {
	    extract( shortcode_atts([
	        'width' => '1-2'
	    ], $params) );
	    return "<div class='col col-{$width}'>" . do_shortcode($content) . "</div>";
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
	        'target' => 'self'
	    ], $params) );
	    $html = "<i class='fa fa-{$icon} text-{$color} {$size}'></i>";
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
	        'target' => 'self'
	    ], $params) );
	    $html = "<button class='button bg-{$color} {$size}'><i class='fa fa-{$icon}'></i>" . do_shortcode( $content ) . "</button>";
	    return self::wrap_with_anchor( $link, $target, $html );
	}

	/*
	* Panel shortcode
	*/
	public function panel( $params, $content = null ) {
	    extract( shortcode_atts([
	        'color' => '',
	        'size' => '',
	        'icon' => ''
	    ], $params) );
	    return "<div class='panel bg-{$color} {$size}'><i class='fa fa-{$icon}'></i>" . do_shortcode( $content ) . "</div>";
	}

	/*
	* Align shortcode
	*/
	public function align( $params, $content = null ) {
	    extract( shortcode_atts([
	        'to' => '',
	        'width' => '1-3'
	    ], $params) );
	    return "<div class='align align{$to} col-{$width}'>" . do_shortcode( $content ) . "</div>";
	}

	/*
	* Accordian shortcode
	*/
	public function accordion( $params, $content = null ) {
	    extract( shortcode_atts([
	        'title' => '',
	        'icon' => ''
	    ], $params) );
	    wp_enqueue_script( 'ss-accordion-js', $this->directory_url . '/js/accordion.js', ['jquery'], '1.0', true );
	    return "<div class='accordion'><h3 class='accordion-title'>
	            <i class='fa fa-{$icon}'></i>{$title}<i class='fa fa-plus'></i></h3>
	            <div class='accordion-content'>" . do_shortcode($content) . "</div></div>";
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
	        'image' => false
	    ], $params) );

	    $args = [
	        'category_name' => $cat,
	        'tag' => $tag,
	        'post_type' => $type,
	        'posts_per_page' => $no
	    ];
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

	/*
	* Sitemap shortcode
	*/
	public function sitemap( $params, $content = null ) {
	    extract( shortcode_atts([
	        'show' => 'menus,pages,posts'
	    ], $params) );
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
	        $menus = get_terms( 'nav_menu', [ 'hide_empty' => true ] );
	        $html .= "<h4>Menus</h4>";
	        foreach ( $menus as $menu ) {
	            $html .= wp_nav_menu( [ 'menu' => $menu->name, 'echo' => false ] );
	        }
	    }

	    return $html;
	}

	/*
	* Map shortcode
	*/
	public function map( $params, $content = null ) {
	    extract( shortcode_atts([
	        'width' => '400px',
	        'height' => '300px',
	        'location' => 'Australia'
	    ], $params) );
	    $location = str_replace( ' ', '+', $location );
	    return "<div class='fluid-iframe'><iframe src='https://maps.google.com/maps?q={$location}&output=embed' frameborder='0' scrolling='no' marginheight='0' marginwidth='0' width='{$width}' height='{$height}'></iframe></div>";
	}

	/*
	* Image shortcode
	*/
	public function image ($params, $content = null ) {
	    extract( shortcode_atts([
	        'url' => '',
	        'align' => 'one',
	        'link' => '',
	        'target' => 'self'
	    ], $params) );
	    $html = "<img src='{$url}' class='align{$align}'>";
	    return self::wrap_with_anchor( $link, $target, $html );
	}

	/*
	* Link shortcode
	*/
	public function link( $params, $content = null ) {
	    extract( shortcode_atts([
	        'url' => '#',
	        'target' => 'self'
	    ], $params) );
	    return "<a href='{$url}' target='_{$target}'>" . do_shortcode($content) . "</a>";
	}

	/*
	* Wrap with anchor helper
	*/
	private function wrap_with_anchor( $link, $target, $html ) {
	    return ( $link !== '' ) ? "<a href='{$link}' target='_{$target}' class='a-wrap'>{$html}</a>" : $html;
	}

}

// Register Shortcodes.
add_action( 'init', function() {
    new Shortcodes;
});
