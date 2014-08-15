<?php
/**
 * Mild includes
 *
 * @package Mild
 */

$mild_includes = [
    'helpers/post-types.php',
    'helpers/taxonomies.php',
    'helpers/user-roles.php',
    'helpers/sidebars.php',
    'options/ot-loader.php',
    'theme/setup.php',
    'theme/tweaks.php',
    'theme/options.php',
    'theme/functions.php',
    'theme/template.php',
    'theme/meta-boxes.php',
    'plugins/shortcodes/shortcodes.php',
    'plugins/image-widget/image-widget.php',
    'plugins/latest-posts-widget/latest-posts-widget.php'
];

foreach( $mild_includes as $include ) {
    require_once( 'includes/' . $include );
}
