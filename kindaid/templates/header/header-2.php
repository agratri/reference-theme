<?php

    $header_button_text = get_theme_mod('button_text',__('Donate Now','kindaid'));
    $header_button_url = get_theme_mod('button_url',__('#','kindaid'));
    $header_right_switch = get_theme_mod('header_right_switch',false);

    $header_menu_column = ($header_right_switch == false) ? 'col-lg-12 col-5' : 'col-lg-10 col-5';
    $header_menu_pos = ($header_right_switch == false) ? 'justify-content-between' : '';


    
?>
  


<?php get_template_part('templates/header/header-search'); ?>
<?php get_template_part('templates/header/offcanvas'); ?>
<?php if(class_exists( 'WooCommerce' )) : ?>
<?php get_template_part('templates/header/minicart'); ?>
<?php endif; ?>




   <!-- header start -->
   <header>
      <div id="header-sticky" class="tp-header-area tp-header-lg-spacing tp-transparent tp-header-blur">
         <div class="container-fluid container-1790">
            <div class="row align-items-center">
               <div class="<?php echo esc_attr($header_menu_column); ?>">
                  <div class="tp-header-content d-flex align-items-center <?php echo esc_attr($header_menu_pos); ?>">
                     <div class="tp-header-logo">
                        <?php kindaid_logo(); ?>
                     </div>
                     <div class="tp-main-menu ml-80 d-none d-xl-block">
                        <nav class="tp-mobile-menu-active">
                           <?php kindaid_main_menu(); ?>
                        </nav>
                     </div>
                  </div>
               </div>

               <?php if($header_right_switch) : ?>
               <div class="col-lg-2 col-7">
                  <div class="tp-header-action d-flex align-items-center justify-content-end">
                     <?php if(class_exists( 'WooCommerce' )) : ?>
                     <div class="tp-header-action-item">
                        <button class="tp-header-action-btn cartmini-open-btn">
                           <svg width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M5.00211 17H11.9507C14.503 17 16.4611 16.0781 15.9049 12.3676L15.2573 7.33907C14.9145 5.48765 13.7335 4.77908 12.6973 4.77908H4.22497C3.17354 4.77908 2.06116 5.54098 1.66497 7.33907L1.01736 12.3676C0.544976 15.6591 2.44973 17 5.00211 17Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                              <path d="M4.88859 4.59622C4.88859 2.6101 6.49865 1.00003 8.48477 1.00003V1.00003C9.44117 0.99598 10.3598 1.37307 11.0375 2.04793C11.7152 2.72278 12.0962 3.6398 12.0962 4.59622V4.59622" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                              <path d="M6.01553 8.34478H6.05362" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                              <path d="M10.8695 8.34481H10.9076" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                           </svg>
                           <span id="tp-cart-item" class="tp-header-action-badge cart__count"><?php echo esc_html(WC()->cart->cart_contents_count); ?></span>
                        </button>
                     </div>
                     <?php endif; ?>
                     <div class="tp-header-action-item">
                        <button class="tp-header-action-btn tp-search-click">
                           <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M8.1108 15.2222C12.038 15.2222 15.2216 12.0385 15.2216 8.11111C15.2216 4.18375 12.038 1 8.1108 1C4.18361 1 1 4.18375 1 8.11111C1 12.0385 4.18361 15.2222 8.1108 15.2222Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                              <path d="M17.0003 17L13.1338 13.1333" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                           </svg>
                        </button>
                     </div>
                     <div class="tp-header-toogle-wrapper d-xl-none">
                        <button class="tp-header-toogle"><i class="far fa-bars"></i></button>
                     </div>
                  </div>
               </div>
               <?php else : ?>
               <div class="col-7">
                  <div class="tp-header-action d-flex align-items-center justify-content-end">
                     <div class="tp-header-toogle-wrapper d-xl-none">
                        <button class="tp-header-toogle"><i class="far fa-bars"></i></button>
                     </div>
                  </div>
               </div>
               <?php endif; ?>
            </div>
         </div>
      </div>
   </header>
   <!-- header end -->

