<?php
/**
* _m Create new user role
*
* @package _m
*/

class Create_User_Role {
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
        add_action( 'init', array( $this, 'register' ) );
    }

    /**
     * Adds the new user role
     *
     * @access private
     * @return null
     */
    private function register() {

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
