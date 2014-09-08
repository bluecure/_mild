<?php
/**
* Create new sidebars i.e. widgets areas
*
* @package Mild
*/

namespace Mild;

class Sidebars {

    // Variables
    public $sidebars = [];

    /**
     * Creates new sidebars
     *
     * @param array $sidebars
     */
    public function __construct( $sidebars = [] ) {
        $this->sidebars = $sidebars;

        // Register
        self::register();
    }

    /**
     * Adds the new sidebar
     *
     * @access public
     * @return null
     */
    public function register() {

        foreach ( $this->sidebars as $sidebar ) {
            
            // Set options
            $options = wp_parse_args( $sidebar, self::default_options() );
            
            // Translate name
            $sidebar_name = __( $options['name'], 'mild' );
            
            // Register sidebar
            register_sidebar( [
                'name'          => $sidebar_name,
                'id'            => sanitize_title_with_dashes( $sidebar_name ),
                'before_widget' => '<aside id="%1$s" class="widget %2$s ' . $options['classes'] . '">',
                'after_widget'  => '</aside>',
                'before_title'  => '<' .$options['header']. ' class="widget-title">',
                'after_title'   => '</' .$options['header']. '>'
            ] );
            
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
            'name'    => 'Sidebar',
            'header'  => 'h3',
            'classes' => ''
        ];

    }

}
