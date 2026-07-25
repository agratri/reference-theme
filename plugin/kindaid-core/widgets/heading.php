<?php
class Kindaid_Heading extends \Elementor\Widget_Base {

	use Kindaid_Content_Style;

	public function get_name(): string {
		return 'kindaid-heading';
	}

	public function get_title(): string {
		return esc_html__( 'Heading', 'kindaid-core' );
	}

	public function get_icon(): string {
		return 'eicon-components';
	}

	public function get_categories(): array {
		return [ 'kindaid-core' ];
	}

	public function get_keywords(): array {
		return [ 'heading' ];
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
		$this->tp_content_style('sub','Section Sub Heading','.el-sub-title');
		$this->tp_content_style('heading','Section Heading','.el-title');
		$this->tp_content_style('content','Section Content','.el-content');
	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();
		$wow_class = '';
		$duration = '';

		if ($settings['enable_wow'] === 'yes') {
			$wow_class = 'wow ' . $settings['animation_type'];
			$duration = 'data-wow-duration="' . esc_attr($settings['wow_duration']) . '"';
		}

		// base delay
		$base_delay = 0.3;
		$step = 0.1;


		?>

		<div class="tp-section-team-wrap p-relative tp-align">
			<?php if(!empty($settings['sub_title'])) : ?>
			<span class="tp-section-subtitle el-sub-title d-inline-block mb-15 <?php echo esc_attr($wow_class); ?>" <?php echo $duration; ?> data-wow-delay="<?php echo esc_attr($base_delay . 's'); ?>"><?php echo esc_html($settings['sub_title']); ?></span>
			<?php endif; ?>

			<?php if(!empty($settings['title'])) : ?>
			<h2 class="tp-section-title el-title  mb-20 <?php echo esc_attr($wow_class); ?>" <?php echo $duration; ?> data-wow-delay="<?php echo esc_attr(($base_delay + $step) . 's'); ?>"><?php echo kindaid_kses_svg($settings['title']); ?></h2> 
			<?php endif; ?>

			<?php if(!empty($settings['description'])) : ?>
			<p class="<?php echo esc_attr($wow_class); ?> el-content" <?php echo $duration; ?> data-wow-delay="<?php echo esc_attr(($base_delay + ($step * 2)) . 's'); ?>"><?php echo kindaid_kses_svg($settings['description']); ?></p>
			<?php endif; ?>  
		</div>


		<?php
	}

}


$widgets_manager->register( new Kindaid_Heading() );