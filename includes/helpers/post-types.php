<?php
/**
* Create new post types
*
* @package Mild
*/

namespace Mild;

class Post_Types {
    // Variables
    public $post_types = [];
    public $labels = [];

    /**
     * Creates new post types
     *
     * @param array $post_types
     */
    public function __construct( $post_types = [] ) {
        $this->post_types = $post_types;

        // Register
        self::register();
    }

    /**
     * Register new post type
     *
     * @access public
     * @return null
     */
    public function register() {

        foreach ( $this->post_types as $type ) {
            
            // Set labels
            $this->labels['single'] = $type['name'];
            $this->labels['plural'] = ( $type['plural'] ) ? $type['plural'] : $type['name'] . 's' ;

            // Set options
            $type_name = sanitize_title_with_dashes ( $type['name'] );
            $options = wp_parse_args( $type['options'], self::default_options() );
            $options['labels'] = wp_parse_args( $type['labels'], self::default_labels() );

            // Register post type
            register_post_type( $type_name, $options );
            
        }

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
            'menu_icon'   => 'dashicons-format-aside',
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
