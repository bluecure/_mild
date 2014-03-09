<?php
/**
 * Plugin Name: Gallery Widget
 * Version: 1.0
 * Description: Adds a gallery with optional title and description.
 * Author: David Featherston
 *
 * @package _m
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

// Define plugin path
if ( ! defined( 'GALLERY_WIDGET_DIRECTORY' ) )
    define( 'GALLERY_WIDGET_DIRECTORY', _m_PLUGINS_URI . basename( dirname( __FILE__) ) );

class Gallery_Widget extends WP_Widget {

    // Widget details
    public function __construct() {
        parent::__construct(
            'gallery-widget',
            'Gallery Widget',
            array(
                'classname'   => 'gallery-widget',
                'description' => 'Adds a gallery with optional title and description.'
            )
        );

        // Register admin styles and scripts
        add_action( 'admin_print_styles', array( $this, 'register_admin_styles' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ) );

    }

    // Outputs the content of the widget.
    public function widget( $args, $instance ) {
        extract( $args, EXTR_SKIP );
        extract( $instance, EXTR_SKIP );
        echo $before_widget;
            include( plugin_dir_path(__FILE__) . '/views/widget.php' );
        echo $after_widget;
    }

    // Generates the administration form for the widget.
    public function form( $instance ) {
        $defaults = array(
            'title' => '',
            'gw_images' => '',
            'gw_description' => '',
            'gw_link' => ''
        );
        $instance = wp_parse_args(
            (array) $instance,
            $defaults
        );
        extract( $instance, EXTR_SKIP );
        include( plugin_dir_path(__FILE__) . '/views/admin.php' );
    }

    // Processes the widget's options to be saved.
    public function update( $new_instance, $old_instance ) {
        extract( $new_instance, EXTR_SKIP );
        $instance = $old_instance;
        $instance['title']           = strip_tags( $title );
        $instance['gw_images']       = $gw_images;
        $instance['gw_description']  = strip_tags( $gw_description );
        $instance['gw_link']         = strip_tags( $gw_link );
        return $instance;
    }

    // Registers and enqueues admin-specific styles.
    public function register_admin_styles() {
        wp_enqueue_style( 'gallery-widget-admin-styles', GALLERY_WIDGET_DIRECTORY . '/css/admin.css' );
    }
    // Registers and enqueues admin-specific JavaScript.
    public function register_admin_scripts() {
        wp_enqueue_media();
        wp_enqueue_script( 'gallery-widget-admin-script', GALLERY_WIDGET_DIRECTORY . '/js/admin.js', array('jquery') );
    }

}

// Register Gallery Widget.
add_action( 'widgets_init', function() {
    register_widget( 'Gallery_Widget' );
});
