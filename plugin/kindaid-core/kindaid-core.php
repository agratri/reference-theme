<?php
/**
 * Plugin Name: KindAid Core
 * Description: Kindaid core plugin for widgets.
 * Version:     1.0.0
 * Author:      agratri
 * Author URI:  https://themeforest.net/user/agratri
 * Text Domain: kindaid-core
 *
 * Requires Plugins: elementor
 * Elementor tested up to: 3.33.5
 * Elementor Pro tested up to: 3.25.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'KINDAID_CORE_VERSION', '1.0.0' );
define( 'KINDAID_CORE_URL', plugin_dir_url( __FILE__ ) );
define( 'KINDAID_CORE_PATH', plugin_dir_path( __FILE__ ) );

/**
 * Admin assets for the classic widget forms.
 *
 * Loaded once, centrally, instead of from each widget class — a widget's
 * constructor runs on every request, so hooking admin_enqueue_scripts there
 * registered the same handler eight times over.
 *
 * Paths resolve against the plugin, never the theme: a widget must keep working
 * after a theme switch.
 *
 * @param string $hook_suffix Current admin screen.
 * @return void
 */
function kindaid_core_widget_admin_assets( $hook_suffix ) {

	if ( 'widgets.php' !== $hook_suffix && 'customize.php' !== $hook_suffix ) {
		return;
	}

	wp_enqueue_media();

	wp_enqueue_script(
		'kindaid-widget-media',
		KINDAID_CORE_URL . 'assets/js/kindaid-widget.js',
		array( 'jquery' ),
		KINDAID_CORE_VERSION,
		true
	);

	wp_localize_script(
		'kindaid-widget-media',
		'kindaidWidgetL10n',
		array(
			'frameTitle' => esc_html__( 'Select or upload an image', 'kindaid-core' ),
			'buttonText' => esc_html__( 'Use this image', 'kindaid-core' ),
		)
	);
}
add_action( 'admin_enqueue_scripts', 'kindaid_core_widget_admin_assets' );

// WP Custom Widgets
require_once( __DIR__ . '/include/wp-widgets/blog-author.php' );
require_once( __DIR__ . '/include/wp-widgets/blog-banner.php' );
require_once( __DIR__ . '/include/wp-widgets/blog-recent-post.php' );
require_once( __DIR__ . '/include/wp-widgets/footer-contact-info.php' );
require_once( __DIR__ . '/include/wp-widgets/footer-contact-info-2.php' );
require_once( __DIR__ . '/include/wp-widgets/footer-newsletter.php' );
require_once( __DIR__ . '/include/wp-widgets/footer-info.php' );
require_once( __DIR__ . '/include/wp-widgets/event-recent-post.php' );

// plugins functions 
require_once( __DIR__ . '/include/kindaid-core-helper.php' );
require_once( __DIR__ . '/include/ocdi.php' );

/*
 * include/common/pure-animation.php is NOT loaded on purpose.
 *
 * It is leftover code from another product (it declares namespace TPCore\Common)
 * and adds animation controls to every Elementor element. Animation in this theme
 * is handled per-widget with the WOW.js control section instead, so the file and
 * its assets/css/pure-animations.css + assets/js/pure-animations.js are dead
 * weight. Delete all three before release — shipping unused assets fails
 * ThemeForest review.
 */

require_once( __DIR__ . '/include/traits/normal-trait.php' );
require_once( __DIR__ . '/include/traits/heading-control-trait.php' );
require_once( __DIR__ . '/include/traits/link-trait.php' );

// Elementor Custom Widgets 
function kindaid_register_elementor_widgets( $widgets_manager ) {

	if(class_exists( 'Charitable' )){
		require_once( __DIR__ . '/widgets/charity-grid.php' );
		require_once( __DIR__ . '/widgets/charity-slider.php' );
		require_once( __DIR__ . '/widgets/charity-support.php' );
	}
	
	require_once( __DIR__ . '/widgets/event-grid.php' );

	require_once( __DIR__ . '/widgets/contact-form.php' );
	require_once( __DIR__ . '/widgets/image-blend.php' );
	require_once( __DIR__ . '/widgets/slider.php' );
	require_once( __DIR__ . '/widgets/about.php' );
	require_once( __DIR__ . '/widgets/blog-post.php' );
	require_once( __DIR__ . '/widgets/heading.php' );
	require_once( __DIR__ . '/widgets/heading-trait.php' );
	require_once( __DIR__ . '/widgets/hero.php' );
	require_once( __DIR__ . '/widgets/fact.php' );
	require_once( __DIR__ . '/widgets/services-list.php' );
	require_once( __DIR__ . '/widgets/faq.php' );
	require_once( __DIR__ . '/widgets/join.php' );
	require_once( __DIR__ . '/widgets/step.php' );
	require_once( __DIR__ . '/widgets/call-us.php' );
	require_once( __DIR__ . '/widgets/button.php' );
	require_once( __DIR__ . '/widgets/brand.php' );
	require_once( __DIR__ . '/widgets/team.php' );
	require_once( __DIR__ . '/widgets/social.php' );
	require_once( __DIR__ . '/widgets/skill.php' );
	require_once( __DIR__ . '/widgets/team-info-list.php' );
	require_once( __DIR__ . '/widgets/icon-box.php' );
	require_once( __DIR__ . '/widgets/image-box.php' );
	require_once( __DIR__ . '/widgets/who-we-are.php' );
	require_once( __DIR__ . '/widgets/testimonials.php' );
	require_once( __DIR__ . '/widgets/gallery.php' );
	require_once( __DIR__ . '/widgets/mission-vision.php' );
	require_once( __DIR__ . '/widgets/test.php' );
	require_once( __DIR__ . '/widgets/tin.php' );
}
add_action( 'elementor/widgets/register', 'kindaid_register_elementor_widgets' );

// Elementor Custom Category
function kindaid_elementor_widget_categories( $elements_manager ) {
	$elements_manager->add_category(
		'kindaid-core',
		[
			'title' => esc_html__( 'Kindaid Core', 'kindaid-core' ),
			'icon' => 'fa fa-plug',
		]
	);
}
add_action( 'elementor/elements/categories_registered', 'kindaid_elementor_widget_categories' );
