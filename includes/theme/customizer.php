<?php
/**
 * Add all theme controls.
 *
 * @package Bow
 */

use Lambry\Bow\Helpers\Customizer\Customizer as Customizer;

add_action( 'init', function() {

	// Create controls
	$controls = [
		[
			'id'          => 'visual',
			'title'       => __( 'Visuals', 'bow' ),
			'description' => __( 'Your sites visual options.', 'bow' ),
			'priority'    => 21,
			'sections'    => [
				[
					'id'          => 'text_colors',
					'title'       => __( 'Text Colors', 'bow' ),
					'description' => __( 'Your sites text colors.', 'bow' ),
					'priority'    => 1,
					'settings'    => [
						[
							'id'    => 'header_text',
							'label' => 'Header Text',
							'type'  => 'color'
						], [
							'id'    => 'content_text',
							'label' => 'Content Text',
							'type'  => 'color'
						], [
							'id'    => 'footer_text',
							'label' => 'Footer Text',
							'type'  => 'color'
						]
					]
				], [
					'id'          => 'link_colors',
					'title'       => __( 'Link Colors', 'bow' ),
					'description' => __( 'Your sites link colors.', 'bow' ),
					'priority'    => 2,
					'settings'    => [
						[
							'id'    => 'header_links',
							'label' => 'Header Links',
							'type'  => 'color'
						], [
							'id'    => 'content_links',
							'label' => 'Content Links',
							'type'  => 'color'
						], [
							'id'    => 'footer_links',
							'label' => 'Footer Links',
							'type'  => 'color'
						]
					]
				], [
					'id'          => 'background_colors',
					'title'       => __( 'Background Colors', 'bow' ),
					'description' => __( 'Your sites background colors.', 'bow' ),
					'priority'    => 3,
					'settings'    => [
						[
							'id'    => 'header_background',
							'label' => 'Header Background',
							'type'  => 'color'
						], [
							'id'    => 'content_background',
							'label' => 'Content Background',
							'type'  => 'color'
						], [
							'id'    => 'footer_background',
							'label' => 'Footer Background',
							'type'  => 'color'
						]
					]
				]
			]
		], [
			'id'          => 'content',
			'title'       => __( 'Content', 'bow' ),
			'description' => __( 'You sites content options.', 'bow' ),
			'priority'    => 22,
			'sections'    => [
				[
				   'id'          => 'settings',
				   'title'       => __( 'Settings', 'bow' ),
				   'description' => __( 'Your sites custom settings.', 'bow' ),
				   'priority'    => 1,
				   'settings'    => [
					   [
						   'id'          => 'display_tagline',
						   'label'       => __( 'Display Tagline', 'bow' ),
						   'description' => __( 'Display tagline in sites header.', 'bow' ),
						   'type'        => 'checkbox'
					   ], [
						   'id'          => 'archive_full',
						   'label'       => __( 'Complete Archive Content', 'bow' ),
						   'description' => __( 'Display complete content on blog and archives pages.', 'bow' ),
						   'type'        => 'checkbox'
					   ]
				   ]
			   ], [
					'id'          => 'social',
					'title'       => __( 'Social Links', 'bow' ),
					'description' => __( 'Your sites social links.', 'bow' ),
					'priority'    => 2,
					'settings'    => [
						[
							'id'    => 'facebook',
							'label' => __( 'Facebook Url', 'bow' ),
							'type'  => 'text'
						], [
							'id'    => 'twitter',
							'label' => __( 'Twitter Url', 'bow' ),
							'type'  => 'text'
						], [
							'id'    => 'google_plus',
							'label' => __( 'Google Plus Url', 'bow' ),
							'type'  => 'text'
						], [
							'id'    => 'linkedin',
							'label' => __( 'LinkedIn Url', 'bow' ),
							'type'  => 'text'
						], [
							'id'    => 'instagram',
							'label' => __( 'Instagram Url', 'bow' ),
							'type'  => 'text'
						], [
							'id'    => 'flickr',
							'label' => __( 'Flickr Url', 'bow' ),
							'type'  => 'text'
						], [
							'id'    => 'youtube',
							'label' => __( 'Youtube Url', 'bow' ),
							'type'  => 'text'
						], [
							'id'    => 'vimeo',
							'label' => __( 'Vimeo Url', 'bow' ),
							'type'  => 'text'
						]
					]
				], [
					'id'          => 'custom_code',
					'title'       => __( 'Custom Code', 'bow' ),
					'description' => __( 'Your sites custom JavaScript.', 'bow' ),
					'priority'    => 3,
					'settings'    => [
						[
							'id'          => 'javascript',
							'label'       => __( 'JavaScript', 'bow' ),
							'description' => __( 'i.e. Google Analytics without script tags.', 'bow' ),
							'type'        => 'textarea'
						]
					]
				]
			]
		]
	];

	// Register customizer controls
	$customizer = new Customizer( $controls );

} );
