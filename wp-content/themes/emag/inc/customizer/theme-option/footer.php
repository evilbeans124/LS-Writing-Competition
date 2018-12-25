<?php
global $emag_sections;
global $emag_settings_controls;
global $emag_repeated_settings_controls;
global $emag_customizer_defaults;

/*defaults values*/
$emag_customizer_defaults['emag-footer-sidebar-number'] = 3;
$emag_customizer_defaults['emag-copyright-text'] = __('Copyright &copy; All right reserved.','emag');
$emag_customizer_defaults['emag-enable-theme-name'] = 1;

$emag_sections['emag-footer-options'] =
    array(
        'priority'       => 15,
        'title'          => __( 'Footer Options', 'emag' ),
        'panel'          => 'emag-theme-options'
    );

$emag_settings_controls['emag-footer-sidebar-number'] =
    array(
        'setting' =>     array(
            'default'              => $emag_customizer_defaults['emag-footer-sidebar-number'],
        ),
        'control' => array(
            'label'                 =>  __( 'Number of Sidebars In Footer Area', 'emag' ),
            'section'               => 'emag-footer-options',
            'type'                  => 'select',
            'choices'               => array(
                0 => __( 'Disable footer sidebar area', 'emag' ),
                1 => __( '1', 'emag' ),
                2 => __( '2', 'emag' ),
                3 => __( '3', 'emag' ),
                4 => __( '4', 'emag' )
            ),
            'priority'              => 15,
            'description'           => '',
            'active_callback'       => ''
        )
    );

$emag_settings_controls['emag-copyright-text'] =
    array(
        'setting' =>     array(
            'default'              => $emag_customizer_defaults['emag-copyright-text'],
        ),
        'control' => array(
            'label'                 =>  __( 'Copyright Text', 'emag' ),
            'section'               => 'emag-footer-options',
            'type'                  => 'text_html',
            'priority'              => 20,
        )
    );