<?php 

function kindaid_breadcrumb(){ 
    
    global $post;

   if ( is_front_page() && is_home() ) {
      $title = __('Blog','kindaid');
   }
   elseif ( is_front_page() ) {
         $title =  __('Blog','kindaid');
   }
   elseif ( is_home() ) {
      if ( get_option( 'page_for_posts' ) ) {
         $title = get_the_title( get_option( 'page_for_posts') );
      }
   }

   elseif ( is_single() && 'post' == get_post_type() ) {
      $title = get_the_title();
   } 
   elseif ( is_single() && 'service' == get_post_type() ) {
      $title = get_the_title();
   } 
   elseif ( is_single() && 'product' == get_post_type() ) {
         $title = get_theme_mod( 'breadcrumb_product_details', __( 'Shop', 'kindaid' ) );
   } 
   elseif ( is_search() ) {
         $title = esc_html__( 'Search Results for : ', 'kindaid' ) . get_search_query();
   } 
   elseif ( is_404() ) {
         $title = esc_html__( '404 Page not Found', 'kindaid' );
   } 
   elseif ( is_archive() ) {
         $title = get_the_archive_title();
   } 
   else {
         $title = get_the_title();
   }
    
    
   $breadcrumb_page_switch = function_exists('tpmeta_field')? tpmeta_field('breadcrumb_page_switch') : 'on';
   $breadcrumb_global = get_theme_mod('breadcrumb_switch',true);

   $breadcrumb_on_off = $breadcrumb_global && ($breadcrumb_page_switch == 'on');

   // var_dump($breadcrumb_on_off);
      

    ?>

      <?php if($breadcrumb_on_off) : ?>
      <div class="tp-breadcrumb-area tp-breadcrumb-bg position-relative">
         <div class="tp-breadcrumb-thumb">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/breadcrumb/bg-3.jpg" alt="">
         </div>
         <div class="container">
            <div class="tp-breadcrumb text-center position-relative z-index-2">
               <h2 class="tp-breadcrumb-title lh-1 mb-10 wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".3s"><?php echo kindaid_kses($title); ?></h2>

               <?php if( function_exists('bcn_display')) : ?>
               <div class="tp-breadcrumb-list wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".4s">
                  <?php bcn_display(); ?>
               </div>
               <?php endif; ?>

               <div class="tp-breadcrumb-scroll pt-85">
                  <a href="#">
                     <svg width="20" height="29" viewBox="0 0 20 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 9.9541C1.00024 5.00348 5.03497 1 10 1C14.965 1 18.9998 5.00348 19 9.9541V19.0459C18.9998 23.9965 14.965 28 10 28C5.03497 28 1.00024 23.9965 1 19.0459L1 9.9541Z" stroke="white" stroke-opacity="0.1" stroke-width="2" />
                        <path class="upslide-1" d="M13 19.0455C13 17.398 11.6569 16.0625 10 16.0625C8.34315 16.0625 7 17.398 7 19.0455C7 20.6929 8.34315 22.0284 10 22.0284C11.6569 22.0284 13 20.6929 13 19.0455Z" fill="white" />
                     </svg>
                  </a>
               </div>
            </div>
         </div>
      </div>  
      <?php endif; ?>

<?php    
}

add_action('header_before','kindaid_breadcrumb',11);