<?php
namespace TPCore\Common;

use Elementor\Controls_Manager;
use Elementor\Element_Base;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Pure_Animation {

    public function __construct() {
        add_action( 'elementor/element/after_section_end', [ $this, 'register_controls' ], 10, 2 );
        add_action( 'elementor/frontend/before_render', [ $this, 'before_render' ], 1 );
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
    }

    public function before_render( $element ) {
        // Only run for our widgets/sections/containers that have the setting
        $settings = $element->get_settings_for_display();

        if ( ! empty( $settings['pure_animation_type'] ) ) {
            
            // Add classes directly to wrapper if not using prefix_class or to reinforce
            // With prefix_class 'tp-', the value 'fade-in' becomes class 'tp-fade-in' automatically on wrapper
            
            // Inject data attributes for JS
            $element->add_render_attribute( '_wrapper', 'data-pure-anim', 'yes' );
            $element->add_render_attribute( '_wrapper', 'class', 'tp-effect' );
            
            if ( isset( $settings['pure_animation_duration']['size'] ) && '' !== $settings['pure_animation_duration']['size'] ) {
                $duration = $settings['pure_animation_duration']['size'] . $settings['pure_animation_duration']['unit'];
                $element->add_render_attribute( '_wrapper', 'data-tp-duration', $duration );
            }

            if ( isset( $settings['pure_animation_delay']['size'] ) && '' !== $settings['pure_animation_delay']['size'] ) {
                $delay = $settings['pure_animation_delay']['size'] . $settings['pure_animation_delay']['unit'];
                $element->add_render_attribute( '_wrapper', 'data-tp-delay', $delay );
            }
        }
    }

    public function register_controls( $element, $section_id ) {
        // We ensure we only add it once by targeting _section_responsive
        if ( '_section_responsive' !== $section_id ) {
            return;
        }

        $element->start_controls_section(
            'section_pure_animation',
            [
                'label' => __( 'Pure Animation', 'tpcore' ),
                'tab' => Controls_Manager::TAB_ADVANCED,
            ]
        );

        $element->add_control(
            'pure_animation_type',
            [
                'label' => __( 'Animation Type', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    ''              => __( 'None', 'tpcore' ),
                    'fade-in'       => __( 'Fade In', 'tpcore' ),
                    'fade-in-up'    => __( 'Fade In Up', 'tpcore' ),
                    'fade-in-down'  => __( 'Fade In Down', 'tpcore' ),
                    'fade-in-left'  => __( 'Fade In Left', 'tpcore' ),
                    'fade-in-right' => __( 'Fade In Right', 'tpcore' ),
                    'zoom-in'       => __( 'Zoom In', 'tpcore' ),
                    'bounce'        => __( 'Bounce', 'tpcore' ),
                    'skew-in'       => __( 'Skew In', 'tpcore' ),
                    'rotate-in'     => __( 'Rotate In', 'tpcore' ),
                ],
                'prefix_class' => 'tp-',
                'frontend_available' => true,
                'render_type' => 'template',
            ]
        );

        $element->add_control(
            'pure_animation_duration',
            [
                'label' => __( 'Animation Duration', 'tpcore' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 1,
                    'unit' => 's',
                ],
                'range' => [
                    's' => [
                        'min' => 0.1,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                    'ms' => [
                        'min' => 100,
                        'max' => 5000,
                        'step' => 100,
                    ],
                ],
                'size_units' => [ 's', 'ms' ],
                'condition' => [
                    'pure_animation_type!' => '',
                ],
                'render_type' => 'template',
            ]
        );

        $element->add_control(
            'pure_animation_delay',
            [
                'label' => __( 'Animation Delay', 'tpcore' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                    'unit' => 's',
                ],
                'range' => [
                    's' => [
                        'min' => 0,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                    'ms' => [
                        'min' => 0,
                        'max' => 5000,
                        'step' => 100,
                    ],
                ],
                'size_units' => [ 's', 'ms' ],
                'condition' => [
                    'pure_animation_type!' => '',
                ],
                'render_type' => 'template',
            ]
        );

        $element->end_controls_section();
    }

    public function enqueue_scripts() {
        wp_enqueue_style( 'pure-animations', plugins_url( '../../assets/css/pure-animations.css', __FILE__ ), [], '1.0.0' );
        wp_enqueue_script( 'pure-animations', plugins_url( '../../assets/js/pure-animations.js', __FILE__ ), [ 'jquery', 'elementor-frontend' ], '1.0.0', true );
    }

}

new Pure_Animation();
