<?php
/**
 * Bow functions and files.
 *
 * @package Bow
 */

/**
 * Check WordPress and PHP versions.
 */
function bow_theme_check() {

    if ( version_compare( $GLOBALS['wp_version'], '4.5', '<' ) || version_compare( phpversion(), '5.4.0', '<' ) ) {
        // Add notice
        function bow_theme_notice() { ?>
            <div class="update-nag"><?php _e( 'This theme requires version 4.5+ of WordPress and 5.4.0+ of PHP.', 'bow' ); ?></div>
        <?php }
        add_action( 'admin_notices', 'bow_theme_notice' );
        // Revert to previous theme
        switch_theme( get_option( 'theme_switched' ) );
    }

}
add_action( 'after_switch_theme', 'bow_theme_check' );

/**
 * Bow includes.
 */
$bow_includes = [
    'helpers/customizer/controls.php',
    'helpers/customizer/register.php',
    'helpers/customizer/customizer.php',
    'helpers/meta-boxes/utilities.php',
    'helpers/meta-boxes/fields.php',
    'helpers/meta-boxes/register.php',
    'helpers/meta-boxes/meta-boxes.php',
    'helpers/sidebars.php',
    'theme/functions.php',
    'theme/setup.php',
    'theme/tweaks.php',
    'theme/customizer.php',
    'theme/meta-boxes.php',
    'theme/template.php',
    'theme/fallbacks.php'
];

foreach( $bow_includes as $include ) {
    require_once 'includes/' . $include;
}
