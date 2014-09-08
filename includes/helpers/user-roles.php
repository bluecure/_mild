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
        $this->roles = $roles;

        // Register
        self::register();
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
            $display_name = __( $role['name'], 'mild' );
            $role_name = sanitize_title_with_dashes ( $display_name );
            $capabilities = wp_parse_args( $role['capabilities'], self::default_capabilities() );

            // Register user role
            add_role( $role_name, $display_name, $capabilities );
            
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
