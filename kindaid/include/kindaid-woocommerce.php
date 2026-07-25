<?php

// archive product 
// product top hook 
remove_action('woocommerce_before_main_content','woocommerce_breadcrumb',20);
remove_action('woocommerce_shop_loop_header','woocommerce_product_taxonomy_archive_header',10);

remove_action('woocommerce_before_shop_loop','woocommerce_result_count',20);
remove_action('woocommerce_before_shop_loop','woocommerce_catalog_ordering',30);

// product hook 
remove_action('woocommerce_sidebar','woocommerce_get_sidebar',10);
remove_action('woocommerce_before_shop_loop_item','woocommerce_template_loop_product_link_open',10);
remove_action('woocommerce_before_shop_loop_item_title','woocommerce_show_product_loop_sale_flash',10);
remove_action('woocommerce_before_shop_loop_item_title','woocommerce_template_loop_product_thumbnail',10);
remove_action('woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title',10);
remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_price',10);
remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating',5);
remove_action('woocommerce_after_shop_loop_item','woocommerce_template_loop_product_link_close',5);
remove_action('woocommerce_after_shop_loop_item','woocommerce_template_loop_add_to_cart',10);

// single product hook 
remove_action('woocommerce_before_single_product_summary','woocommerce_show_product_sale_flash',10);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_title',5);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_rating',10);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_price',10);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_excerpt',20);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_add_to_cart',30);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_meta',40);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_sharing',50);


// wishlist default button hide 
add_filter( 'woosw_button_position_archive', '__return_false' );
add_filter( 'woosw_button_position_single', '__return_false' );

// quicview default button hide
add_filter( 'woosq_button_position', '__return_false' );

// compare default button hide
add_filter( 'woosc_button_position_archive', '__return_false' );
add_filter( 'woosc_button_position_single', '__return_false' );



// woocommerce_get_image_size_gallery_thumbnail
add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function( $size ) {
    return array(
        'width'  => 200,
        'height' => 200,
        'crop'   => 1,
    );
});

// woocommerce_review_gravatar_size
add_filter( 'woocommerce_review_gravatar_size', function( $size ) {
    return 100;
});


add_filter('comment_form_defaults', function($defaults) {
    $defaults['submit_button'] = '<button  name="%1$s" type="submit" id="%2$s" class="tp-btn tp-btn-animetion rounded-5 text-capitalize %3$s">
        <span class="btn-text">%4$s</span>
        <span class="btn-icon">
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1 7H13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M7 1L13 7L7 13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </span>
    </button>';
    return $defaults;
});




// woocommerce mini cart content
add_filter('woocommerce_add_to_cart_fragments', function ($fragments) {
    ob_start();
    ?>
    <div class="mini_shopping_cart_box">
        <?php woocommerce_mini_cart(); ?>
    </div>
    <?php $fragments['.mini_shopping_cart_box'] = ob_get_clean();
    return $fragments;
});

// woocommerce mini cart count icon
if ( ! function_exists( 'kindaid_header_add_to_cart_fragment' ) ) {
    function kindaid_header_add_to_cart_fragment( $fragments ) {
        ob_start();
        ?>
        <span class="tp-header-action-badge cart__count" id="tp-cart-item">
            <?php echo esc_html( WC()->cart->cart_contents_count ); ?>
        </span>
        <?php
        $fragments['#tp-cart-item'] = ob_get_clean();

        return $fragments;
    }
}
add_filter( 'woocommerce_add_to_cart_fragments', 'kindaid_header_add_to_cart_fragment' );




