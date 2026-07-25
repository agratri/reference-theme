<?php
class Kindaid_Join extends \Elementor\Widget_Base {

	public function get_name(): string {
		return 'kindaid-join';
	}

	public function get_title(): string {
		return esc_html__( 'Join', 'kindaid-core' );
	}

	public function get_icon(): string {
		return 'eicon-components';
	}

	public function get_categories(): array {
		return [ 'kindaid-core' ];
	}

	public function get_keywords(): array {
		return [ 'join', 'home 01 join' ];
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
			'number',
			[
				'label' => esc_html__( 'Number', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '120,859', 'kindaid-core' ),
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
		$this->add_control(
			'image_3',
			[
				'label' => esc_html__( 'Choose Image 03', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'image_4',
			[
				'label' => esc_html__( 'Choose Image 04', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
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
			'caption',
			[
				'label' => esc_html__( 'Caption', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Caption Text', 'kindaid-core' ),
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


		$this->end_controls_section();
	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();

		if(!empty($settings['image'])){
			$image_url =  !empty($settings['image']['id']) ? wp_get_attachment_image_url($settings['image']['id'],'full') : $settings['image']['url'];
			$image_alt = ! empty( $settings['image']['id'] ) ? get_post_meta( $settings['image']['id'], '_wp_attachment_image_alt', true ) : '';
		}

		if(!empty($settings['image_2'])){
			$image_2_url =  !empty($settings['image_2']['id']) ? wp_get_attachment_image_url($settings['image_2']['id'],'full') : $settings['image_2']['url'];
			$image_2_alt = ! empty( $settings['image_2']['id'] ) ? get_post_meta( $settings['image_2']['id'], '_wp_attachment_image_alt', true ) : '';
		}

		if(!empty($settings['image_3'])){
			$image_3_url =  !empty($settings['image_3']['id']) ? wp_get_attachment_image_url($settings['image_3']['id'],'full') : $settings['image_3']['url'];
			$image_3_alt = ! empty( $settings['image_3']['id'] ) ? get_post_meta( $settings['image_3']['id'], '_wp_attachment_image_alt', true ) : '';
		}

		if(!empty($settings['image_4'])){
			$image_4_url =  !empty($settings['image_4']['id']) ? wp_get_attachment_image_url($settings['image_4']['id'],'full') : $settings['image_4']['url'];
			$image_4_alt = ! empty( $settings['image_4']['id'] ) ? get_post_meta( $settings['image_4']['id'], '_wp_attachment_image_alt', true ) : '';
		}


		if(!empty($settings['button_text'])){
			$this->add_link_attributes( 'button_arg', $settings['button_url'] );
			$this->add_render_attribute('button_arg', 'class', 'tp-join-btn tp-btn tp-btn-animetion');
		}
		

		?>

      <div class="tp-join-area scene fix pt-115 pb-150">
         <div class="container container-1424">
            <div class="tp-join text-center p-relative" >
               <div class="tp-join-shape d-none d-md-block">
                  <img class="tp-join-shape-1 p-absolute d-none d-lg-block layer" data-depth="0.8" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                  <img class="tp-join-shape-2 p-absolute layer" data-depth="-0.8" src="<?php echo esc_url($image_2_url); ?>" alt="<?php echo esc_attr($image_2_alt); ?>">
                  <img class="tp-join-shape-3 p-absolute d-none d-lg-block layer" data-depth="0.8" src="<?php echo esc_url($image_3_url); ?>" alt="<?php echo esc_attr($image_3_alt); ?>">
                  <img class="tp-join-shape-4 p-absolute layer" data-depth="-0.8" src="<?php echo esc_url($image_4_url); ?>" alt="<?php echo esc_attr($image_4_alt); ?>">
               </div>
               <div class="row justify-content-center">
                  <div class="col-xl-7 col-lg-8">
                     <div class="tp-join-info mb-60 ml-25 mr-25">
                        <span class="tp-section-subtitle d-block mb-15 wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".3s"><?php echo esc_html($settings['sub_title']); ?></span>
                        <h3 class="tp-join-title mb-20 wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".4s"><?php echo kindaid_kses_svg($settings['title']); ?></h3 >   
                     </div>
                  </div>
               </div>
               <h2 class="tp-join-number mb-70 wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".5s"> <?php echo kindaid_kses_svg($settings['number']); ?></h2>
               <div class="tp-join-down wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".6s">
                  <p class="tp-join-down-tittle mb-15"><?php echo kindaid_kses_svg($settings['caption']); ?></p>
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
         </div>
      </div>


		<?php
	}

}


$widgets_manager->register( new Kindaid_Join() );