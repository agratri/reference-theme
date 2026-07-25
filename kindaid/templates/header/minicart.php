   <!-- cart mini area start -->
   <div class="cartmini__area">
      <div class="cartmini__wrapper d-flex justify-content-between flex-column">
         <div class="cartmini__top-wrapper ">
            <div class="cartmini__top p-relative">
               <div class="cartmini__title">
                  <h4><?php echo esc_html__('Shopping cart','kindaid'); ?></h4>
               </div>
               <div class="cartmini__close">
                  <button type="button" class="cartmini__close-btn cartmini-close-btn"><i class="fal fa-times"></i></button>
               </div>
            </div>
            <div class="mini_shopping_cart_box"><?php woocommerce_mini_cart(); ?></div>
            <!-- for wp -->
         </div>
      </div>
   </div>
   <!-- cart mini area end -->