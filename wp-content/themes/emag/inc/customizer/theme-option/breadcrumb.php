<?php
global $emag_sections;
global $emag_settings_controls;
global $emag_repeated_settings_controls;
global $emag_customizer_defaults;

/*defaults values*/
$emag_customizer_defaults['emag-enable-breadcrumb'] = 1;

$emag_sections['emag-breadcrumb-options'] =
    array(
        'priority'       => 50,
        'title'          => __( 'Breadcrumb Options', 'emag' ),
        'panel'          => 'emag-theme-options',
    );

$emag_settings_controls['emag-enable-breadcrumb'] =
    array(
        'setting' =>     array(
            'default'              => $emag_customizer_defaults['emag-enable-breadcrumb'],
        ),
        'control' => array(
            'label'                 =>  __( 'Enable Breadcrumb', 'emag' ),
            'section'               => 'emag-breadcrumb-options',
            'type'                  => 'checkbox',
            'priority'              => 10,
        )
    );