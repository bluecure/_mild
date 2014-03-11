<?php
/**
 * Constants and Includes
 *
 * @package Mild
 */

/**
* Constants
*/
define( 'MILD_DIRECTORY', get_template_directory() . '/' );
define( 'MILD_THEME', MILD_DIRECTORY . 'includes/MildTheme/' );
define( 'MILD_HELPERS', MILD_DIRECTORY . 'includes/MildHelpers/' );
define( 'MILD_PLUGINS', MILD_DIRECTORY . 'includes/MildPlugins/' );
define( 'MILD_OPTION_TREE', MILD_DIRECTORY . 'includes/OptionTree/' );
define( 'MILD_PLUGINS_URI', get_template_directory_uri() . '/includes/MildPlugins/' );

/**
* Theme helper classes.
*/
//require_once MILD_HELPERS . 'PostTypes.php';
//require_once MILD_HELPERS . 'Taxonomies.php';
//require_once MILD_HELPERS . 'UserRoles.php';

/**
* Theme setup, options, additions, functions and so on.
*/
require_once MILD_THEME . 'Setup.php';
require_once MILD_THEME . 'Options.php';
//require_once MILD_THEME . 'MetaBoxes.php';
//require_once MILD_THEME . 'Additions.php';
require_once MILD_THEME . 'Tweaks.php';
require_once MILD_THEME . 'Template.php';
require_once MILD_THEME . 'Functions.php';

/**
 * Theme plugins and widgets.
 */
require_once MILD_PLUGINS . 'Shortcodes/Shortcodes.php';
require_once MILD_PLUGINS . 'ImageWidget/ImageWidget.php';
require_once MILD_PLUGINS . 'GalleryWidget/GalleryWidget.php';
require_once MILD_PLUGINS . 'LatestPostsWidget/LatestPostsWidget.php';
