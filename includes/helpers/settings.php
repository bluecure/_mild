<?php
/**
* Create new settings page in WordPress admin
*
* @package Mild
*/

namespace Mild;

class Settings {

    // Variables
    private $type;
    private $settings;
    private $title;
    private $title_clean;
    private $menu;
    private $menu_title;

    /**
     * Creates new settings pages
     *
     * @param string $type
     * @param array  $settings
     * @param string $title
     * @param string $menu
     * @param string $menu_title
     */
    public function __construct( $type, $settings, $title, $menu = false, $menu_title = false  ) {

        if ( ! is_admin() )
            return;

        // Set variables
        $this->type = $type;
        $this->settings = $settings;
        $this->title = $title;
        $this->title_clean = sanitize_title_with_dashes( $this->title );
        $this->menu = $menu;
        $this->menu_title = ( $menu_title ) ? $menu_title : $title;

        // Register settings
        add_action( 'admin_init', [ $this, 'register_settings' ] );
        
        // Add admin menu
        add_action( 'admin_menu', [ $this, 'add_menu' ] );

    }
    
    /**
     * Add Menu
     *
     * @access public
     * @return null
     */
    public function add_menu() {
        
        switch ( $this->type ) {
            case 'menu':
                $menu = add_menu_page( $this->title, $this->menu_title, 'manage_options', $this->title_clean, [ $this, 'register_page' ] );
                break;

            case 'theme':
                $menu = add_theme_page( $this->title, $this->menu_title, 'manage_options', $this->title_clean, [ $this, 'register_page' ] );
                break;

            case 'option':
                $menu = add_options_page( $this->title, $this->menu_title, 'manage_options', $this->title_clean, [ $this, 'register_page' ] );
                break;

            case 'custom':
                $menu = add_submenu_page( $this->menu, $this->title, $this->menu_title, 'manage_options', $this->title_clean,  [ $this, 'register_page' ] );
                break;
        }

        // Add assets
        add_action( 'admin_print_scripts-' . $menu, [ $this, 'assets' ] );

    }

    /**
     * Register settings
     *
     * @access public
     * @return null
     */
    public function register_settings() {

        // Set up each setting section   
        foreach ( $this->settings as $section ) {

            $setting_id = $this->setting_name( $this->title_clean, $section['id'] );

            // Create option
            if ( ! get_option( $setting_id ) )
                add_option( $setting_id );

            // Add settings section
            add_settings_section( $section['id'], $section['title'], [ $this, 'section_description' ], $setting_id );

            // Add settings fields 
            foreach ( $section['fields'] as $field ) {
                $field['section'] = $setting_id;
                add_settings_field( $field['id'], $field['label'], [ $this, 'add_field' ], $setting_id, $section['id'], $field );
            }

            // Register setting
            register_setting( $setting_id, $setting_id, [ $this, 'sanitize_settings' ] );

        }

    }

    /**
     * Register Page
     *
     * @access public
     * @return null
     */
    public function register_page() { ?>
        
        <div id="<?php echo $this->title_clean; ?>" class="wrap mild-settings">
            <h2><?php echo $this->title; ?></h2>
            <?php settings_errors(); ?>

            <h2 class="nav-tab-wrapper">
                <?php foreach( $this->settings as $section ) : ?>
                    <a href="?page=<?php echo $this->title_clean; ?>&tab=<?php echo $section['id']; ?>" class="nav-tab <?php echo ( $section['id'] === $this->get_tab() ) ? 'nav-tab-active' : ''; ?>">
                        <?php echo $section['title']; ?>
                    </a>
                <?php endforeach; ?>
            </h2>
            
            <form action="options.php" method="POST" enctype="post">
                <?php
                    foreach( $this->settings as $section ) {
                        if ( $section['id'] === $this->get_tab() ) {
                            $setting_name = $this->setting_name( $this->title_clean, $section['id'] );
                            settings_fields( $setting_name );
                            do_settings_sections( $setting_name );
                            submit_button();
                        }
                    }
                ?>
            </form>

        </div>

    <?php }

    /**
     * Section Description
     *
     * Displays the sections description
     *
     * @access public
     * @param array $section
     * @return null
     */
    public function section_description( $section ) {
        
        foreach( $this->settings as $setting ) {
            if ( $setting['id'] === $section['id'] ) { 
                echo "<p>{$setting['description']}</p>";
            }
        }

    
    }

    /**
     * Add Field
     *
     * Displays the settings description
     *
     * @access public
     * @param  array $field
     * @return null
     */
    public function add_field( $field ) {
        
        switch ( $field['type'] ) {
            case 'text':
                $this->text( $field );
                break;

            case 'textarea':
                $this->textarea( $field );
                break;

            case 'upload':
                $this->upload( $field );
                break;

            default:
                $this->text( $field );
                break;
        }

    }

    /**
     * Text
     *
     * Generates a text field
     *
     * @access private
     * @param  array $field
     * @return null
     */
    private function text( $field ) { 

        $options = get_option( $field['section'] ); ?>

        <input name="<?php echo $this->field_name( $field ); ?>" value="<?php echo ( isset( $options[$field['id']] ) ) ? $options[$field['id']] : ''; ?>" type="text">
        <?php if ( isset( $field['description'] ) ) : ?>
            <p><?php echo $field['description']; ?></p>
        <?php endif;

    }

