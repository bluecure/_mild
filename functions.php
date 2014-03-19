<?php
/**
 * Constants and Includes
 *
 * @package Mild
 */

/**
* Constants
*/
define( 'MILD_INCLUDES', get_template_directory() . '/includes/' );
define( 'MILD_THEME', MILD_INCLUDES . 'theme/' );
define( 'MILD_HELPERS', MILD_INCLUDES . 'helpers/' );
define( 'MILD_OPTIONS', MILD_INCLUDES . 'options/' );
define( 'MILD_PLUGINS', MILD_INCLUDES . 'plugins/' );
define( 'MILD_PLUGINS_URI', get_template_directory_uri() . '/includes/plugins/' );

/**
* Theme helper classes.
*/
//require_once MILD_HELPERS . 'post-types.php';
//require_once MILD_HELPERS . 'taxonomies.php';
//require_once MILD_HELPERS . 'user-roles.php';
require_once MILD_HELPERS . 'functions.php';
require_once MILD_HELPERS . 'template.php';

/**
* Theme setup, options, additions, functions and so on.
*/
require_once MILD_THEME . 'setup.php';
require_once MILD_THEME . 'tweaks.php';
require_once MILD_THEME . 'options.php';
//require_once MILD_THEME . 'meta-boxes.php';
//require_once MILD_THEME . 'additions.php';

/**
 * Theme plugins and widgets.
 */
require_once MILD_PLUGINS . 'shortcodes/shortcodes.php';
require_once MILD_PLUGINS . 'image-widget/image-widget.php';
require_once MILD_PLUGINS . 'gallery-widget/gallery-widget.php';
require_once MILD_PLUGINS . 'latest-posts-widget/latest-posts-widget.php';
