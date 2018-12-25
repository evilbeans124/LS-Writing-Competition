<?php
global $emag_sections;
global $emag_settings_controls;
global $emag_repeated_settings_controls;
global $emag_customizer_defaults;

/*defaults values*/
$emag_customizer_defaults['emag-default-banner-image'] = '';
$emag_customizer_defaults['emag-default-layout'] = 'right-sidebar';
$emag_customizer_defaults['emag-single-post-image-align'] = 'full';
$emag_customizer_defaults['emag-excerpt-length'] = '50';
$emag_customizer_defaults['emag-archive-layout'] = 'thumbnail-and-excerpt';
$emag_customizer_defaults['emag-archive-image-align'] = 'full';

$emag_sections['emag-layout-options'] =
    array(
        'priority'       => 20,
        'title'          => __( 'Layout Options', 'emag' ),
        'panel'          => 'emag-theme-options',
    );

/*layout-options option responsive lodader start*/
/*creating setting control for emag-layout-options start*/
$emag_settings_controls['emag-default-banner-image'] =
    array(
        'setting' =>     array(
            'default'              => $emag_customizer_defaults['emag-default-banner-image'],
        ),
        'control' => array(
            'label'                 =>  __( 'Default Banner Image', 'emag' ),
            'description'           =>  __( 'Please note that if you remove this image default banner image will appear', 'emag' ),
            'section'               => 'emag-layout-options',
            'type'                  => 'image',
            'priority'              => 20,
        )
    );

$emag_settings_controls['emag-default-layout'] =
    array(
        'setting' =>     array(
            'default'              => $emag_customizer_defaults['emag-default-layout'],
        ),
        'control' => array(
            'label'                 =>  __( 'Default Layout', 'emag' ),
            'description'           =>  __( 'Please note that this section can be overridden for individual page/posts', 'emag' ),
            'section'               => 'emag-layout-options',
            'type'                  => 'select',
            'choices'               => array(
                'right-sidebar' => __( 'Content - Primary Sidebar', 'emag' ),
                'left-sidebar' => __( 'Primary Sidebar - Content', 'emag' ),
                'no-sidebar' => __( 'No Sidebar', 'emag' )
            ),
            'priority'              => 10,
            'active_callback'       => ''
        )
    );


$emag_settings_controls['emag-single-post-image-align'] =
    array(
        'setting' =>     array(
            'default'              => $emag_customizer_defaults['emag-single-post-image-align'],
        ),
        'control' => array(
            'label'                 =>  __( 'Alignment Of Image In Single Post/Page', 'emag' ),
            'section'               => 'emag-layout-options',
            'type'                  => 'select',
            'choices'               => array(
                'full' => __( 'Full', 'emag' ),
                'right' => __( 'Right', 'emag' ),
                'left' => __( 'Left', 'emag' ),
                'no-image' => __( 'No image', 'emag' )
            ),
            'priority'              => 40,
            'description'           =>  __( 'Please note that this setting can be override from individual post/page', 'emag' ),
        )
    );

    $emag_settings_controls['emag-excerpt-length'] =
        array(
            'setting' =>     array(
                'default'              => $emag_customizer_defaults['emag-excerpt-length'],
            ),
            'control' => array(
                'label'                 =>  __( 'Excerpt Length (in words)', 'emag' ),
                'section'               => 'emag-layout-options',
                'type'                  => 'number',
                'priority'              => 40,
            )
        );

        $emag_settings_controls['emag-archive-layout'] =
            array(
                'setting' =>     array(
                    'default'              => $emag_customizer_defaults['emag-archive-layout'],
                ),
                'control' => array(
                    'label'                 =>  __( 'Archive Layout', 'emag' ),
                    'section'               => 'emag-layout-options',
                    'type'                  => 'select',
                    'choices'               => array(
                        'excerpt-only' => __( 'Excerpt Only', 'emag' ),
                        'thumbnail-and-excerpt' => __( 'Thumbnail and Excerpt', 'emag' ),
                        'full-post' => __( 'Full Post', 'emag' ),
                        'thumbnail-and-full-post' => __( 'Thumbnail and Full Post', 'emag' ),
                    ),
                    'priority'              => 55,
                )
            );