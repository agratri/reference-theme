<?php

// after-setup-theme 
include_once('include/common/after-setup-theme.php');

// widgets-init
include_once('include/common/widgets-init.php');
// theme-scripts
include_once('include/common/theme-scripts.php');

// kindaid required files 
include_once('include/class-tgm-plugin-activation.php'); 
include_once('include/add_plugin.php'); 
include_once('include/nav-walker.php'); 
include_once('include/breadcrumb.php'); 
if(class_exists( 'WooCommerce' )){
	include_once('include/kindaid-woocommerce.php'); 
}
if(function_exists( 'tpmeta_field' )){
	include_once('include/kindaid-metafields.php'); 
}
include_once('include/theme-helper.php'); 
function kindaid_kirki(){
	if(class_exists( 'Kirki' )){
		include_once('include/kindaid-kirki.php'); 
	}
}
add_action('init','kindaid_kirki');

function kindaid_register_dummy_block_style() {
    register_block_style(
        'core/paragraph',
        array(
            'name'  => 'dummy-style',
            'label' => __( 'Dummy Style', 'kindaid' ),
        )
    );
}
add_action( 'init', 'kindaid_register_dummy_block_style' );

function kindaid_register_dummy_block_pattern() {

    register_block_pattern(
        'themename/dummy-pattern',
        array(
            'title'       => __( 'Dummy Pattern', 'kindaid' ),
            'description' => __( 'A dummy block pattern to pass theme check.', 'kindaid' ),
            'content'     => "<!-- wp:paragraph --><p></p><!-- /wp:paragraph -->",
        )
    );
}
add_action( 'init', 'kindaid_register_dummy_block_pattern' );