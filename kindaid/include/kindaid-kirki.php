<?php

// kikri 
new \Kirki\Panel(
	'kindaid_panel',
	[
		'priority'    => 10,
		'title'       => esc_html__( 'KindAid Options', 'kindaid' ),
		'description' => esc_html__( 'KindAid All Option Panel Here.', 'kindaid' ),
	]
);

// header info section 
function kindaid_header_info_section(){
    new \Kirki\Section(
	'kindaid_header_info_section',
	[
		'title'       => esc_html__( 'Header Info', 'kindaid' ),
		'description' => esc_html__( 'Here header information', 'kindaid' ),
		'panel'       => 'kindaid_panel',
		'priority'    => 160,
	]
    );

    new \Kirki\Field\Select(
        [
            'settings'    => 'header-global',
            'label'       => esc_html__( 'Select Your Default Header', 'kindaid' ),
            'section'     => 'kindaid_header_info_section',
            'default'     => 'header-global-1',
            'placeholder' => esc_html__( 'Choose an option', 'kindaid' ),
            'choices'     => [
                'header-global-1' => esc_html__( 'Header One', 'kindaid' ),
                'header-global-2' => esc_html__( 'Header Two', 'kindaid' ),
                'header-global-3' => esc_html__( 'Header Three', 'kindaid' ),
            ],
        ]
    );


    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'header_right_switch',
            'label'       => esc_html__( 'Header Right Info switch', 'kindaid' ),
            'description' => esc_html__( 'Header Right switch', 'kindaid' ),
            'section'     => 'kindaid_header_info_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'kindaid' ),
                'off' => esc_html__( 'Disable', 'kindaid' ),
            ],
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'button_text',
            'label'    => esc_html__( 'Button Text', 'kindaid' ),
            'section'  => 'kindaid_header_info_section',
            'default'  => esc_html__( 'Donate Now', 'kindaid' ),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'button_url',
            'label'    => esc_html__( 'Button URL', 'kindaid' ),
            'section'  => 'kindaid_header_info_section',
            'default'  => esc_html__( '#', 'kindaid' ),
            'priority' => 10,
        ]
    );
}
kindaid_header_info_section();

// header social section 
function kindaid_header_social_kirki(){
    new \Kirki\Section(
	'header_social_section',
    [
        'title'       => esc_html__( 'Header Social', 'kindaid' ),
        'description' => esc_html__( 'Here header logo information', 'kindaid' ),
        'panel'       => 'kindaid_panel',
        'priority'    => 160,
    ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'fb_url',
            'label'    => esc_html__( 'Facebook URL ', 'kindaid' ),
            'section'  => 'header_social_section',
            'default'  => esc_html__( '#', 'kindaid' ),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'tw_url',
            'label'    => esc_html__( 'Twitter URL ', 'kindaid' ),
            'section'  => 'header_social_section',
            'default'  => esc_html__( '#', 'kindaid' ),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'inst_url',
            'label'    => esc_html__( 'Instagram URL ', 'kindaid' ),
            'section'  => 'header_social_section',
            'default'  => esc_html__( '#', 'kindaid' ),
            'priority' => 10,
        ]
    );

}
kindaid_header_social_kirki();


// header logo section 
function kindaid_header_logo_kirki(){
    new \Kirki\Section(
	'header_logo_section',
    [
        'title'       => esc_html__( 'Header Logo', 'kindaid' ),
        'description' => esc_html__( 'Here header logo information', 'kindaid' ),
        'panel'       => 'kindaid_panel',
        'priority'    => 160,
    ]
    );
    new \Kirki\Field\Image(
        [
            'settings'    => 'logo',
            'label'       => esc_html__( 'Main Logo', 'kindaid' ),
            'description' => esc_html__( 'The saved value will be the URL.', 'kindaid' ),
            'section'     => 'header_logo_section',
            'default'     => get_template_directory_uri().'/assets/img/logo/logo.png',
        ]
    );
    new \Kirki\Field\Image(
        [
            'settings'    => 'logo-transparent',
            'label'       => esc_html__( 'Transparent Logo', 'kindaid' ),
            'description' => esc_html__( 'The saved value will be the URL.', 'kindaid' ),
            'section'     => 'header_logo_section',
            'default'     => get_template_directory_uri().'/assets/img/logo/logo-yellow.png',
        ]
    );
}
kindaid_header_logo_kirki();

