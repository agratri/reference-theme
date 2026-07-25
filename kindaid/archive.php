<?php

get_header();

$post_center = is_active_sidebar('blog-sidebar') ? '' : 'justify-content-center';

?>

      <div class="tp-blog-post-area pt-120 pb-80">
         <div class="container container-1424">
            <div class="row <?php echo esc_attr($post_center); ?>">
               <div class="col-xl-9 col-lg-8">
                  <div class="tp-postbox-wrapper mr-85 mb-40">

                    <?php if ( have_posts() ) : while( have_posts()  ) : the_post(); ?>
                        <?php get_template_part('templates/content',get_post_format()); ?>
                    <?php endwhile; ?>
                    <?php else : ?>
                        <p><?php esc_html_e('Post not found','kindaid'); ?></p>
                    <?php endif; ?>

                     <div class="tp-pagination mt-40">
                        <?php kindaid_blog_pagination(); ?>
                     </div>
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