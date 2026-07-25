<?php
class Kindaid_Step extends \Elementor\Widget_Base {

	public function get_name(): string {
		return 'kindaid-step';
	}

	public function get_title(): string {
		return esc_html__( 'Step', 'kindaid-core' );
	}

	public function get_icon(): string {
		return 'eicon-components';
	}

	public function get_categories(): array {
		return [ 'kindaid-core' ];
	}

	public function get_keywords(): array {
		return [ 'step' ];
	}

	protected function register_controls(): void {
		$this->register_controls_section();
		$this->register_style_section();
	}

	protected function register_controls_section(){
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Step List', 'kindaid-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'number',
			[
				'label' => esc_html__( 'Number', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '200', 'kindaid-core' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Step Title', 'kindaid-core' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'content',
			[
				'label' => esc_html__( 'Content', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Default Content', 'kindaid-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Fact List', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'number' => esc_html__( '01', 'kindaid-core' ),
						'content' => esc_html__( 'Children & families served', 'kindaid-core' ),
					],
					[
						'number' => esc_html__( '02', 'kindaid-core' ),
						'content' => esc_html__( 'Successful Campaigns', 'kindaid-core' ),
					],
					[
						'number' => esc_html__( '03', 'kindaid-core' ),
						'content' => esc_html__( 'Receipts we have', 'kindaid-core' ),
					],
					[
						'number' => esc_html__( '04', 'kindaid-core' ),
						'content' => esc_html__( 'Monthly Donors', 'kindaid-core' ),
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'wow_section',
			[
				'label' => esc_html__( 'Animation', 'kindaid-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		// WOW Enable / Disable
		$this->add_control(
			'enable_wow',
			[
				'label' => __('Enable Animation', 'kindaid-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Yes', 'kindaid-core'),
				'label_off' => __('No', 'kindaid-core'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		// Animation Type Dropdown
		$this->add_control(
			'animation_type',
			[
				'label' => __('Animation Type', 'kindaid-core'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'fadeInUp',
				'options' => [
					'fadeIn' => 'Fade In',
					'fadeInUp' => 'Fade In Up',
					'fadeInDown' => 'Fade In Down',
					'zoomIn' => 'Zoom In',
					'slideInLeft' => 'Slide In Left',
					'slideInRight' => 'Slide In Right',
				],
				'condition' => [
					'enable_wow' => 'yes',
				],
			]
		);

		// Duration
		$this->add_control(
			'wow_duration',
			[
				'label' => __('Animation Duration', 'kindaid-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '.9s',
				'condition' => [
					'enable_wow' => 'yes',
				],
			]
		);

		// Delay
		$this->add_control(
			'wow_delay',
			[
				'label' => __('Animation Delay', 'kindaid-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '.3s',
				'condition' => [
					'enable_wow' => 'yes',
				],
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
      <div class="tp-step-area p-relative">
        <div class="container">
         <div class="row tp-step-row">
			<?php 
			
			foreach( $settings['list'] as $key => $item ) : 
	
				$delay_time = (($key+1) * 0.2) . 's';

				$wow_class = '';
				$duration = '';
				$delay = '';

				if ($settings['enable_wow'] === 'yes') {
					$wow_class = 'wow ' . $settings['animation_type'];
					$duration = 'data-wow-duration="' . esc_attr($settings['wow_duration']) . '"';
					$delay = 'data-wow-delay="' . esc_attr($delay_time) . '"';
				}

 			?>
            <div class="col-lg-3 col-md-6 col-sm-6">
               <div class="tp-step text-center p-relative mb-40 <?php echo esc_attr($wow_class); ?>" <?php echo $duration; ?>
     <?php echo $delay; ?>>
                  <div class="tp-step-arrow d-none d-lg-block">
                     <span>
                        <svg width="21" height="14" viewBox="0 0 21 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <path fill-rule="evenodd" clip-rule="evenodd" d="M13.6793 0.260557C13.3033 0.617831 13.2915 1.20867 13.6531 1.58024L18.9277 7L13.6531 12.4198C13.2915 12.7913 13.3033 13.3822 13.6793 13.7394C14.0554 14.0967 14.6534 14.0851 15.015 13.7136L20.6044 7.97035C21.1319 7.4284 21.1319 6.5716 20.6044 6.02965L15.015 0.286433C14.6534 -0.0851318 14.0554 -0.0967169 13.6793 0.260557ZM1.16249 0.260557C0.786411 0.617831 0.774685 1.20867 1.1363 1.58024L6.41089 7L1.1363 12.4198C0.774685 12.7913 0.786409 13.3822 1.16249 13.7394C1.53856 14.0967 2.13658 14.0851 2.49819 13.7136L8.08758 7.97035C8.61502 7.4284 8.61501 6.5716 8.08758 6.02965L2.49819 0.286433C2.13658 -0.0851318 1.53856 -0.0967169 1.16249 0.260557Z" fill="currentColor" />
                        </svg>
                     </span>
                  </div>
                  <div class="tp-step-number mb-35">
                     <h3><?php echo esc_html($item['number']); ?> <span></span></h3>
                  </div>
                  <div class="tp-step-content">
                     <h3 class="tp-step-title"><?php echo esc_html($item['title']); ?></h3>
                     <p><?php echo kindaid_kses_svg($item['content']); ?></p>
                  </div>
               </div>
            </div>
			<?php endforeach; ?>	
         </div>
        </div>
      </div>

		<?php
	}

}


$widgets_manager->register( new Kindaid_Step() );