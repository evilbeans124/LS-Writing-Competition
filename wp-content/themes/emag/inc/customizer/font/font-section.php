<?php
global $emag_panels;
global $emag_sections;
global $emag_settings_controls;
global $emag_repeated_settings_controls;
global $emag_customizer_defaults;

/*font array*/
global $emag_google_fonts;
$emag_google_fonts = array(
    'Archivo+Narrow:400,400italic,700' => 'Archivo Narrow',
    'Bitter:400,400italic,700' => 'Bitter',
    'Cookie' => 'Cookie',
    'Exo:400,300,400italic,600,800' => 'Exo',
    'Kreon:400,300,700' => 'Kreon',
    'Lato:400,300,400italic,900,700' => 'Lato',
    'Merriweather:400,400italic,300,900,700' => 'Merriweather',
    'News+Cycle:400,700' => 'News Cycle',
    'Oxygen:400,300,700' => 'Oxygen',
    'Playball' => 'Playball',
    'Ropa+Sans:400,400italic' => 'Ropa Sans',
    'Squada+One' => 'Squada One',
    'Tangerine:400,700' => 'Tangerine',
    'Ubuntu:400,400italic,500,700' => 'Ubuntu',
    'Varela+Round' => 'Varela Round',
    'Yanone+Kaffeesatz:400,300,700' => 'Yanone Kaffeesatz',
);

/*defaults values*/
$emag_customizer_defaults['emag-font-family-Primary'] = 'Oxygen:400,300,700';
$emag_customizer_defaults['emag-font-family-site-identity'] = 'Merriweather:400,400italic,300,900,700';
$emag_customizer_defaults['emag-font-family-title'] = 'Merriweather:400,400italic,300,900,700';


/*section*/
$emag_sections['emag-family'] =
    array(
        'priority'       => 20,
        'title'          => __( 'Font Family', 'emag' ),
    );

$emag_settings_controls['emag-font-family-site-identity'] =
    array(
        'setting' =>     array(
            'default'              => $emag_customizer_defaults['emag-font-family-site-identity'],
            
        ),
        'control' => array(
            'label'                 => __( 'Site Identity/Logo', 'emag' ),
            'description'           => __( 'Site Identity font family', 'emag' ),
            'section'               => 'emag-family',
            'type'                  => 'select',
            'choices'               => $emag_google_fonts,
            'priority'              => 10,
            'active_callback'       => ''
        )
    );

/*setting - controls*/
$emag_settings_controls['emag-font-family-Primary'] =
    array(
        'setting' =>     array(
            'default'              => $emag_customizer_defaults['emag-font-family-Primary'],
            
        ),
        'control' => array(
            'label'                 => __( 'Body ( paragraph ) Primary', 'emag' ),
            'description'           => __( 'change primary font family', 'emag' ),
            'section'               => 'emag-family',
            'type'                  => 'select',
            'choices'               => $emag_google_fonts,
            'priority'              => 15,
            'active_callback'       => ''
        )
    );


$emag_settings_controls['emag-font-family-title'] =
    array(
        'setting' =>     array(
            'default'              => $emag_customizer_defaults['emag-font-family-title'],
            
        ),
        'control' => array(
            'label'                 => __( 'Section Title', 'emag' ),
            'description'           => __('section title font will be changed', 'emag'),
            'section'               => 'emag-family',
            'type'                  => 'select',
            'choices'               => $emag_google_fonts,
            'priority'              => 20,
            'active_callback'       => ''
        )
    );