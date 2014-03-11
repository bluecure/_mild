<?php
/**
* mild Create new post types
*
* @package Mild
*/

namespace MildHelpers;

class PostTypes {
    // Variables
    public $post_type;
    public $labels = [];
    public $args = [];

    /**
     * Creates a new post type
     * @param string $post_type
     * @param array $options
     * @param array $labels
     */
    public function __construct( $post_type, $labels = [], $options = [] ) {
        $this->post_type = sanitize_title_with_dashes( $post_type );
        $this->labels = $labels;

        // Setup args
        $this->args = wp_parse_args( $options, self::default_options() );
        // Add labels
        $this->args['labels'] = wp_parse_args( $labels, self::default_labels() );

        // Register post type
        add_action( 'init', [ $this, 'register' ] );
    }

    /**
     * Register new post type
     *
     * @access private
     * @return null
     */
    private function register() {

        register_post_type( $this->post_type, $this->args );

    }

    /**
     * Setup default options
     *
     * @access private
     * @return array
     */
    private function default_options() {
        
        return [
            'public'      => true,
            'has_archive' => true,
            'menu_icon'   => 'dashicons-images-alt2',
            'supports'    => [ 'title', 'editor', 'revisions', 'thumbnail', 'excerpt' ]
        ];

    }

    /**
     * Setup default labels
     *
     * @access private
     * @return array
     */
    private function default_labels() {
        
        return [
            'name'               => $this->labels['plural'],
            'singular_name'      => $this->labels['single'],
            'add_new'            => 'Add New',
            'add_new_item'       => 'Add New ' . $this->labels['single'],
            'edit_item'          => 'Edit ' . $this->labels['single'],
            'new_item'           => 'New ' . $this->labels['single'],
            'all_items'          => 'All ' . $this->labels['plural'],
            'view_item'          => 'View ' . $this->labels['single'],
            'update_item'        => 'Update ' . $this->labels['single'],
            'search_items'       => 'Search ' . $this->labels['plural'],
            'not_found'          => 'No matching ' . strtolower($this->labels['plural']) . ' found',
            'not_found_in_trash' => 'No ' . strtolower($this->labels['plural']) . ' in Trash',
            'parent_item_colon'  => 'Parent ' . $this->labels['single'] . ':',
            'menu_name'          => $this->labels['plural'],
        ];
    
    }
}
