<?php
/**
* Settings
*
* Create new settings page in WordPress admin.
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
     * Construct
     *
     * Creates new settings pages.
     *
     * @param string $type
     * @param array  $settings
     * @param string $title
     * @param string $menu
     * @param string $menu_title
     */
    public function __construct( $type, $settings, $title, $menu = false, $menu_title = false ) {

        if ( ! is_admin() ) return;

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
     * Adds the appropriate menu.
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

            case 'submenu':
                $menu = add_submenu_page( $this->menu, $this->title, $this->menu_title, 'manage_options', $this->title_clean,  [ $this, 'register_page' ] );
                break;
        }

        // Load scripts
        add_action( 'admin_print_scripts-' . $menu, [ $this, 'load_scripts' ] );

    }

    /**
     * Register settings
     *
     * Registers all section settings.
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
            register_setting( $setting_id, $setting_id );

        }

    }

    /**
     * Register Page
     *
     * Registers the page content and section settings.
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
     * Displays the sections description.
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
     * Adds the appropriate field type.
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

            case 'editor':
                $this->editor( $field );
                break;

            case 'select':
                $this->select( $field );
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
     * Generates a text field.
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
     * Generates a textarea.
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
     * Editor
     *
     * Generates a WordPress editor.
     *
     * @access private
     * @param  array $field
     * @return null
     */
    private function editor( $field ) { 

        $options = get_option( $field['section'] );
        $content = ( isset( $options[$field['id']] ) ) ? $options[$field['id']] : '';
        
        wp_editor( $content, $field['id'], [ 'textarea_name' => $this->field_name( $field ) ] );
        
        if ( isset( $field['description'] ) ) : ?>
            <p><?php echo $field['description']; ?></p>
        <?php endif;

    }

    /**
     * Select
     *
     * Generates a select box.
     *
     * @access private
     * @param  array $field
     * @return null
     */
    private function select( $field ) { 

        $options = get_option( $field['section'] );
        $option = ( isset( $options[$field['id']] ) ) ? $options[$field['id']] : ''; ?>
        
        <select name="<?php echo $this->field_name( $field ); ?>">
           <option><?php echo __( '-- select --', 'Mild' ); ?></option>
            <?php foreach( $field['choices'] as $value => $label ) : ?>
                <option value="<?php echo $value; ?>" <?php selected( $option, $value ); ?>><?php echo $label; ?></option>
            <?php endforeach; ?>            
        </select>

        <?php if ( isset( $field['description'] ) ) : ?>
            <p><?php echo $field['description']; ?></p>
        <?php endif;

    }

    /**
     * Upload
     *
     * Generates a upload field.
     *
     * @access private
     * @param  array $field
     * @return null
     */
    private function upload( $field ) { 

        $options = get_option( $field['section'] );
        $file = ( isset( $options[$field['id']] ) ) ? $options[$field['id']] : ''; ?>

            <div class="upload">
                <p><img src="<?php echo $file; ?>" class="upload-image <?php echo ( ! $file ) ? 'hidden': ''; ?>" alt="<?php echo $file; ?>"></p>

                <input type="hidden" name="<?php echo $this->field_name( $field ); ?>" value="<?php echo $file; ?>" class="upload-file">
                <button class="button upload-select" type="button"><?php _e( 'Select', 'mild' ); ?></button>
    
                <?php if ( isset( $field['description'] ) ) : ?>
                    <p><?php echo $field['description']; ?></p>
                <?php endif; ?>
            </div>

    <?php }

    /**
     * Load Scripts
     *
     * Loads all scripts.
     *
     * @access public
     * @return null
     */
    public function load_scripts() {

        wp_enqueue_media();

        add_action( 'admin_print_footer_scripts', function() { ?>

        <script>
            (function( $ ) {
                var Settings = {
                    init: function () {
                        // Handle upload
                        $( '.mild-settings' ).on( 'click', '.upload-select', this.selectUpload );
                    },
                    // Launch media manager
                    selectUpload : function( e ) {
                        e.preventDefault();
                        var upload  = $( this ).parents( '.upload' ),
                            frame = wp.media({ title: '<?php _e( 'Select a file', 'mild' ); ?>', multiple: false }).open();
                        // Load upload into setting
                        frame.on( 'close', function() {
                            var file = frame.state().get( 'selection' ).toJSON()[0];
                            upload.find( '.upload-image' ).attr( { 'src': file.url, 'alt': file.url } ).show();
                            upload.find( '.upload-file' ).val( file.url );
                        });
                    }
                };
                Settings.init();
            })( jQuery );
        </script>

    <?php });

    }

    /**
     * Get Tab
     *
     * Gets the current tab.
     *
     * @access private
     * @return string  $tab
     */
    private function get_tab() { 

        return ( isset( $_GET['tab'] ) ) ? $_GET['tab'] : $this->settings[0]['id'];

    }

    /**
     * Field Name
     *
     * Generates a field name.
     *
     * @access private
     * @param  string  $id
     * @return string  $name
     */
    private function field_name( $field ) { 

        return $field['section'] . '[' . $field['id'] . ']';

    }

    /**
     * Setting Name
     *
     * Generates a settings name.
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
     * Get Settings
     *
     * Gets the all settings within a section.
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
     * Gets a setting value.
     *
     * @access public
     * @param string  $name
     * @param string  $id
     * @param string  $field
     * @return string $setting
     */
    public static function get_setting( $name, $id, $field ) {

        $setting = get_option( self::setting_name( $name, $id ), false );
        if ( $setting && isset( $setting[$field] ) ) {
            $setting = $setting[$field];
        }
        return $setting;

    }

}
