<?php
class Kindaid_Services_List extends \Elementor\Widget_Base {

	public function get_name(): string {
		return 'kindaid-services';
	}

	public function get_title(): string {
		return esc_html__( 'Services', 'kindaid-core' );
	}

	public function get_icon(): string {
		return 'eicon-components';
	}

	public function get_categories(): array {
		return [ 'kindaid-core' ];
	}

	public function get_keywords(): array {
		return [ 'service' ];
	}

	protected function register_controls(): void {
		$this->register_controls_section();
		$this->register_style_section();
	}

	protected function register_controls_section(){

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
				'default' => esc_html__( 'Content Here', 'kindaid-core' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'image_section',
			[
				'label' => esc_html__( 'Image', 'kindaid-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
			'content_section',
			[
				'label' => esc_html__( 'Services List', 'kindaid-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'icon_style',
			[
				'label' => esc_html__( 'Select Icon', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'icon_font',
				'options' => [
					'icon_font' => esc_html__( 'Icon', 'kindaid-core' ),
					'image_icon' => esc_html__( 'Image', 'kindaid-core' ),
					'svg_icon' => esc_html__( 'SVG', 'kindaid-core' ),
				],
			]
		);

		$repeater->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-smile',
					'library' => 'fa-solid',
				],
				'condition' => [
					'icon_style' => 'icon_font',
				],
			]
		);

		$repeater->add_control(
			'image',
			[
				'label' => esc_html__( 'Image Icon', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'icon_style' => 'image_icon',
				],
			]
		);

		$repeater->add_control(
			'svg',
			[
				'label' => esc_html__( 'SVG Icon', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( ' ', 'kindaid-core' ),
				'condition' => [
					'icon_style' => 'svg_icon',
				],
			]
		);

		$repeater->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Healthy Food', 'kindaid-core' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'content',
			[
				'label' => esc_html__( 'Content', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Health care are essential for a child growth.', 'kindaid-core' ),
			]
		);

		$repeater->add_control(
			'button_text',
			[
				'label' => esc_html__( 'Button Text', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Button Text', 'kindaid-core' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'button_url',
			[
				'label' => esc_html__( 'Button URL', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#', 'kindaid-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Services List', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => esc_html__( 'Healthy Food', 'kindaid-core' ),
						'content' => esc_html__( 'Health care are essential for a child growth.', 'kindaid-core' ),
					],
					[
						'title' => esc_html__( 'Medical Care', 'kindaid-core' ),
						'content' => esc_html__( 'Health care are essential for a child growth.', 'kindaid-core' ),
					],
				],
				'title_field' => '{{{ title }}}',
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

        $image_url =  !empty($settings['image']['id']) ? wp_get_attachment_image_url($settings['image']['id'],'full') : $settings['image']['url'];
        $image_alt = ! empty( $settings['image']['id'] ) ? get_post_meta( $settings['image']['id'], '_wp_attachment_image_alt', true ) : '';


		?>

      <div class="tp-service-area tp-bg-mulberry p-relative">
         <img class="tp-service-shape" src="<?php echo esc_url( KINDAID_CORE_URL . 'assets/img/service/shape.png' ); ?>" alt="">
         <div class="container-fluid">
            <div class="row">
				<?php if(!empty($image_url)) : ?>
               <div class="col-xxl-3 col-xl-4 d-none d-xl-block">
                  <div class="tp-service-thumb">
                     <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                  </div>
               </div>
			   <?php endif; ?>

               <div class="col-xxl-8 col-xl-8">
                  <div class="tp-service-content-wrap pt-95 pb-90 pr-90">
                     <div class="tp-service-title-wrap mb-40">
						<?php if(!empty($settings['sub_title'])) : ?>
                        <span class="tp-section-subtitle tp-section-subtitle-yellow d-inline-block mb-10 wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".3s"><?php echo esc_html($settings['sub_title']); ?></span>
						<?php endif; ?>

						<?php if(!empty($settings['title'])) : ?>
                        <h2 class="tp-section-title tp-section-title-white wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".5s"><?php echo kindaid_kses_svg($settings['title']); ?></h2>
						<?php endif; ?>

						<?php if(!empty($settings['description'])) : ?>
						<p><?php echo kindaid_kses_svg($settings['description']); ?></p>
						<?php endif; ?>
                     </div>
                     <div class="row">
						<?php foreach( $settings['list'] as $item ) : 
							if(!empty($item['image'])){
								$image_url =  !empty($item['image']['id']) ? wp_get_attachment_image_url($item['image']['id'],'full') : $item['image']['url'];
								$image_alt = ! empty( $item['image']['id'] ) ? get_post_meta( $item['image']['id'], '_wp_attachment_image_alt', true ) : '';
							}
						?>
                        <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6">
                           <div class="tp-service-item icon-anime-wrap mb-25 wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".3s">
                              <span class="tp-service-icon icon-anime mb-25 d-inline-block">
								<?php if($item['icon_style'] == 'icon_font') : ?>
								<?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
								<?php elseif($item['icon_style'] == 'image_icon') : ?>	
									<img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
								<?php else : ?>	
									<?php echo kindaid_kses_svg($item['svg']); ?>
								<?php endif; ?>	
							  </span>

							  <?php if(!empty($item['button_url']))  : ?>
                              <h3 class="tp-service-title mb-10"><a href="<?php echo esc_url($item['button_url']); ?>"><?php echo esc_html($item['title']); ?></a></h3>
							  <?php else : ?>
								<h3 class="tp-service-title mb-10"><?php echo esc_html($item['title']); ?></h3>
							  <?php endif; ?>	

							  <?php if(!empty($item['content']))  : ?>
                              <p class="tp-service-dec"><?php echo esc_html($item['content']); ?></p>
							  <?php endif; ?>

							  <?php if(!empty($item['button_url']))  : ?>
                              <a class="tp-service-btn" href="<?php echo esc_url($item['button_url']); ?>">
                                 <span class="btn-text"><?php echo esc_html($item['button_text']); ?></span>
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
						<?php endforeach; ?>	
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>


		<?php
	}

}


$widgets_manager->register( new Kindaid_Services_List() );