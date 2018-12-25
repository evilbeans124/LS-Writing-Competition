<?php
if ( ! function_exists( 'emag_featured_home_slider' ) ) :
    /**
     * Featured Slider
     *
     * @since emag 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function emag_featured_home_slider() {
        global $emag_customizer_all_values;

        if( 1 != $emag_customizer_all_values['emag-feature-slider-enable'] ){
            return null;
        }
        $emag_feature_slider_category = esc_attr($emag_customizer_all_values['emag-featured-slider-category']);
        $emag_feature_slider_number = absint( $emag_customizer_all_values['emag-feature-slider-number'] );
        $emag_feature_slider_mode = $emag_customizer_all_values['emag-fs-slider-mode'];
        $emag_feature_slider_time = $emag_customizer_all_values['emag-fs-slider-time'];
        $emag_feature_slider_pause_time = $emag_customizer_all_values['emag-fs-slider-pause-time'];
        $emag_feature_enable_arrow = $emag_customizer_all_values['emag-fs-enable-arrow'];
        $emag_feature_enable_autoplay = $emag_customizer_all_values['emag-fs-enable-autoplay'];
        $emag_feature_enable_title = $emag_customizer_all_values['emag-fs-enable-title'];
    ?>

    <!-- wrap after header -->
    <section class="wrapper below-header">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8 pad0r left-content">
                    <div class="wrapper-slider">
                        <?php if (1 == $emag_feature_enable_arrow) { ?>
                            <div class="controls">
                                <a href="#" id="slide-prev"><i class="fa fa-angle-left"></i></a>
                                <a href="#" id="slide-next"><i class="fa fa-angle-right"></i></a>
                            </div>
                        <?php } ?>

                        <div id="cycle-slideshow" class="cycle-slideshow"
                            data-cycle-log="false"
                            data-cycle-swipe=true
                            data-cycle-fx=<?php echo esc_attr( $emag_feature_slider_mode);?>
                            data-cycle-speed=<?php echo (esc_attr( $emag_feature_slider_time) * 1000)?>
                            data-cycle-carousel-fluid=true
                            data-cycle-carousel-visible=5
                            data-cycle-pause-on-hover=true
                            data-cycle-auto-height=container
                            data-cycle-slides="> div"
                            data-cycle-prev=#slide-prev
                            data-cycle-next=#slide-next 
                            <?php if( 1 != $emag_feature_enable_autoplay){ ?>
                                data-cycle-timeout=0
                            <?php }  ?>
                            <?php if(1 == $emag_feature_enable_autoplay){ ?>
                                data-cycle-timeout=<?php echo (esc_attr( $emag_feature_slider_pause_time) * 1000)?>
                            <?php }  ?>
                            >
                            <?php 
                            $emag_feature_slider_default_args =    array(
                                'post_type' => 'post',
                                'posts_per_page' => $emag_feature_slider_number,
                                'orderby' => 'post__in',
                                'cat' => $emag_feature_slider_category,
                                'offset' => 2
                            );
                            $emag_fature_section_default_post_query = new WP_Query( $emag_feature_slider_default_args );
                            if ($emag_fature_section_default_post_query->have_posts()) :
                                while ( $emag_fature_section_default_post_query->have_posts() ) : $emag_fature_section_default_post_query->the_post(); 
                                $url ='';
                                if(has_post_thumbnail()){
                                    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'emag-main-slider' );
                                    $url = $thumb['0'];
                                }
                                else{
                                    $url = get_template_directory_uri().'/assets/images/slider-post.jpg';
                                }
                                ?>
                                    <div class="slide-item">
                                        <figure class="post-img">
                                            <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($url); ?>"></a>
                                        </figure>
                                        
                                        <div class="slider-post thumb-post">
                                            <div class="overlay-post-content">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-xs-10 col-sm-12 col-md-12 col-xs-offset-2 col-sm-offset-0 col-md-offset-0 pad0lr">
                                                            <h3 class="entry-title"><a href="<?php the_permalink(); ?>"> <?php the_title(); ?></h3>
                                                            <div class="post-icons">
                                                                <span>
                                                                    <?php 
                                                                    $author_name   = get_the_author();
                                                                    $author_url   = get_author_posts_url( get_the_author_meta( 'ID' ) );?>
                                                                    <a href="<?php echo esc_url($author_url); ?>" class="icon" title=""><i class="fa fa-user"></i><span><?php echo esc_html($author_name ); ?></span></a>
                                                                </span>
                                                                <span>
                                                                <?php 
                                                                $archive_year   = get_the_time('Y');
                                                                ?>
                                                                    <a href="<?php echo esc_url(get_year_link($archive_year)); ?>" class="icon"><i class="fa fa-calendar"></i> <?php echo esc_html(get_the_date());?></a>
                                                                </span>
                                                                <span>
                                                                    <a href="<?php the_permalink(); ?>" class="icon">
                                                                        <i class="fa fa-comment"></i> 
                                                                        <?php
                                                                            $commentscount = get_comments_number();
                                                                            if($commentscount == 1): $commenttext = __('comment','emag'); endif;
                                                                            if($commentscount > 1 || $commentscount == 0): $commenttext = __('comments','emag'); endif;
                                                                            echo (esc_html($commentscount).' '.(esc_html($commenttext)));
                                                                        ?>
                                                                    </a>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile;
                            wp_reset_postdata();
                            endif;
                             ?>
                        </div>
                        <div class="cycle-pager" id="slide-pager"></div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 pad0l mainslider-right-content right-content">
                    <div class="row">
                        <?php
                        $emag_slider_posts_args =    array(
                            'post_type' => 'post',
                            'posts_per_page' => 2,
                            'orderby' => 'post__in',
                            'cat' => $emag_feature_slider_category,
                        );
                        $emag_home_slider_posts_post_query = new WP_Query($emag_slider_posts_args);
                        if ($emag_home_slider_posts_post_query->have_posts()) :
                            while ($emag_home_slider_posts_post_query->have_posts()) : $emag_home_slider_posts_post_query->the_post();
                                if(has_post_thumbnail()){
                                    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'emag-right-slide' );
                                    $url = $thumb['0'];
                                }
                                else{
                                    $url = get_template_directory_uri().'/assets/images/slider-post.jpg';
                                }
                                ?>
                                <div class="col-xs-12 col-sm-6 col-md-12">
                                    <div class="thumb-post">
                                        <figure class="post-img">
                                        <a href="<?php the_permalink(); ?>">
                                            <img src="<?php echo esc_url($url); ?>" alt="post">
                                        </a>
                                        </figure>
                                        <div class="overlay-post-content">
                                            <h3 class="entry-title"><a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a></h3>
                                            <div class="post-icons">
                                                <span>
                                                    <?php 
                                                    $author_name   = get_the_author();
                                                    $author_url   = get_author_posts_url( get_the_author_meta( 'ID' ) );?>
                                                    <a href="<?php echo esc_url($author_url); ?>" class="icon" title=""><i class="fa fa-user"></i><span><?php echo esc_html($author_name ); ?></span></a>
                                                </span>
                                                <span>
                                                    <?php 
                                                    $archive_year   = get_the_time('Y');
                                                    ?>
                                                    <a href="<?php echo esc_url(get_day_link(get_the_time('Y'), get_the_time('m'), get_the_time('d') )); ?>" class="icon"><i class="fa fa-calendar"></i> <?php echo esc_html(get_the_date('M j, Y'));?></a>
                                                </span>
                                                <span>
                                                    <a href="<?php the_permalink(); ?>" class="icon">
                                                        <i class="fa fa-comment"></i> 
                                                        <?php
                                                            $commentscount = get_comments_number();
                                                            if($commentscount == 1): $commenttext = ''; endif;
                                                            if($commentscount > 1 || $commentscount == 0): $commenttext = ''; endif;
                                                            echo (esc_html($commentscount).' '.(esc_html($commenttext)));
                                                        ?>
                                                    </a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; 
                            wp_reset_postdata();
                        endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    }
endif;
add_action( 'emag_action_front_page', 'emag_featured_home_slider', 10 );