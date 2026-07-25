<?php
class Kindaid_Icon_Box extends \Elementor\Widget_Base {

	public function get_name(): string {
		return 'kindaid-icon-box';
	}

	public function get_title(): string {
		return esc_html__( 'Icon Box', 'kindaid-core' );
	}

	public function get_icon(): string {
		return 'eicon-components';
	}

	public function get_categories(): array {
		return [ 'kindaid-core' ];
	}

	public function get_keywords(): array {
		return [ 'icon box' ];
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
			'box_section',
			[
				'label' => esc_html__( 'Title & Content', 'kindaid-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
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

		$this->add_control(
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

		$this->add_control(
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

		$this->add_control(
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

		$this->add_control(
			'box_url_text',
			[
				'label' => esc_html__( 'Box URL Text', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Support@gmail.com', 'kindaid-core' ),
				'label_block' => true,
				'condition' => [
					'design-layout' => 'layout-2',
				],
			]
		);

		$this->add_control(
			'box_url',
			[
				'label' => esc_html__( 'Box URL', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#', 'kindaid-core' ),
				'label_block' => true,
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
				'condition' => [
					'design-layout' => 'layout-2',
				],
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
				'label' => esc_html__( 'Box BG Color', 'kindaid-core' ),
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


		$this->start_controls_section(
			'section_link_style',
			[
				'label' => esc_html__( 'Link', 'kindaid-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'link_color',
			[
				'label' => esc_html__( 'Color', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .el-link' => 'color: {{VALUE}};',
				],
			]
		);


		$this->add_control(
			'link_margin',
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
					'{{WRAPPER}} .el-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'link_padding',
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
					'{{WRAPPER}} .el-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'link_typography',
				'selector' => '{{WRAPPER}} .el-link',
			]
		);


		$this->end_controls_section();
	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();


		$wow_class = '';
		$duration = '';
		$delay = '';

		if ($settings['enable_wow'] === 'yes') {
			$wow_class = 'wow ' . $settings['animation_type'];
			$duration = 'data-wow-duration="' . esc_attr($settings['wow_duration']) . '"';
			$delay = 'data-wow-delay="' . esc_attr($settings['wow_delay']) . '"';
		}


		?>

		<?php if($settings['design-layout'] == 'layout-2') : 
			if(!empty($settings['image'])){
				$image_url =  !empty($settings['image']['id']) ? wp_get_attachment_image_url($settings['image']['id'],'full') : $settings['image']['url'];
				$image_alt = ! empty( $settings['image']['id'] ) ? get_post_meta( $settings['image']['id'], '_wp_attachment_image_alt', true ) : '';
			}
		?>
		<div class="tp-contact-item tp-align el-bg icon-anime-wrap <?php echo esc_attr($wow_class); ?>" <?php echo $duration; ?> <?php echo $delay; ?>>
			<span class="tp-contact-icon icon-anime mb-45 d-inline-block">
				<?php if($settings['icon_style'] == 'icon_font') : ?>
				<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
				<?php elseif($settings['icon_style'] == 'image_icon') : ?>	
					<img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
				<?php else : ?>	
					<?php echo kindaid_kses_svg($settings['svg']); ?>
				<?php endif; ?>	
			</span>
			<div class="tp-contact-content">
				<?php if(!empty($settings['title'])) : ?>
				<h5 class="el-title"><?php echo kindaid_kses_svg($settings['title']); ?></h5>
				<?php endif; ?>	
				<?php if(!empty($settings['description'])) : ?>
				<span class="d-block mb-35 el-content"><?php echo kindaid_kses_svg($settings['description']); ?></span>
				<?php endif; ?>	
				<?php if(!empty($settings['description'])) : ?>
				<a class="common-underline el-link" href="<?php echo esc_url($settings['box_url']); ?>"><?php echo kindaid_kses_svg($settings['box_url_text']); ?></a>
				<?php endif; ?>	
			</div>
		</div>

		<?php else : 
			if(!empty($settings['image'])){
				$image_url =  !empty($settings['image']['id']) ? wp_get_attachment_image_url($settings['image']['id'],'full') : $settings['image']['url'];
				$image_alt = ! empty( $settings['image']['id'] ) ? get_post_meta( $settings['image']['id'], '_wp_attachment_image_alt', true ) : '';
			}
		?>

		<div class="tp-service-2-style">
			<div class="tp-service-item icon-anime-wrap tp-bg-mulberry wow fadeInUp el-bg" data-wow-duration=".9s" data-wow-delay=".3s">
				<span class="tp-service-icon icon-anime mb-75 d-inline-block">
					<?php if($settings['icon_style'] == 'icon_font') : ?>
					<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
					<?php elseif($settings['icon_style'] == 'image_icon') : ?>	
						<img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
					<?php else : ?>	
						<?php echo kindaid_kses_svg($settings['svg']); ?>
					<?php endif; ?>	
				</span>
				<?php if(!empty($settings['box_url'])) : ?>
				<h3 class="tp-service-title mb-15 el-title"><a href="<?php echo esc_url($settings['box_url']); ?>" class="common-underline"><?php echo kindaid_kses_svg($settings['title']); ?></a></h3>
				<?php else : ?>
					<h3 class="tp-service-title mb-15 el-title"><?php echo kindaid_kses_svg($settings['title']); ?></h3>
				<?php endif; ?>

				<?php if(!empty($settings['description'])) : ?>
				<p class="tp-service-dec mb-0 el-content"><?php echo kindaid_kses_svg($settings['description']); ?></p>
				<?php endif; ?>
			</div>
		</div>

		<?php endif; ?>

		<?php
	}

}


$widgets_manager->register( new Kindaid_Icon_Box() );