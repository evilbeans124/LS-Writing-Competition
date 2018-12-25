<?php
if ( ! function_exists( 'emag_before_footer' ) ) :
    /**
     * Footer content
     *
     * @since emag 1.0.0
     *
     * @param null
     * @return false | void
     *
     */
    function emag_before_footer() {
    ?>
        </div><!-- #content -->
    </section>
        <!-- *****************************************
             Footer section starts
    ****************************************** -->
    <footer class="wrapper wrap-footer">
    <?php
    }
endif;
add_action( 'emag_action_before_footer', 'emag_before_footer', 10 );

if ( ! function_exists( 'emag_widget_before_footer' ) ) :
    /**
     * Footer content
     *
     * @since emag 1.0.0
     *
     * @param null
     * @return false | void
     *
     */
    function emag_widget_before_footer() {
        global $emag_customizer_all_values;
        $emag_footer_widgets_number = $emag_customizer_all_values['emag-footer-sidebar-number'];
        if( !is_active_sidebar( 'footer-col-one' ) && !is_active_sidebar( 'footer-col-two' ) && !is_active_sidebar( 'footer-col-three' ) && !is_active_sidebar( 'footer-col-four' )){
            return false;
        }
        if( 1 == $emag_footer_widgets_number ){
                $col = 'col-md-12';
            }
        elseif( 2 == $emag_footer_widgets_number ){
            $col = 'col-md-6';
        }
        elseif( 3 == $emag_footer_widgets_number ){
            $col = 'col-md-4';
        }
        else{
            $col = 'col-md-3';
        }
        ?>
        <!-- footer widget -->
        <section class="wrapper footer-widget">
            <div class="container">
                <div class="row">
                     <?php if( is_active_sidebar( 'footer-col-one' ) && $emag_footer_widgets_number > 0 ) : ?>
                        <div class="contact-list <?php echo esc_attr( $col );?>">
                            <?php dynamic_sidebar( 'footer-col-one' ); ?>
                        </div>
                    <?php endif; ?>
                    <?php if( is_active_sidebar( 'footer-col-two' ) && $emag_footer_widgets_number > 1 ) : ?>
                        <div class="contact-list <?php echo esc_attr( $col );?>">
                            <?php dynamic_sidebar( 'footer-col-two' ); ?>
                        </div>
                    <?php endif; ?>
                    <?php if( is_active_sidebar( 'footer-col-three' ) && $emag_footer_widgets_number > 2 ) : ?>
                        <div class="contact-list <?php echo esc_attr( $col );?>">
                            <?php dynamic_sidebar( 'footer-col-three' ); ?>
                        </div>
                    <?php endif; ?>
                    <?php if( is_active_sidebar( 'footer-col-four' ) && $emag_footer_widgets_number > 3 ) : ?>
                        <div class="contact-list <?php echo esc_attr( $col );?>">
                            <?php dynamic_sidebar( 'footer-col-four' ); ?>
                        </div>
                    <?php endif; ?>
                    
                </div>
            </div>
        </section>
    <?php
    }
endif;
add_action( 'emag_action_widget_before_footer', 'emag_widget_before_footer', 10 );

if ( ! function_exists( 'emag_footer' ) ) :
    /**
     * Footer content
     *
     * @since emag 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function emag_footer() {
        global $emag_customizer_all_values;
        ?> 
        <!-- footer site info -->
        <section id="colophon" class="wrapper site-footer" role="contentinfo">
            <div class="container">
                <div class="row">
                    <div class="xs-12 col-sm-6 col-md-6">
                        <div class="site-info">
                            <?php
                            if(isset($emag_customizer_all_values['emag-copyright-text'])){
                                echo wp_kses_post( $emag_customizer_all_values['emag-copyright-text'] );
                            }
                            ?>
                            <?php
                             if( 1 == $emag_customizer_all_values['emag-enable-theme-name']){
                                ?>
                                <span class="sep"> | </span>
                                <?php printf( esc_html__( 'Theme: %1$s by %2$s', 'emag' ), 'eMag', '<a href="http://evisionthemes.com/" target = "_blank" rel="designer">eVisionThemes </a>' ); ?>
                                <?php
                            }
                            ?>
                        </div><!-- .site-info -->
                    </div>
                    <?php if (has_nav_menu('footer')) { ?>
                        <div class="xs-12 col-sm-6 col-md-6">
                            <div class="footer-menu">
                                <nav id="footer-site-navigation" class="footer-main-navigation" role="navigation" aria-label="footer-menu">
                                    <?php
                                        wp_nav_menu( array(
                                            'theme_location' => 'footer',
                                            'menu_id'        => 'footer-menu',
                                            'menu_class'     => 'footer-menu',
                                        ) );
                                    ?>
                                </nav><!-- #site-navigation --> 
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section><!-- #colophon -->     

    </footer><!-- #colophon -->
    <!-- *****************************************
             Footer section ends
    ****************************************** -->
    <?php
    }
endif;
add_action( 'emag_action_footer', 'emag_footer', 10 );

if ( ! function_exists( 'emag_page_end' ) ) :
    /**
     * Page end
     *
     * @since emag 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function emag_page_end() {
    global $emag_customizer_all_values;
        ?>
    <?php
     if( 1 == $emag_customizer_all_values['emag-enable-back-to-top']) {
        ?>
            <a id="gotop" class="evision-back-to-top" href="#page"><i class="fa fa-angle-up"></i></a>
        <?php
        } ?>
    </div><!-- #page -->
    <?php }
endif;
add_action( 'emag_action_after', 'emag_page_end', 10 );