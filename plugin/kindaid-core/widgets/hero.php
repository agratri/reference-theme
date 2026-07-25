<?php
class Kindaid_Hero extends \Elementor\Widget_Base {

	public function get_name(): string {
		return 'kindaid-hero';
	}

	public function get_title(): string {
		return esc_html__( 'Hero', 'kindaid-core' );
	}

	public function get_icon(): string {
		return 'eicon-components';
	}

	public function get_categories(): array {
		return [ 'kindaid-core' ];
	}

	public function get_keywords(): array {
		return [ 'hero', 'home 01 hero' ];
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
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'content_section',
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
				'condition' => [
					'design-layout' => 'layout-1',
				],
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
			'content',
			[
				'label' => esc_html__( 'Content', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( '', 'kindaid-core' ),
				'condition' => [
					'design-layout' => 'layout-1',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'image_section',
			[
				'label' => esc_html__( 'Image', 'kindaid-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'design-layout' => 'layout-1',
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

		$this->end_controls_section();


		$this->start_controls_section(
			'video_section',
			[
				'label' => esc_html__( 'Video', 'kindaid-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'design-layout' => 'layout-2',
				],
			]
		);

		$this->add_control(
			'mp4_video_url',
			[
				'label' => esc_html__( 'MP4 Video URL', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '', 'kindaid-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'video_label',
			[
				'label' => esc_html__( 'Popup Video Label', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Video Text Here', 'kindaid-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'popup_video_url',
			[
				'label' => esc_html__( 'Popup Video URL', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#', 'kindaid-core' ),
				'label_block' => true,
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'button_section',
			[
				'label' => esc_html__( 'Button', 'kindaid-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => esc_html__( 'Button Text', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Button Text', 'kindaid-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'button_url',
			[
				'label' => esc_html__( 'Button Link', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '#',
					'is_external' => false,
					'nofollow' => false,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'button_02_section',
			[
				'label' => esc_html__( 'Button 02', 'kindaid-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'button_02_text',
			[
				'label' => esc_html__( 'Button Text', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Button Text', 'kindaid-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'button_02_url',
			[
				'label' => esc_html__( 'Button Link', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '#',
					'is_external' => false,
					'nofollow' => false,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);

		$this->end_controls_section();
	}
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
		if(!empty($settings['button_text'])){
			$this->add_link_attributes( 'button_arg', $settings['button_url'] );
			$this->add_render_attribute('button_arg', 'class', 'tp-btn tp-btn-animetion mr-5 mb-10');
		}
		
		if(!empty($settings['button_02_text'])){
			$this->add_link_attributes( 'button_02_arg', $settings['button_02_url'] );
			$this->add_render_attribute('button_02_arg', 'class', 'tp-btn tp-btn-secondary tp-btn-animetion mb-10');
		}
		?>

      <div class="tp-hero-area tp-hero-3-style fix">
         <div class="tp-hero-3-video-container">
            <video loop="" muted="" autoplay="" playsinline="">
               <source src="<?php echo esc_url($settings['mp4_video_url']); ?>" type="video/mp4">
            </video>
         </div> 
         <div class="container-fluid container-1790">
            <div class="row align-items-end">
               <div class="col-lg-7">
                  <div class="tp-hero-content p-relative z-index-2 mb-30">
                     <h2 class="tp-hero-title mb-40 wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".3s"><?php echo kindaid_kses_svg($settings['title']); ?></h2>
                     <div class="tp-hero-btn wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".4s">
						<?php if(!empty($settings['button_text'])) : ?>
                        <a <?php echo $this->get_render_attribute_string( 'button_arg' ); ?>>
                           <span class="btn-text"><?php echo kindaid_kses_svg($settings['button_text']); ?></span>
                           <span class="btn-icon">
                              <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M1 7H13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                 <path d="M7 1L13 7L7 13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                              </svg>
                           </span>
                        </a>
						<?php endif; ?>
						<?php if(!empty($settings['button_02_text'])) : ?>
                        <a <?php echo $this->get_render_attribute_string( 'button_02_arg' ); ?>>
                           <span class="btn-text"><?php echo kindaid_kses_svg($settings['button_02_text']); ?></span>
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
               <div class="col-lg-5">
                  <div class="d-flex justify-content-lg-end">
                     <div class="tp-hero-3-video-wrap mb-40 wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".5s">
                        <span class="tp-hero-3-video-text mr-25"><?php echo kindaid_kses_svg($settings['video_label']); ?> </span>
                        <a class="tp-hero-3-video-btn popup-video" href="<?php echo esc_url($settings['popup_video_url']); ?>">
                           <span>
                              <svg width="15" height="17" viewBox="0 0 15 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M0.660254 1.73205C0.660254 0.962251 1.49359 0.481125 2.16025 0.866025L14.1603 7.79423C14.8269 8.17913 14.8269 9.14138 14.1603 9.52628L2.16025 16.4545C1.49359 16.8394 0.660254 16.3583 0.660254 15.5885L0.660254 1.73205Z" fill="currentColor" />
                              </svg>
                           </span>
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>


	  <?php else : 
        $image_url =  !empty($settings['image']['id']) ? wp_get_attachment_image_url($settings['image']['id'],'full') : $settings['image']['url'];
        $image_alt = ! empty( $settings['image']['id'] ) ? get_post_meta( $settings['image']['id'], '_wp_attachment_image_alt', true ) : '';

		if(!empty($settings['button_text'])){
			$this->add_link_attributes( 'button_arg', $settings['button_url'] );
			$this->add_render_attribute('button_arg', 'class', 'tp-btn tp-btn-animetion mr-5 mb-10');
		}
		
		if(!empty($settings['button_02_text'])){
			$this->add_link_attributes( 'button_02_arg', $settings['button_02_url'] );
			$this->add_render_attribute('button_02_arg', 'class', 'tp-btn tp-btn-secondary tp-btn-animetion mb-10');
		}
		
		?>
      <div class="tp-hero-area el-bg fix">
         <div class="container-fluid p-0">
            <div class="row">
               <div class="col-xxl-6 col-xl-7 col-lg-6 offset-xxl-1">
                  <div class="tp-hero-content tp-hero-spacing">
                    <?php if(!empty($settings['sub_title'])) : ?>
                     <span class="tp-hero-subtitle el-sub-title d-inline-block mb-25 ml-5  wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".4s"><?php echo esc_html($settings['sub_title']); ?></span>
                    <?php endif; ?>

                     <?php if(!empty($settings['title'])) : ?>
                     <h2 class="tp-hero-title el-title mb-80 wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".5s">
                        <?php echo kindaid_kses_svg($settings['title']); ?>
                     </h2>
                     <?php endif; ?>

                     <div class="tp-hero-btn-wrap">
                        <?php if(!empty($settings['content'])) : ?>
                        <div class="wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".6s">
                           <p class="tp-hero-dec el-content mb-30"><?php echo kindaid_kses_svg($settings['content']); ?></p>
                        </div>
                        <?php endif; ?>
                        <div class="tp-hero-btn wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".7s">

						  <?php if(!empty($settings['button_text'])) : ?>
                           <a <?php echo $this->get_render_attribute_string( 'button_arg' ); ?>>
                              <span class="btn-text"><?php echo kindaid_kses_svg($settings['button_text']); ?></span>
                              <span class="btn-icon">
                                 <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 7H13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M7 1L13 7L7 13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                 </svg>
                              </span>
                           </a>
						   <?php endif; ?>

						   <?php if(!empty($settings['button_02_text'])) : ?>
                           <a <?php echo $this->get_render_attribute_string( 'button_02_arg' ); ?>>
                              <span class="btn-text"><?php echo kindaid_kses_svg($settings['button_02_text']); ?></span>
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
               </div>
			   <?php if(!empty($image_url)) : ?>
               <div class="col-xxl-5 col-xl-5 col-lg-6">
                  <div class="tp-hero-thumb ml-20">
                     <img class="w-100" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                  </div>
               </div>
			    <?php endif; ?>
            </div>
         </div>
      </div>
	  <?php endif; ?>

		<?php
	}

}


$widgets_manager->register( new Kindaid_Hero() );