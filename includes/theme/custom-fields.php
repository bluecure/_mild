<?php
/**
 * Add all meta boxes.
 *
 * @package Bow
 */

namespace Lambry\Bow;

add_action( 'init', function() {

	// Create meta box array
	$meta_boxes = [
		[
			'id'          => 'section_bottom',
			'title'       => __( 'Bottom Section', 'bow' ),
			'fields'      => [
				[
					'id'     => 'bottom_tiles',
					'label'  => __( 'Tiles', 'bow' ),
					'description' => __( 'Small blocks of content displayed in a grid layout.', 'bow' ),
					'type'   => 'repeater',
					'fields' => [
						[
							'id'    => 'title',
							'label' => __( 'Title', 'bow' ),
							'type'  => 'text'
						], [
							'id'    => 'image',
							'label' => __( 'Image', 'bow' ),
							'type'  => 'upload'
						], [
							'id'    => 'content',
							'label' => __( 'Content', 'bow' ),
							'type'  => 'textarea'
						], [
							'id'     => 'on_off2',
							'label'  => __( 'On Off', 'bow' ),
							'type'   => 'on_off'
						]
					]
				]
			]
		], [
			'id'          => 'test',
			'context'     => 'side',
			'priority' => 'default',
			'title'       => __( 'Test Section', 'bow' ),
			'fields'      => [
				[
					'id'     => 'on_off',
					'label'  => __( 'On Off', 'bow' ),
					'type'   => 'on_off'
				]
			]
		]
	];

	// Register meta boxes
	new Meta_Boxes( $meta_boxes );

} );
