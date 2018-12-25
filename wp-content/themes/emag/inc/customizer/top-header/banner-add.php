<?php
global $emag_panels;
global $emag_sections;
global $emag_settings_controls;
global $emag_repeated_settings_controls;
global $emag_customizer_defaults;

/*creating panel for fonts-setting*/
$emag_panels['emag-top-header-section'] =
    array(
        'title'          => __( 'Header Section Settings', 'emag' ),
        'priority'       => 190
    );

$emag_sections['emag-feature-header-section'] =
    array(
        'priority'       => 40,
        'title'          => __( 'Top Header Settings', 'emag' ),
        'panel'         => 'emag-top-header-section',
    );

$emag_sections['emag-feature-add'] =
    array(
        'priority'       => 50,
        'title'          => __( 'Header Advertisement Settings', 'emag' ),
        'panel'         => 'emag-top-header-section',
    );

$emag_customizer_defaults['emag-header-add'] = '';
$emag_customizer_defaults['emag-home-header-add-link'] = '#';
$emag_customizer_defaults['emag-header-enable-search'] = 1;
$emag_customizer_defaults['emag-header-enable-random'] = 1;
$emag_customizer_defaults['emag-header-enable-home-link'] = 1;
$emag_customizer_defaults['emag-header-enable-tinker'] = 1;
$emag_customizer_defaults['emag-header-tinker-title'] = __('Latest','emag');
$emag_customizer_defaults['emag-header-no-of-tinker'] = 5;
$emag_customizer_defaults['emag-header-enable-date'] = 1;


$emag_settings_controls['emag-header-enable-search'] =
array(
    'setting' =>     array(
        'default'              => $emag_customizer_defaults['emag-header-enable-search'],
    ),
    'control' => array(
        'label'                 =>  __( 'Enable Search', 'emag' ),
        'section'               => 'emag-feature-header-section',
        'type'                  => 'checkbox',
        'priority'              => 40,
    )
);


$emag_settings_controls['emag-header-enable-random'] =
array(
    'setting' =>     array(
        'default'              => $emag_customizer_defaults['emag-header-enable-random'],
    ),
    'control' => array(
        'label'                 =>  __( 'Enable Random', 'emag' ),
        'section'               => 'emag-feature-header-section',
        'type'                  => 'checkbox',
        'priority'              => 40,
    )
);


$emag_settings_controls['emag-header-enable-home-link'] =
array(
    'setting' =>     array(
        'default'              => $emag_customizer_defaults['emag-header-enable-home-link'],
    ),
    'control' => array(
        'label'                 =>  __( 'Enable Home', 'emag' ),
        'section'               => 'emag-feature-header-section',
        'type'                  => 'checkbox',
        'priority'              => 45,
    )
);

$emag_settings_controls['emag-header-enable-date'] =
array(
    'setting' =>     array(
        'default'              => $emag_customizer_defaults['emag-header-enable-date'],
    ),
    'control' => array(
        'label'                 =>  __( 'Enable Date', 'emag' ),
        'section'               => 'emag-feature-header-section',
        'type'                  => 'checkbox',
        'priority'              => 35   ,
    )
);

$emag_settings_controls['emag-header-enable-tinker'] =
array(
    'setting' =>     array(
        'default'              => $emag_customizer_defaults['emag-header-enable-tinker'],
    ),
    'control' => array(
        'label'                 =>  __( 'Header Tiker Enable', 'emag' ),
        'section'               => 'emag-feature-header-section',
        'type'                  => 'checkbox',
        'priority'              => 20,
    )
);

$emag_settings_controls['emag-header-tinker-title'] =
array(
    'setting' =>     array(
        'default'              => $emag_customizer_defaults['emag-header-tinker-title'],
    ),
    'control' => array(
        'label'                 =>  __( 'Header Tinker Title', 'emag' ),
        'section'               => 'emag-feature-header-section',
        'type'                  => 'text',
        'priority'              => 25,
    )
);

$emag_settings_controls['emag-header-no-of-tinker'] =
array(
    'setting' =>     array(
        'default'              => $emag_customizer_defaults['emag-header-no-of-tinker'],
    ),
    'control' => array(
        'label'                 =>  __( 'No of Tinker to Display', 'emag' ),
        'section'               => 'emag-feature-header-section',
        'type'                  => 'number',
        'priority'              => 30,
        'active_callback'       => '',
        'input_attrs' => array( 'min' => 1, 'max' => 20),
    )
);

/*creating setting control for emag-layout-options start*/
$emag_settings_controls['emag-header-add'] =
    array(
        'setting' =>     array(
            'default'              => $emag_customizer_defaults['emag-header-add'],
        ),
        'control' => array(
            'label'                 =>  __( 'Header Banner Addvertise', 'emag' ),
            'description'           =>  __( 'Upload Image to be on header banner', 'emag' ),
            'section'               => 'emag-feature-add',
            'type'                  => 'image',
            'priority'              => 20,
        )
    );


/*header banner url*/
$emag_settings_controls['emag-home-header-add-link'] =
array(
    'setting' =>     array(
        'default'              => $emag_customizer_defaults['emag-home-header-add-link']
    ),
    'control' => array(
        'label'                 =>  __( 'Redirect Advertisement URL', 'emag' ),
        'section'               => 'emag-feature-add',
        'type'                  => 'url',
        'priority'              => 60,
        'active_callback'       => ''
    )
);


