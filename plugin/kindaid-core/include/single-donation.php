<?php

get_header();

$post_center = is_active_sidebar('blog-sidebar') ? '' : 'justify-content-center';


   $campaign = charitable_get_campaign( get_the_ID() );
   $goal = charitable_format_money($campaign->get_goal());
   $donated = charitable_format_money($campaign->get_donated_amount());
   $percent  = round($campaign->get_percent_donated_raw());	
   $button_text = $campaign->get( 'donate_button_text', true );


add_filter( 'charitable_donation_form_user_fields', 'kindaid_remove_donation_fields' );

function kindaid_remove_donation_fields( $fields ) {
    if ( isset( $fields['address'] ) ) {
        unset( $fields['address'] );
    }

    if ( isset( $fields['address_2'] ) ) {
        unset( $fields['address_2'] );
    }

    if ( isset( $fields['city'] ) ) {
        unset( $fields['city'] );
    }
    if ( isset( $fields['state'] ) ) {
        unset( $fields['state'] );
    }

    if ( isset( $fields['postcode'] ) ) {
        unset( $fields['postcode'] );
    }

    if ( isset( $fields['phone'] ) ) {
        unset( $fields['phone'] );
    }

    if ( isset( $fields['country'] ) ) {
        unset( $fields['country'] );
    }
    return $fields;
}





?>

<?php
function kindaid_campaign_total_donations_count($campaign_id) {
    global $wpdb;

    // Table name
    $table_name = $wpdb->prefix . 'charitable_campaign_donations';

    // Custom query
    $total = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT COUNT(*) FROM $table_name WHERE campaign_id = %d",
            $campaign_id
        )
    );

    return $total;
}

?>


<div class="tp-event-details-area pt-115 pb-90">
   <div class="container container-1424">
      
      <div class="row">
         <div class="col-xl-8">
            <div class="tp-causes-details mb-30">
               <div class="tp-causes-details-thumb">
                  <?php the_post_thumbnail(); ?>
                  
               </div>
               <div class="tp-donation-form">
                  <div class="tp-donation-form-wrap">
                     <h3 class="tp-donation-form-title mb-35"><?php the_title(); ?></h3>
                     <div class="tp-donation-progress-main">
                        <div class="row">
                           <div class="col-10">
                              <h5 class="tp-donation-progress-label mb-5"><?php echo esc_html($donated); ?> <?php echo esc_html__('pledged of','kindaid'); ?>  <span><?php echo esc_html($goal); ?></span></h5>
                           </div>
                           <div class="col-2 text-end">
                              <span class="tp-donation-progress-number"><?php echo esc_html($percent); ?>%</span>
                           </div>
                        </div>
                        <div class="tp-donation-progress mt-10 mb-30">
                           <div class="progress">
                              <div class="progress-bar wow slideInLeft" data-wow-duration="1s" data-wow-delay=".05s" style="width: <?php echo esc_html($percent); ?>%"></div>
                           </div>
                        </div>
                        <div class="tp-donation-filter-custom mt-40">
                           <?php echo do_shortcode( '[charitable_donation_form]' ); ?>
                           
                        </div>
                     </div>
                  </div>
               </div>
               <div class="tp-donation-info-wrap">
                  <?php the_content(); ?>
               </div>
            </div>       
         </div>
         <div class="col-xl-4">
            <div class="tp-event-sidebar ml-65">
               <?php dynamic_sidebar('donation-sidebar'); ?>
            </div>
         </div>
      </div>
   </div>
</div>


<?php get_footer();