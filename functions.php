<?php
/**
 * Bow functions.
 *
 * @package Bow
 */

/**
 * Check WordPress and PHP versions.
 */
function bow_theme_check() {

    if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) || version_compare( phpversion(), '5.4.0', '<' ) ) {
        // Add notice
        function bow_theme_notice() { ?>
            <div class="update-nag"><?php _e( 'This theme requires version 4.1 of WordPress and 5.4.0 of PHP.', 'bow' ); ?></div>
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
    'helpers/customizer.php',
    'helpers/meta-boxes.php',
    'helpers/sidebars.php',
    'theme/functions.php',
    'theme/setup.php',
    'theme/controls.php',
    'theme/custom-fields.php',
    'theme/tweaks.php',
    'theme/template.php',
    'theme/fallbacks.php'
];

foreach( $bow_includes as $include ) {
    require_once 'includes/' . $include;
}
