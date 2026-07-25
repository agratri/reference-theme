<?php
class Kindaid_About extends \Elementor\Widget_Base {

	public function get_name(): string {
		return 'kindaid-about';
	}

	public function get_title(): string {
		return esc_html__( 'About', 'kindaid-core' );
	}

	public function get_icon(): string {
		return 'eicon-components';
	}

	public function get_categories(): array {
		return [ 'kindaid-core' ];
	}

	public function get_keywords(): array {
		return [ 'about' ];
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
				'default' => esc_html__( 'Hero Content Here', 'kindaid-core' ),
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
				'condition' => [
					'design-layout' => 'layout-2',
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
				'condition' => [
					'design-layout' => 'layout-2',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'list_section',
			[
				'label' => esc_html__( 'Info List', 'kindaid-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'design-layout' => 'layout-2',
				],
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Healthy Food', 'kindaid-core' ),
				'label_block' => true,
			]
		);


		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Info List', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => esc_html__( 'Healthy Food', 'kindaid-core' ),
					],
					[
						'title' => esc_html__( 'Medical Care', 'kindaid-core' ),
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'box_section',
			[
				'label' => esc_html__( 'Box Section', 'kindaid-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'design-layout' => 'layout-2',
				],
			]
		);

		$this->add_control(
			'box_image',
			[
				'label' => esc_html__( 'Choose Image', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'box_title',
			[
				'label' => esc_html__( 'Box Title', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Box Title', 'kindaid-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'box_content',
			[
				'label' => esc_html__( 'Box Content', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Box Content here', 'kindaid-core' ),
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
			'info_section',
			[
				'label' => esc_html__( 'Info', 'kindaid-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'info_image',
			[
				'label' => esc_html__( 'Info Image', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'design-layout' => 'layout-1',
				],
			]
		);

		$this->add_control(
			'number',
			[
				'label' => esc_html__( 'Number', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '50k', 'kindaid-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'info_content',
			[
				'label' => esc_html__( 'Info Content', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Info Content Here', 'kindaid-core' ),
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

			if(!empty($settings['box_image'])){
				$box_image_url =  !empty($settings['box_image']['id']) ? wp_get_attachment_image_url($settings['box_image']['id'],'full') : $settings['box_image']['url'];
				$box_image_alt = ! empty( $settings['box_image']['id'] ) ? get_post_meta( $settings['box_image']['id'], '_wp_attachment_image_alt', true ) : '';
			}

			if(!empty($settings['button_text'])){
				$this->add_link_attributes( 'button_arg', $settings['button_url'] );
				$this->add_render_attribute('button_arg', 'class', 'tp-btn tp-btn-animetion mb-20 mr-20');
			}
		?>

      <div class="tp-about-area">
         <div class="container container-1424">
            <div class="row align-items-center">
               <div class="offset-xl-1 col-xl-5 offset-lg-2 col-lg-9">
                  <div class="tp-about-3-thumb-wrap text-md-end p-relative mb-30">
					<img class="tp-about-3-thumb" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">

                     <img class="tp-about-3-thumb-2" data-parallax='{"y": 40, "smoothness": 10}' src="<?php echo esc_url($image_2_url); ?>" alt="<?php echo esc_attr($image_2_alt); ?>">

                     <img class="tp-about-3-thumb-3" data-parallax='{"y": 40, "smoothness": 10}' src="<?php echo esc_url($image_3_url); ?>" alt="<?php echo esc_attr($image_3_alt); ?>">

                     <img class="tp-about-3-thumb-shape" data-parallax='{"y": 40, "smoothness": 10}' src="assets/img/about/about-3/shape.png" alt="">
                  </div>
               </div>
               <div class="col-xl-6">
                  <div class="tp-about-3 ml-100 mb-10">
                     <div class="tp-section-info mb-30 p-relative">
						<?php if(!empty($settings['sub_title'])) : ?>
                        <span class="tp-section-subtitle d-inline-block mb-15 wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".3s"><?php echo esc_html($settings['sub_title']); ?></span>
						<?php if(!empty($settings['title'])) : ?>
						<?php endif; ?>
                        <h2 class="tp-section-title mb-15 wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".4s"><?php echo kindaid_kses_svg($settings['title']); ?></h2>
						<?php endif; ?> 
						<?php if(!empty($settings['content'])) : ?>
                        <p class="tp-section-dec wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".5s"><?php echo esc_html($settings['content']); ?></p>
						<?php endif; ?>
                     </div>
                     <div class="tp-about-3-list-wrapper mb-35 wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".6s">
					<?php foreach( $settings['list'] as $item ) : ?>
					    <div class="tp-about-3-list d-flex align-items-center flex-wrap mb-10">
                           <span class="tp-about-3-list-icon mr-10">
                              <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M8.59193 0.662629C8.76327 0.455359 8.97827 0.288489 9.22158 0.173942C9.46489 0.0593955 9.7305 0 9.99943 0C10.2684 0 10.534 0.0593955 10.7773 0.173942C11.0206 0.288489 11.2356 0.455359 11.4069 0.662629C11.9018 1.26054 12.7224 1.48131 13.4501 1.20995C13.7021 1.11611 13.9717 1.0791 14.2397 1.10155C14.5077 1.124 14.7674 1.20535 15.0003 1.33981C15.2332 1.47426 15.4335 1.65849 15.587 1.87933C15.7404 2.10018 15.8432 2.35218 15.8879 2.61734C16.0167 3.38267 16.6174 3.98334 17.3828 4.11304C17.6479 4.1578 17.8998 4.26053 18.1205 4.4139C18.3413 4.56726 18.5255 4.76747 18.66 5.00023C18.7944 5.233 18.8758 5.49257 18.8983 5.76043C18.9209 6.02828 18.884 6.2978 18.7903 6.54976C18.6582 6.90498 18.6399 7.2925 18.738 7.65858C18.8361 8.02466 19.0457 8.35115 19.3377 8.59277C20.2208 9.32314 20.2208 10.6772 19.3377 11.4076C18.7397 11.9024 18.5189 12.723 18.7903 13.4506C18.8841 13.7026 18.9211 13.9722 18.8987 14.2402C18.8762 14.5081 18.7949 14.7678 18.6604 15.0007C18.526 15.2336 18.3417 15.4339 18.1209 15.5873C17.9 15.7407 17.648 15.8435 17.3828 15.8882C17.0092 15.9514 16.6645 16.1292 16.3965 16.397C16.1285 16.6649 15.9504 17.0094 15.887 17.383C15.8422 17.648 15.7395 17.8999 15.5861 18.1207C15.4327 18.3414 15.2325 18.5256 14.9997 18.66C14.7669 18.7945 14.5073 18.8759 14.2395 18.8984C13.9716 18.9209 13.7021 18.884 13.4501 18.7904C13.0948 18.6583 12.7073 18.64 12.3412 18.7381C11.9751 18.8362 11.6486 19.0457 11.4069 19.3377C10.6765 20.2208 9.32236 20.2208 8.59193 19.3377C8.35029 19.0457 8.02377 18.8362 7.65767 18.7381C7.29157 18.64 6.90402 18.6583 6.54876 18.7904C6.29674 18.8842 6.02711 18.9212 5.75912 18.8988C5.49113 18.8763 5.23141 18.795 4.99852 18.6605C4.76563 18.5261 4.56531 18.3418 4.41187 18.121C4.25844 17.9001 4.15568 17.6481 4.11094 17.383C4.04782 17.0095 3.87011 16.665 3.60244 16.397C3.33477 16.129 2.99038 15.9509 2.61698 15.8873C2.35191 15.8425 2.1 15.7398 1.87923 15.5864C1.65846 15.4331 1.47427 15.2329 1.33982 15.0001C1.20537 14.7673 1.12398 14.5078 1.10145 14.2399C1.07891 13.972 1.1158 13.7025 1.20948 13.4506C1.34178 13.0952 1.36016 12.7075 1.26207 12.3412C1.16399 11.975 0.954301 11.6483 0.662122 11.4066C0.454998 11.2353 0.288257 11.0204 0.173801 10.7772C0.0593461 10.534 0 10.2685 0 9.9997C0 9.73092 0.0593461 9.46545 0.173801 9.22224C0.288257 8.97904 0.454998 8.7641 0.662122 8.59277C1.26008 8.09789 1.48086 7.27737 1.20948 6.54976C1.11564 6.29775 1.07862 6.02814 1.10107 5.76017C1.12352 5.49221 1.20489 5.2325 1.33935 4.99963C1.47381 4.76675 1.65806 4.56644 1.87892 4.41302C2.09978 4.2596 2.3518 4.15685 2.61698 4.11212C2.99029 4.04882 3.33469 3.87105 3.60251 3.60341C3.87034 3.33577 4.04833 2.9915 4.11186 2.61826C4.15663 2.35321 4.25937 2.10132 4.41275 1.88057C4.56612 1.65981 4.76635 1.47564 4.99913 1.3412C5.23191 1.20676 5.4915 1.12537 5.75938 1.10284C6.02725 1.08031 6.29679 1.1172 6.54876 1.21087C6.90402 1.34294 7.29157 1.36121 7.65767 1.26314C8.02377 1.16507 8.35029 0.954598 8.59193 0.662629Z" fill="#620035" />
                                 <path d="M13.7469 8.49543L9.37778 12.7539C9.21597 12.9115 8.9966 13 8.76788 13C8.53916 13 8.31979 12.9115 8.15798 12.7539L6.26698 10.9234C6.1824 10.8418 6.11525 10.7447 6.06942 10.6377C6.0236 10.5307 6 10.4159 6 10.3C6 10.184 6.0236 10.0692 6.06942 9.96225C6.11525 9.85525 6.1824 9.75817 6.26698 9.67663C6.43508 9.51628 6.66094 9.42648 6.89616 9.42648C7.13137 9.42648 7.35723 9.51628 7.52534 9.67663L8.73822 10.8463C8.73822 10.8463 8.77085 10.8588 8.78468 10.8463L12.4678 7.25545C12.5509 7.17446 12.6495 7.11022 12.7581 7.06639C12.8666 7.02256 12.983 7 13.1005 7C13.218 7 13.3343 7.02256 13.4429 7.06639C13.5514 7.11022 13.65 7.17446 13.7331 7.25545C14.089 7.59555 14.089 8.15436 13.7331 8.49543H13.7469Z" fill="white" />
                              </svg>
                           </span>
                           <span class="tp-about-3-list-text"><?php echo esc_html($item['title']); ?></span>
                        </div>
					<?php endforeach; ?>	
                     </div>
                     <div class="tp-about-3-support-wrap d-flex mb-40 wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".7s">
                        <div class="tp-about-3-support-icon mr-20 mb-10">
                           <img src="<?php echo esc_url($box_image_url); ?>" alt="<?php echo esc_attr($box_image_alt); ?>">
                        </div>
                        <div class="tp-about-3-support-dec mb-10">
                           <span class="tp-about-3-support-title"><?php echo esc_html($settings['box_title']); ?></span>
                           <p><?php echo esc_html($settings['box_content']); ?></p>
                        </div>
                     </div>
                     <div class="tp-about-3-btn d-flex align-items-center flex-wrap wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".8s">
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
                        <div class="tp-about-3-contact-info d-flex mb-20">
                           <span class="tp-about-3-contact-icon d-inline-flex justify-content-center align-items-center mr-15">
                              <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M3.14835 9.95192C2.35832 8.57438 1.97687 7.44952 1.74686 6.3093C1.40668 4.62294 2.18517 2.97563 3.47481 1.92452C4.01986 1.48028 4.64468 1.63206 4.96699 2.21029L5.69464 3.51572C6.2714 4.55043 6.55978 5.06779 6.50258 5.61628C6.44538 6.16478 6.05647 6.61151 5.27864 7.50496L3.14835 9.95192ZM3.14835 9.95192C4.74741 12.7402 7.25686 15.251 10.0484 16.8519M10.0484 16.8519C11.4259 17.642 12.5508 18.0234 13.691 18.2534C15.3773 18.5936 17.0247 17.8151 18.0758 16.5255C18.52 15.9804 18.3682 15.3556 17.79 15.0333L16.4846 14.3056C15.4499 13.7289 14.9325 13.4405 14.384 13.4977C13.8355 13.5549 13.3888 13.9438 12.4953 14.7216L10.0484 16.8519Z" stroke="#620035" stroke-width="1.5" stroke-linejoin="round" />
                                 <path d="M11.667 5.69317C12.853 6.19682 13.8035 7.14727 14.3071 8.33329M12.212 1.66663C15.1597 2.51726 17.4829 4.84039 18.3337 7.78798" stroke="#620035" stroke-width="1.5" stroke-linecap="round" />
                              </svg>
                           </span>
						   <?php if(!empty($settings['number'])) : ?>
                           <div class="tp-about-3-contact">
                              <span class="d-block"><?php echo esc_html($settings['info_content']); ?></span>
                              <a class="common-underline" href="tel:<?php echo esc_attr($settings['number']); ?>"><?php echo esc_html($settings['number']); ?></a>
                           </div>
						   <?php endif; ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>


	  <?php else : 
			if(!empty($settings['image'])){
				$image_url =  !empty($settings['image']['id']) ? wp_get_attachment_image_url($settings['image']['id'],'full') : $settings['image']['url'];
				$image_alt = ! empty( $settings['image']['id'] ) ? get_post_meta( $settings['image']['id'], '_wp_attachment_image_alt', true ) : '';
			}

			if(!empty($settings['info_image'])){
				$image_info_url =  !empty($settings['info_image']['id']) ? wp_get_attachment_image_url($settings['info_image']['id'],'full') : $settings['info_image']['url'];
				$image_info_alt = ! empty( $settings['info_image']['id'] ) ? get_post_meta( $settings['info_image']['id'], '_wp_attachment_image_alt', true ) : '';
			}

			if(!empty($settings['button_text'])){
				$this->add_link_attributes( 'button_arg', $settings['button_url'] );
				$this->add_render_attribute('button_arg', 'class', 'tp-btn tp-btn-secondary tp-btn-animetion');
			}
		
		?>
      <div class="tp-about-area fix">
         <div class="container-fluid p-0">
            <div class="row">
               <div class="col-xxl-6 col-xl-6">
                  <div class="tp-about-thumb mr-80 h-100">
                     <img class="w-100" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                  </div>
               </div>
               <div class="col-xxl-5 col-xl-6">
                  <div class="tp-about-content tp-about-2-text pt-80 pb-80 mr-100">
                     <span class="tp-section-subtitle d-inline-block mb-15 wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".3s"><?php echo esc_html($settings['sub_title']); ?></span>
                     <h2 class="tp-section-title mb-35 wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".4s"><?php echo kindaid_kses_svg($settings['title']); ?>
                     </h2>
                     <div class="tp-about-dec-wrap wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".5s">
                        <div class="row">
                           <div class="col-lg-8 col-md-8">
                              <div class="tp-about-dec">
                                 <p class="mb-40"><?php echo kindaid_kses_svg($settings['content']); ?></p>
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
                              </div>
                           </div>
                           <div class="col-lg-4 col-md-4">
                              <div class="tp-about-user pl-20">
                                 <h4><?php echo kindaid_kses_svg($settings['number']); ?></h4>
                                 <p class="mb-20"><?php echo kindaid_kses_svg($settings['info_content']); ?></p>
                                 <img src="<?php echo esc_url($image_info_url); ?>" alt="<?php echo esc_attr($image_info_alt); ?>">
                              </div>
                           </div>
                        </div>
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


$widgets_manager->register( new Kindaid_About() );