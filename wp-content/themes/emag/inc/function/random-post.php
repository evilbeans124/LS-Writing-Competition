<?php
if ( ! function_exists( 'emag_random_post' ) ) :
/**
 * Displays the random post
 *
 * @since emag 1.0.0
 */
function emag_random_post() {
       global $wp;
       $wp->add_query_var('random');
       add_rewrite_rule('random/?$', 'index.php?random=1', 'emag');
}
endif;
add_action('init','emag_random_post');


if ( ! function_exists( 'emag_random_post_template' ) ) :
/**
* Templates helps to get random post
*/
  function emag_random_post_template() {
        global $post;
        if (get_query_var('random') == 1) {
          $posts = get_posts('post_type=post&orderby=rand&numberposts=1');
          $post = $posts[0];
          setup_postdata( $post );
          $link = get_permalink();
          wp_redirect($link,307);
        }
  }
endif;

add_action('template_redirect','emag_random_post_template');