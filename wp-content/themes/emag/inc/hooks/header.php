<?php
if ( ! function_exists( 'emag_set_global' ) ) :
/**
 * Setting global values for all saved customizer values
 *
 * @since emag 1.0.0
 *
 * @param null
 * @return null
 *
 */
function emag_set_global() {
    /*Getting saved values start*/
    $GLOBALS['emag_customizer_all_values'] = emag_get_all_options(1);
}
endif;
add_action( 'emag_action_before_head', 'emag_set_global', 0 );

if ( ! function_exists( 'emag_doctype' ) ) :
/**
 * Doctype Declaration
 *
 * @since emag 1.0.0
 *
 * @param null
 * @return null
 *
 */
function emag_doctype() {
    ?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>
<?php
}
endif;
add_action( 'emag_action_before_head', 'emag_doctype', 10 );

if ( ! function_exists( 'emag_before_wp_head' ) ) :
/**
 * Before wp head codes
 *
 * @since emag 1.0.0
 *
 * @param null
 * @return null
 *
 */
function emag_before_wp_head() {
    ?>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php
}
endif;
add_action( 'emag_action_before_wp_head', 'emag_before_wp_head', 10 );

if( ! function_exists( 'emag_default_layout' ) ) :
    /**
     * emag default layout function
     *
     * @since  emag 1.0.0
     *
     * @param int
     * @return string
     */
    function emag_default_layout( $post_id = null ){

        global $emag_customizer_all_values,$post;
        $emag_default_layout = $emag_customizer_all_values['emag-default-layout'];
        if( is_home()){
            $post_id = get_option( 'page_for_posts' );
        }
        if( null == $post_id && isset ( $post->ID ) ){
            $post_id = $post->ID;
        }
        $emag_default_layout_meta = get_post_meta( $post_id, 'emag-default-layout', true );

        if( false != $emag_default_layout_meta ) {
            $emag_default_layout = $emag_default_layout_meta;
        }
        return $emag_default_layout;
    }
endif;

if ( ! function_exists( 'emag_body_class' ) ) :
/**
 * add body class
 *
 * @since emag 1.0.0
 *
 * @param null
 * @return null
 *
 */
function emag_body_class( $emag_body_classes ) {
    if(!is_front_page() || ( is_front_page())){
        $emag_default_layout = emag_default_layout();
        if( !empty( $emag_default_layout ) ){
            if( 'left-sidebar' == $emag_default_layout ){
                $emag_body_classes[] = 'evision-left-sidebar';
            }
            elseif( 'right-sidebar' == $emag_default_layout ){
                $emag_body_classes[] = 'evision-right-sidebar';
            }
            elseif( 'both-sidebar' == $emag_default_layout ){
                $emag_body_classes[] = 'evision-both-sidebar';
            }
            elseif( 'no-sidebar' == $emag_default_layout ){
                $emag_body_classes[] = 'evision-no-sidebar';
            }
            else{
                $emag_body_classes[] = 'evision-right-sidebar';
            }
        }
        else{
            $emag_body_classes[] = 'evision-right-sidebar';
        }
    }
    return $emag_body_classes;

}
endif;
add_action( 'body_class', 'emag_body_class', 10, 1);

if ( ! function_exists( 'emag_before_page_start' ) ) :
/**
 * intro loader
 *
 * @since emag 1.0.0
 *
 * @param null
 * @return null
 *
 */
function emag_before_page_start() {
    global $emag_customizer_all_values;
    /*intro loader*/
}
endif;
add_action( 'emag_action_before', 'emag_before_page_start', 10 );

if ( ! function_exists( 'emag_page_start' ) ) :
/**
 * page start
 *
 * @since emag 1.0.0
 *
 * @param null
 * @return null
 *
 */
function emag_page_start() {
?>
    <div id="page" class="site">
<?php
}
endif;
add_action( 'emag_action_before', 'emag_page_start', 15 );

if ( ! function_exists( 'emag_skip_to_content' ) ) :
/**
 * Skip to content
 *
 * @since emag 1.0.0
 *
 * @param null
 * @return null
 *
 */
function emag_skip_to_content() {
    ?>
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'emag' ); ?></a>
<?php
}
endif;
add_action( 'emag_action_before_header', 'emag_skip_to_content', 10 );

if ( ! function_exists( 'emag_header' ) ) :
/**
 * Main header
 *
 * @since emag 1.0.0
 *
 * @param null
 * @return null
 *
 */
