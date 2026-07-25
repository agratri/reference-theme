<?php
    
    function kindaid_metafields( $meta_boxes ) {
        $meta_boxes[] = array(
            'metabox_id'       => 'kindaid-metafields',
            'title'    => esc_html__( 'Page Options', 'kindaid' ),
            'post_type'=> 'page', // page, custom post type name
            'context'  => 'normal',
            'priority' => 'core',
            'fields'   => array(
                array(
                    'label' => 'Breadcrumb On/Off',
                    'id'    => "breadcrumb_page_switch",
                    'type'  => 'switch', // specify the type field
                    'placeholder' => '',
                    'default' => 'on', // do not remove default key
                ),
                array(
                    'label'           => esc_html__('Header Layout', 'kindaid'),
                    'id'              => "header-from-page",
                    'type'            => 'select',
                    'options'         => array(
                        'blank-header' => esc_html__('Select Your header','kindaid'),
                        'header-page-1' => esc_html__('Header One','kindaid'),
                        'header-page-2' => esc_html__('Header Two','kindaid'),
                        'header-page-3' => esc_html__('Header Three','kindaid'),
                    ),
                    'placeholder'     => esc_html__('Select an item','kindaid'),
                    'conditional' => array(),
                    'default' => '',
                    'multiple' => false,
                ),
                array(
                    'label'           => esc_html__('Footer Layout', 'kindaid'),
                    'id'              => "footer-from-page",
                    'type'            => 'select',
                    'options'         => array(
                        'blank-header' => esc_html__('Select Your Footer','kindaid'),
                        'footer-page-1' => esc_html__('Footer One','kindaid'),
                        'footer-page-2' => esc_html__('Footer Two','kindaid'),
                    ),
                    'placeholder'     => esc_html__('Select an item','kindaid'),
                    'conditional' => array(),
                    'default' => '',
                    'multiple' => false,
                )
            ),
        );

        $meta_boxes[] = array(
            'metabox_id'       => 'post-format-video-metafields',
            'title'    => esc_html__( 'Post Video URL', 'kindaid' ),
            'post_type'=> 'post',
            'context'  => 'normal',
            'priority' => 'core',
            'fields'   => array(
                array(
                    'label' => esc_html__( 'Video Format', 'kindaid' ),
                    'id'    => "kindaid-post-format-video",
                    'type'  => 'text',
                    'placeholder' => esc_html__( 'Video url here', 'kindaid' ),
                    'default'     => '',
                    'conditional' => array()
                ),
            ),
            'post_format' => 'video' // if u want to bind with post formats
        );

        $meta_boxes[] = array(
            'metabox_id'       => 'post-format-audio-metafields',
            'title'    => esc_html__( 'Post Video URL', 'kindaid' ),
            'post_type'=> 'post',
            'context'  => 'normal',
            'priority' => 'core',
            'fields'   => array(
                array(
                    'label' => esc_html__( 'Audio Format', 'kindaid' ),
                    'id'    => "kindaid-post-format-audio",
                    'type'  => 'text',
                    'placeholder' => esc_html__( 'Audio url here', 'kindaid' ),
                    'default'     => '',
                    'conditional' => array()
                ),
            ),
            'post_format' => 'audio' // if u want to bind with post formats
        );


        $meta_boxes[] = array(
            'metabox_id'       => 'post-format-gallery-metafields',
            'title'    => esc_html__( 'Post Meta Gallery', 'kindaid' ),
            'post_type'=> 'post',
            'context'  => 'normal',
            'priority' => 'core',
            'fields'   => array(
                array(

                    'label'    => esc_html__( 'Post Gallery Images', 'kindaid' ),
                    'id'      => "kindaid-post-format-gallery",
                    'type'    => 'gallery',
                    'default' => '',
                    'conditional' => array(),
                ),
            ),
            'post_format' => 'gallery' // if u want to bind with post formats
        );


        return $meta_boxes;
    }

    add_filter( 'tp_meta_boxes', 'kindaid_metafields' );


    // kindaid_user_metas
    function kindaid_user_metas(){
        $meta = array(
            'id' => 'kindaid_user_meta_sec',
            'label' => esc_html__( 'User Social Information', 'kindaid' ),
            'fields' => array(
                array(
                    'id' => 'kindaid_facebook',
                    'label' => esc_html__( 'Facebook URL', 'kindaid' ),
                    'type' => 'text',
                    'default' => '',
                    'placeholder' => esc_html__( 'Facebook URL...', 'kindaid' ),
                    'show_in_admin_table' => 1
                ),
                array(
                    'id' => 'kindaid_linkedin',
                    'label' => esc_html__( 'Linkedin URL', 'kindaid' ),
                    'type' => 'text',
                    'default' => '',
                    'placeholder' => esc_html__( 'Linkedin URL...', 'kindaid' ),
                    'show_in_admin_table' => 1
                ),
                array(
                    'id' => 'kindaid_instagram',
                    'label' => esc_html__( 'Instagram URL', 'kindaid' ),
                    'type' => 'text',
                    'default' => '',
                    'placeholder' => esc_html__( 'Instagram URL...', 'kindaid' ),
                    'show_in_admin_table' => 1
                ),
                array(
                    'id' => 'kindaid_youtube',
                    'label' =>  esc_html__( 'Youtube URL', 'kindaid' ),
                    'type' => 'text',
                    'default' => '',
                    'placeholder' => esc_html__( 'Youtube URL...', 'kindaid' ),
                    'show_in_admin_table' => 1
                ),
            )
        );

        return $meta;
    }
    add_filter('tp_user_meta', 'kindaid_user_metas');


?>