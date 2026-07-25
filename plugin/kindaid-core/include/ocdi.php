<?php 

/**
 * OCDI Demo Import Setup
 */
function kindaid_ocdi_import_files() {

    return array(

        array(
            'import_file_name'             => 'Kindaid Demo',
            'local_import_file'            => trailingslashit( get_template_directory() ) . 'sample-data/content.xml',

            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'sample-data/widgets.wie',

            'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'sample-data/customizer.dat',

            'preview_url'                  => 'https://wp.aqlova.com/kindaid/',

            'import_notice'                => __( 'Import process may take 2-5 minutes. Please wait until completed.', 'pure' ),
        ),

    );
}

add_filter( 'ocdi/import_files', 'kindaid_ocdi_import_files' );

/**
 * OCDI After Import Setup
 */
function kindaid_ocdi_after_import_setup() {

    // Assign menus
    $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations', array(
        'main-menu' => $main_menu->term_id,
    ) );

    // Assign front page and posts page
    $front_page = get_page_by_title( 'Home' );
    $blog_page  = get_page_by_title( 'Blog' );

    update_option( 'show_on_front', 'page' );

    update_option( 'page_on_front', $front_page->ID );

    update_option( 'page_for_posts', $blog_page->ID );
}

add_action( 'ocdi/after_import', 'kindaid_ocdi_after_import_setup' );

add_filter( 'ocdi/plugin_page_setup', function( $default_settings ) {

    $default_settings['parent_slug'] = 'themes.php';

    $default_settings['page_title']  = esc_html__( 'Theme Demo Import' , 'pure' );

    $default_settings['menu_title']  = esc_html__( 'Kindaid Demo Import' , 'pure' );

    $default_settings['capability']  = 'import';

    $default_settings['menu_slug']   = 'pure-demo-import';

    return $default_settings;
});