<?php
class Kindaid_Team extends \Elementor\Widget_Base {

	public function get_name(): string {
		return 'kindaid-team';
	}

	public function get_title(): string {
		return esc_html__( 'Team', 'kindaid-core' );
	}

	public function get_icon(): string {
		return 'eicon-components';
	}

	public function get_categories(): array {
		return [ 'kindaid-core' ];
	}

	public function get_keywords(): array {
		return [ 'team' ];
	}

	protected function register_controls(): void {
		$this->register_controls_section();
		$this->register_style_section();
	}

	protected function register_controls_section(){
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
				'default' => esc_html__( 'Designation', 'kindaid-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Team Title Here', 'kindaid-core' ),
			]
		);

		$this->add_control(
			'content',
			[
				'label' => esc_html__( 'Content', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
			]
		);

		$this->add_control(
			'url',
			[
				'label' => esc_html__( 'URL', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#', 'kindaid-core' ),
				'label_block' => true,
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
			'social_section',
			[
				'label' => esc_html__( 'Social', 'kindaid-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'fb_url',
			[
				'label' => esc_html__( 'Facebook URL', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#', 'kindaid-core' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'tw_url',
			[
				'label' => esc_html__( 'Twitter URL', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#', 'kindaid-core' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'yt_url',
			[
				'label' => esc_html__( 'Youtube URL', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#', 'kindaid-core' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'ins_url',
			[
				'label' => esc_html__( 'Instagram URL', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#', 'kindaid-core' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'lin_url',
			[
				'label' => esc_html__( 'Linkedin URL', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '', 'kindaid-core' ),
				'label_block' => true,
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

		$wow_class = '';
		$duration = '';
		$delay = '';

		if ($settings['enable_wow'] === 'yes') {
			$wow_class = 'wow ' . $settings['animation_type'];
			$duration = 'data-wow-duration="' . esc_attr($settings['wow_duration']) . '"';
			$delay = 'data-wow-delay="' . esc_attr($settings['wow_delay']) . '"';
		}	

        $image_url =  !empty($settings['image']['id']) ? wp_get_attachment_image_url($settings['image']['id'],'full') : $settings['image']['url'];
        $image_alt = ! empty( $settings['image']['id'] ) ? get_post_meta( $settings['image']['id'], '_wp_attachment_image_alt', true ) : '';
		
		?>

		<div class="tp-team-item text-center mb-30 <?php echo esc_attr($wow_class); ?>" <?php echo $duration; ?> <?php echo $delay; ?>>
			<?php if(!empty($image_url)) : ?>
			<div class="tp-team-thumb mb-30">
				<img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
			</div>
			 <?php endif; ?>
			<div class="tp-team-content">
				<span class="mb-10 d-block"><?php echo esc_html($settings['sub_title']); ?></span>
				<h3 class="tp-team-title mb-10">
					<a href="<?php echo esc_url($settings['url']); ?>"><?php echo esc_html($settings['title']); ?></a>
				</h3>
				<?php if(!empty($settings['content'])) : ?>
				<p><?php echo esc_html($settings['content']); ?></p>
				<?php endif; ?>	
				<div class="tp-team-social">
					<?php if(!empty($settings['fb_url'])) : ?>
					<a href="<?php echo esc_url($settings['fb_url']); ?>">
						<svg xmlns="http://www.w3.org/2000/svg" width="12" height="18" viewBox="0 0 12 18" fill="none">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M1.62839 7.77713C0.911363 7.77713 0.761719 7.91782 0.761719 8.59194V9.81416C0.761719 10.4883 0.911363 10.629 1.62839 10.629H3.36172V15.5179C3.36172 16.192 3.51136 16.3327 4.22839 16.3327H5.96172C6.67874 16.3327 6.82839 16.192 6.82839 15.5179V10.629H8.77466C9.31846 10.629 9.45859 10.5296 9.60798 10.038L9.97941 8.81579C10.2353 7.97368 10.0776 7.77713 9.14609 7.77713H6.82839V5.74009C6.82839 5.29008 7.21641 4.92527 7.69505 4.92527H10.1617C10.8787 4.92527 11.0284 4.78458 11.0284 4.11046V2.48083C11.0284 1.80671 10.8787 1.66602 10.1617 1.66602H7.69505C5.30182 1.66602 3.36172 3.49004 3.36172 5.74009V7.77713H1.62839Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
						</svg>
					</a>
					<?php endif; ?>

					<?php if(!empty($settings['tw_url'])) : ?>
					<a href="<?php echo esc_url($settings['tw_url']); ?>">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="14" viewBox="0 0 16 14" fill="none">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M5.28884 0.714844H0.666992L6.14691 7.9153L1.01754 13.9556H3.38746L7.26697 9.38713L10.7118 13.9136H15.3337L9.69453 6.50391L9.70451 6.51669L14.5599 0.798959H12.19L8.58427 5.04503L5.28884 0.714844ZM3.21817 1.97588H4.65702L12.7825 12.6525H11.3436L3.21817 1.97588Z" fill="currentColor"/>
						</svg>
					</a>
					<?php endif; ?>

					<?php if(!empty($settings['yt_url'])) : ?>
					<a href="<?php echo esc_url($settings['yt_url']); ?>">
						<svg width="20" height="15" viewBox="0 0 20 15" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M18.6227 2.9799C18.5255 2.59162 18.3276 2.23586 18.0489 1.94856C17.7702 1.66125 17.4207 1.45258 17.0355 1.34362C15.6283 1 9.99951 1 9.99951 1C9.99951 1 4.37071 1 2.96351 1.37634C2.57837 1.48531 2.22881 1.69398 1.95012 1.98128C1.67144 2.26858 1.47351 2.62434 1.37632 3.01262C1.11879 4.44073 0.992809 5.88945 0.999979 7.34058C0.990799 8.80263 1.11678 10.2624 1.37632 11.7013C1.48347 12.0775 1.68583 12.4197 1.96387 12.6949C2.2419 12.97 2.5862 13.1689 2.96351 13.2721C4.37071 13.6484 9.99951 13.6484 9.99951 13.6484C9.99951 13.6484 15.6283 13.6484 17.0355 13.2721C17.4207 13.1631 17.7702 12.9545 18.0489 12.6672C18.3276 12.3799 18.5255 12.0241 18.6227 11.6358C18.8783 10.2185 19.0042 8.78078 18.999 7.34058C19.0082 5.87853 18.8822 4.41876 18.6227 2.9799Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M8.15869 10.0159L12.863 7.3406L8.15869 4.66528V10.0159Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</a>
					<?php endif; ?>

					<?php if(!empty($settings['ins_url'])) : ?>
					<a href="<?php echo esc_url($settings['ins_url']); ?>">
						<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M1.66602 8.99935C1.66602 5.54238 1.66602 3.8139 2.73996 2.73996C3.8139 1.66602 5.54238 1.66602 8.99935 1.66602C12.4563 1.66602 14.1848 1.66602 15.2587 2.73996C16.3327 3.8139 16.3327 5.54238 16.3327 8.99935C16.3327 12.4563 16.3327 14.1848 15.2587 15.2587C14.1848 16.3327 12.4563 16.3327 8.99935 16.3327C5.54238 16.3327 3.8139 16.3327 2.73996 15.2587C1.66602 14.1848 1.66602 12.4563 1.66602 8.99935Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
							<path d="M12.4747 9.00103C12.4747 10.9195 10.9195 12.4747 9.00103 12.4747C7.08256 12.4747 5.52734 10.9195 5.52734 9.00103C5.52734 7.08256 7.08256 5.52734 9.00103 5.52734C10.9195 5.52734 12.4747 7.08256 12.4747 9.00103Z" stroke="currentColor" stroke-width="1.5"/>
							<path d="M13.251 4.75391L13.242 4.75391" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>     
					</a>
					<?php endif; ?>

					<?php if(!empty($settings['lin_url'])) : ?>
					<a href="<?php echo esc_url($settings['lin_url']); ?>">
						<svg width="17" height="17" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M13.6 6.40002C15.0321 6.40002 16.4056 6.96895 17.4183 7.98165C18.431 8.99434 19 10.3679 19 11.8V18.1H15.4V11.8C15.4 11.3226 15.2103 10.8648 14.8727 10.5272C14.5352 10.1897 14.0773 10 13.6 10C13.1226 10 12.6647 10.1897 12.3272 10.5272C11.9896 10.8648 11.8 11.3226 11.8 11.8V18.1H8.19995V11.8C8.19995 10.3679 8.76888 8.99434 9.78157 7.98165C10.7943 6.96895 12.1678 6.40002 13.6 6.40002Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M4.6 7.30005H1V18.1H4.6V7.30005Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M2.8 4.6C3.79411 4.6 4.6 3.79411 4.6 2.8C4.6 1.80589 3.79411 1 2.8 1C1.80589 1 1 1.80589 1 2.8C1 3.79411 1.80589 4.6 2.8 4.6Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</a>
					<?php endif; ?>
				</div>     
			</div>
		</div>

		<?php
	}

}


$widgets_manager->register( new Kindaid_Team() );