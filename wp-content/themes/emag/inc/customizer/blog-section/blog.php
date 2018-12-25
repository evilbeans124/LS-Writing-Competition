<?php
global $emag_panels;
global $emag_sections;
global $emag_settings_controls;
global $emag_repeated_settings_controls;
global $emag_customizer_defaults;

/*defaults values*/
$emag_customizer_defaults['emag-blog-enable'] = 1;
$emag_customizer_defaults['emag-blog-number'] = 4;
$emag_customizer_defaults['emag-blog-category'] = 1;

/*aboutoptions*/
$emag_sections['emag-blog-options'] =
    array(
        'priority'       => 230,
        'title'          => __( 'Home Blog Options', 'emag' ),
    );

$emag_settings_controls['emag-blog-enable'] =
    array(
        'setting' =>     array(
            'default'              => $emag_customizer_defaults['emag-blog-enable']
        ),
        'control' => array(
            'label'                 =>  __( 'Enable Blog', 'emag' ),
            'section'               => 'emag-blog-options',
            'type'                  => 'checkbox',
            'priority'              => 10,
            'active_callback'       => ''
        )
    );

$emag_settings_controls['emag-blog-number'] =
    array(
        'setting' =>     array(
            'default'              => $emag_customizer_defaults['emag-blog-number']
        ),
        'control' => array(
            'label'                 =>  __( 'Number Of Blog/s', 'emag' ),
            'description'           =>  __( 'Remember that featured post will not be counted', 'emag' ),
            'section'               => 'emag-blog-options',
            'type'                  => 'select',
            'choices'               => array(
                1 => __( '1', 'emag' ),
                2 => __( '2', 'emag' ),
                3 => __( '3', 'emag' ),
                4 => __( '4', 'emag' )
            ),
            'priority'              => 40,
            'active_callback'       => ''
        )
    );

/*creating setting control for emag-fs-Category start*/
$emag_settings_controls['emag-blog-category'] =
    array(
        'setting' =>     array(
            'default'              => $emag_customizer_defaults['emag-blog-category']
        ),
        'control' => array(
            'label'                 =>  __( 'Select Category For Blog', 'emag' ),
            'description'           =>  __( 'Blog will only displayed from this category', 'emag' ),
            'section'               => 'emag-blog-options',
            'type'                  => 'category_dropdown',
            'priority'              => 70,
            'active_callback'       => ''
        )
    );