// product add to cart button
function kindaid_wooc_add_to_cart( $args = array() ) {
    global $product;

        if ( $product ) {
            $defaults = array(
                'quantity'   => 1,
                'class'      => implode(
                    ' ',
                    array_filter(
                        array(
                            'tp-btn text-capitalize w-100 justify-content-center',
                            'product_type_' . $product->get_type(),
                            $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                            $product->supports( 'ajax_add_to_cart' ) && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
                        )
                    )
                ),
                'attributes' => array(
                    'data-product_id'  => $product->get_id(),
                    'data-product_sku' => $product->get_sku(),
                    'aria-label'       => $product->add_to_cart_description(),
                    'rel'              => 'nofollow',
                ),
            );

            $args = wp_parse_args( $args, $defaults );

            if ( isset( $args['attributes']['aria-label'] ) ) {
                $args['attributes']['aria-label'] = wp_strip_all_tags( $args['attributes']['aria-label'] );
            }
        }


         // check product type 
         if( $product->is_type( 'simple' ) ){
            $btntext = esc_html__("Add to Cart",'kindaid');
         } elseif( $product->is_type( 'variable' ) ){
            $btntext = esc_html__("Select Options",'kindaid');
         } elseif( $product->is_type( 'external' ) ){
            $btntext = esc_html__("Buy Now",'kindaid');
         } elseif( $product->is_type( 'grouped' ) ){
            $btntext = esc_html__("View Products",'kindaid');
         }
         else{
            $btntext = esc_html__("Add to Cart",'kindaid');
         } 

        echo sprintf( '<a title="%s" href="%s" data-quantity="%s" class="%s" %s>%s</a>',
            $btntext,
            esc_url( $product->add_to_cart_url() ),
            esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
            esc_attr( isset( $args['class'] ) ? $args['class'] : 'tp-btn text-capitalize w-100 justify-content-center' ),
            isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
            '<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <path fill-rule="evenodd" clip-rule="evenodd" d="M3.54431 4.80484L4.08701 11.2487C4.12661 11.7447 4.53251 12.1167 5.02841 12.1167H5.03201H14.8519H14.8537C15.3227 12.1167 15.7232 11.7681 15.7898 11.3053L16.6448 5.41221C16.6646 5.27205 16.6295 5.13189 16.544 5.01868C16.4594 4.90457 16.3352 4.8309 16.1948 4.81113C16.0067 4.81832 8.20092 4.80754 3.54431 4.80484ZM5.02647 13.4642C3.84117 13.4642 2.83766 12.5405 2.74136 11.359L1.91696 1.57098L0.560653 1.33738C0.192551 1.27269 -0.0531497 0.924974 0.00985058 0.557495C0.0746508 0.190017 0.430152 -0.0489788 0.790154 0.00852392L2.66216 0.331977C2.96366 0.384987 3.19316 0.634765 3.21926 0.940248L3.43076 3.45689C16.2792 3.46228 16.3206 3.46857 16.3827 3.47576C16.884 3.54854 17.325 3.80999 17.6256 4.21251C17.9262 4.61413 18.0522 5.1092 17.9802 5.60516L17.1261 11.4974C16.965 12.6187 15.9894 13.4642 14.8554 13.4642H14.8509H5.03367H5.02647Z" fill="currentColor"/>
                                             <path fill-rule="evenodd" clip-rule="evenodd" d="M13.4079 8.12567H10.9131C10.5396 8.12567 10.2381 7.82379 10.2381 7.45181C10.2381 7.07984 10.5396 6.77795 10.9131 6.77795H13.4079C13.7805 6.77795 14.0829 7.07984 14.0829 7.45181C14.0829 7.82379 13.7805 8.12567 13.4079 8.12567Z" fill="currentColor"/>
                                             <path fill-rule="evenodd" clip-rule="evenodd" d="M4.63943 15.9048C4.91033 15.9048 5.12903 16.1235 5.12903 16.3944C5.12903 16.6653 4.91033 16.8849 4.63943 16.8849C4.36763 16.8849 4.14893 16.6653 4.14893 16.3944C4.14893 16.1235 4.36763 15.9048 4.63943 15.9048Z" fill="currentColor"/>
                                             <path fill-rule="evenodd" clip-rule="evenodd" d="M4.63859 16.2097C4.53689 16.2097 4.45409 16.2925 4.45409 16.3942C4.45409 16.5985 4.82399 16.5985 4.82399 16.3942C4.82399 16.2925 4.74029 16.2097 4.63859 16.2097ZM4.6386 17.5569C3.996 17.5569 3.474 17.0349 3.474 16.3933C3.474 15.7518 3.996 15.2307 4.6386 15.2307C5.28121 15.2307 5.80411 15.7518 5.80411 16.3933C5.80411 17.0349 5.28121 17.5569 4.6386 17.5569Z" fill="currentColor"/>
                                             <path fill-rule="evenodd" clip-rule="evenodd" d="M14.7918 15.9048C15.0627 15.9048 15.2823 16.1235 15.2823 16.3944C15.2823 16.6653 15.0627 16.8849 14.7918 16.8849C14.52 16.8849 14.3013 16.6653 14.3013 16.3944C14.3013 16.1235 14.52 15.9048 14.7918 15.9048Z" fill="currentColor"/>
                                             <path fill-rule="evenodd" clip-rule="evenodd" d="M14.7906 16.2098C14.6898 16.2098 14.607 16.2926 14.607 16.3943C14.6079 16.6004 14.9769 16.5986 14.976 16.3943C14.976 16.2926 14.8923 16.2098 14.7906 16.2098ZM14.7909 17.5569C14.1483 17.5569 13.6263 17.0349 13.6263 16.3933C13.6263 15.7518 14.1483 15.2307 14.7909 15.2307C15.4344 15.2307 15.9573 15.7518 15.9573 16.3933C15.9573 17.0349 15.4344 17.5569 14.7909 17.5569Z" fill="currentColor"/>
                                          </svg> '.$btntext
        );
}

