<?php
/**
 * Reusable Elementor link control.
 *
 * Most widgets in this plugin declare a plain TEXT control for URLs and print it
 * with esc_url(). That loses the "open in new window" and "add nofollow" options
 * Elementor gives you for free, and every widget re-implements the same field.
 *
 * This trait supplies both halves: the control, and the attribute rendering.
 *
 * Usage:
 *
 *     class Kindaid_Icon_Box extends \Elementor\Widget_Base {
 *         use Kindaid_Link_Control;
 *
 *         protected function register_controls_section(){
 *             // … inside an open controls section …
 *             $this->kindaid_link_control( 'box_url', esc_html__( 'Button Link', 'kindaid-core' ) );
 *         }
 *
 *         protected function render(): void {
 *             $settings = $this->get_settings_for_display();
 *             ?>
 *             <a class="el-link" <?php echo $this->kindaid_link_attrs( $settings['box_url'] ); ?>>
 *                 <?php echo kindaid_kses_svg( $settings['box_url_text'] ); ?>
 *             </a>
 *             <?php
 *         }
 *     }
 *
 * @package KindAid_Core
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

trait Kindaid_Link_Control {

	/**
	 * Register a URL control.
	 *
	 * Must be called between start_controls_section() and end_controls_section().
	 *
	 * @param string $id    Control ID, e.g. 'box_url'.
	 * @param string $label Control label.
	 * @param array  $extra Extra control arguments merged last (condition, default, …).
	 * @return void
	 */
	protected function kindaid_link_control( $id = 'link', $label = '', $extra = array() ) {

		if ( '' === $label ) {
			$label = esc_html__( 'Link', 'kindaid-core' );
		}

		$args = array(
			'label'       => $label,
			'type'        => \Elementor\Controls_Manager::URL,
			'label_block' => true,
			'options'     => array( 'url', 'is_external', 'nofollow' ),
			'default'     => array(
				'url'         => '#',
				'is_external' => false,
				'nofollow'    => false,
			),
			'placeholder' => esc_html__( 'https://example.com', 'kindaid-core' ),
		);

		$this->add_control( $id, array_merge( $args, $extra ) );
	}

	/**
	 * Build the href/target/rel attribute string for a URL control's value.
	 *
	 * Returns an already-escaped string, so echo it raw:
	 *
	 *     <a <?php echo $this->kindaid_link_attrs( $settings['box_url'] ); ?>>
	 *
	 * Accepts a plain string too, so it still works on widgets that have not been
	 * migrated from a TEXT control yet.
	 *
	 * @param array|string $link Value of a URL control, or a bare URL string.
	 * @return string
	 */
	protected function kindaid_link_attrs( $link ) {

		if ( is_string( $link ) ) {
			$link = array( 'url' => $link );
		}

		if ( empty( $link['url'] ) ) {
			return '';
		}

		$attrs = ' href="' . esc_url( $link['url'] ) . '"';

		if ( ! empty( $link['is_external'] ) ) {
			$attrs .= ' target="_blank"';
		}

		$rel = array();

		if ( ! empty( $link['nofollow'] ) ) {
			$rel[] = 'nofollow';
		}

		if ( ! empty( $link['is_external'] ) ) {
			$rel[] = 'noopener';
			$rel[] = 'noreferrer';
		}

		if ( $rel ) {
			$attrs .= ' rel="' . esc_attr( implode( ' ', array_unique( $rel ) ) ) . '"';
		}

		return $attrs;
	}
}
