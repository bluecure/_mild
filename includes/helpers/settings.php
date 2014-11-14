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

        // Add admin assets
        add_action( 'admin_enqueue_scripts', [ $this, 'load_assets' ] );

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
                $this->page = add_menu_page( $this->title, $this->menu_title, 'manage_options', $this->title_clean, [ $this, 'register_page' ] );
                break;

            case 'theme':
                $this->page = add_theme_page( $this->title, $this->menu_title, 'manage_options', $this->title_clean, [ $this, 'register_page' ] );
                break;

            case 'option':
                $this->page = add_options_page( $this->title, $this->menu_title, 'manage_options', $this->title_clean, [ $this, 'register_page' ] );
                break;

            case 'submenu':
                $this->page = add_submenu_page( $this->menu, $this->title, $this->menu_title, 'manage_options', $this->title_clean,  [ $this, 'register_page' ] );
                break;
        }

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
                echo "<p class='section-descripion'>{$setting['description']}</p>";
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

            case 'radio':
                $this->radio( $field );
                break;

            case 'checkbox':
                $this->checkbox( $field );
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
            <p class="setting-description"><?php echo $field['description']; ?></p>
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
            <p class="setting-description"><?php echo $field['description']; ?></p>
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
            <p class="setting-description"><?php echo $field['description']; ?></p>
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
            <p class="setting-description"><?php echo $field['description']; ?></p>
        <?php endif;

    }

    /**
     * Radio
     *
     * Generates a list of radio buttons.
     *
     * @access private
     * @param  array $field
     * @return null
     */
    private function radio( $field ) { 

        $options = get_option( $field['section'] );
        $option = ( isset( $options[$field['id']] ) ) ? $options[$field['id']] : ''; ?>
        
        <?php foreach( $field['choices'] as $value => $label ) : ?>
            <label name="<?php echo $this->field_name( $field ); ?>"><?php echo $label; ?></label>
            <input type="radio" name="<?php echo $this->field_name( $field ); ?>" id="<?php echo $this->field_name( $field ); ?>" value="<?php echo $value; ?>" <?php checked( $option, $value ); ?>>
        <?php endforeach; ?>

        <?php if ( isset( $field['description'] ) ) : ?>
            <p class="setting-description"><?php echo $field['description']; ?></p>
        <?php endif;

    }

    /**
     * Checkbox
     *
     * Generates a list of checkboxs.
     *
     * @access private
     * @param  array $field
     * @return null
     */
    private function checkbox( $field ) { 

        $options = get_option( $field['section'] );
        $option = ( isset( $options[$field['id']] ) ) ? $options[$field['id']] : ''; ?>

        <?php $i = 1; foreach( $field['choices'] as $value => $label ) : ?>
            <label name="<?php echo $this->field_name( $field ); ?>"><?php echo $label; ?></label>
            <input type="checkbox" name="<?php echo $this->field_name( $field ) . "[{$i}]"; ?>" id="<?php echo $this->field_name( $field ); ?>" value="<?php echo $value; ?>" <?php checked( $option[$i], $value ); ?>>
        <?php $i++; endforeach; ?>

        <?php if ( isset( $field['description'] ) ) : ?>
            <p class="setting-description"><?php echo $field['description']; ?></p>
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
                <div class="upload-image <?php echo ( ! $file ) ? 'hide': ''; ?>">
                    <img src="<?php echo $file; ?>" alt="<?php echo $file; ?>">
                    <i class="upload-remove dashicons dashicons-no-alt"></i>
                </div>

                <input type="hidden" name="<?php echo $this->field_name( $field ); ?>" value="<?php echo $file; ?>" class="upload-file">
                <button class="button upload-select" type="button"><?php _e( 'Select', 'mild' ); ?></button>
    
                <?php if ( isset( $field['description'] ) ) : ?>
                    <p class="setting-description"><?php echo $field['description']; ?></p>
                <?php endif; ?>
            </div>

    <?php }

    /**
     * Load Assets
     *
     * Loads all assets.
     *
     * @access public
     * @param  string $hook
     * @return null
     */
    public function load_assets( $hook ) {

        if ( $this->page !== $hook )
            return;

        // Load settings css
        wp_enqueue_style( 'mild-settings-style', get_template_directory_uri() . '/assets/admin/styles/settings.css', [], '0.1.0' );
        // Load media assets
        wp_enqueue_media();
        // Load settings js
        wp_enqueue_script( 'mild-settings-scripts', get_template_directory_uri() . '/assets/admin/scripts/settings.js', ['jquery'], '0.1.0', true );

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
     * @param  string  $field
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
