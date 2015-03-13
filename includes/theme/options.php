<?php
/**
 * Add all theme options.
 *
 * @package Mild
 */

add_action( 'init', function() {

	// Create options array
	$theme_options = [
		[
			'id'          => 'general',
			'title'       => __( 'General', 'mild' ),
			'description' => __( 'Main theme options.', 'mild' ),
			'fields'      => [
				[
					'id'    => 'logo',
					'label' => __( 'Logo', 'mild' ),
					'type'  => 'upload'
				], [
					'id'          => 'favicon',
					'label'       => __( 'Favicon', 'mild' ),
					'description' => '32px X 32px',
					'type'        => 'upload'
				], [
					'id'          => 'appicon',
					'label'       => __( 'App Icon', 'mild' ),
					'description' => '192px X 192px',
					'type'        => 'upload'
				], [
					'id'          => 'css',
					'label'       => __( 'CSS', 'mild' ),
					'description' => __( 'i.e. Custom CSS without style tags.', 'mild' ),
					'type'        => 'textarea'
				], [
					'id'          => 'javascript',
					'label'       => __( 'JavaScript', 'mild' ),
					'description' => __( 'i.e. Google Analytics without script tags.', 'mild' ),
					'type'        => 'textarea'
				]
			]
		],
		[
			'id'          => 'social',
			'title'       => __( 'Social', 'mild' ),
			'description' => __( 'Social website links.', 'mild' ),
			'fields'      => [
				[
					'id'    => 'facebook',
					'label' => __( 'Facebook Url', 'mild' ),
					'type'  => 'text'
				], [
					'id'    => 'twitter',
					'label' => __( 'Twitter Url', 'mild' ),
					'type'  => 'text'
				], [
					'id'    => 'google-plus',
					'label' => __( 'Google Plus Url', 'mild' ),
					'type'  => 'text'
				], [
					'id'    => 'linkedin',
					'label' => __( 'LinkedIn Url', 'mild' ),
					'type'  => 'text'
				], [
					'id'    => 'instagram',
					'label' => __( 'Instagram Url', 'mild' ),
					'type'  => 'text'
				], [
					'id'    => 'flickr',
					'label' => __( 'Flickr Url', 'mild' ),
					'type'  => 'text'
				], [
					'id'    => 'youtube',
					'label' => __( 'Youtube Url', 'mild' ),
					'type'  => 'text'
				], [
					'id'    => 'vimeo',
					'label' => __( 'Vimeo Url', 'mild' ),
					'type'  => 'text'
				]
			]
		]
	];

	// Register theme options
	new Mild\Settings( 'theme', $theme_options, __( 'Theme Options', 'mild' ) );

} );
