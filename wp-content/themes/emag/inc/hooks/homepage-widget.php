<?php
if ( ! function_exists( 'emag_widget_section' ) ) :
    /**
     *
     * @since eMag 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function emag_widget_section() {
        ?>
        <!-- Main Content section -->
        <section class="wrapper wrap-main-content">
            <div class="container">
                <div class="row">
                    <!-- Main-panel Content -->
                    <div class="col-xs-12 col-sm-12 col-md-8">
                        <div class="main-panel-section">
                            <!-- Main-panel Top Content -->
                                <?php dynamic_sidebar( 'homepage-main-section' ); ?>
                        </div>
                    </div>
                    <!-- Sidebar Content -->
                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <div class="sidebar-sections">
                            <!-- Sidebar Top Content -->
                            <?php get_sidebar(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
endif;
add_action( 'emag_action_front_page', 'emag_widget_section', 50 );