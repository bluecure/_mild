<?php
/**
* Create new user role
*
* @package Mild
*/

namespace Mild;

class User_Roles {
    // Variables
    public $role;
    public $display_name;
    public $capabilities = [];

    /**
     * Creates a new taxonomy
     * @param string $role
     * @param string $display_name
     * @param array $capabilities
     */
    public function __construct( $role, $display_name, $capabilities = [] ) {
        $this->role = sanitize_title_with_dashes( $role );
        $this->display_name = $display_name;

        // Setup capabilities
        $this->capabilities = wp_parse_args( $capabilities, self::default_capabilities() );

        // Add user role
        add_action( 'init', [ $this, 'register' ] );
    }

    /**
     * Adds the new user role
     *
     * @access public
     * @return null
     */
    public function register() {

        add_role( $this->role, $this->display_name, $this->capabilities );

    }

    /**
     * Setup default capabilities
     *
     * @access private
     * @return array
     */
    private function default_capabilities() {
        
        return [
            'read'                   => true,
            'publish_posts'          => false,
            'edit_posts'             => false,
            'edit_published_posts'   => false,
            'delete_posts'           => false,
            'delete_published_posts' => false,
            'upload_files'           => false
        ];

    }

}
