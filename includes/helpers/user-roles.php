<?php
/**
* User Roles
*
* Create new user roles.
*
* @package Mild
*/

namespace Mild;

class User_Roles {

    // Variables
    public $roles = [];

    /**
     * Construct
     *
     * Creates new roles.
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
     * Register
     *
     * Add new user roles.
     *
     * @access private
     * @return null
     */
    private function register() {

        foreach ( $this->roles as $role ) {
            
            // Set params
            $role_name = sanitize_title_with_dashes ( $role['name'] );
            $capabilities = wp_parse_args( $role['capabilities'], $this->default_capabilities() );

            // Register user role
            add_role( $role_name, $role['name'], $capabilities );
            
        }

    }

    /**
     * Default Capabilities
     *
     * Setup the default capabilities.
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
