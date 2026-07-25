<?php
class Kindaid_Charity_Slider extends \Elementor\Widget_Base {

	public function get_name(): string {
		return 'kindaid-charity-slider';
	}

	public function get_title(): string {
		return esc_html__( 'Charity Slider', 'kindaid-core' );
	}

	public function get_icon(): string {
		return 'eicon-components';
	}

	public function get_categories(): array {
		return [ 'kindaid-core' ];
	}

	public function get_keywords(): array {
		return [ 'charity' ];
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
					'layout-1' => esc_html__( 'Layout 01', 'kindaid-core' ),
					'layout-2' => esc_html__( 'Layout 02', 'kindaid-core' ),
					'layout-3' => esc_html__( 'Layout 03', 'kindaid-core' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'heading_section',
			[
				'label' => esc_html__( 'Title & Content', 'kindaid-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'sub_title',
			[
				'label' => esc_html__( 'Sub Title', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Hero Sub Title', 'kindaid-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Hero Title Here', 'kindaid-core' ),
			]
		);

		$this->add_control(
			'description',
			[
				'label' => esc_html__( 'Content', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( '', 'kindaid-core' ),
			]
		);

		$this->add_control(
			'text_align',
			[
				'label' => esc_html__( 'Alignment', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'kindaid-core' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'kindaid-core' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'kindaid-core' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'left',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .tp-align' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'post_section',
			[
				'label' => esc_html__( 'Charity Slider', 'kindaid-core' ),
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
				'options' => kindaid_all_cat('campaign_category')
			]
		);

		$this->add_control(
			'post-in',
			[
				'label' => esc_html__( 'Post In', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => kindaid_all_post('campaign')
			]
		);

		$this->add_control(
			'post-not-in',
			[
				'label' => esc_html__( 'Post Not In', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => kindaid_all_post('campaign')
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
			'post-content-word',
			[
				'label' => esc_html__( 'Content Word Count', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => esc_html__( '9', 'kindaid-core' ),
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
			'post_type'              => array('campaign'), 
			'post_status'            => array('publish'), 
			'posts_per_page'         => $settings['post-number'], // use -1 for all post
			'order'                  => $settings['post-order'], // Also support: ASC
			'orderby'                => $settings['post-order-by'],
			'post__in'               => $settings['post-in'],
			'post__not_in'           => $settings['post-not-in'],
			'paged'          => $paged,
		);

		if(!empty($settings['post-cat'])){
			$args['tax_query'] = array(
				array(
					'taxonomy'         => 'campaign_category', // taxonomy slug
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
      <div class="tp-causes-area tp-causes-2-style fix p-relative">
         <div class="container container-1324">
            <div class="row align-items-end">
               <div class="col-md-9">
                  <div class="tp-section-info mb-50 p-relative">
                     <span class="tp-section-subtitle d-inline-block mb-15 wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".3s"><?php echo esc_html($settings['sub_title']); ?></span>
                     <h2 class="tp-section-title mb-20 wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".4s"><?php echo kindaid_kses_svg($settings['title']); ?></h2>  
					<?php if(!empty($settings['description'])) : ?>
					<p class="wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".5s"><?php echo kindaid_kses_svg($settings['description']); ?></p>
					<?php endif; ?>  
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="tp-causes-arrow-wrap mb-50 text-md-end wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".5s">
                     <button class="tp-causes-prev">
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <path d="M13 7H1" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                           <path d="M7 1L1 7L7 13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                     </button>
                     <button class="tp-causes-next">
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <path d="M1 7H13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                           <path d="M7 1L13 7L7 13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                     </button>
                  </div>
               </div>
            </div>
         </div>
         <div class="container-fluid p-0">
            <div class="row">
               <div class="col-12 wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".4s">
                  <div class="swiper tp-causes-slider-active">
                     <div class="swiper-wrapper">
						<?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); 
							$campaign = charitable_get_campaign( get_the_ID() );
							$goal = charitable_format_money($campaign->get_goal());
							$donated = charitable_format_money($campaign->get_donated_amount());
							$percent  = round($campaign->get_percent_donated_raw());	
							$button_text = $campaign->get( 'donate_button_text', true );
						?>
                        <div class="swiper-slide">
							<div class="tp-causes-wrap mb-30">
								<div class="tp-causes-inner">
									<div class="tp-causes-thumb fix mb-25">
										<?php the_post_thumbnail(); ?>
									</div>
									<div class="tp-causes-content">
										<h3 class="tp-causes-title mb-10"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
										<p class="tp-causes-dec mb-0"><?php echo wp_trim_words(get_the_content(),$settings['post-content-word']); ?></p>
									</div>
								</div>
								<div class="tp-causes-button">
									<div class="tp-progress mb-10">
										<div class="tp-progress-top d-flex justify-content-between mb-5">
											<span><?php echo esc_html__('Donation','kindaid-core'); ?></span>
											<label><?php echo esc_html($percent); ?>%</label>
										</div>
										<div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="<?php echo esc_html($percent); ?>" aria-valuemin="0" aria-valuemax="100">
											<div class="progress-bar wow slideInLeft" data-wow-duration="1s" data-wow-delay=".1s" style="width: <?php echo esc_html($percent); ?>%"></div>
										</div>
									</div>
									<div class="row">
										<div class="col-6">
											<div class="tp-causes-amount">
												<label><?php echo esc_html__('Goals:','kindaid-core'); ?></label>
												<span><?php echo esc_html($goal); ?></span>
											</div>
										</div>
										<div class="col-6">
											<div class="tp-causes-amount text-end">
												<label><?php echo esc_html__('Raised:','kindaid-core'); ?></label>
												<span><?php echo esc_html($donated); ?></span>
											</div>
										</div>
									</div>
									<?php if(!empty($button_text)) : ?>
									<a class="tp-btn tp-btn-animetion mt-20 tp-btn-mulberry w-100 justify-content-center" href="<?php the_permalink(); ?>">
										<span class="btn-text"><?php echo esc_html($button_text); ?></span>
										<span class="btn-icon">
											<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M1 7H13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
												<path d="M7 1L13 7L7 13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
											</svg>
										</span>
									</a>
									<?php endif; ?>
								</div>
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
      </div>

		<?php elseif($settings['design-layout'] == 'layout-3') : ?>
      <div class="tp-causes-area tp-causes-3-style fix p-relative">
         <div class="container container-1424">
            <div class="row align-items-end">
               <div class="col-md-9">
                  <div class="tp-section-info mb-50 p-relative">
                     <span class="tp-section-subtitle d-inline-block mb-15 wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".3s"><?php echo esc_html($settings['sub_title']); ?></span>
                     <h2 class="tp-section-title mb-20 wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".4s"><?php echo kindaid_kses_svg($settings['title']); ?></h2>   
					<?php if(!empty($settings['description'])) : ?>
					<p class="wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".5s"><?php echo kindaid_kses_svg($settings['description']); ?></p>
					<?php endif; ?>  
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="tp-causes-arrow-wrap mb-50 text-md-end wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".5s">
                     <button class="tp-causes-prev">
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <path d="M13 7H1" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                           <path d="M7 1L1 7L7 13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                     </button>
                     <button class="tp-causes-next">
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <path d="M1 7H13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                           <path d="M7 1L13 7L7 13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                     </button>
                  </div>
               </div>
            </div>
         </div>
         <div class="container container-1424">
            <div class="row">
               <div class="col-12 wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".3s">
                  <div class="swiper-container tp-causes-3-slider-active">
                     <div class="swiper-wrapper">
						<?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); 
							$campaign = charitable_get_campaign( get_the_ID() );
							$goal = charitable_format_money($campaign->get_goal());
							$donated = charitable_format_money($campaign->get_donated_amount());
							$percent  = round($campaign->get_percent_donated_raw());	
							$button_text = $campaign->get( 'donate_button_text', true );
						?>
                        <div class="swiper-slide">
							<div class="tp-causes-wrap">
								<div class="tp-causes-inner">
									<div class="tp-causes-thumb fix mb-25">
										<?php the_post_thumbnail(); ?>
									</div>
									<div class="tp-causes-content">
										<div class="tp-causes-border">
											<h3 class="tp-causes-title mb-10"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
											<p class="tp-causes-dec mb-20"><?php echo wp_trim_words(get_the_content(),$settings['post-content-word']); ?></p>
										</div>
										<div class="tp-progress mb-10 mt-20">
											<div class="tp-progress-top d-flex justify-content-between mb-5">
												<span><?php echo esc_html__('Donation','kindaid-core'); ?></span>
												<label><?php echo esc_html($percent); ?>%</label>
											</div>
											<div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="<?php echo esc_html($percent); ?>" aria-valuemin="0" aria-valuemax="100">
												<div class="progress-bar wow slideInLeft" data-wow-duration="1s" data-wow-delay=".1s" style="width: <?php echo esc_html($percent); ?>%"></div>
											</div>
										</div>
										<div class="row">
											<div class="col-6">
												<div class="tp-causes-amount">
													<label><?php echo esc_html__('Goals:','kindaid-core'); ?></label>
													<span><?php echo esc_html($goal); ?></span>
												</div>
											</div>
											<div class="col-6">
												<div class="tp-causes-amount text-end">
													<label><?php echo esc_html__('Raised:','kindaid-core'); ?></label>
													<span><?php echo esc_html($donated); ?></span>
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php if(!empty($button_text)) : ?>
								<div class="tp-causes-button">
									<a class="tp-btn tp-btn-animetion tp-btn-mulberry w-100 justify-content-center" href="causes-details.html">
										<span class="btn-text"><?php echo esc_html($button_text); ?></span>
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
						<?php endwhile; wp_reset_postdata(); ?>
						<?php else : ?>
							<p>No posts found</p>
						<?php endif; ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

		<?php else : ?>
      <div class="tp-causes-area fix p-relative">
         <div class="container container-1424">
            <div class="row align-items-end">
               <div class="col-md-9">
                  <div class="tp-section-info mb-50 p-relative">
                     <span class="tp-section-subtitle d-inline-block mb-15 wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".3s"><?php echo esc_html($settings['sub_title']); ?></span>
                     <h2 class="tp-section-title mb-20 wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".4s"><?php echo kindaid_kses_svg($settings['title']); ?></h2>   
					<?php if(!empty($settings['description'])) : ?>
					<p class="wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".5s"><?php echo kindaid_kses_svg($settings['description']); ?></p>
					<?php endif; ?>  
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="tp-causes-arrow-wrap mb-50 text-md-end wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".5s">
                     <button class="tp-causes-prev">
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <path d="M13 7H1" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                           <path d="M7 1L1 7L7 13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                     </button>
                     <button class="tp-causes-next">
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <path d="M1 7H13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                           <path d="M7 1L13 7L7 13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                     </button>
                  </div>
               </div>
            </div>
         </div>
         <div class="container-fluid p-0">
            <div class="row">
               <div class="col-12 wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".5s">
                  <div class="swiper tp-causes-slider-active">
                     <div class="swiper-wrapper">
						<?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); 
							$campaign = charitable_get_campaign( get_the_ID() );
							$goal = charitable_format_money($campaign->get_goal());
							$donated = charitable_format_money($campaign->get_donated_amount());
							$percent  = round($campaign->get_percent_donated_raw());	
							$button_text = $campaign->get( 'donate_button_text', true );
						?>
                        <div class="swiper-slide">
                           <div class="tp-causes-wrap">
                              <div class="tp-causes-inner">
                                 <div class="tp-causes-thumb fix mb-25">
                                    <?php the_post_thumbnail(); ?>
                                 </div>
                                 <div class="tp-causes-content">
                                    <div class="tp-causes-border">
                                       <h3 class="tp-causes-title mb-10"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                       <p class="tp-causes-dec mb-20"><?php echo wp_trim_words(get_the_content(),$settings['post-content-word']); ?></p>
                                    </div>
                                    <div class="tp-progress mb-10 mt-20">
                                       <div class="tp-progress-top d-flex justify-content-between mb-5">
                                          <span><?php echo esc_html__('Donation','kindaid-core'); ?></span>
                                          <label><?php echo esc_html($percent); ?>%</label>
                                       </div>
                                       <div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="<?php echo esc_html($percent); ?>" aria-valuemin="0" aria-valuemax="100">
                                          <div class="progress-bar wow slideInLeft" data-wow-duration="1s" data-wow-delay=".1s" style="width: <?php echo esc_html($percent); ?>%"></div>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-6">
                                          <div class="tp-causes-amount">
                                             <label><?php echo esc_html__('Goals:','kindaid-core'); ?></label>
                                             <span><?php echo esc_html($goal); ?></span>
                                          </div>
                                       </div>
                                       <div class="col-6">
                                          <div class="tp-causes-amount text-end">
                                             <label><?php echo esc_html__('Raised:','kindaid-core'); ?></label>
                                             <span><?php echo esc_html($donated); ?></span>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
							  <?php if(!empty($button_text)) : ?>
                              <div class="tp-causes-button">
                                 <a class="tp-btn tp-btn-animetion tp-btn-mulberry w-100 justify-content-center" href="<?php the_permalink(); ?>">
                                    <span class="btn-text"><?php echo esc_html($button_text); ?></span>
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
						<?php endwhile; wp_reset_postdata(); ?>
						<?php else : ?>
							<p>No posts found</p>
						<?php endif; ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

	  <?php endif; ?>



		<?php
	}

}


$widgets_manager->register( new Kindaid_Charity_Slider() );