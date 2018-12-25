<?php
/**
 * Implement Editor Styles
 *
 * @since emag 1.0.0
 *
 * @param null
 * @return null
 *
 */
add_action( 'init', 'emag_add_editor_styles' );

if ( ! function_exists( 'emag_add_editor_styles' ) ) :
    function emag_add_editor_styles() {
        add_editor_style( 'editor-style.css' );
    }
endif;