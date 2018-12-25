<?php
/**
** A base module for [response]
**/

/* form_tag handler */

add_action( 'wpcf7_init', 'wpcf7_add_form_tag_response' );

function wpcf7_add_form_tag_response() {
	// echo "asdfasdf";
	wpcf7_add_form_tag( 'response', 'wpcf7_response_form_tag_handler' );
}

function wpcf7_response_form_tag_handler( $tag ) {
	// echo 'tag='.$tag;
	if ( $contact_form = wpcf7_get_current_contact_form() ) {
		// print_r($contact_form->form_response_output());
		return $contact_form->form_response_output();
	}
}

