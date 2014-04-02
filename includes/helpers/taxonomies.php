<?php
/**
* Create new taxonomies
*
* @package Mild
*/

namespace Mild;

class Taxonomies {
    // Variables
    public $taxonomies = [];
    public $labels = [];

    /**
     * Creates a new taxonomy
     * @param string $tax
     * @param array $post_type
     * @param array $options
     * @param array $labels
     */
    public function __construct( $taxonomies = [] ) {
        $this->taxonomies = $taxonomies;

        // Register
        self::register();
    }

    /**
     * Register new taxonomy
     *
     * @access public
     * @return null
     */
    public function register() {

        foreach ( $this->taxonomies as $taxonomy ) {
            // Set labels
            $this->labels['single'] = $taxonomy['name'];
            $this->labels['plural'] = ( $taxonomy['plural'] ) ? $taxonomy['plural'] : $taxonomy['name'] . 's' ;

            // Setup options
            $post_types = [];
            foreach ( $taxonomy['post_types'] as $type ) {
                $post_types[] = sanitize_title_with_dashes( $type );
            }
            $taxonomy_name = sanitize_title_with_dashes( $taxonomy['name'] );
            $options = wp_parse_args( $options, self::default_options() );
            $options['labels'] = wp_parse_args( $labels, self::default_labels() );
            
            // Register taxonomy
            register_taxonomy( $taxonomy_name, $post_types, $options );
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
            'hierarchical'      => true,
            'public'            => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'show_in_nav_menus' => true,
            'show_tagcloud'     => true
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
            'name'                       => $this->labels['plural'],
            'singular_name'              => $this->labels['single'],
            'menu_name'                  => $this->labels['plural'],
            'all_items'                  => 'All ' . $this->labels['plural'],
            'add_new_item'               => 'Add New ' . $this->labels['single'],
            'new_item_name'              => 'New ' . $this->labels['single'] . ' Name',
            'update_item'                => 'Update ' . $this->labels['single'],
            'edit_item'                  => 'Edit ' . $this->labels['single'],
            'not_found'                  => 'No matching ' . strtolower( $this->labels['plural'] ) . ' found',
            'parent_item'                => 'Parent ' . $this->labels['single'],
            'parent_item_colon'          => 'Parent ' . $this->labels['single'] . ':',
            'search_items'               => 'Search ' . $this->labels['plural'],
            'add_or_remove_items'        => 'Add or remove ' . strtolower( $this->labels['plural'] ),
            'choose_from_most_used'      => 'Choose from the most used ' . strtolower( $this->labels['plural'] ),
            'separate_items_with_commas' => 'Separate  ' . $this->labels['single'] . ' with commas'
        ];
    
    }

}