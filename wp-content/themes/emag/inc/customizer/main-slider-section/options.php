<?php
global $emag_panels;
global $emag_sections;
global $emag_settings_controls;
global $emag_repeated_settings_controls;
global $emag_customizer_defaults;

/*defaults values feature trip options*/
$emag_customizer_defaults['emag-feature-slider-enable'] = 1;
$emag_customizer_defaults['emag-feature-slider-number'] = 3;
$emag_customizer_defaults['emag-featured-slider-category'] = 1;
$emag_customizer_defaults['emag-fs-slider-mode'] = 'fadeout';
$emag_customizer_defaults['emag-fs-slider-time'] = 2;
$emag_customizer_defaults['emag-fs-slider-pause-time'] = 5;
$emag_customizer_defaults['emag-fs-enable-arrow'] = 1;
$emag_customizer_defaults['emag-fs-enable-autoplay'] = 1;
$emag_customizer_defaults['emag-fs-enable-title'] = 1;

/*feature slider enable setting*/
$emag_sections['emag-feature-section-options'] =
    array(
        'priority'       => 10,
        'title'          => __( 'Setting Options', 'emag' ),
        'panel'          => 'emag-feature-slider',
    );

/*Feature section enable control*/
$emag_settings_controls['emag-feature-slider-enable'] =
    array(
        'setting' =>     array(
            'default'              => $emag_customizer_defaults['emag-feature-slider-enable']
        ),
        'control' => array(
            'label'                 =>  __( 'Enable Feature Slider', 'emag' ),
            'section'               => 'emag-feature-section-options',
        	'description'    		=> __( 'Enable "Feature slider" on checked' , 'emag' ),
            'type'                  => 'checkbox',
            'priority'              => 10,
            'active_callback'       => ''
        )
    );

/*No of feature slider selection*/
$emag_settings_controls['emag-feature-slider-number'] =
    array(
        'setting' =>     array(
            'default'              => $emag_customizer_defaults['emag-feature-slider-number']
        ),
        'control' => array(
            'label'                 =>  __( 'Number Of Slider', 'emag' ),
            'description'           => __( 'You need to have more than three post on that category to make slider section working properly' , 'emag' ),
            'section'               => 'emag-feature-section-options',
            'type'                  => 'select',
            'choices'               => array(
                1 => __( '1', 'emag' ),
                2 => __( '2', 'emag' ),
                3 => __( '3', 'emag' ),
                4 => __( '4', 'emag' )
            ),
            'priority'              => 20,
            'active_callback'       => ''
        )
    );


/*creating setting control for emag-fs-Category start*/
$emag_settings_controls['emag-featured-slider-category'] =
    array(
        'setting' =>     array(
            'default'              => $emag_customizer_defaults['emag-featured-slider-category']
        ),
        'control' => array(
            'label'                 =>  __( 'Select Category For Slider', 'emag' ),
            'description'           =>  __( 'If you have only choosen category then slider will dispaly form it, if not then will display latest post', 'emag' ),
            'section'               => 'emag-feature-section-options',
            'type'                  => 'category_dropdown',
            'priority'              => 30,
            'active_callback'       => ''
        )
    );