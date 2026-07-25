<?php

// kindaid_scripts
function kindaid_scripts() {

    // common variables
    $theme_version = wp_get_theme()->get( 'Version' );
    $theme_uri     = get_template_directory_uri() . '/assets/';

    /*
    -----------------------------------------
    CSS
    -----------------------------------------
    */
    wp_enqueue_style( 'kindaid-fonts', kindaid_fonts_url(), array(), $theme_version, 'all' );

    wp_enqueue_style( 'bootstrap', $theme_uri . 'css/bootstrap.min.css', array(), '5.3.8', 'all' );
    wp_enqueue_style( 'animate', $theme_uri . 'css/animate.css', array(), '1.0', 'all' );
    wp_enqueue_style( 'swiper-bundle', $theme_uri . 'css/swiper-bundle.css', array(), '6.5.0', 'all' );
    wp_enqueue_style( 'magnific-popup', $theme_uri . 'css/magnific-popup.css', array(), '1.0', 'all' );
    wp_enqueue_style( 'font-awesome-pro', $theme_uri . 'css/font-awesome-pro.css', array(), '6.0.0', 'all' );
    wp_enqueue_style( 'kindaid-spacing', $theme_uri . 'css/spacing.css', array(), $theme_version, 'all' );
    wp_enqueue_style( 'kindaid-main', $theme_uri . 'css/main.css', array(), $theme_version, 'all' );
    wp_enqueue_style( 'kindaid-unit-test', $theme_uri . 'css/unit-test.css', array(), $theme_version, 'all' );
    wp_enqueue_style( 'kindaid-custom', $theme_uri . 'css/custom.css', array(), $theme_version, 'all' );
	wp_enqueue_style( 'kindaid-style', get_stylesheet_uri(), array(), $theme_version );


    /*
    -----------------------------------------
    JavaScript
    -----------------------------------------
    */
	wp_enqueue_script( 'bootstrap', $theme_uri . 'js/bootstrap-min.js', array( 'jquery' ), '5.3.8', true );
	wp_enqueue_script( 'swiper-bundle', $theme_uri . 'js/swiper-bundle.js', array( 'jquery' ), '6.5.0', true );
	wp_enqueue_script( 'magnific-popup', $theme_uri . 'js/magnific-popup.js', array( 'jquery' ), '1.1.0', true );
	wp_enqueue_script( 'nice-select', $theme_uri . 'js/nice-select.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'purecounter', $theme_uri . 'js/purecounter.js', array( 'jquery' ), '1.5.0', true );
	wp_enqueue_script( 'range-slider', $theme_uri . 'js/range-slider.js', array( 'jquery' ), '1.12.1', true );
	wp_enqueue_script( 'parallax', $theme_uri . 'js/parallax.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'parallax-scroll', $theme_uri . 'js/parallax-scroll.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'wow', $theme_uri . 'js/wow.min.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'kindaid-slider-init', $theme_uri . 'js/slider-init.js', array( 'jquery' ), $theme_version, true );
	wp_enqueue_script( 'kindaid-main', $theme_uri . 'js/main.js', array( 'jquery' ), $theme_version, true );


    /*
    -----------------------------------------
    Comment Reply
    -----------------------------------------
    */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'kindaid_scripts' );


/*
Register Fonts
 */
function kindaid_fonts_url() {

    $font_url = '';

    /*
     * Translators: If there are characters in your language that are not supported
     * by the font, translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'kindaid' ) ) {

        $font_families = array(
            'Libre+Baskerville:wght@400;500;600;700',
            'Montserrat:wght@300;400;500;600;700;800;900',
        );

        $font_url = add_query_arg(
            array(
                'family'  => implode( '&family=', $font_families ),
                'display' => 'swap',
            ),
            'https://fonts.googleapis.com/css2'
        );
    }

    return esc_url_raw( $font_url );
}