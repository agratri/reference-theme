<?php
defined('ABSPATH') || exit;

$single_event_id = get_the_id();
$logo = get_post_meta( $single_event_id, 'event_logo_id', true );
$event_logo = wp_get_attachment_image( $logo );


$etn_event_location = get_post_meta($single_event_id, 'etn_event_location', true);

$start_date = get_post_meta( $single_event_id, 'etn_start_date', true );

$start_time = get_post_meta( $single_event_id, 'etn_start_time', true );
$end_time   = get_post_meta( $single_event_id, 'etn_end_time', true );

$tickets  = get_post_meta( $single_event_id, 'etn_ticket_variations', true );

$is_paid = false;

foreach($tickets as $ticket){
    if($ticket['etn_ticket_price'] > 0 ) {
        $is_paid = true;
        break;
    }
}



// var_dump($is_paid);


if( ( ETN_DEMO_SITE === false ) || ( ETN_DEMO_SITE == true && ETN_EVENT_TEMPLATE_TWO_ID != get_the_ID(  ) && ETN_EVENT_TEMPLATE_THREE_ID != get_the_ID(  )) ){
?>
<?php // do_action("etn_before_single_event_details", $single_event_id); ?>


<div class="tp-event-details-area pt-115 pb-85">
    <div class="container container-1424">
        <div class="row align-items-end">
            <div class="col-lg-8 col-md-8">
                <div class="tp-section-info mb-30">
                    <div class="event-logo">
                        <?php echo wp_kses_post($event_logo); ?>
                    </div>
                    <span class="tp-section-subtitle mb-15 d-inline-block"><?php echo esc_html__('Discover Events','kindaid'); ?></span>
                    <h2 class="tp-section-title">
                        <?php
                            echo esc_html( apply_filters('etn_single_event_content_title', get_the_title()) );
                        ?>
                    </h2>  
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="tp-event-price text-md-end mb-45">
                    <?php if($is_paid) : ?>
                    <span>Paid</span>
                    <?php else : ?>
                    <span>Free</span>
                    <?php endif; ?>  
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="tp-event-details-img mt-25 mb-60">
                    <?php echo get_the_post_thumbnail(); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="tp-event-details mb-30">
                    <?php the_content(); ?>
                </div>
            </div>
            <div class="col-xl-4 col-lg-5">
                <div class="tp-event-sidebar ml-65">
                    <div class="tp-event-info mb-20">
                        <div class="tp-event-info-icon">
                            <i class="fal fa-calendar-alt"></i>
                        </div>
                        <div class="tp-event-info-text">
                            <h3 class="tp-event-info-title"><?php echo esc_html__('Event Date','kindaid'); ?></h3>
                            <span><?php echo esc_html(date( 'F j, Y', strtotime( $start_date ))); ?> <br> <?php echo esc_html($start_time); ?> - <?php echo esc_html($end_time); ?></span>
                        </div>
                    </div>
                    <div class="tp-event-info tp-event-info-2 mb-20" data-bg-color="#620035">
                        <div class="tp-event-info-icon">
                            <i class="far fa-map-marker-alt"></i>
                        </div>
                        <div class="tp-event-info-text">
                            <h3 class="tp-event-info-title"><?php echo esc_html__('Event Location','kindaid'); ?> </h3>
                            <span><?php echo  esc_html($etn_event_location['address']); ?></span>
                        </div>
                    </div>

                    <?php dynamic_sidebar('event-sidebar'); ?>       

                    <?php do_action("etn_after_single_event_meta", $single_event_id); ?>
                </div>
            </div>
        </div>
        <?php  do_action("etn_after_single_event_container", $single_event_id); ?>
    </div>
</div>


<?php // do_action("etn_after_single_event_details", $single_event_id); ?>

<?php } ?>