// header offcanvas section 
function kindaid_header_offcanvas_kirki(){
    new \Kirki\Section(
	'header_offcanvas_section',
    [
        'title'       => esc_html__( 'Offcanvas', 'kindaid' ),
        'description' => esc_html__( 'Here header logo information', 'kindaid' ),
        'panel'       => 'kindaid_panel',
        'priority'    => 160,
    ]
    );
    new \Kirki\Field\Image(
        [
            'settings'    => 'offcanvas_logo',
            'label'       => esc_html__( 'Offcanvas Logo', 'kindaid' ),
            'description' => esc_html__( 'The saved value will be the URL.', 'kindaid' ),
            'section'     => 'header_offcanvas_section',
            'default'     => get_template_directory_uri().'/assets/img/logo/logo.png',
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'offcanvas_title',
            'label'    => esc_html__( 'Offcanvas Title', 'kindaid' ),
            'section'  => 'header_offcanvas_section',
            'default'  => esc_html__( 'Hello There!', 'kindaid' ),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Textarea(
        [
            'settings' => 'offcanvas_desc',
            'label'    => esc_html__( 'Offcanvas Description', 'kindaid' ),
            'section'  => 'header_offcanvas_section',
            'default'  => esc_html__( 'Lorem ipsum dolor sit amet, consect etur adipiscing elit.', 'kindaid' ),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Repeater(
        [
            'settings' => 'offcanvas_gallery',
            'label'    => esc_html__( 'Offcanvas Gallery Item', 'kindaid' ),
            'section'  => 'header_offcanvas_section',
            'priority' => 10,
            'fields'   => [
                'offcanvas_image'   => [
                    'type'        => 'image',
                    'label'       => esc_html__( 'Offcanvas Image', 'kindaid' ),
                    'description' => esc_html__( 'Offcanvas Image here', 'kindaid' ),
                    'default'     => '',
                ],
            ],
        ]
    );

    new \Kirki\Field\Repeater(
        [
            'settings' => 'offcanvas_info',
            'label'    => esc_html__( 'Offcanvas Info Item', 'kindaid' ),
            'section'  => 'header_offcanvas_section',
            'priority' => 10,
            'fields'   => [
                'offcanvas_info_name'   => [
                    'type'        => 'text',
                    'label'       => esc_html__( 'Offcanvas Info Item', 'kindaid' ),
                    'description' => esc_html__( 'Offcanvas Info Content', 'kindaid' ),
                    'default'     => '',
                ],
                'offcanvas_info_url'   => [
                    'type'        => 'text',
                    'label'       => esc_html__( 'Offcanvas info URL', 'kindaid' ),
                    'description' => esc_html__( 'Phone or Email', 'kindaid' ),
                    'default'     => '',
                ],
            ],
        ]
    );


}
kindaid_header_offcanvas_kirki();

// 404 section 
function kindaid_breadcrumb_section_kirki(){
    new \Kirki\Section(
	'breadcrumb_section',
    [
        'title'       => esc_html__( 'Breadcrumb', 'kindaid' ),
        'description' => esc_html__( 'Here Breadcrumb settings will place.', 'kindaid' ),
        'panel'       => 'kindaid_panel',
        'priority'    => 160,
    ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'breadcrumb_switch',
            'label'       => esc_html__( 'Breadcrumb Switch', 'kindaid' ),
            'description' => esc_html__( 'Breadcrumb On/Off switch', 'kindaid' ),
            'section'     => 'breadcrumb_section',
            'default'     => 'on',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'kindaid' ),
                'off' => esc_html__( 'Disable', 'kindaid' ),
            ],
        ]
    );

}
kindaid_breadcrumb_section_kirki();


// blog section 
function kindaid_blog_section_kirki(){
    new \Kirki\Section(
	'blog_section',
    [
        'title'       => esc_html__( 'Blog', 'kindaid' ),
        'description' => esc_html__( 'Here blog settings will be place.', 'kindaid' ),
        'panel'       => 'kindaid_panel',
        'priority'    => 160,
    ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'blog_cat_switch',
            'label'       => esc_html__( 'Blog Category Switch', 'kindaid' ),
            'description' => esc_html__( 'Blog Category switch', 'kindaid' ),
            'section'     => 'blog_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'kindaid' ),
                'off' => esc_html__( 'Disable', 'kindaid' ),
            ],
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'blog_meta_author_switch',
            'label'       => esc_html__( 'Blog Meta Author On/Off', 'kindaid' ),
            'description' => esc_html__( 'Blog Meta Author switch', 'kindaid' ),
            'section'     => 'blog_section',
            'default'     => 'on',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'kindaid' ),
                'off' => esc_html__( 'Disable', 'kindaid' ),
            ],
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'blog_meta_date_switch',
            'label'       => esc_html__( 'Blog Meta Date On/Off', 'kindaid' ),
            'description' => esc_html__( 'Blog Meta Date switch', 'kindaid' ),
            'section'     => 'blog_section',
            'default'     => 'on',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'kindaid' ),
                'off' => esc_html__( 'Disable', 'kindaid' ),
            ],
        ]
    );
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'blog_meta_comment_switch',
            'label'       => esc_html__( 'Blog Meta Comment On/Off', 'kindaid' ),
            'description' => esc_html__( 'Blog Meta Comment switch', 'kindaid' ),
            'section'     => 'blog_section',
            'default'     => 'on',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'kindaid' ),
                'off' => esc_html__( 'Disable', 'kindaid' ),
            ],
        ]
    );


    new \Kirki\Field\Text(
        [
            'settings' => 'blog_btn_text',
            'label'    => esc_html__( 'Blog Button', 'kindaid' ),
            'section'  => 'blog_section',
            'default'  => esc_html__( 'Read More', 'kindaid' ),
            'priority' => 10,
        ]
    );

}
kindaid_blog_section_kirki();

