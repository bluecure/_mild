<?php
/**
 * Mild includes.
 *
 * @package Mild
 */

$mild_includes = [
    'helpers/settings.php',
    'helpers/sidebars.php',
    'helpers/post-types.php',
    'helpers/taxonomies.php',
    'helpers/user-roles.php',
    'theme/options.php',
    'theme/setup.php',
    'theme/tweaks.php',
    'theme/functions.php',
    'theme/template.php',
    'theme/fallbacks.php'
];

foreach( $mild_includes as $include ) {
    require_once( 'includes/' . $include );
}
