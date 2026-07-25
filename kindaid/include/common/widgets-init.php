<?php 
/**
 * Add a sidebar.
 */
function kindaid_widgets() {

	// Blog Sidebar
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'kindaid' ),
		'id'            => 'blog-sidebar',
		'description'   => __( 'Widgets in this area will be shown on blog sidebar', 'kindaid' ),
		'before_widget' => '<div id="%1$s" class="tp-widget-sidebar mb-20 %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="tp-widget-main-title mb-25">',
		'after_title'   => '</h3>',
	) );

	// Product Sidebar
	register_sidebar( array(
		'name'          => __( 'Product Sidebar', 'kindaid' ),
		'id'            => 'product-sidebar',
		'description'   => __( 'Widgets in this area will be shown on product sidebar', 'kindaid' ),
		'before_widget' => '<div id="%1$s" class="tp-shop-widget mb-50 %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="tp-shop-widget-title no-border">',
		'after_title'   => '</h3>',
	) );

	// Donation Sidebar
	register_sidebar( array(
		'name'          => __( 'Donation Sidebar', 'kindaid' ),
		'id'            => 'donation-sidebar',
		'description'   => __( 'Widgets in this area will be shown on donation sidebar', 'kindaid' ),
		'before_widget' => '<div id="%1$s" class="tp-widget-sidebar mb-20 %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="tp-widget-main-title mb-25">',
		'after_title'   => '</h3>',
	) );

	// Event Sidebar
	register_sidebar( array(
		'name'          => __( 'Event Sidebar', 'kindaid' ),
		'id'            => 'event-sidebar',
		'description'   => __( 'Widgets in this area will be shown on event sidebar', 'kindaid' ),
		'before_widget' => '<div id="%1$s" class="tp-widget-sidebar mb-20 %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="tp-widget-main-title mb-25">',
		'after_title'   => '</h3>',
	) );

	// footer style 01 
	register_sidebar( array(
		'name'          => __( 'Footer 1 : Widget 1', 'kindaid' ),
		'id'            => 'footer-1-widget-1',
		'description'   => __( 'Widgets in this area will be shown on Footer 1 : Widget 1', 'kindaid' ),
		'before_widget' => '<div id="%1$s" class="tp-footer-widget mb-40 wow fadeInUp %2$s" data-wow-duration=".9s" data-wow-delay=".3s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="tp-footer-title mb-15">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1 : Widget 2', 'kindaid' ),
		'id'            => 'footer-1-widget-2',
		'description'   => __( 'Widgets in this area will be shown on Footer 1 : Widget 2', 'kindaid' ),
		'before_widget' => '<div id="%1$s" class="tp-footer-widget ml-65 mb-50 wow fadeInUp %2$s" data-wow-duration=".9s" data-wow-delay=".4s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="tp-footer-title mb-15">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1 : Widget 3', 'kindaid' ),
		'id'            => 'footer-1-widget-3',
		'description'   => __( 'Widgets in this area will be shown on Footer 1 : Widget 3', 'kindaid' ),
		'before_widget' => '<div id="%1$s" class="tp-footer-widget tp-footer-col-2 mb-50 wow fadeInUp %2$s" data-wow-duration=".9s" data-wow-delay=".5s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="tp-footer-title mb-15">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1 : Widget 4', 'kindaid' ),
		'id'            => 'footer-1-widget-4',
		'description'   => __( 'Widgets in this area will be shown on Footer 1 : Widget 4', 'kindaid' ),
		'before_widget' => '<div id="%1$s" class="tp-footer-widget mb-50 bg-position wow fadeInUp %2$s" data-wow-duration=".9s" data-wow-delay=".6s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="tp-footer-title mb-15">',
		'after_title'   => '</h3>',
	) );


	// footer style 02 
	register_sidebar( array(
		'name'          => __( 'Footer 2 : Widget 1', 'kindaid' ),
		'id'            => 'footer-2-widget-1',
		'description'   => __( 'Widgets in this area will be shown on Footer 2 : Widget 1', 'kindaid' ),
		'before_widget' => '<div id="%1$s" class="tp-footer-widget mb-40 mr-70 wow fadeInUp %2$s" data-wow-duration=".9s" data-wow-delay=".3s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="tp-footer-title mb-15">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2 : Widget 2', 'kindaid' ),
		'id'            => 'footer-2-widget-2',
		'description'   => __( 'Widgets in this area will be shown on Footer 2 : Widget 2', 'kindaid' ),
		'before_widget' => '<div id="%1$s" class="tp-footer-widget ml-30 mb-50 wow fadeInUp %2$s" data-wow-duration=".9s" data-wow-delay=".4s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="tp-footer-title mb-15">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2 : Widget 3', 'kindaid' ),
		'id'            => 'footer-2-widget-3',
		'description'   => __( 'Widgets in this area will be shown on Footer 2 : Widget 3', 'kindaid' ),
		'before_widget' => '<div id="%1$s" class="tp-footer-widget ml-75 tp-footer-col-2 mb-50 wow fadeInUp %2$s" data-wow-duration=".9s" data-wow-delay=".5s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="tp-footer-title mb-15">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2 : Widget 4', 'kindaid' ),
		'id'            => 'footer-2-widget-4',
		'description'   => __( 'Widgets in this area will be shown on Footer 2 : Widget 4', 'kindaid' ),
		'before_widget' => '<div id="%1$s" class="tp-footer-widget ml-30 tp-footer-3-cta mb-50 wow fadeInUp %2$s" data-wow-duration=".9s" data-wow-delay=".6s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="tp-footer-title mb-15">',
		'after_title'   => '</h3>',
	) );

}
add_action( 'widgets_init', 'kindaid_widgets' );