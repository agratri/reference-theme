<?php
class Kindaid_Heading_Trait extends \Elementor\Widget_Base {

	use Kindaid_Content_Style,Kindaid_Heading_Control;

	public function get_name(): string {
		return 'kindaid-heading-trait';
	}

	public function get_title(): string {
		return esc_html__( 'Heading Trait', 'kindaid-core' );
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

		
		$this->tp_heading_control('tp','Title Section');
		$this->tp_heading_control('sv','Service Title Section');

	
	}

	// style 
	protected function register_style_section(){
		$this->tp_content_style('sub','Section Sub Heading','.el-sub-title');
		$this->tp_content_style('heading','Section Heading','.el-title');
		$this->tp_content_style('content','Section Content','.el-content');
	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();

		?>

		<div class="tp-section-team-wrap p-relative tp-align">
			<?php if(!empty($settings['tp_sub_title'])) : ?>
			<span class="tp-section-subtitle el-sub-title d-inline-block mb-15"><?php echo esc_html($settings['tp_sub_title']); ?></span>
			<?php endif; ?>

			<?php if(!empty($settings['tp_title'])) : ?>
			<h2 class="tp-section-title el-title  mb-20"><?php echo kindaid_kses_svg($settings['tp_title']); ?></h2> 
			<?php endif; ?>

			<?php if(!empty($settings['tp_description'])) : ?>
			<p class="el-content"><?php echo kindaid_kses_svg($settings['tp_description']); ?></p>
			<?php endif; ?>  
		</div>


		<?php
	}

}


$widgets_manager->register( new Kindaid_Heading_Trait() );