// header footer section 
function kindaid_footer_section_kirki(){
    new \Kirki\Section(
	'footer_section',
    [
        'title'       => esc_html__( 'Footer', 'kindaid' ),
        'description' => esc_html__( 'Here footer settings will place.', 'kindaid' ),
        'panel'       => 'kindaid_panel',
        'priority'    => 160,
    ]
    );

    new \Kirki\Field\Select(
        [
            'settings'    => 'footer-global',
            'label'       => esc_html__( 'Select Your Default Footer', 'kindaid' ),
            'section'     => 'footer_section',
            'default'     => 'footer-global-1',
            'placeholder' => esc_html__( 'Choose an option', 'kindaid' ),
            'choices'     => [
                'footer-global-1' => esc_html__( 'Footer One', 'kindaid' ),
                'footer-global-2' => esc_html__( 'Footer Two', 'kindaid' ),
            ],
        ]
    );

    new \Kirki\Field\Image(
        [
            'settings'    => 'footer_bg_image',
            'label'       => esc_html__( 'Footer BG Image', 'kindaid' ),
            'description' => esc_html__( 'Footer bg image will be place', 'kindaid' ),
            'section'     => 'footer_section',
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'footer_copyright',
            'label'    => esc_html__( 'Copyright Text', 'kindaid' ),
            'section'  => 'footer_section',
            'default'  => esc_html__( '© 2026 Charity. is Proudly Powered by Agratri', 'kindaid' ),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'back_to_top_switch',
            'label'       => esc_html__( 'Back to Top Switch', 'kindaid' ),
            'description' => esc_html__( 'Back to Top On/Off switch', 'kindaid' ),
            'section'     => 'footer_section',
            'default'     => 'on',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'kindaid' ),
                'off' => esc_html__( 'Disable', 'kindaid' ),
            ],
        ]
    );


}
kindaid_footer_section_kirki();


