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
            
            // Set params
            $header = ( $sidebar['header'] ) ? $sidebar['header'] : 'h3' ;
            
            // Register sidebar
            register_sidebar( [
                'name'          => $sidebar['name'],
                'id'            => sanitize_title_with_dashes( $sidebar['name'] ),
                'before_widget' => "<aside id='%1$s' class='widget %2$s {$sidebar['classes']}'>",
                'after_widget'  => "</aside>",
                'before_title'  => "<{$header} class='widget-title'>",
                'after_title'   => "</{$header}>"
            ] );
            
        }

    }

}
