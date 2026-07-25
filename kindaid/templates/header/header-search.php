   <!--search-form-start -->
   <div class="tp-search-body-overlay"></div>
   <div class="tp-search-form-toggle">
      <div class="container">
         <div class="row mb-70">
            <div class="col-lg-12">
               <div class="tp-search-top d-flex justify-content-between align-items-center">
                  <div class="cm-search-logo">
                     <?php kindaid_logo(); ?>
                  </div>
                  <button class="tp-search-close">
                     <i class="fa-light fa-xmark"></i>
                  </button>
               </div>
            </div>
         </div>
         <div class="row justify-content-center">
            <div class="col-lg-12">
               <div class="tp-search-form">
                  <form action="<?php home_url( '/' ); ?>"  method="get">
                     <div class="tp-search-form-input">
                        <input name="s" type="text" value="<?php echo get_search_query(); ?>" placeholder="<?php echo esc_attr__( 'What are you looking foor?','kindaid' ); ?>" required>
                        <span class="tp-search-focus-border"></span>
                        <button class="tp-search-form-icon" type="submit">
                           <i class="fa-sharp fa-regular fa-magnifying-glass"></i>
                        </button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- search-form-end -->   