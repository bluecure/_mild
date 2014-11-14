<?php
/**
 * Add all theme controls.
 *
 * @package Mild
 */

add_action( 'init', function() {

    // Create controls array
    $controls = [
         [
            'id' => 'visual',
            'title' => __( 'Visual', 'mild' ),
            'description' => __( 'Here you can change your logo favicon and so on.', 'mild' ),
            'priority' => 1,
            'sections' => [
                [
                    'id' => 'images',
                    'title' => __( 'Images', 'mild' ),
                    'description' => __( 'Your sites images.', 'mild' ),
                    'priority' => 10,
                    'settings' => [
                        [
                            'id'    => 'logo',
                            'label' => __( 'Logo', 'mild' ),
                            'type'  => 'image'
                        ], [
                            'id'          => 'favicon',
                            'label'       => __( 'Favicon', 'mild' ),
                            'description' => '32px X 32px',
                            'type'        => 'image'
                        ], [
                            'id'          => 'appicon',
                            'label'       => __( 'App Icon', 'mild' ),
                            'description' => '192px X 192px',
                            'type'        => 'image'
                        ]
                    ]
                ], [
                    'id' => 'background_colors',
                    'title' => __( 'Background Colors', 'mild' ),
                    'description' => __( 'Here you can change your sites background colors.', 'mild' ),
                    'priority' => 15,
                    'settings' => [
                        [
                            'id' => 'background',
                            'label' => 'Background',
                            'type'  => 'color'
                        ]
                    ]
                ]
            ]
        ], [
            'id' => 'content',
            'title' => __( 'Content', 'mild' ),
            'description' => __( 'Here you can change social link and add custom code.', 'mild' ),
            'priority' => 2,
            'sections' => [
                [
                    'id' => 'social',
                    'title' => __( 'Social Links.', 'mild' ),
                    'description' => __( 'Your sites social links.', 'mild' ),
                    'priority' => 10,
                    'settings' => [
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
                        ]
                    ]
                ], [
                    'id' => 'custom_code',
                    'title' => __( 'Custom Code', 'mild' ),
                    'description' => __( 'Your sites custom CSS and JavaScript.', 'mild' ),
                    'priority' => 15,
                    'settings' => [
                        [
                            'id'          => 'css',
                            'label'       => __( 'CSS', 'mild' ),
                            'description' => __( 'i.e. CSS without style tags.', 'mild' ),
                            'type'        => 'textarea'
                        ], [
                            'id'          => 'javascript',
                            'label'       => __( 'JavaScript', 'mild' ),
                            'description' => __( 'i.e. Google Analytics without script tags.', 'mild' ),
                            'type'        => 'textarea'
                        ]
                    ]
                ]
            ]
        ]
    ];

    // Register customizer controls
    new Mild\Customizer( $controls );

});
