<?php
/**
 * Plugin Name: Simple Shortcodes
 * Description: A set of simple shortcodes
 * Version: 1.0
 * Author: David Featherston
 *
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

// Define plugin path
if ( ! defined( 'SIMPLE_SHORTCODES_DIRECTORY' ) )
    define( 'SIMPLE_SHORTCODES_DIRECTORY', _m_PLUGINS_URI . basename( dirname( __FILE__) ) );

require_once 'inc/shortcodes.php';
require_once 'editor/editor.php';
