<?php
class Kindaid_Testimonial extends \Elementor\Widget_Base {

	public function get_name(): string {
		return 'kindaid-testimonial';
	}

	public function get_title(): string {
		return esc_html__( 'Testimonials', 'kindaid-core' );
	}

	public function get_icon(): string {
		return 'eicon-components';
	}

	public function get_categories(): array {
		return [ 'kindaid-core' ];
	}

	public function get_keywords(): array {
		return [ 'testimonials' ];
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
				'condition' => [
					'design-layout' => 'layout-2',
				],
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
			'content_section',
			[
				'label' => esc_html__( 'Testimonial List', 'kindaid-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'image',
			[
				'label' => esc_html__( 'Image Icon', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'subject',
			[
				'label' => esc_html__( 'Subject', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Better support', 'kindaid-core' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'name',
			[
				'label' => esc_html__( 'Name', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Arc jhon', 'kindaid-core' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'designation',
			[
				'label' => esc_html__( 'Designation', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Varified Buyer', 'kindaid-core' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'review_text',
			[
				'label' => esc_html__( 'Content', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Health care are essential for a child growth.', 'kindaid-core' ),
			]
		);

		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Testimonial List', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'name' => esc_html__( 'Better service', 'kindaid-core' ),
						'review_text' => esc_html__( 'Health care are essential for a child growth.', 'kindaid-core' ),
					],
					[
						'title' => esc_html__( 'Need and Clean', 'kindaid-core' ),
						'review_text' => esc_html__( 'Health care are essential for a child growth.', 'kindaid-core' ),
					],
				],
				'title_field' => '{{{ name }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'image_section',
			[
				'label' => esc_html__( 'Image', 'kindaid-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'design-layout' => 'layout-2',
				],
			]
		);

		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'image_2',
			[
				'label' => esc_html__( 'Choose Image 02', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
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

		?>


		<?php if($settings['design-layout'] == 'layout-2') : 
			if(!empty($settings['image'])){
				$image_url =  !empty($settings['image']['id']) ? wp_get_attachment_image_url($settings['image']['id'],'full') : $settings['image']['url'];
				$image_alt = ! empty( $settings['image']['id'] ) ? get_post_meta( $settings['image']['id'], '_wp_attachment_image_alt', true ) : '';
			}

			if(!empty($settings['image_2'])){
				$image_2_url =  !empty($settings['image_2']['id']) ? wp_get_attachment_image_url($settings['image_2']['id'],'full') : $settings['image_2']['url'];
				$image_2_alt = ! empty( $settings['image_2']['id'] ) ? get_post_meta( $settings['image_2']['id'], '_wp_attachment_image_alt', true ) : '';
			}
		?>

      <div class="tp-testimonial-area tp-testimonal-3-style fix p-relative">
         <div class="container-fluid p-0">
            <div class="row">
				<?php if(!empty($image_url)) : ?>
               <div class="col-xl-3">
                  <div class="tp-about-2-thumb">
                     <img class="tp-about-3-thumb" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                  </div>
               </div>
			   <?php endif; ?>
               <div class="col-xl-9">
                  <div class="tp-about-2-content-wrap ml-30 pt-195 pb-195 tp-bg-mulberry p-relative">
					<?php if(!empty($image_2_url)) : ?>
					 <img class="tp-about-2-map" src="<?php echo esc_url($image_2_url); ?>" alt="<?php echo esc_attr($image_2_alt); ?>">
					 <?php endif; ?>
                     <div class="row">
                        <div class="offset-xxl-4 col-xxl-6 offset-xl-4 col-xl-7">
                           <div class="tp-about-2-content-inner mr-50">
                              <div class="tp-about-2-info mb-60">
                                 <span class="tp-section-subtitle tp-section-subtitle-yellow d-inline-block mb-15 wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".3s"><?php echo esc_html($settings['sub_title']); ?></span>
                                 <h2 class="tp-section-title tp-section-title-white mb-30 wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".4s"><?php echo kindaid_kses_svg($settings['title']); ?></h2>
                              </div>
                              <div class="tp-testimonal-3-wrap">
                                 <div class="swiper-container tp-testimonal-3-slider-active">
                                    <div class="swiper-wrapper">
										<?php foreach( $settings['list'] as $item ) : 
											if(!empty($item['image'])){
												$image_url =  !empty($item['image']['id']) ? wp_get_attachment_image_url($item['image']['id'],'full') : $item['image']['url'];
												$image_alt = ! empty( $item['image']['id'] ) ? get_post_meta( $item['image']['id'], '_wp_attachment_image_alt', true ) : '';
											}
										?>
                                       <div class="swiper-slide">
                                          <div class="tp-testimonal">
                                             <div class="tp-testimonal-star mb-20">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                             </div>
                                             <h4 class="tp-testimonal-dec" data-color="#fcf8ec"><?php echo kindaid_kses_svg($item['review_text']); ?></h4>
                                             <div class="tp-testimonal-user mt-50">
                                                <div class="tp-testimonal-img">
                                                   <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                                                </div>
                                                <div class="tp-testimonal-bio">
                                                   <h4 class="tp-testimonal-name"><?php echo esc_html($item['name']); ?></h4>
                                                   <span><?php echo esc_html($item['designation']); ?></span>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
										<?php endforeach; ?>	
                                    </div>
                                 </div>
                                 <div class="tp-testimonal-3-pagination mt-70"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>


		<?php else : 

		?>
      <div class="tp-testimonial-area">
         <div class="container container-1324 p-relative">
            <div class="row justify-content-center">
               <div class="col-xl-9 col-lg-10 col-md-11 text-center">
                  <div class="swiper-container tp-testimonal-slider-active">
                     <div class="swiper-wrapper">
						<?php foreach( $settings['list'] as $item ) : 
							if(!empty($item['image'])){
								$image_url =  !empty($item['image']['id']) ? wp_get_attachment_image_url($item['image']['id'],'full') : $item['image']['url'];
								$image_alt = ! empty( $item['image']['id'] ) ? get_post_meta( $item['image']['id'], '_wp_attachment_image_alt', true ) : '';
							}
						?>
                        <div class="swiper-slide">
                           <div class="tp-testimonal">
                              <div class="tp-testimonal-star mb-5">
                                 <i class="fas fa-star"></i>
                                 <i class="fas fa-star"></i>
                                 <i class="fas fa-star"></i>
                                 <i class="fas fa-star"></i>
                                 <i class="fas fa-star"></i>
                              </div>
                              <span class="tp-testimonal-label mb-20 d-inline-block"><?php echo esc_html($item['subject']); ?></span>
                              <h4 class="tp-testimonal-dec"><?php echo kindaid_kses_svg($item['review_text']); ?></h4>
                              <div class="tp-testimonal-user mt-40">
                                 <div class="tp-testimonal-img">
                                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                                 </div>
                                 <div class="tp-testimonal-bio">
                                    <h4 class="tp-testimonal-name"><?php echo esc_html($item['name']); ?></h4>
                                    <span><?php echo esc_html($item['designation']); ?></span>
                                 </div>
                              </div>
                           </div>
                        </div>
						<?php endforeach; ?>		
                     </div>
                  </div>
               </div>
            </div>
            <div class="tp-testimonial-arrow text-start text-md-end">
               <button class="tp-test-arrow-prev tp-test-arrow">
                  <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <path d="M13 7H1" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                     <path d="M7 1L1 7L7 13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
               </button>
               <button class="tp-test-arrow-next tp-test-arrow">
                  <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <path d="M1.00049 7H13.0005" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                     <path d="M7.00049 1L13.0005 7L7.00049 13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
               </button>
            </div>
         </div>
      </div>
	  <?php endif; ?>


		<?php
	}

}


$widgets_manager->register( new Kindaid_Testimonial() );