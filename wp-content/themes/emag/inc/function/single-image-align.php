<?php 
/*image alignment single post*/

if( ! function_exists( 'emag_single_post_image_align' ) ) :
    /**
     * emag default layout function
     *
     * @since  emag 1.0.0
     *
     * @param int
     * @return string
     */
    function emag_single_post_image_align( $post_id = null ){
        global $emag_customizer_all_values,$post;
        if( null == $post_id && isset ( $post->ID ) ){
            $post_id = $post->ID;
        }
        $emag_single_post_image_align = $emag_customizer_all_values['emag-single-post-image-align'];
        $emag_single_post_image_align_meta = get_post_meta( $post_id, 'emag-single-post-image-align', true );

        if( false != $emag_single_post_image_align_meta ) {
            $emag_single_post_image_align = $emag_single_post_image_align_meta;
        }
        return $emag_single_post_image_align;
    }
endif;