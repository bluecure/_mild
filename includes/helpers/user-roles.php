<?php
/**
* Create new user role
*
* @package Mild
*/

namespace Mild;

class User_Roles {

    // Variables
    public $roles = [];

    /**
     * Creates new roles
     *
     * @param array $roles
     */
    public function __construct( $roles = [] ) {

        // Set variables
        $this->roles = $roles;

        // Register
        $this->register();

    }

    /**
     * Adds the new user role
     *
     * @access public
     * @return null
     */
    public function register() {

        foreach ( $this->roles as $role ) {
            
            // Set params
            $role_name = sanitize_title_with_dashes ( $role['name'] );
            $capabilities = wp_parse_args( $role['capabilities'], $this->default_capabilities() );

            // Register user role
            add_role( $role_name, $role['name'], $capabilities );
            
        }

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
