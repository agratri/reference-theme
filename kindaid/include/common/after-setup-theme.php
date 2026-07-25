<?php
if ( ! function_exists( 'kindaid_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Twenty Fifteen 1.0
 */
function kindaid_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on twentyfifteen, use a find and replace
	 * to change 'kindaid' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'kindaid', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded  tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// set_post_thumbnail_size( 825, 510, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'main-menu' =>  __( 'Main Menu','kindaid' ),
		'footer-menu' =>  __( 'Footer Menu','kindaid' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'image', 'video', 'quote', 'gallery', 'audio',
	) );

	remove_theme_support( 'widgets-block-editor' );	

	// Add support for Block Styles.
	add_theme_support('wp-block-styles');

	add_theme_support( "responsive-embeds" );

	add_theme_support( "align-wide" );


	add_theme_support( "woocommerce" );

	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

    // Custom Logo Support (Minimal + Safe)
    add_theme_support(
        'custom-logo',
        array(
            'height'      => 100,
            'width'       => 100,
            'flex-height' => true,
            'flex-width'  => true,
        )
    );

    add_theme_support(
        'custom-header',
        array(
            'width'         => 1600,
            'height'        => 400,
            'flex-height'   => true,
            'flex-width'    => true,
            'uploads'       => true,
        )
    );

    add_theme_support(
        'custom-background',
        array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )
    );

	add_editor_style( 'assets/css/editor-style.css' );

}
endif; 

// kindaid_setup
add_action( 'after_setup_theme', 'kindaid_setup' );