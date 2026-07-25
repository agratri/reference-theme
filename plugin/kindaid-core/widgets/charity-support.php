<?php
class Kindaid_Charity_Support extends \Elementor\Widget_Base {

	public function get_name(): string {
		return 'kindaid-charity-support';
	}

	public function get_title(): string {
		return esc_html__( 'Charity Support', 'kindaid-core' );
	}

	public function get_icon(): string {
		return 'eicon-components';
	}

	public function get_categories(): array {
		return [ 'kindaid-core' ];
	}

	public function get_keywords(): array {
		return [ 'charity' ];
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
			'heading_section',
			[
				'label' => esc_html__( 'Title & Content', 'kindaid-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'design-layout' => 'layout-1',
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
				'default' => esc_html__( '', 'kindaid-core' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'button_section',
			[
				'label' => esc_html__( 'Button', 'kindaid-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'design-layout' => 'layout-1',
				],
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
			'post_section',
			[
				'label' => esc_html__( 'Charity Support', 'kindaid-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'post-title',
			[
				'label' => esc_html__( 'Select Title', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'layout-post-title',
				'options' => [
					'layout-custom-title' => esc_html__( 'Custom Title', 'kindaid-core' ),
					'layout-post-title' => esc_html__( 'Post Title', 'kindaid-core' ),
				],
				'condition' => [
					'design-layout' => 'layout-1',
				],
			]
		);

		$this->add_control(
			'post-custom-title',
			[
				'label' => esc_html__( 'Custom Title', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Custom Title Here', 'kindaid-core' ),
				'condition' => [
					'post-title' => 'layout-custom-title',
				],
			]
		);

		$this->add_control(
			'post-description',
			[
				'label' => esc_html__( 'Post Content', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Help our organization by donating today! Donations go to making a difference for our cause. ', 'kindaid-core' ),
				'condition' => [
					'design-layout' => 'layout-1',
				],
			]
		);
		$this->add_control(
			'secure-text',
			[
				'label' => esc_html__( 'Bottom Text', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( '100% Secure Donation', 'kindaid-core' ),
				'condition' => [
					'design-layout' => 'layout-1',
				],
			]
		);

		$this->add_control(
			'post-number',
			[
				'label' => esc_html__( 'Post Number', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => esc_html__( '1', 'kindaid-core' ),
			]
		);

		$this->add_control(
			'post-cat',
			[
				'label' => esc_html__( 'Select Post Categorie', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => kindaid_all_cat('campaign_category')
			]
		);

		$this->add_control(
			'post-in',
			[
				'label' => esc_html__( 'Post In', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => kindaid_all_post('campaign')
			]
		);

		$this->add_control(
			'post-not-in',
			[
				'label' => esc_html__( 'Post Not In', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => kindaid_all_post('campaign')
			]
		);

		$this->add_control(
			'post-order',
			[
				'label' => esc_html__( 'Order', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'ASC',
				'options' => [
					'ASC' => esc_html__( 'ASC', 'kindaid-core' ),
					'DESC' => esc_html__( 'DESC', 'kindaid-core' ),
				],
			]
		);

		$this->add_control(
			'post-order-by',
			[
				'label' => esc_html__( 'Order By', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
			        'ID' => 'Post ID',
			        'author' => 'Post Author',
			        'title' => 'Title',
			        'date' => 'Date',
			        'modified' => 'Last Modified Date',
			        'parent' => 'Parent Id',
			        'rand' => 'Random',
			        'comment_count' => 'Comment Count',
			        'menu_order' => 'Menu Order',
				],
			]
		);

		$this->add_control(
			'post-content-word',
			[
				'label' => esc_html__( 'Content Word Count', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => esc_html__( '9', 'kindaid-core' ),
			]
		);


		$this->add_control(
			'show_pagination',
			[
				'label' => esc_html__( 'Show Pagination', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'kindaid-core' ),
				'label_off' => esc_html__( 'Hide', 'kindaid-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);


		$this->end_controls_section();


	}

	// style 
	protected function register_style_section(){

		$this->start_controls_section(
			'section_percentage_style',
			[
				'label' => esc_html__( 'Percentage', 'kindaid-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'percentage_color',
			[
				'label' => esc_html__( 'Color', 'kindaid-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .el-percentage' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .el-percentage',
			]
		);


		$this->end_controls_section();


		
	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();

		$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

		$args = array(
			'post_type'              => array('campaign'), 
			'post_status'            => array('publish'), 
			'posts_per_page'         => $settings['post-number'], // use -1 for all post
			'order'                  => $settings['post-order'], // Also support: ASC
			'orderby'                => $settings['post-order-by'],
			'post__in'               => $settings['post-in'],
			'post__not_in'           => $settings['post-not-in'],
			'paged'          => $paged,
		);

		if(!empty($settings['post-cat'])){
			$args['tax_query'] = array(
				array(
					'taxonomy'         => 'campaign_category', // taxonomy slug
					'terms'            => $settings['post-cat'], // term slug
					'field'            => 'slug', // Also support: slug, name, term_taxonomy_id
					'operator'         => 'IN', // Also support: AND, NOT IN, EXISTS, NOT EXISTS
					'include_children' => true,
				),
			);
		}

		$query = new \WP_Query($args);



		?>


		<?php if($settings['design-layout'] == 'layout-2') : ?>


		<?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); 
				$campaign = charitable_get_campaign( get_the_ID() );

				$goal = charitable_format_money($campaign->get_goal());
				$donated = charitable_format_money($campaign->get_donated_amount());
				$percent  = round($campaign->get_percent_donated_raw());	

				$button_text = $campaign->get( 'donate_button_text', true );	

				function kindaid_campaign_total_donations_count($campaign_id) {
					global $wpdb;

					// Table name
					$table_name = $wpdb->prefix . 'charitable_campaign_donations';

					// Custom query
					$total = $wpdb->get_var(
						$wpdb->prepare(
							"SELECT COUNT(*) FROM $table_name WHERE campaign_id = %d",
							$campaign_id
						)
					);

					return $total;
				}

				$campaign_id =  get_the_ID(); 

				$donation_total = kindaid_campaign_total_donations_count($campaign_id);

				$total_donations = $donation_total > 0 ? $donation_total : '0' ;

		?>	
		<div class="tp-help-progress">
			<div class="tp-progress tp-cta-progress mb-15">
				<h3 class="tp-cta-counter el-percentage mb-5"><?php echo esc_html($percent); ?>%</h3>
				<div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="<?php echo esc_html($percent); ?>" aria-valuemin="0" aria-valuemax="100">
					<div class="progress-bar wow slideInLeft" data-wow-duration="2s" data-wow-delay=".1s" style="width: <?php echo esc_html($percent); ?>%"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-6">
					<div class="tp-help-amount">
					<h4><span><?php echo esc_html__('Raised','kindaid-core'); ?> - </span><?php echo esc_html($donated); ?></h4>
					</div>
				</div>
				<div class="col-6">
					<div class="tp-help-amount text-end">
					<h4><span><?php echo esc_html__('Goals','kindaid-core'); ?> - </span><?php echo esc_html($goal); ?></h4>
					</div>
				</div>
			</div>
		</div>
		<?php endwhile; wp_reset_postdata(); ?>
		<?php else : ?>
			<p>No posts found</p>
		<?php endif; ?>

		<?php else : 
			if(!empty($settings['button_text'])){
				$this->add_link_attributes( 'button_arg', $settings['button_url'] );
				$this->add_render_attribute('button_arg', 'class', 'tp-btn tp-btn-nopading tp-btn-animetion');
			}
		?>
      <div class="tp-mission-area">
         <div class="container-none">
            <div class="tp-mission-spacing" style="background-color:#ffca24">
               <div class="row align-items-center">
                  <div class="col-lg-7">
                     <div class="tp-mission-content mr-50">
                        <h2 class="tp-mission-title mb-20"><?php echo kindaid_kses_svg($settings['title']); ?></h2>
                        <p class="mb-45"><?php echo kindaid_kses_svg($settings['description']); ?></p>

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
                  <div class="col-lg-5">
					<?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); 
							$campaign = charitable_get_campaign( get_the_ID() );

							$goal = charitable_format_money($campaign->get_goal());
							$donated = charitable_format_money($campaign->get_donated_amount());
							$percent  = round($campaign->get_percent_donated_raw());	

							$button_text = $campaign->get( 'donate_button_text', true );	

							function kindaid_campaign_total_donations_count($campaign_id) {
								global $wpdb;

								// Table name
								$table_name = $wpdb->prefix . 'charitable_campaign_donations';

								// Custom query
								$total = $wpdb->get_var(
									$wpdb->prepare(
										"SELECT COUNT(*) FROM $table_name WHERE campaign_id = %d",
										$campaign_id
									)
								);

								return $total;
							}

							$campaign_id =  get_the_ID(); 

							$donation_total = kindaid_campaign_total_donations_count($campaign_id);

							$total_donations = $donation_total > 0 ? $donation_total : '0' ;
	
					?>
                     <div class="tp-custom-donate-wrap" data-bg-color="#fcf8ec">
                        <div class="tp-custom-donate-content text-center">
                           <h3 class="tp-custom-donate-title mb-10">
								<?php if($settings['post-title'] == 'layout-custom-title') : ?>
									<?php echo kindaid_kses_svg($settings['post-custom-title']); ?>
								<?php else : ?>
									<?php the_title(); ?>
								<?php endif; ?>	
						    </h3>
                           <p class="tp-custom-donate-dec mb-30"><?php echo kindaid_kses_svg($settings['post-description']); ?></p>
                        </div>
                        <div class="tp-custom-donate-inner">
                           <div class="tp-custom-donate-count">
                              <ul>
                                 <li>
                                    <b><?php echo esc_html($donated); ?></b>
                                    <span><?php echo esc_html__('Raised:','kindaid-core'); ?></span>
                                 </li>

                                 <li>
                                    <b><?php echo esc_html($total_donations); ?></b>
                                    <span><?php echo esc_html__('Donations:','kindaid-core'); ?> </span>
                                 </li>

                                 <li>
                                    <b><?php echo esc_html($goal); ?></b>
                                    <span><?php echo esc_html__('Goals:','kindaid-core'); ?></span>
                                 </li>
                              </ul>
                           </div>
                        </div>
                        <div class="tp-custom-donate-progress mb-20">
                           <div class="tp-progress mb-10">
                              <div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="<?php echo esc_html($percent); ?>" aria-valuemin="0" aria-valuemax="100">
                                 <div class="progress-bar wow slideInLeft" data-wow-duration="1s" data-wow-delay=".1s" style="width: <?php echo esc_html($percent); ?>%"></div>
                              </div>
                           </div>
                        </div>
						<?php if(!empty($button_text)) : ?>
                        <div class="tp-custom-donate-button text-center">
                           <a class="tp-btn tp-btn-animetion tp-btn-mulberry w-100 justify-content-center mb-10" href="<?php the_permalink(); ?>">
                              <span class="btn-text"><?php echo esc_html($button_text); ?></span>
                              <span class="btn-icon">
                                 <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 7H13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M7 1L13 7L7 13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                 </svg>
                              </span>
                           </a>
                           <span class="tp-custom-donate-secure"><?php echo kindaid_kses_svg($settings['secure-text']); ?></span>
                        </div>
						<?php endif; ?>
                     </div>
					<?php endwhile; wp_reset_postdata(); ?>
					<?php else : ?>
						<p>No posts found</p>
					<?php endif; ?>
                  </div>       
               </div>
            </div>
         </div>
      </div>

	  <?php endif; ?>



		<?php
	}

}


$widgets_manager->register( new Kindaid_Charity_Support() );