<?php
global $emag_sections;
global $emag_settings_controls;
global $emag_repeated_settings_controls;
global $emag_customizer_defaults;

/*defaults values*/
$emag_customizer_defaults['emag-enable-back-to-top'] = 1;

$emag_sections['emag-back-to-top-options'] =
    array(
        'priority'       => 80,
        'title'          => __( 'Back To Top Options', 'emag' ),
        'panel'          => 'emag-theme-options'
    );

$emag_settings_controls['emag-enable-back-to-top'] =
    array(
        'setting' =>     array(
            'default'              => $emag_customizer_defaults['emag-enable-back-to-top'],
        ),
        'control' => array(
            'label'                 =>  __( 'Enable Back To Top', 'emag' ),
            'section'               => 'emag-back-to-top-options',
            'type'                  => 'checkbox',
            'priority'              => 50,
        )
    );