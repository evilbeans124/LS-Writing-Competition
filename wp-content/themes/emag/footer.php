<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 *
 * @package eVision themes
 * @subpackage emag
 * @since emag 1.0.0
 */


/**
 * emag_action_after_content hook
 * @since emag 1.0.0
 *
 * @hooked null
 */
do_action( 'emag_action_after_content' );

/**
 * emag_action_before_footer hook
 * @since emag 1.0.0
 *
 * @hooked emag_before_footer - 10
 */
do_action( 'emag_action_before_footer' );

/**
 * emag_action_widget_before_footer hook
 * @since emag 1.0.0
 *
 * @hooked emag_widget_before_footer - 10
 */
do_action( 'emag_action_widget_before_footer' );

/**
 * emag_action_footer hook
 * @since emag 1.0.0
 *
 * @hooked emag_footer - 10
 */
do_action( 'emag_action_footer' );

/**
 * emag_action_after_footer hook
 * @since emag 1.0.0
 *
 * @hooked null
 */
do_action( 'emag_action_after_footer' );

/**
 * emag_action_after hook
 * @since emag 1.0.0
 *
 * @hooked emag_page_end - 10
 */
do_action( 'emag_action_after' );
?>
<?php wp_footer(); ?>
</body>
</html>