// kindaid_product_grid 
function kindaid_product_grid(){
    global $product;
    ?>

    <div class="tp-product-item mb-40">
        <div class="tp-product-thumb p-relative z-index-1 fix">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail(); ?>
            </a>
            <!-- product action -->
            <div class="tp-product-action">
                <div class="tp-product-action-item d-flex flex-column">
                    <?php if(function_exists( 'woosc_init' )) : ?>
                    <div class="tp-product-action-btn tp-product-add-cart-btn">
                        <?php echo do_shortcode('[woosc]'); ?>                                               
                        <span class="tp-product-tooltip tp-product-tooltip-right"><?php echo esc_html__('Add to Compare','kindaid'); ?></span>
                    </div>
                    <?php endif; ?>

                    <?php if(function_exists( 'woosq_init' )) : ?>
                    <div class="tp-product-action-btn tp-product-quick-view-btn">
                        <?php echo do_shortcode('[woosq]'); ?>                                                                   
                        <span class="tp-product-tooltip tp-product-tooltip-right"><?php echo esc_html__('Quick View','kindaid'); ?> </span>
                    </div>
                    <?php endif; ?>

                    <?php if(function_exists( 'woosw_init' )) : ?>
                    <div class="tp-product-action-btn tp-product-add-to-wishlist-btn">
                        <?php echo do_shortcode('[woosw]'); ?>                                                                         
                        <span class="tp-product-tooltip tp-product-tooltip-right"><?php echo esc_html__('Add To Wishlist','kindaid'); ?> </span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="tp-product-cart-btn">
                <?php kindaid_wooc_add_to_cart(); ?>                  
            </div>
        </div>
        <div class="tp-product-content pt-15">
            <?php if($product->get_rating_count() > 0) : ?>
                <div class="tp-product-woo-rating">
                <?php woocommerce_template_loop_rating(); ?>
                </div>
            <?php else : ?>
            <div class="tp-product-rating-icon">
                <span><i class="fa-regular fa-star"></i></span>
                <span><i class="fa-regular fa-star"></i></span>
                <span><i class="fa-regular fa-star"></i></span>
                <span><i class="fa-regular fa-star"></i></span>
                <span><i class="fa-regular fa-star"></i></span>
            </div>
            <?php endif; ?>  
    
            <h3 class="tp-product-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>
            <div class="tp-product-price-wrapper">
                <?php woocommerce_template_loop_price(); ?>
            </div>
        </div>
    </div>
<?php

}

add_action('woocommerce_before_shop_loop_item','kindaid_product_grid'); 

