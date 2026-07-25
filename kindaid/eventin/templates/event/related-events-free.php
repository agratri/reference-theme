<?php

use \Etn\Utils\Helper;

defined( 'ABSPATH' ) || exit;

if ( is_array( $data ) && ! empty( $data ) ) {

    // Sort the data by start date
    usort( $data, function ( $a, $b ) {
        $start_date_a = get_post_meta( $a->ID, 'etn_start_date', true );
        $start_date_b = get_post_meta( $b->ID, 'etn_start_date', true );

        $timestamp_a = strtotime( $start_date_a );
        $timestamp_b = strtotime( $start_date_b );

        return $timestamp_a <=> $timestamp_b; // Ascending order
    });

	?>
    <div class="etn-event-related-post">
        <h3 class="related-post-title mb-30">
			<?php
			$related_events_title = apply_filters( 'etn_event_related_event_title', $title );
			echo esc_html($related_events_title );
			?>
        </h3>
        <div class="etn-row">
			<?php
			foreach ( $data as $value ) {

				$category = Helper::cate_with_link( $value->ID, 'etn_category' );
				$category = ! empty( $category ) ? $category : "";

				$start_date             = get_post_meta( $value->ID, 'etn_start_date', true );
				$start_date             = Helper::etn_date( $start_date );
				$related_event_location = get_post_meta( $value->ID, 'etn_event_location', true );
				$event_location_type    = get_post_meta( $value->ID, 'etn_event_location_type', true );
				
				$start_time = get_post_meta( $value->ID, 'etn_start_time', true );
				$end_time   = get_post_meta( $value->ID, 'etn_end_time', true );

                if ( class_exists('Wpeventin_Pro') ) {
                    $event_terms            = ! empty( get_the_terms( $value->ID, 'etn_location' ) ) ? get_the_terms( $value->ID, 'etn_location' ) : [];
                } else {
                    $event_terms = [];
                }
                
				?>
                <div class="etn-col-lg-<?php echo esc_attr( $column ); ?> etn-col-md-6">

                  <div class="tp-event p-relative mb-30 wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".3s">
                     <div class="tp-event-img fix">
                        <?php the_post_thumbnail(); ?>
                        <div class="tp-event-date">
                           <span><?php echo esc_html(date( 'M', strtotime( $start_date ))); ?></span>
                           <h4><?php echo esc_html(date( 'd', strtotime( $start_date ))); ?></h4>
                        </div>
                     </div>
                     <div class="tp-event-content">
                        <div class="tp-event-meta mb-5">
                           <span class="mr-20">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                 <path d="M8 15C11.866 15 15 11.866 15 8C15 4.13401 11.866 1 8 1C4.13401 1 1 4.13401 1 8C1 11.866 4.13401 15 8 15Z" stroke="#454449" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M8 3.80005V8.00005L10.8 9.40005" stroke="#454449" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                              </svg> 
                              <?php echo esc_html($start_time); ?> - <?php echo esc_html($end_time); ?>
                           </span>
                           <?php $location = \Etn\Core\Event\Helper::instance()->display_event_location( $value->ID ); ?>
                           <?php if ( ! empty( $location )) : ?>
                           <span>
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                 <path d="M8 15C11.866 15 15 11.866 15 8C15 4.13401 11.866 1 8 1C4.13401 1 1 4.13401 1 8C1 11.866 4.13401 15 8 15Z" stroke="#454449" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M8 3.80005V8.00005L10.8 9.40005" stroke="#454449" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                              </svg> 
                              <?php echo esc_html( $location ); ?>
                           </span>
                           <?php endif; ?> 
                        </div>
                        <h3 class="tp-event-title"><a href="<?php echo esc_url( get_the_permalink( $value->ID ) ); ?>" class="common-underline"><?php echo esc_html( get_the_title( $value->ID ) ); ?></a></h3>
                        <div class="tp-event-link mt-15">
                           <a class="tp-btn tp-btn-nopading tp-btn-animetion" href="<?php echo esc_url( get_the_permalink( $value->ID ) ); ?>">
                              <span class="btn-text"><?php echo esc_html__( 'View event', "kindaid" ) ?> </span>
                              <span class="btn-icon">
                                 <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 7H13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M7 1L13 7L7 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                 </svg>
                              </span>
                           </a>
                        </div>    
                     </div>
                  </div>
                </div>
				<?php
			}
			?>
        </div>
    </div>
	<?php
}