    /**
     * Textarea
     *
     * Generates a textarea
     *
     * @access private
     * @param  array $field
     * @return null
     */
    private function textarea( $field ) { 

        $options = get_option( $field['section'] ); ?>

        <textarea name="<?php echo $this->field_name( $field ); ?>" cols="50" rows="10"><?php echo ( isset( $options[$field['id']] ) ) ? $options[$field['id']] : ''; ?></textarea>
        <?php if ( isset( $field['description'] ) ) : ?>
            <p><?php echo $field['description']; ?></p>
        <?php endif;

    }

    /**
     * Upload
     *
     * Generates a textarea
     *
     * @access private
     * @param  array   $field
     * @return null
     */
    private function upload( $field ) { 

        $options = get_option( $field['section'] );
        $upload  = $this->get_upload( $field, $options ) ?>

            <div class="upload">
                <p>
                    <img src="<?php echo $upload['url']; ?>" class="upload-image <?php echo ( $upload['url'] === '' ) ? 'hidden': ''; ?>">
                    <strong class="upload-title <?php echo ( $upload['url'] ) ? 'hidden': ''; ?>"><?php echo $upload['name']; ?></strong>
                </p>
                <input type="hidden" name="<?php echo $this->field_name( $field ); ?>" value="<?php echo ( isset( $options[$field['id']] ) ) ? $options[$field['id']] : ''; ?>" class="upload-id">
                <button class="button upload" type="button"><?php _e( 'Select', 'mild' ); ?></button>
                <?php if ( isset( $field['description'] ) ) : ?>
                    <p><?php echo $field['description']; ?></p>
                <?php endif; ?>
            </div>

    <?php }

    /**
     * Assets
     *
     * Loads assets
     *
     * @access public
     * @return null
     */
    public function assets() {

        wp_enqueue_media();

        add_action( 'admin_print_footer_scripts', function() { ?>

        <script>
            (function ($) {
                var Settings = {
                    init: function () {
                        // Handle upload
                        $( '.mild-settings' ).on( 'click', '.upload button', this.upload );
                    },
                    // Launch media manager
                    upload : function( e ) {
                        e.preventDefault();
                        var wrap  = $( this ).parents( '.upload' ),
                            frame = wp.media({ multiple: false }).open();
                        // Load upload into setting
                        frame.on( 'close', function() {
                            var upload = frame.state().get( 'selection' ).toJSON()[0];
                            if ( upload.type === 'image' ) {
                                wrap.find( '.upload-image' ).attr( 'src', upload.url ).show();
                            } else {
                                wrap.find( '.upload-title' ).html( upload.title ).show();
                            }
                            wrap.find( '.upload-id' ).val( upload.id );
                        });
                    }
                };
                Settings.init();
            } (jQuery));
        </script>

    <?php });

    }

    /**
     * Sanitize Settings
     *
     * Perform sanitization of settings
     *
     * @access public
     * @return string  $tab
     */
    public function sanitize_settings( $settings ) { 

        foreach( $settings as $id => $val ) {
            $settings[$id] = trim( $val );
        }

        return $settings;

    }

    /**
     * Setting Name
     *
     * Generates a settings name
     *
     * @access public 
     * @param  string  $name
     * @param  string  $id
     * @return string  $name
     */
    public static function setting_name( $name, $id ) { 

        return 'mild-' . $name . '-' . $id;

    }

    /**
     * Field Name
     *
     * Generates a field name
     *
     * @access private
     * @param  string  $id
     * @return string  $name
     */
    private function field_name( $field ) { 

        return $field['section'] . '[' . $field['id'] . ']';

    }

    /**
     * Get Tab
     *
     * Gets the current tab
     *
     * @access private
     * @return string  $tab
     */
    private function get_tab() { 

        return ( isset( $_GET['tab'] ) ) ? $_GET['tab'] : $this->settings[0]['id'];

    }

    /**
     * Get Upload
     *
     * Gets the saved upload
     *
     * @access private
     * @param  array $field
     * @param  array $options
     * @return array $upload
     */
    private function get_upload( $field, $options ) {

        $upload = [
            'url'  => '',
            'name' => ''
        ];

        // Set source and name
        if ( isset( $options[$field['id']] ) ) {
            if ( wp_attachment_is_image( $options[$field['id']] ) ) {
                $upload['url'] = wp_get_attachment_thumb_url( $options[$field['id']] );
            } else {
                $upload['name'] = get_the_title( $options[$field['id']] );
            }
        }

        return $upload;

    }

    /**
     * Get Settings
     *
     * Gets the all settings within a section
     *
     * @access public
     * @param string $name
     * @param string $id
     * @return array $settings
     */
    public static function get_settings( $name, $id ) { 

        return get_option( self::setting_name( $name, $id ), [] );

    }

    /**
     * Get Setting
     *
     * Gets a setting value
     *
     * @access public
     * @param string  $name
     * @param string  $id
     * @param string  $field
     * @param boolen  $url
     * @return string $setting
     */
    public static function get_setting( $name, $id, $field, $url = true ) {

        $setting = get_option( self::setting_name( $name, $id ), false );
        if ( $setting && isset( $setting[$field] ) ) {
            $setting = $setting[$field];
        }
        if ( $setting && $url && ( get_post_type( $setting ) === 'attachment' ) ) {
            $setting = wp_get_attachment_url( $setting );
        }
        return $setting;

    }

}