function emag_header() {
    global $emag_customizer_all_values;
    ?>
    <header class="wrapper top-header">
        <div class="container">
            <div class="wrap-inner">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 top-header-left">
                        <?php if (1 == $emag_customizer_all_values['emag-header-enable-tinker']) { ?>
                            <div class="noticebar">
                                <?php if (!empty($emag_customizer_all_values['emag-header-tinker-title'])) { ?>
                                    <span class="notice-title"><?php echo esc_html($emag_customizer_all_values['emag-header-tinker-title']); ?></span>
                                <?php } ?>
                                <div class="ticker">
                                    <div id="cycle-slideshow-ticker" class="cycle-slideshow"
                                        data-cycle-log="false"
                                        data-cycle-swipe=true
                                        data-cycle-timeout=5000
                                        data-cycle-fx=scrollVert
                                        data-cycle-speed=1000
                                        data-cycle-carousel-fluid=true
                                        data-cycle-carousel-visible=5
                                        data-cycle-pause-on-hover=true
                                        data-cycle-auto-height=container
                                        data-cycle-slides="> div">
                                            <?php $emag_tinker_args = array(
                                                'post_type' => 'post',
                                                'posts_per_page' => absint( $emag_customizer_all_values['emag-header-no-of-tinker']) ,
                                                'ignore_sticky_posts' => 1,
                                            );
                                            $emag_home_tinker_post_query = new WP_Query($emag_tinker_args);
                                            if ($emag_home_tinker_post_query->have_posts()) :
                                                while ($emag_home_tinker_post_query->have_posts()) : $emag_home_tinker_post_query->the_post();
                                                    ?>
                                                    <div class="slide-item">
                                                        <a href="<?php the_permalink(); ?>">
                                                            <span class="notice-content"><?php the_title(); ?></span>
                                                        </a>
                                                    </div>
                                                <?php endwhile; 
                                                wp_reset_postdata();
                                            endif; ?>
                                        </div>
                                    <div class="cycle-pager" id="slide-pager"></div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 top-header-right">
                        <?php if (has_nav_menu('social' )) { ?>
                            <div class="social-widget evision-social-section social-icon-only bottom-tooltip">
                                <?php
                                    wp_nav_menu( array( 
                                        'theme_location' => 'social', 
                                        'link_before' => '<span>',
                                        'link_after'=>'</span>' , 
                                        'menu_id' => 'social-menu',
                                        'fallback_cb' => false,
                                    ) );
                                ?>
                            </div>
                        <?php } ?>
                        <?php if (1 == $emag_customizer_all_values['emag-header-enable-date']) { ?>
                            <div class="timer">
                                <?php $time = current_time('l, M j, Y');
                                echo esc_attr($time);
                                 ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <header id="masthead" class="wrapper wrap-head site-header">
        <div class="wrapper wrapper-site-identity">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <div class="site-branding">
                            <?php
                                if ( is_front_page() && is_home() ) : ?>
                                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                                <?php else : ?>
                                    <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                                <?php
                                endif;

                                $description = get_bloginfo( 'description', 'display' );
                                if ( $description || is_customize_preview() ) : ?>
                                    <p class="site-description"><?php echo esc_html($description); /* WPCS: xss ok. */ ?></p>
                                <?php
                                endif; ?>
                            <?php emag_the_custom_logo(); ?>
                        </div><!-- .site-branding -->
                    </div>
                    <?php if (!empty($emag_customizer_all_values['emag-header-add'])) { ?>
                        <div class="col-xs-12 col-sm-12 col-md-8">
                            <div class="ads-section header-right">
                                <a href= "<?php echo esc_url($emag_customizer_all_values['emag-home-header-add-link'] ); ?>">
                                    <img src="<?php echo esc_url($emag_customizer_all_values['emag-header-add']);?>">
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </header><!-- #masthead -->
<?php 
}
endif;
add_action( 'emag_action_header', 'emag_header', 10 );


if ( ! function_exists( 'emag_navigation_page_start' ) ) :
/**
 * Skip to content
 *
 * @since emag 1.0.0
 *
 * @param null
 * @return null
 *
 */
function emag_navigation_page_start() {
    global $emag_customizer_all_values; 
    ?>
    <nav class="wrapper wrap-nav">
        <div class="container">
            <div class="wrap-inner">
                <div class="sec-menu">
                    <nav id="sec-site-navigation" class="main-navigation sec-main-navigation" role="navigation" aria-label="secondary-menu">
                    
                    <?php
                        wp_nav_menu( array(
                            'theme_location' => 'primary',
                            'menu_id'        => 'primary-menu',
                            'menu_class'     => 'primary-menu',
                        ) );
                    ?>
                    </nav><!-- #site-navigation -->
                    <div class="nav-holder">
                        <button id="sec-menu-toggle" class="menu-toggle" aria-controls="secondary-menu" aria-expanded="false"><span class="fa fa-bars"></span></button>
                        <div id="sec-site-header-menu" class="site-header-menu">
                            <div class="container">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <button id="mobile-menu-toggle-close" class="menu-toggle" aria-controls="secondary-menu"><span class="fa fa-close fa-2x"></span></button>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <nav id="sec-site-navigation-mobile" class="main-navigation sec-main-navigation" role="navigation" aria-label="secondary-menu">
                                        <?php
                                            wp_nav_menu( array(
                                                'theme_location' => 'primary',
                                                'menu_id'        => 'primary-menu-mobile',
                                                'menu_class'     => 'primary-menu',
                                            ) );
                                        ?>
                                        </nav><!-- #site-navigation -->
                                    </div>
                                </div>
                            </div>
                        </div><!-- site-header-menu -->
                    </div>
                </div>
                <?php if ((1 == $emag_customizer_all_values['emag-header-enable-home-link']) || (1 == $emag_customizer_all_values['emag-header-enable-random']) || (1 == $emag_customizer_all_values['emag-header-enable-search'])) { ?>
                    <div class="nav-buttons">
                        <?php if (1 == $emag_customizer_all_values['emag-header-enable-home-link']) { ?>
                            <div class="button-list">
                                <a href="<?php echo esc_url(get_home_url()); ?>"><i class="fa fa-home"></i></a>
                            </div>
                        <?php } ?>
                        <?php if (1 == $emag_customizer_all_values['emag-header-enable-random']) { ?>
                            <div class="button-list">
                                <a href="<?php echo esc_url( home_url( '/?random=1' ) ); ?> "><i class="fa fa-random"></i></a>
                            </div>
                        <?php } ?>
                        
                        <?php if (1 == $emag_customizer_all_values['emag-header-enable-search']) { ?>
                            <div class="button-list">
                                <div class="search-holder">
                                  <a class="button-search button-outline" href="#">
                                    <i class="fa fa-search"></i>
                                  </a>
                                  <div id="search-bg" class="search-bg">
                                    <div class="form-holder">
                                    <div class="btn-search button-search-close" href="#"><i class="fa fa-close"></i></div>
                                        <?php get_search_form();?>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </nav>
    <section class="wrapper">
        <div id="content" class="site-content">
<?php
}
endif;
add_action( 'emag_action_nav_page_start', 'emag_navigation_page_start', 10 );


if( ! function_exists( 'emag_main_slider_setion' ) ) :
/**
 * Main slider
 *
 * @since emag 1.0.0
 *
 * @param null
 * @return null
 *
 */
    function emag_main_slider_setion(){
        if (  is_front_page() && !is_home() ) {
            do_action('emag_action_main_slider');
        }
        else {
            do_action('emag-page-inner-title');
        }
    }
endif;
add_action( 'emag_action_on_header', 'emag_main_slider_setion', 10 );


if( ! function_exists( 'emag_add_breadcrumb' ) ) :

/**
 * Breadcrumb
 *
 * @since emag 1.0.0
 *
 * @param null
 * @return null
 *
 */
    function emag_add_breadcrumb(){
        global $emag_customizer_all_values;
        // Bail if Breadcrumb disabled
        $breadcrumb_enable_breadcrumb = $emag_customizer_all_values['emag-enable-breadcrumb' ];
        if ( 1 != $breadcrumb_enable_breadcrumb ) {
            return;
        }
        // Bail if Home Page
        if ( is_front_page() || is_home() ) {
            return;
        }
        echo '<div id="breadcrumb" class="wrapper wrap-breadcrumb"><div class="container">';
         emag_simple_breadcrumb();
        echo '</div><!-- .container --></div><!-- #breadcrumb -->';
        return;
    }
endif;
add_action( 'emag_action_after_title', 'emag_add_breadcrumb', 10 );


