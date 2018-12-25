<?php
global $emag_sections;
global $emag_settings_controls;
global $emag_customizer_defaults;

/*defaults values*/
$emag_customizer_defaults['emag-site-identity-color'] = '#313131';
$emag_customizer_defaults['emag-primary-color'] = '#E64946';
$emag_customizer_defaults['emag-color-reset'] = '';

/**
 * Reset color settings to default
 *
 * @since emag 1.0.0
 */
if ( ! function_exists( 'emag_color_reset' ) ) :
    function emag_color_reset( ) {
        
            global $emag_customizer_saved_values;
           $emag_customizer_saved_values = emag_get_all_options();
        if ( $emag_customizer_saved_values['emag-color-reset'] == 1 ) {
            global $emag_customizer_defaults;
            global $emag_customizer_saved_values;
            /*getting fields*/

            /*setting fields */
            $emag_customizer_saved_values['emag-site-identity-color'] = $emag_customizer_defaults['emag-site-identity-color'] ;
            $emag_customizer_saved_values['emag-primary-color'] = $emag_customizer_defaults['emag-primary-color'] ;
            remove_theme_mod( 'background_color' );
            $emag_customizer_saved_values['emag-color-reset'] = '';
            /*resetting fields*/
            emag_reset_options( $emag_customizer_saved_values );
        }
        else {
            return '';
        }
    }
endif;
add_action( 'customize_save_after','emag_color_reset' );

$emag_settings_controls['emag-site-identity-color'] =
    array(
        'setting' =>     array(
            'default'              => $emag_customizer_defaults['emag-site-identity-color'],
        ),
        'control' => array(
            'label'                 =>  __( 'Site Identity Color', 'emag' ),
            'description'           =>  __( 'Site title and tagline color', 'emag' ),
            'section'               => 'colors',
            'type'                  => 'color',
            'priority'              => 20,
            'active_callback'       => ''
        )
    );

$emag_settings_controls['emag-primary-color'] =
    array(
        'setting' =>     array(
            'default'              => $emag_customizer_defaults['emag-primary-color'],
        ),
        'control' => array(
            'label'                 =>  __( 'Primary Color', 'emag' ),
            'section'               => 'colors',
            'type'                  => 'color',
            'priority'              => 30,
            'active_callback'       => ''
        )
    );

$emag_settings_controls['emag-color-reset'] =
    array(
        'setting' =>     array(
            'default'              => $emag_customizer_defaults['emag-color-reset'],
            'transport'            => 'postmessage',
        ),
        'control' => array(
            'label'                 =>  __( 'Reset', 'emag' ),
            'description'           =>  __( 'Caution: Reset all color settings above to default. Refresh the page after saving to view the effects', 'emag' ),
            'section'               => 'colors',
            'type'                  => 'checkbox',
            'priority'              => 220,
            'active_callback'       => ''
        )
    );