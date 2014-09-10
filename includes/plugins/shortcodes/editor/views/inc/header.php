<?php
/**
 * Header files
 */
define('WP_USE_THEMES', false);

// Get blog header path for include.
$ref = explode( '/', $_SERVER['REQUEST_URI'] );
$path = '/';

foreach ( $ref as $segment ) {
	if ( $segment !== '' && stripos( $segment, 'wp-' ) === false ) {
		$path .= $segment . '/';
		break;
	}
}
$url = $_SERVER['DOCUMENT_ROOT'] . $path;

require $url . 'wp-blog-header.php'; ?>

<link href="../css/popups.css" rel="stylesheet">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="../js/popups.js"></script>