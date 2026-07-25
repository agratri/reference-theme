<?php
class Kindaid_Button extends \Elementor\Widget_Base {

	public function get_name(): string {
		return 'kindaid-button';
	}

	public function get_title(): string {
		return esc_html__( 'Button', 'kindaid-core' );
	}

	public function get_icon(): string {
		return 'eicon-components';
	}

	public function get_categories(): array {
		return [ 'kindaid-core' ];
	}

	public function get_keywords(): array {
		return [ 'button' ];
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
					'layout-1' => esc_html__( 'Layout Default', 'kindaid-core' ),
					'layout-2' => esc_html__( 'Layout Border', 'kindaid-core' ),
					'layout-3' => esc_html__( 'Layout Text', 'kindaid-core' ),
					'layout-4' => esc_html__( 'Layout Big', 'kindaid-core' ),
					'layout-5' => esc_html__( 'Layout Title', 'kindaid-core' ),
				],
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
			'button_title_text',
			[
				'label' => esc_html__( 'Button Title Text', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Button Title Text', 'kindaid-core' ),
				'label_block' => true,
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
				$this->add_render_attribute('button_arg', 'class', 'tp-join-btn tp-btn tp-btn-animetion');
			}
		?>

		<div class="tp-button-box">
			<a <?php echo $this->get_render_attribute_string( 'button_arg' ); ?>>
				<span class="btn-text"><?php echo kindaid_kses_svg($settings['button_text']); ?></span>
				<span class="btn-icon">
					<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1 7H13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
						<path d="M7 1L13 7L7 13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
					</svg>
				</span>
			</a>
		</div>	

		<?php elseif($settings['design-layout'] == 'layout-3') : 
			if(!empty($settings['button_text'])){
				$this->add_link_attributes( 'button_arg', $settings['button_url'] );
				$this->add_render_attribute('button_arg', 'class', 'tp-btn-nopading tp-btn tp-btn-animetion');
			}
		?>
		<div class="tp-button-box">
			<a <?php echo $this->get_render_attribute_string( 'button_arg' ); ?>>
				<span class="btn-text"><?php echo kindaid_kses_svg($settings['button_text']); ?></span>
				<span class="btn-icon">
					<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M1 7H13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
					<path d="M7 1L13 7L7 13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
					</svg>
				</span>
			</a>
		</div>	

		<?php elseif($settings['design-layout'] == 'layout-4') : 
			if(!empty($settings['button_text'])){
				$this->add_link_attributes( 'button_arg', $settings['button_url'] );
				$this->add_render_attribute('button_arg', 'class', 'tp-btn tp-btn-secondary-white tp-btn-animetion w-100 justify-content-center');
			}
		?>

		<div class="tp-cta-btn text-center">
			<a <?php echo $this->get_render_attribute_string( 'button_arg' ); ?>>
				<span class="btn-icon">
					<svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M6.15195 0.500138C6.71895 0.517281 7.26794 0.6157 7.79984 0.79554H7.85294C7.88894 0.812539 7.91594 0.831328 7.93394 0.848328C8.13283 0.911853 8.32093 0.983431 8.50093 1.08185L8.84293 1.23395C8.97793 1.30553 9.13992 1.43884 9.22992 1.49342C9.31992 1.54621 9.41892 1.60079 9.49992 1.66253C10.4998 0.902906 11.7139 0.491334 12.9649 0.500138C13.5328 0.500138 14.0998 0.579912 14.6389 0.759751C17.9607 1.83342 19.1577 5.45704 18.1578 8.62436C17.5908 10.2429 16.6638 11.7201 15.4498 12.9271C13.7119 14.6002 11.8048 16.0854 9.75192 17.3649L9.52692 17.5L9.29292 17.3559C7.23284 16.0854 5.31496 14.6002 3.56088 12.9181C2.3549 11.7111 1.42701 10.2429 0.851011 8.62436C-0.165978 5.45704 1.03101 1.83342 4.38887 0.740961C4.64987 0.651489 4.91897 0.588859 5.18897 0.553965H5.29696C5.54986 0.517281 5.80096 0.500138 6.05296 0.500138H6.15195ZM14.1709 3.3276C13.8019 3.20145 13.3969 3.39918 13.2619 3.77496C13.1359 4.15075 13.3339 4.56232 13.7119 4.69563C14.2888 4.91037 14.6749 5.47494 14.6749 6.10035V6.12808C14.6578 6.33297 14.7199 6.53071 14.8459 6.68281C14.9719 6.83491 15.1609 6.92349 15.3589 6.94228C15.7279 6.93244 16.0428 6.63807 16.0698 6.2614V6.15492C16.0968 4.90142 15.3328 3.76602 14.1709 3.3276Z" fill="currentColor" />
					</svg>
				</span>
				<span class="btn-text"><?php echo kindaid_kses_svg($settings['button_text']); ?></span>
			</a>
		</div>

		<?php elseif($settings['design-layout'] == 'layout-5') : 
			if(!empty($settings['button_text'])){
				$this->add_link_attributes( 'button_arg', $settings['button_url'] );
				$this->add_render_attribute('button_arg', 'class', 'tp-btn tp-btn-secondary tp-btn-animetion');
			}
		?>

		<div class="tp-contact-item icon-anime-wrap wow fadeInUp el-bg" data-wow-duration=".9s" data-wow-delay=".6s">
			<div class="tp-contact-content">
				<?php if(!empty($settings['button_title_text'])) : ?>
				<h3 class="mb-70" data-color="#fcf8ec"><?php echo kindaid_kses_svg($settings['button_title_text']); ?></h3>
				<?php endif; ?>
				<a <?php echo $this->get_render_attribute_string( 'button_arg' ); ?>>
					<span class="btn-text"><?php echo kindaid_kses_svg($settings['button_text']); ?></span>
					<span class="btn-icon">
						<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M1 7H13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
							<path d="M7 1L13 7L7 13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
						</svg>
					</span>
				</a>
			</div>
		</div>

		<?php else : 
			if(!empty($settings['button_text'])){
				$this->add_link_attributes( 'button_arg', $settings['button_url'] );
				$this->add_render_attribute('button_arg', 'class', 'tp-btn tp-btn-animetion mr-5 mb-10');
			}
		?>

		<div class="tp-button-box">
			<a <?php echo $this->get_render_attribute_string( 'button_arg' ); ?>>
				<span class="btn-text"><?php echo kindaid_kses_svg($settings['button_text']); ?></span>
				<span class="btn-icon">
					<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M1 7H13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
					<path d="M7 1L13 7L7 13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
					</svg>
				</span>
			</a>
		</div>

		<?php endif; ?>

		<?php
	}

}


$widgets_manager->register( new Kindaid_Button() );