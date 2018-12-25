<?php
global $emag_panels;
/*creating panel for fonts-setting*/
$emag_panels['emag-feature-slider'] =
    array(
        'title'          => __( 'Home Main Slider', 'emag' ),
        'priority'       => 200
    );

/*slider selection from slider options */
require get_template_directory().'/inc/customizer/main-slider-section/options.php';