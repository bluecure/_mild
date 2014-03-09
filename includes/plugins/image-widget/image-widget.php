<?php
/**
 * Plugin Name: Image Widget
 * Version: 1.0
 * Description: Adds an image with optional title, description and link.
 * Author: David Featherston
 *
 * @package _m
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

// Define plugin path
if ( ! defined( 'IMAGE_WIDGET_DIRECTORY' ) )
    define( 'IMAGE_WIDGET_DIRECTORY', _m_PLUGINS_URI . basename( dirname( __FILE__) ) );

class Image_Widget extends WP_Widget {

    // Widget details
    public function __construct() {
        parent::__construct(
            'image-widget',
            'Image Widget',
            array(
                'classname'   => 'image-widget',
                'description' => 'Adds an image with optional title, description and link.'
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
            'iw_image' => '',
            'iw_description' => '',
            'iw_link' => ''
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
        $instance['title']   = strip_tags( $title );
        $instance['iw_image']   = intval( $iw_image );
        $instance['iw_description'] = strip_tags( $iw_description );
        $instance['iw_link']    = strip_tags( $iw_link );
        return $instance;
    }

    // Registers and enqueues admin-specific styles.
    public function register_admin_styles() {
        wp_enqueue_style( 'image-widget-admin-styles', IMAGE_WIDGET_DIRECTORY . '/css/admin.css' );
    }
    // Registers and enqueues admin-specific JavaScript.
    public function register_admin_scripts() {
        wp_enqueue_media();
        wp_enqueue_script( 'image-widget-admin-script', IMAGE_WIDGET_DIRECTORY . '/js/admin.js', array('jquery') );
    }

}

// Register Image Widget.
add_action( 'widgets_init', function() {
    register_widget( 'Image_Widget' );
});
