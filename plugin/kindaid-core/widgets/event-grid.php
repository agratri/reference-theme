<?php
use Etn\Core\Event\Event_Model;

class Kindaid_Events_Post extends \Elementor\Widget_Base {

	public function get_name(): string {
		return 'kindaid-events';
	}

	public function get_title(): string {
		return esc_html__( 'Event Post', 'kindaid-core' );
	}

	public function get_icon(): string {
		return 'eicon-components';
	}

	public function get_categories(): array {
		return [ 'kindaid-core' ];
	}

	public function get_keywords(): array {
		return [ 'event' ];
	}

	protected function register_controls(): void {
		$this->register_controls_section();
		$this->register_style_section();
	}

	protected function register_controls_section(){

		$this->start_controls_section(
			'layout_section',
			[
				'label' => esc_html__( 'Layout', 'kindaid-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'design-layout',
			[
				'label' => esc_html__( 'Select Layout', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'layout-1',
				'options' => [
					'layout-1' => esc_html__( 'Layout Grid', 'kindaid-core' ),
					'layout-2' => esc_html__( 'Layout List', 'kindaid-core' ),
					'layout-3' => esc_html__( 'Layout Image Hover', 'kindaid-core' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'heading_section',
			[
				'label' => esc_html__( 'Event Grid', 'kindaid-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'post-number',
			[
				'label' => esc_html__( 'Post Number', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => esc_html__( '3', 'kindaid-core' ),
			]
		);

		$this->add_control(
			'post-cat',
			[
				'label' => esc_html__( 'Select Post Categorie', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => kindaid_all_cat('etn_category')
			]
		);


		$this->add_control(
			'post-in',
			[
				'label' => esc_html__( 'Post In', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => kindaid_all_post('etn')
			]
		);

		$this->add_control(
			'post-not-in',
			[
				'label' => esc_html__( 'Post Not In', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => kindaid_all_post('etn')
			]
		);

		$this->add_control(
			'post-order',
			[
				'label' => esc_html__( 'Order', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'ASC',
				'options' => [
					'ASC' => esc_html__( 'ASC', 'kindaid-core' ),
					'DESC' => esc_html__( 'DESC', 'kindaid-core' ),
				],
			]
		);

		$this->add_control(
			'post-order-by',
			[
				'label' => esc_html__( 'Order By', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
			        'ID' => 'Post ID',
			        'author' => 'Post Author',
			        'title' => 'Title',
			        'date' => 'Date',
			        'modified' => 'Last Modified Date',
			        'parent' => 'Parent Id',
			        'rand' => 'Random',
			        'comment_count' => 'Comment Count',
			        'menu_order' => 'Menu Order',
				],
			]
		);

		$this->add_control(
			'show_pagination',
			[
				'label' => esc_html__( 'Show Pagination', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'kindaid-core' ),
				'label_off' => esc_html__( 'Hide', 'kindaid-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

	}

	// style 
	protected function register_style_section(){
		$this->start_controls_section(
			'section_area_style',
			[
				'label' => esc_html__( 'Section Style', 'kindaid-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'bg_color',
			[
				'label' => esc_html__( 'Sub Title Color', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .el-bg' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'bg_margin',
			[
				'label' => esc_html__( 'Margin', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'custom' ],
				'default' => [
					'top' => '',
					'right' => '',
					'bottom' => '',
					'left' => '',
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .el-bg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'bg_padding',
			[
				'label' => esc_html__( 'Padding', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'custom' ],
				'default' => [
					'top' => '',
					'right' => '',
					'bottom' => '',
					'left' => '',
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .el-bg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_sub_title_style',
			[
				'label' => esc_html__( 'Sub Title', 'kindaid-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'sub_title_color',
			[
				'label' => esc_html__( 'Sub Title Color', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .el-sub-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'sub_title_margin',
			[
				'label' => esc_html__( 'Margin', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'custom' ],
				'default' => [
					'top' => '',
					'right' => '',
					'bottom' => '',
					'left' => '',
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .el-sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'sub_title_padding',
			[
				'label' => esc_html__( 'Padding', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'custom' ],
				'default' => [
					'top' => '',
					'right' => '',
					'bottom' => '',
					'left' => '',
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .el-sub-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'sub_title_typography',
				'selector' => '{{WRAPPER}} .el-sub-title',
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__( 'Title', 'kindaid-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .el-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_mark_color',
			[
				'label' => esc_html__( 'Title Mark Color', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .el-title span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_margin',
			[
				'label' => esc_html__( 'Margin', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'custom' ],
				'default' => [
					'top' => '',
					'right' => '',
					'bottom' => '',
					'left' => '',
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .el-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_padding',
			[
				'label' => esc_html__( 'Padding', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'custom' ],
				'default' => [
					'top' => '',
					'right' => '',
					'bottom' => '',
					'left' => '',
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .el-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .el-title',
			]
		);


		$this->end_controls_section();


		$this->start_controls_section(
			'section_content_style',
			[
				'label' => esc_html__( 'Content', 'kindaid-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_color',
			[
				'label' => esc_html__( 'Color', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .el-content' => 'color: {{VALUE}};',
				],
			]
		);


		$this->add_control(
			'content_margin',
			[
				'label' => esc_html__( 'Margin', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'custom' ],
				'default' => [
					'top' => '',
					'right' => '',
					'bottom' => '',
					'left' => '',
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .el-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'content_padding',
			[
				'label' => esc_html__( 'Padding', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'custom' ],
				'default' => [
					'top' => '',
					'right' => '',
					'bottom' => '',
					'left' => '',
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .el-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .el-content',
			]
		);


		$this->end_controls_section();
	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();

		$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

		$args = array(
			'post_type'              => array('etn'), 
			'post_status'            => array('publish'), 
			'posts_per_page'         => $settings['post-number'], // use -1 for all post
			'order'                  => $settings['post-order'], // Also support: ASC
			'orderby'                => $settings['post-order-by'],
			'post__in'                => $settings['post-in'],
			'post__not_in'                => $settings['post-not-in'],
			'paged'          => $paged,
		);

		if(!empty($settings['post-cat'])){
			$args['tax_query'] = array(
				array(
					'taxonomy'         => 'etn_category', // taxonomy slug
					'terms'            => $settings['post-cat'], // term slug
					'field'            => 'slug', // Also support: slug, name, term_taxonomy_id
					'operator'         => 'IN', // Also support: AND, NOT IN, EXISTS, NOT EXISTS
					'include_children' => true,
				),
			);
		}

		$query = new \WP_Query($args);

		?>

		<?php if($settings['design-layout'] == 'layout-2') : ?>
		<div class="tp-causes-area fix p-relative">
			<div class="container-none">
				<div class="row align-items-end">
					<div class="col-lg-12">
						<div class="tp-event-2-wrap">
							<?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); 
								$event_id = get_the_ID();
								$etn_event_location = get_post_meta($event_id, 'etn_event_location', true);

								$start_date = get_post_meta( $event_id, 'etn_start_date', true );

								$start_time = get_post_meta( $event_id, 'etn_start_time', true );
								$end_time   = get_post_meta( $event_id, 'etn_end_time', true );
							?>
							<div class="tp-event-2-item mb-10 d-flex align-items-center justify-content-between flex-wrap wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".3s">
								<div class="tp-event-2-left d-flex align-items-center flex-wrap">
									<div class="tp-event-2-date mb-25 mr-45">
										<h4 class="mb-0"><?php echo esc_html(date( 'd', strtotime( $start_date ))); ?></h4>
										<span><?php echo esc_html(date( 'M, Y', strtotime( $start_date ))); ?></span>
									</div>
									<div class="tp-event-2-thumb mr-40 fix d-inline-block mb-25">
										<?php the_post_thumbnail(); ?>
									</div>
									<div class="tp-event-2-content mb-25">
										<h3 class="tp-event-2-title mb-5"><a href="<?php the_permalink(); ?>" class="common-underline"><?php the_title(); ?></a></h3>
										<div class="tp-event-meta">
											<span class="mr-20">
												<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
												<path d="M8 15C11.866 15 15 11.866 15 8C15 4.13401 11.866 1 8 1C4.13401 1 1 4.13401 1 8C1 11.866 4.13401 15 8 15Z" stroke="#454449" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
												<path d="M8 3.80005V8.00005L10.8 9.40005" stroke="#454449" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
												</svg> 
												<?php echo esc_html($start_time); ?> - <?php echo esc_html($end_time); ?>
											</span>
											<span>
												<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
												<path d="M8 15C11.866 15 15 11.866 15 8C15 4.13401 11.866 1 8 1C4.13401 1 1 4.13401 1 8C1 11.866 4.13401 15 8 15Z" stroke="#454449" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
												<path d="M8 3.80005V8.00005L10.8 9.40005" stroke="#454449" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
												</svg> 
												<?php echo  $etn_event_location['address']; ?>
											</span>
										</div>
									</div>
								</div>
								<div class="tp-event-2-link mb-25">
									<a class="tp-event-2-btn tp-btn-animetion" href="<?php the_permalink(); ?>">
										<span class="btn-icon">
											<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M1 7H13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
												<path d="M7 1L13 7L7 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
											</svg>
										</span>
									</a>
								</div>    
							</div>
							<?php endwhile; wp_reset_postdata(); ?>
							<?php else : ?>
								<p>No posts found</p>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php elseif($settings['design-layout'] == 'layout-3') : ?>
		<div class="tp-event-area tp-event-4-style fix p-relative">
			<div class="container container-1424">
				<div class="row align-items-end">
					<div class="col-lg-12">
						<div class="tp-event-2-wrap">
							<?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); 
								$event_id = get_the_ID();
								$etn_event_location = get_post_meta($event_id, 'etn_event_location', true);

								$start_date = get_post_meta( $event_id, 'etn_start_date', true );

								$start_time = get_post_meta( $event_id, 'etn_start_time', true );
								$end_time   = get_post_meta( $event_id, 'etn_end_time', true );

							?>
							<div class="tp-event-2-item d-flex align-items-center justify-content-between flex-wrap position-relative wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".3s">
								<div class="tp-event-4-thumb bg-position" data-img-bg="<?php the_post_thumbnail_url(); ?>"></div>
								<div class="tp-event-2-left d-flex align-items-center flex-wrap mr-30">
								<div class="tp-event-2-date mb-25 mr-130">
									<h4 class="mb-0"><?php echo esc_html(date( 'd', strtotime( $start_date ))); ?></h4>
									<span><?php echo esc_html(date( 'M, Y', strtotime( $start_date ))); ?></span>
								</div>
								<div class="tp-event-2-content mb-25">
									<h3 class="tp-event-2-title mb-5"><a href="<?php the_permalink(); ?>" class="common-underline"><?php the_title(); ?></a></h3>
									<div class="tp-event-meta">
										<span class="mr-20">
											<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
											<path d="M8 15C11.866 15 15 11.866 15 8C15 4.13401 11.866 1 8 1C4.13401 1 1 4.13401 1 8C1 11.866 4.13401 15 8 15Z" stroke="#454449" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
											<path d="M8 3.80005V8.00005L10.8 9.40005" stroke="#454449" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
											</svg> 
											<?php echo esc_html($start_time); ?> - <?php echo esc_html($end_time); ?>
										</span>
										<span>
											<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
											<path d="M8 15C11.866 15 15 11.866 15 8C15 4.13401 11.866 1 8 1C4.13401 1 1 4.13401 1 8C1 11.866 4.13401 15 8 15Z" stroke="#454449" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
											<path d="M8 3.80005V8.00005L10.8 9.40005" stroke="#454449" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
											</svg> 
											<?php echo  $etn_event_location['address']; ?>
										</span>
									</div>
								</div>
								</div>
								<div class="tp-event-2-link mb-25">
								<a class="tp-event-2-btn tp-btn-animetion" href="<?php the_permalink(); ?>">
									<span class="btn-icon">
										<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M1 10H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
											<path d="M10 1L19 10L10 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
										</svg>
									</span>
								</a>
								</div>    
							</div>
							<?php endwhile; wp_reset_postdata(); ?>
							<?php else : ?>
								<p>No posts found</p>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>



		<?php else : ?>

      <div class="tp-event-area fix p-relative">
         <div class="container container-1424">
            <div class="row">
               <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); 
			    $event_id = get_the_ID();
			   	$etn_event_location = get_post_meta($event_id, 'etn_event_location', true);

				$start_date = get_post_meta( $event_id, 'etn_start_date', true );

				$start_time = get_post_meta( $event_id, 'etn_start_time', true );
				$end_time   = get_post_meta( $event_id, 'etn_end_time', true );

			   ?>
               <div class="col-xl-4 col-md-6">
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
                           <span>
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                 <path d="M8 15C11.866 15 15 11.866 15 8C15 4.13401 11.866 1 8 1C4.13401 1 1 4.13401 1 8C1 11.866 4.13401 15 8 15Z" stroke="#454449" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M8 3.80005V8.00005L10.8 9.40005" stroke="#454449" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                              </svg> 
                              <?php echo  $etn_event_location['address']; ?>
                           </span>
                        </div>
                        <h3 class="tp-event-title"><a href="<?php the_permalink(); ?>" class="common-underline"><?php the_title(); ?></a></h3>
                        <div class="tp-event-link mt-15">
                           <a class="tp-btn tp-btn-nopading tp-btn-animetion" href="<?php the_permalink(); ?>">
                              <span class="btn-text">View event</span>
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
				<?php endwhile; wp_reset_postdata(); ?>
				<?php else : ?>
					<p>No posts found</p>
				<?php endif; ?>
            </div>

			<?php if($settings['show_pagination']) : ?>	
			<div class="row">
				<div class="col-12">
					<div class="tp-pagination text-center mt-20 wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".4s">
							<?php 
								echo paginate_links( array(
									'total'     => $query->max_num_pages,
									'current'   => $paged,
									'type'      => 'list',
									'prev_text' => '<i class="far fa-arrow-left"></i>',
									'next_text' => '<i class="far fa-arrow-right"></i>',
									'end_size'  => 1, 
									'mid_size'  => 1,
								) );
							?>
					</div>
				</div>
			</div>
			<?php endif; ?>

         </div>
      </div>
	  <?php endif; ?>


		<?php
	}

}


$widgets_manager->register( new Kindaid_Events_Post() );