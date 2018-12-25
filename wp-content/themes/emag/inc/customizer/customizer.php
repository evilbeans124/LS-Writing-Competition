<?php
/**
 * evision themes Theme Customizer
 *
 * @package eVision themes
 * @subpackage emag
 * @since emag 1.0.0
 */
/*Define Url for including css and js*/
if ( !defined( 'EVISION_CUSTOMIZER_URL' ) ) {
    define( 'EVISION_CUSTOMIZER_URL', trailingslashit( get_template_directory_uri() ) . 'inc/frameworks/evision-customizer/' );
}
/*Define path for including php files*/
if ( !defined( 'EVISION_CUSTOMIZER_PATH' ) ) {
    define( 'EVISION_CUSTOMIZER_PATH', trailingslashit( get_template_directory() ) . 'inc/frameworks/evision-customizer/' );
}

/*define constant for evision customizer name*/
if(!defined('EVISION_CUSTOMIZER_NAME')){
    define( 'EVISION_CUSTOMIZER_NAME', 'emag_options' );
}

/**
 * reset options
 * @param  array $reset_options
 * @return void
 *
 * @since emag 1.0.0
 */
if ( ! function_exists( 'emag_reset_options' ) ) :
    function emag_reset_options( $reset_options ) {
        set_theme_mod( EVISION_CUSTOMIZER_NAME, $reset_options );
    }
endif;

/**
 * Customizer framework added.
 */
require get_template_directory() . '/inc/frameworks/evision-customizer/evision-customizer.php';
global $emag_panels;
global $emag_sections;
global $emag_settings_controls;
global $emag_repeated_settings_controls;
global $emag_customizer_defaults;

/******************************************
Modify Site Color Options
 *******************************************/
require get_template_directory().'/inc/customizer/color/color-section.php';

/******************************************
Modify Site Font Options
 *******************************************/
require get_template_directory().'/inc/customizer/font/font-section.php';

/******************************************
Modify Slider Section Options
 *******************************************/
require get_template_directory().'/inc/customizer/top-header/banner-add.php';

/******************************************
Modify Slider Section Options
 *******************************************/
require get_template_directory().'/inc/customizer/main-slider-section/panel.php';

/******************************************
Modify Blog Section Options
 *******************************************/
require get_template_directory().'/inc/customizer/blog-section/blog.php';

/******************************************
Modify Theme Option Section Options
 *******************************************/
require get_template_directory().'/inc/customizer/theme-option/option-panel.php';



/*Resetting all Values*/
/**
 * Reset color settings to default
 *
 * @since emag 1.0.0
 */
global $emag_customizer_defaults;
$emag_customizer_defaults['emag-customizer-reset-settings'] = '';
if ( ! function_exists( 'emag_customizer_reset' ) ) :
    function emag_customizer_reset( ) {
        global $emag_customizer_saved_values;
        $emag_customizer_saved_values = emag_get_all_options();
        if ( $emag_customizer_saved_values['emag-customizer-reset-settings'] == 1 ) {
            global $emag_customizer_defaults;
            /*getting fields*/
            $emag_customizer_defaults['emag-customizer-reset-settings'] = '';
            /*resetting fields*/
            emag_reset_options( $emag_customizer_defaults );
        }
        else {
            return '';
        }
    }
endif;
add_action( 'customize_save_after','emag_customizer_reset' );

$emag_sections['emag-customizer-reset'] =
    array(
        'priority'       => 999,
        'title'          => __( 'Reset All Options', 'emag' )
    );
$emag_settings_controls['emag-customizer-reset-settings'] =
    array(
        'setting' =>     array(
            'default'              => $emag_customizer_defaults['emag-customizer-reset-settings'],
            'sanitize_callback'    => 'evision_customizer_sanitize_checkbox',
            'transport'            => 'postmessage',
        ),
        'control' => array(
            'label'                 =>  __( 'Reset All Options', 'emag' ),
            'description'           =>  __( 'Caution: Reset all options settings to default. Refresh the page after save to view the effects. ', 'emag' ),
            'section'               => 'emag-customizer-reset',
            'type'                  => 'checkbox',
            'priority'              => 10,
            'active_callback'       => ''
        )
    );

/******************************************
Aranging header image
 *******************************************/
$emag_sections['custom_css'] =
    array(
        'title'          => __( 'Additional CSS', 'emag' ),
        'priority'       => 400,
    );
    
$emag_sections['header_image'] =
    array(
        'priority'       => 1999,
        'title'          => __( 'Header Image', 'emag' )
    );

$emag_customizer_args = array(
    'panels'            => $emag_panels, /*always use key panels */
    'sections'          => $emag_sections,/*always use key sections*/
    'settings_controls' => $emag_settings_controls,/*always use key settings_controls*/
    'repeated_settings_controls' => $emag_repeated_settings_controls,/*always use key sections*/
);

/*registering panel section setting and control start*/
function emag_add_panels_sections_settings() {
    global $emag_customizer_args;
    return $emag_customizer_args;
}
add_filter( 'evision_customizer_panels_sections_settings', 'emag_add_panels_sections_settings' );
/*registering panel section setting and control end*/

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function emag_customize_register( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
}
add_action( 'customize_register', 'emag_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function emag_customize_preview_js() {
    wp_enqueue_script( 'emag_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'emag_customize_preview_js' );


/**
 * get all saved options
 * @param  null
 * @return array saved options
 *
 * @since emag 1.0.0
 */
if ( ! function_exists( 'emag_get_all_options' ) ) :
    function emag_get_all_options( $merge_default = 0 ) {
        $emag_customizer_saved_values = evision_customizer_get_all_values( EVISION_CUSTOMIZER_NAME );
        if( 1 == $merge_default ){
            global $emag_customizer_defaults;
            if(is_array( $emag_customizer_saved_values )){
                $emag_customizer_saved_values = array_merge($emag_customizer_defaults, $emag_customizer_saved_values );
            }
            else{
                $emag_customizer_saved_values = $emag_customizer_defaults;
            }
        }
        return $emag_customizer_saved_values;
    }
endif;
