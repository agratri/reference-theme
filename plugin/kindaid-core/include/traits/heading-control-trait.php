<?php 

trait Kindaid_Heading_Control{
    protected function tp_heading_control($id = 'title', $label = 'Title and Content'){
        $this->start_controls_section(
			$id . '_heading_section',
			[
				'label' => $label,
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			$id . '_sub_title',
			[
				'label' => esc_html__( 'Sub Title', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Hero Sub Title', 'kindaid-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			$id .'_title',
			[
				'label' => esc_html__( 'Title', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Hero Title Here', 'kindaid-core' ),
			]
		);

		$this->add_control(
			$id .'_description',
			[
				'label' => esc_html__( 'Content', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( '', 'kindaid-core' ),
			]
		);

		$this->add_control(
			$id .'_text_align',
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
    }
}