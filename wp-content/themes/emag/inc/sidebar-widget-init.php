<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function emag_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'emag' ),
        'id'            => 'sidebar-1',
        'description'   => '',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Home/Front Page Widget', 'emag' ),
        'id'            => 'homepage-main-section',
        'description'   => '',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    $emag_get_all_options = emag_get_all_options(1);
    $emag_footer_widgets_number = $emag_get_all_options['emag-footer-sidebar-number'];

    if( $emag_footer_widgets_number > 0 ){
        register_sidebar(array(
            'name' => __('Footer Column One', 'emag'),
            'id' => 'footer-col-one',
            'description' => __('Displays items on footer section.','emag'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title'  => '<h1 class="widget-title">',
            'after_title'   => '</h1>',
        ));
        if( $emag_footer_widgets_number > 1 ){
            register_sidebar(array(
                'name' => __('Footer Column Two', 'emag'),
                'id' => 'footer-col-two',
                'description' => __('Displays items on footer section.','emag'),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title'  => '<h1 class="widget-title">',
                'after_title'   => '</h1>',
            ));
        }
        if( $emag_footer_widgets_number > 2 ){
            register_sidebar(array(
                'name' => __('Footer Column Three', 'emag'),
                'id' => 'footer-col-three',
                'description' => __('Displays items on footer section.','emag'),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title'  => '<h1 class="widget-title">',
                'after_title'   => '</h1>',
            ));
        }
        if( $emag_footer_widgets_number > 3 ){
            register_sidebar(array(
                'name' => __('Footer Column Four', 'emag'),
                'id' => 'footer-col-four',
                'description' => __('Displays items on footer section.','emag'),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title'  => '<h1 class="widget-title">',
                'after_title'   => '</h1>',
            ));
        }
    }
}
add_action( 'widgets_init', 'emag_widgets_init' );

require get_template_directory() . '/inc/widgets/mainpage-style1.php';
require get_template_directory() . '/inc/widgets/sidebar-style1.php';
