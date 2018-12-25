<?php
if( ! function_exists( 'emag_excerpt_length' ) ) :

    /**
     * Excerpt length
     *
     * @since  emag 1.0.0
     *
     * @param null
     * @return int
     */
    function emag_excerpt_length( $length ){
        global $emag_customizer_all_values;
        $excerpt_length = $emag_customizer_all_values['emag-excerpt-length'];
        if ( empty( $excerpt_length) ) {
            $excerpt_length = $length;
        }
        return intval( $excerpt_length );

    }

endif;
add_filter( 'excerpt_length', 'emag_excerpt_length', 999 );