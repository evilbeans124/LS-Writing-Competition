<?php

// disable direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Creating the shortcode for four columns
function vskb_four_columns( $vskb_atts ) {
	$vskb_atts = shortcode_atts( array( 
		'post_type' => 'post',
		'taxonomy' => 'category',
		'include' => '', 
		'exclude' => '', 
		'hide_empty' => 1, 
		'posts_per_page' => -1, 
		'order' => 'desc', 
		'orderby' => 'date',
		"description" => '',
		"woo_image" => ''
	), $vskb_atts);

	$return = "";
	$return .= '<div id="vskb-four">';
		$vskb_cat_args = array(
			'taxonomy' => $vskb_atts['taxonomy'],
			'include' => $vskb_atts['include'],
			'exclude' => $vskb_atts['exclude'],
			'hide_empty' => $vskb_atts['hide_empty']
		);
		$vskb_cats = get_categories( $vskb_cat_args );

		foreach ($vskb_cats as $cat) :
			$return .= '<ul class="vskb-cat-list"><li class="vskb-cat-name"><a href="'. get_category_link( $cat->cat_ID ) .'" title="'. $cat->name .'" >'. $cat->name .'</a></li>';
				if ($vskb_atts['woo_image'] == "true") {		
					$thumbnail_id = get_woocommerce_term_meta( $cat->cat_ID, 'thumbnail_id', true ); 
					$image = wp_get_attachment_url( $thumbnail_id ); 
					if ( $image ) :
						$return .= '<img class="vskb-cat-image" src="'.esc_url( $image ).'"  title="'. $cat->name .'" alt="'. $cat->name .'" />'; 
					endif; 
				}
				if ($vskb_atts['description'] == "true") {		
					$description = category_description( $cat->cat_ID );
					if ( !empty( $description ) ) :
						$return .= '<div class="vskb-cat-description">'. wp_kses_post( $description ) .'</div>';
					endif;
				}
				
				$vskb_post_args = array(
					'post_type' => $vskb_atts['post_type'],
					'tax_query' => array( 
						array( 
							'taxonomy' => $vskb_atts['taxonomy'],
							'field' => 'term_id', 
							'terms' => $cat->term_id, 
							'include_children' => false,
						) 
					), 
					'posts_per_page' => $vskb_atts['posts_per_page'],
					'order' => $vskb_atts['order'],
					'orderby' => $vskb_atts['orderby']
				);
				$vskb_posts = get_posts( $vskb_post_args ); 

				foreach( $vskb_posts AS $single_post ) :
					$return .= '<li class="vskb-post-name">';
					$return .= '<a href="'. get_permalink( $single_post->ID ) .'" rel="bookmark" title="'. get_the_title( $single_post->ID ) .'">'. get_the_title( $single_post->ID ) .'</a>';
					$return .= '</li>';
				endforeach;
			$return .=  '</ul>';
		endforeach;
	$return .= '</div>';
	return $return;
}
add_shortcode('knowledgebase', 'vskb_four_columns');

?>