// 404 section 
function kindaid_error_section_kirki(){
    new \Kirki\Section(
	'error_section',
    [
        'title'       => esc_html__( '404 Error', 'kindaid' ),
        'description' => esc_html__( 'Here 404 page settings will place.', 'kindaid' ),
        'panel'       => 'kindaid_panel',
        'priority'    => 160,
    ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'error_text',
            'label'    => esc_html__( '404 Text', 'kindaid' ),
            'section'  => 'error_section',
            'default'  => esc_html__( '404', 'kindaid' ),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'error_subtitle',
            'label'    => esc_html__( '404 Sub Title', 'kindaid' ),
            'section'  => 'error_section',
            'default'  => esc_html__( 'Oops! Page not found', 'kindaid' ),
            'priority' => 10,
        ]
    );
    new \Kirki\Field\Textarea(
        [
            'settings' => 'error_content',
            'label'    => esc_html__( '404 Content', 'kindaid' ),
            'section'  => 'error_section',
            'default'  => esc_html__( 'Whoops, this is embarassing. Looks like the page you were looking for was not found.', 'kindaid' ),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'error_btn_text',
            'label'    => esc_html__( '404 Button Text', 'kindaid' ),
            'section'  => 'error_section',
            'default'  => esc_html__( 'Back To Home', 'kindaid' ),
            'priority' => 10,
        ]
    );

}
kindaid_error_section_kirki();

// product section 
function kindaid_product_section_kirki(){
    new \Kirki\Section(
	'product_section',
    [
        'title'       => esc_html__( 'Product', 'kindaid' ),
        'description' => esc_html__( 'Here product settings will place.', 'kindaid' ),
        'panel'       => 'kindaid_panel',
        'priority'    => 160,
    ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'product_social_switch',
            'label'       => esc_html__( 'Product Social Switch', 'kindaid' ),
            'description' => esc_html__( 'Product Socia On/Off switch', 'kindaid' ),
            'section'     => 'product_section',
            'default'     => 'on',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'kindaid' ),
                'off' => esc_html__( 'Disable', 'kindaid' ),
            ],
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'payment_text',
            'label'    => esc_html__( 'Payment Text', 'kindaid' ),
            'section'  => 'product_section',
            'default'  => esc_html__( 'Guaranteed safe & secure checkout', 'kindaid' ),
            'priority' => 10,
        ]
    );


    new \Kirki\Field\Image(
        [
            'settings'    => 'payment_image',
            'label'       => esc_html__( 'Payment Image', 'kindaid' ),
            'description' => esc_html__( 'Payment image will be place', 'kindaid' ),
            'section'     => 'product_section',
        ]
    );

}
kindaid_product_section_kirki();

// product section 
function kindaid_preloader_section_kirki(){
    new \Kirki\Section(
	'preloader_section',
    [
        'title'       => esc_html__( 'Product', 'kindaid' ),
        'description' => esc_html__( 'Here product settings will place.', 'kindaid' ),
        'panel'       => 'kindaid_panel',
        'priority'    => 160,
    ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'preloader_switch',
            'label'       => esc_html__( 'Preloader Switch', 'kindaid' ),
            'description' => esc_html__( 'Preloader On/Off switch', 'kindaid' ),
            'section'     => 'preloader_section',
            'default'     => 'on',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'kindaid' ),
                'off' => esc_html__( 'Disable', 'kindaid' ),
            ],
        ]
    );

}
kindaid_preloader_section_kirki();