<?php
/**
 * Custom theme options
 *
 * @package _m
 */

/**
* Initialize the options before anything else.
*/
add_action( 'admin_init', '_m_theme_options', 1 );

function _m_theme_options() {

    /**
    * Get a copy of the saved settings array.
    */
    $saved_settings = get_option( 'option_tree_settings', array() );

    /**
    * Create a custom settings array that we pass to
    * the OptionTree Settings API Class.
    */
    $theme_settings = array(
        'sections' => array(
            array(
                'title' => 'General',
                'id' => 'ot_general'
            ),
            array(
                'title' => 'Home',
                'id' => 'ot_home'
            ),
            array(
                'title' => 'Social',
                'id' => 'ot_social'
            )
        ),
        'settings' => array(
            array(
                'label' => 'Logo',
                'id' => 'ot_logo',
                'type' => 'upload',
                'section' => 'ot_general'
            ),
            array(
                'label' => 'Custom CSS',
                'id' => 'ot_css',
                'type' => 'textarea-simple',
                'desc' => 'Put any custom CSS here, without the style tags.',
                'section' => 'ot_general'
            ),
            array(
                'label' => 'Analytics code',
                'id' => 'ot_analytics',
                'type' => 'textarea-simple',
                'desc' => 'Paste in your full Analytics code here, without the script tags.',
                'section' => 'ot_general'
            ),

            array(
                'label' => 'Home page slider',
                'id' => 'ot_main_slider',
                'type' => 'slider',
                'desc' => 'This is the main slider that will display at the top of your sites home page.',
                'section' => 'ot_home'
            ),

            array(
                'label' => 'Facebook Url',
                'id' => 'ot_facebook',
                'type' => 'text',
                'section' => 'ot_social'
            ),
            array(
                'label' => 'Twitter Url',
                'id' => 'ot_twitter',
                'type' => 'text',
                'section' => 'ot_social'
            ),
            array(
                'label' => 'Google Plus Url',
                'id' => 'ot_google_plus',
                'type' => 'text',
                'section' => 'ot_social'
            ),
            array(
                'label' => 'LinkenIn Url',
                'id' => 'ot_linkedin',
                'type' => 'text',
                'section' => 'ot_social'
            ),
            array(
                'label' => 'Pinterest Url',
                'id' => 'ot_pinterest',
                'type' => 'text',
                'section' => 'ot_social'
            ),
            array(
                'label' => 'Flickr Url',
                'id' => 'ot_flickr',
                'type' => 'text',
                'section' => 'ot_social'
            ),
            array(
                'label' => 'Instagram Url',
                'id' => 'ot_instagram',
                'type' => 'text',
                'section' => 'ot_social'
            ),
            array(
                'label' => 'YouTube Url',
                'id' => 'ot_youtube',
                'type' => 'text',
                'section' => 'ot_social'
            ),
            array(
                'label' => 'Vimeo Url',
                'id' => 'ot_vimeo',
                'type' => 'text',
                'section' => 'ot_social'
            )

        )
    );

    /* allow settings to be filtered before saving */
    $theme_settings = apply_filters( 'option_tree_settings_args', $theme_settings );

    /* settings are not the same update the DB */
    if ( $saved_settings !== $theme_settings ) {
        update_option( 'option_tree_settings', $theme_settings );
    }

}
