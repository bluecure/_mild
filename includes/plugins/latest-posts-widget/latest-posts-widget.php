<?php
/**
 * Plugin Name: Latest Posts Widget
 * Version: 1.0
 * Description: Display the latest posts with optional title, date and image.
 * Author: David Featherston
 *
 * @package Mild
 */

// Plugins namespace.
namespace MildPlugins;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) die;

/* Latest Posts Widget Class */
class Latest_Posts_Widget extends \WP_Widget {

    /* Variables */
    private $directory;
    private $directory_url;

    public function __construct() {

        // Set directory
        $this->directory = plugin_dir_path( __FILE__ );
        $this->directory_url = MILD_PLUGINS_URI . basename( dirname( __FILE__ ) );

        // Widget details
        parent::__construct(
            'latest-posts-widget',
            'Latest Posts Widget',
            [
                'classname'   => 'latest-posts-widget',
                'description' => 'Display the latest posts with optional title, date and image.'
            ]
        );

        // Register admin styles and scripts
        add_action( 'admin_print_styles', [ $this, 'register_admin_styles' ] );

    }

    // Outputs the content of the widget.
    public function widget( $args, $instance ) {
        extract( $args, EXTR_SKIP );
        extract( $instance, EXTR_SKIP );

        global $post;
        $query = [
            'numberposts'   => $lpw_limit,
            'category__in'  => $lpw_cats,
            'tag__in'       => $lpw_tags
        ];
        $posts = get_posts( $query );

        echo $before_widget;
            include( $this->directory . '/views/widget.php' );
        echo $after_widget;
    }

    // Generates the administration form for the widget.
    public function form( $instance ) {
        $defaults = [
            'title' => '',
            'lpw_cats' => '',
            'lpw_tags' => '',
            'lpw_limit' => '5',
            'lpw_length' => '150',
            'lpw_date' => '',
            'lpw_image' => '',
            'lpw_link' => ''
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
        $instance['title'] = strip_tags( $title );
        $instance['lpw_cats']  = $lpw_cats;
        $instance['lpw_tags']  = $lpw_tags;
        $instance['lpw_limit'] = intval( $lpw_limit );
        $instance['lpw_length'] = intval( $lpw_length );
        $instance['lpw_date']  = intval( $lpw_date );
        $instance['lpw_image'] = intval( $lpw_image );
        $instance['lpw_link'] = strip_tags( $lpw_link );
        return $instance;
    }

    // Registers and enqueues admin-specific styles.
    public function register_admin_styles() {
        wp_enqueue_style( 'latest-posts-widget-admin-styles', $this->directory_url . '/css/admin.css' );
    }

}

// Register Latest Posts Widget.
add_action( 'widgets_init', function() {
    register_widget( 'MildPlugins\Latest_Posts_Widget' );
});
