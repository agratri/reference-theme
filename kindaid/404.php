<?php

get_header();

$error_text = get_theme_mod('error_text',__('404','kindaid'));
$error_subtitle = get_theme_mod('error_subtitle',__('Oops! Page not found','kindaid'));
$error_content = get_theme_mod('error_content',__('Whoops, this is embarassing. Looks like the page you were looking for was not found.','kindaid'));
$error_btn_text = get_theme_mod('error_btn_text',__('Back To Home','kindaid'));

?>

      <div class="tp-error-page-area pt-120 pb-120">
         <div class="container container-1424">
            <div class="row justify-content-center">
               <div class="col-xl-8 col-md-9">
                  <div class="tp-error-box text-center">
                        <?php if(!empty($error_text)) : ?>
                        <h2 class="tp-error-title"><?php echo esc_html($error_text); ?></h2>
                        <?php endif; ?>

                        <?php if(!empty($error_subtitle)) : ?>
                        <h4 class="tp-error-sub-title mb-15"><?php echo esc_html($error_subtitle); ?></h4>
                        <?php endif; ?>

                        <?php if(!empty($error_content)) : ?>
                        <div class="row justify-content-center mb-15">
                           <div class="col-lg-7">
                              <p><?php echo esc_html($error_content); ?></p>
                           </div>
                        </div>
                        <?php endif; ?>

                        <?php if(!empty($error_btn_text)) : ?>
                        <div class="tp-error-btn">
                           <a class="tp-btn tp-btn-animetion mr-5 mb-10" href="<?php echo esc_url(home_url()); ?>">
                              <span class="btn-text"><?php echo esc_html($error_btn_text); ?> </span>
                              <span class="btn-icon">
                                 <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 7H13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M7 1L13 7L7 13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                 </svg>
                              </span>
                           </a>
                        </div>
                        <?php endif; ?>
                  </div>
               </div>
            </div>
         </div>
      </div>


<?php get_footer();