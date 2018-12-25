<?php
/**
* Returns word count of the sentences.
*
* @since emag 1.0.0
*/
if ( ! function_exists( 'emag_words_count' ) ) :
	function emag_words_count( $length = 25, $emag_content = null ) {
		$length = absint( $length );
		$source_content = preg_replace( '`\[[^\]]*\]`', '', $emag_content );
		$trimmed_content = wp_trim_words( $source_content, $length, '...' );
		return $trimmed_content;
	}
endif;