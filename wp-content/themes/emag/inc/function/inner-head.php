<?php 
/**
* Returns Header Title section for inner page.
*
* @since emag 1.0.0
*/
global $post;
if (!function_exists('emag_single_page_title')) :
    function emag_single_page_title() { ?>
		<?php 
		global $emag_customizer_all_values;
		$emag_banner_image = $emag_customizer_all_values['emag-default-banner-image'];
		$emag_header_image = '';
		if (!empty($emag_banner_image)) {
			$emag_header_image = 'inner-banner-image';
		}
		else{
			$emag_header_image = 'inner-banner-no-image';
		} ?>
			<div class="wrapper page-inner-title">
				<div class="container">
				    <div class="row">
				        <div class="col-md-12 col-sm-12 col-xs-12">
							<header class="entry-header <?php echo esc_attr($emag_header_image); ?>" style="background-image: url('<?php echo esc_url($emag_banner_image); ?>')">
								<div class="inner-banner-overlay">
									<?php if (is_singular()){ ?>
									<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
									<?php if (! is_page() ){?>
										<header class="entry-header">
											<div class="entry-meta entry-inner">
												<?php emag_posted_on(); ?>
											</div><!-- .entry-meta -->
										</header><!-- .entry-header -->
									<?php } }
									elseif (is_404()) { ?>
										<h1 class="entry-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'emag' ); ?></h1>
									<?php }
									elseif (is_archive()) {
										the_archive_title( '<h1 class="entry-title">', '</h1>' );
										the_archive_description( '<div class="taxonomy-description">', '</div>' );
									}
									elseif (is_search()) { ?>
										<h1 class="entry-title"><?php printf( esc_html__( 'Search Results for: %s', 'emag' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
									<?php }
									else{ ?>
											<h1 class="entry-title"><?php echo (esc_html__( 'Latest Blog', 'emag' )); ?></h1>
									<?php }
									?>
								</div>
							</header><!-- .entry-header -->
				        </div>
				    </div>
				</div>
			</div>

		<?php 
		/**
		 * emag_action_after_title hook
		 * @since emag 1.0.0
		 *
		 * @hooked null
		 */
		do_action( 'emag_action_after_title' );
	}
endif;
add_action( 'emag-page-inner-title', 'emag_single_page_title', 15 );