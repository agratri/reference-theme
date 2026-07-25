<?php

get_header();

$post_center = is_active_sidebar('blog-sidebar') ? '' : 'justify-content-center';

?>


      <div class="tp-blog-post-area pt-120 pb-80">
         <div class="container container-1424">
            <div class="row <?php echo esc_attr($post_center); ?>">
               <div class="col-xl-9 col-lg-8">
                  <div class="tp-postbox-wrapper tp-postbox-details-wrap mr-85 mb-40">
                    <?php if ( have_posts() ) : while( have_posts()  ) : the_post(); ?>
                        <?php get_template_part('templates/content',get_post_format()); ?>
                        
                    <?php endwhile; ?>
                    <?php else : ?>
                        <p><?php esc_html_e('Post not found','kindaid'); ?></p>
                    <?php endif; ?>

                     <?php 
                         $prev_post =  get_previous_post();
                         $next_post =  get_next_post();
                     ?>

                     <?php if($prev_post || $next_post) : ?>
                     <div class="tp-blog-navigation-wrap mb-35 mt-90">
                        <div class="row justify-content-between">
                           
                           <div class="col-xl-5 col-lg-6 col-md-6">
                              <?php if($prev_post) : ?>
                              <div class="tp-blog-navigation mb-30">
                                 <a href="<?php echo get_permalink( $prev_post->ID);?>">
                                    <i class="far fa-arrow-left"></i>
                                    <div class="tp-blog-navigation-text">
                                       <span><?php echo esc_html__('Previous Post','kindaid'); ?></span>
                                       <h4 class="tp-blog-navigation-title"><?php echo get_the_title($prev_post->ID); ?></h4>
                                    </div>
                                 </a>
                              </div>
                              <?php endif; ?> 
                           </div>

                           <div class="col-xl-5 col-lg-6 col-md-6">
                              <?php if($next_post) : ?>
                              <div class="tp-blog-navigation mb-30 text-end">
                                 <a class="justify-content-end" href="<?php echo get_permalink( $next_post->ID);?>">                                      
                                    <div class="tp-blog-navigation-text">
                                       <span><?php echo esc_html__('Next Post','kindaid'); ?></span>
                                       <h4 class="tp-blog-navigation-title"><?php echo get_the_title($next_post->ID); ?></h4>
                                    </div>
                                    <i class="far fa-arrow-right"></i>
                                 </a>
                              </div>
                              <?php endif; ?>   
                           </div>
                        </div>
                     </div>
                     <?php endif; ?>


                     <?php get_template_part('templates/biography'); ?>

                     <?php if ( comments_open() || get_comments_number() ) :
                              comments_template();
                     endif; ?>

                  </div>
               </div>

               <?php if(is_active_sidebar('blog-sidebar')) : ?>
               <div class="col-xl-3 col-lg-4">
                  <div class="tp-blog-sidebar mb-40">
                     <?php get_sidebar(); ?>
                  </div>
               </div>
               <?php endif; ?>
            </div>
         </div>
      </div>


<?php get_footer();