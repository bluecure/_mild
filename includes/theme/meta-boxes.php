<?php
/**
 * Add all meta boxes.
 *
 * @package Bow
 */

use Lambry\Bow\Helpers\Meta_Boxes\Meta_Boxes as Meta_Boxes;

add_action( 'init', function() {

	// Create array
	$fields = [
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
						]
					]
				]
			]
		]
	];

	// Register meta boxes
	$meta_boxes = new Meta_Boxes( $fields );

} );
