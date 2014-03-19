<?php
/**
 * Plugin Name: Gallery Widget
 * Version: 1.0
 * Description: Adds a gallery with optional title and description.
 * Author: David Featherston
 *
 * @package Mild
 */

namespace Mild;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) die;

/* Gallery Widget Class */
class Gallery_Widget extends \WP_Widget {

    /* Variables */
    private $directory;
    private $directory_url;
    
    public function __construct() {

        // Set directory
        $this->directory = plugin_dir_path( __FILE__ );
        $this->directory_url = MILD_PLUGINS_URI . basename( dirname( __FILE__ ) );

        // Widget details
        parent::__construct(
            'gallery-widget',
            'Gallery Widget',
            [
                'classname'   => 'gallery-widget',
                'description' => 'Adds a gallery with optional title and description.'
            ]
        );

        // Register admin styles and scripts
        add_action( 'admin_print_styles', [ $this, 'register_admin_styles' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'register_admin_scripts' ] );

    }

    // Outputs the content of the widget.
    public function widget( $args, $instance ) {
        extract( $args, EXTR_SKIP );
        extract( $instance, EXTR_SKIP );
        echo $before_widget;
            include( $this->directory . '/views/widget.php' );
        echo $after_widget;
    }

    // Generates the administration form for the widget.
    public function form( $instance ) {
        $defaults = [
            'title' => '',
            'gw_images' => '',
            'gw_description' => '',
            'gw_link' => ''
        ];
        $instance = wp_parse_args(
            (array) $instance,
            $defaults
        );
        extract( $instance, EXTR_SKIP );
        include( $this->directory . '/views/admin.php' );
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
        wp_enqueue_style( 'gallery-widget-admin-styles', $this->directory_url . '/css/admin.css' );
    }
    // Registers and enqueues admin-specific JavaScript.
    public function register_admin_scripts() {
        wp_enqueue_media();
        wp_enqueue_script( 'gallery-widget-admin-script', $this->directory_url . '/js/admin.js', ['jquery'] );
    }

}

// Register Gallery Widget.
add_action( 'widgets_init', function() {
    register_widget( 'Mild\Gallery_Widget' );
});
