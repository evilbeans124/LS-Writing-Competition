<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package emag
 */

/**
 * emag_action_before_head hook
 * @since emag 1.0.0
 *
 * @hooked emag_set_global -  0
 * @hooked emag_doctype -  10
 */
do_action( 'emag_action_before_head' );?>



<head>

	<?php
	/**
	 * emag_action_before_wp_head hook
	 * @since emag 1.0.0
	 *
	 * @hooked emag_before_wp_head -  10
	 */
	do_action( 'emag_action_before_wp_head' );

	wp_head();

	/**
	 * emag_action_after_wp_head hook
	 * @since emag 1.0.0
	 *
	 * @hooked null
	 */
	do_action( 'emag_action_after_wp_head' );
	?>

</head>

<body <?php body_class(); ?>>

<?php
/**
 * emag_action_before hook
 * @since emag 1.0.0
 *
 * @hooked emag_page_start - 15
 */
do_action( 'emag_action_before' );

/**
 * emag_action_before_header hook
 * @since emag 1.0.0
 *
 * @hooked emag_skip_to_content - 10
 */
do_action( 'emag_action_before_header' );

/**
 * emag_action_header hook
 * @since emag 1.0.0
 *
 * @hooked emag_after_header - 10
 */
do_action( 'emag_action_header' );

/**
 * emag_action_nav_page_start hook
 * @since emag 1.0.0
 *
 * @hooked page start and navigations - 10
 */
do_action( 'emag_action_nav_page_start' );

/**
 * emag_action_on_header hook
 * @since emag 1.0.0
 *
 * @hooked page start and navigations - 10
 */
do_action( 'emag_action_on_header' );

/**
 * emag_action_before_content hook
 * @since emag 1.0.0
 *
 * @hooked null
 */
do_action( 'emag_action_before_content' );
?>