// kindaid_product_details
function kindaid_product_details(){ 
    global $product;
                
    $product_id = get_the_ID(); 
    
    $pro_cat = get_the_terms($product_id,'product_cat');

    $social_switch = get_theme_mod('product_social_switch',false);
    $payment_text = get_theme_mod('payment_text',__('Guaranteed safe & secure checkout','kindaid'));
    $payment_image = get_theme_mod('payment_image',get_template_directory_uri().'/assets/img/product/cart/payment-option.png');

    ?>

            <div class="tp-product-details-wrapper pb-30 mt-15">
                <?php if ( ! empty( $pro_cat ) && ! is_wp_error( $pro_cat ) ) : ?> 
				<div class="tp-product-details-category mb-10">
                    <?php 
                        $html = '';
                        foreach($pro_cat as $key => $cat) {

                        $html .= '<span class="tp-section-subtitle">' .$cat->name. '</span>, ';

                        }
                        echo rtrim($html,', '); 

                    ?>
				</div>
                <?php endif; ?>
				<h3 class="tp-product-details-title mb-20"><?php the_title(); ?></h3>

				<!-- inventory details -->
				<div class="tp-product-details-inventory mb-25 d-flex align-items-center justify-content-between">
					<!-- price -->
					<div class="tp-product-details-price-wrapper">
						<span class="tp-product-details-price"><?php woocommerce_template_single_price(); ?></span>
						<div class="tp-product-details-rating-wrapper">
							<?php woocommerce_template_single_rating(); ?>
						</div>
					</div>
				</div>
				<div class="mb-30">
				<p><?php woocommerce_template_single_excerpt(); ?></p>
				</div>
				<!-- actions -->

				<div class="tp-product-details-action-wrapper mb-10">
                     <?php woocommerce_template_single_add_to_cart(); ?>   
				</div>

				
				<?php woocommerce_template_single_meta(); ?>

                <?php if($social_switch) : ?>
				<div class="tp-product-details-social mb-50">
					<div class="tp-footer-social">
                        <?php
                        global $product;
                        $product_url   = get_permalink($product->get_id());
                        $product_title = get_the_title($product->get_id());
                        ?>

                        <!-- Facebook -->
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($product_url); ?>" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="18" viewBox="0 0 12 18" fill="none">
								<path fill-rule="evenodd" clip-rule="evenodd" d="M1.62839 7.77713C0.911363 7.77713 0.761719 7.91782 0.761719 8.59194V9.81416C0.761719 10.4883 0.911363 10.629 1.62839 10.629H3.36172V15.5179C3.36172 16.192 3.51136 16.3327 4.22839 16.3327H5.96172C6.67874 16.3327 6.82839 16.192 6.82839 15.5179V10.629H8.77466C9.31846 10.629 9.45859 10.5296 9.60798 10.038L9.97941 8.81579C10.2353 7.97368 10.0776 7.77713 9.14609 7.77713H6.82839V5.74009C6.82839 5.29008 7.21641 4.92527 7.69505 4.92527H10.1617C10.8787 4.92527 11.0284 4.78458 11.0284 4.11046V2.48083C11.0284 1.80671 10.8787 1.66602 10.1617 1.66602H7.69505C5.30182 1.66602 3.36172 3.49004 3.36172 5.74009V7.77713H1.62839Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
							</svg>
                        </a>

                        <!-- Twitter/X -->
                        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode($product_url); ?>&text=<?php echo urlencode($product_title); ?>" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14" viewBox="0 0 16 14" fill="none">
								<path fill-rule="evenodd" clip-rule="evenodd" d="M5.28884 0.714844H0.666992L6.14691 7.9153L1.01754 13.9556H3.38746L7.26697 9.38713L10.7118 13.9136H15.3337L9.69453 6.50391L9.70451 6.51669L14.5599 0.798959H12.19L8.58427 5.04503L5.28884 0.714844ZM3.21817 1.97588H4.65702L12.7825 12.6525H11.3436L3.21817 1.97588Z" fill="currentColor"/>
							</svg>
                        </a>

                        <!-- LinkedIn -->
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode($product_url); ?>" target="_blank">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M1.66602 8.99935C1.66602 5.54238 1.66602 3.8139 2.73996 2.73996C3.8139 1.66602 5.54238 1.66602 8.99935 1.66602C12.4563 1.66602 14.1848 1.66602 15.2587 2.73996C16.3327 3.8139 16.3327 5.54238 16.3327 8.99935C16.3327 12.4563 16.3327 14.1848 15.2587 15.2587C14.1848 16.3327 12.4563 16.3327 8.99935 16.3327C5.54238 16.3327 3.8139 16.3327 2.73996 15.2587C1.66602 14.1848 1.66602 12.4563 1.66602 8.99935Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
								<path d="M12.4747 9.00103C12.4747 10.9195 10.9195 12.4747 9.00103 12.4747C7.08256 12.4747 5.52734 10.9195 5.52734 9.00103C5.52734 7.08256 7.08256 5.52734 9.00103 5.52734C10.9195 5.52734 12.4747 7.08256 12.4747 9.00103Z" stroke="currentColor" stroke-width="1.5"/>
								<path d="M13.251 4.75391L13.242 4.75391" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
                        </a>
					</div> 
				</div>
                <?php endif; ?>

                <?php if(!empty($payment_text)) : ?>
				<div class="tp-product-details-payment d-flex align-items-center flex-wrap justify-content-between">
					<p><?php echo kindaid_kses($payment_text); ?></p>
					<img src="<?php echo esc_url($payment_image); ?>" alt="">
				</div>
                <?php endif; ?>
			</div>
<?php
}

add_action('woocommerce_single_product_summary','kindaid_product_details');