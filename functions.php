<?php
/**
 * _m definitions and includes
 *
 * @package _m
 */

/**
* Constants
*/
define( '_m_DIRECTORY', get_template_directory() . '/' );
define( '_m_THEME', _m_DIRECTORY . 'includes/theme/' );
define( '_m_HELPERS', _m_DIRECTORY . 'includes/helpers/' );
define( '_m_PLUGINS', _m_DIRECTORY . 'includes/plugins/' );
define( '_m_OPTION_TREE', _m_DIRECTORY . 'includes/option-tree/' );
define( '_m_PLUGINS_URI', get_template_directory_uri() . '/includes/plugins/' );

/**
* Theme setup, options, additions, functions and so on.
*/
require_once _m_THEME . 'setup.php';
require_once _m_THEME . 'options.php';
//require_once _m_THEME . 'meta-boxes.php';
//require_once _m_THEME . 'additions.php';
require_once _m_THEME . 'tweaks.php';
require_once _m_THEME . 'template.php';
require_once _m_THEME . 'functions.php';

/**
 * Theme plugins and widgets
 */
require_once _m_PLUGINS . 'shortcodes/shortcodes.php';
require_once _m_PLUGINS . 'image-widget/image-widget.php';
require_once _m_PLUGINS . 'gallery-widget/gallery-widget.php';
require_once _m_PLUGINS . 'latest-posts-widget/latest-posts-widget.php';
