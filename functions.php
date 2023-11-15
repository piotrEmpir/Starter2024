<?php

include 'blocks/blocks.php';

load_theme_textdomain( 'wbdvpl', get_template_directory() . '/languages' );

add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 1000, 9999 );

add_theme_support( 'wp-block-styles' );
add_editor_style( 'style.css' );

if ( function_exists( 'add_image_size' ) ) {
    add_image_size( 'mobile-thumbnail', 480, 200, true );
}

add_theme_support(
    'html5',
    array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    )
);

add_theme_support( 'wp-block-styles' );
add_theme_support( 'align-wide' );
add_theme_support( 'responsive-embeds' );


register_nav_menus( array(
    'primary'   => __( 'Primary Menu', 'wbdvpl' )
) );



//fixed header
function add_slug_body_class( $classes ) {
    $classes[] = 'fixed-header';
    return $classes;
}
//add_filter( 'body_class', 'add_slug_body_class' );


function add_theme_scripts() {

    wp_enqueue_style( 'splide-css', get_template_directory_uri() . '/css/splide-core.min.css',false,'1.0','all');

    wp_enqueue_style( 'theme-fonts', get_template_directory_uri() . '/font/font.css',false,'1.0','all');
    wp_enqueue_style( 'theme', get_template_directory_uri() . '/css/theme.css',false, filemtime(get_theme_file_path('/css/theme.css')) ,'all');

    wp_enqueue_script( 'theme', get_template_directory_uri() . '/js/theme.js', array(), filemtime(get_theme_file_path('/js/theme.js')) , true );

    wp_enqueue_script( 'slide', get_template_directory_uri() . '/js/splide.min.js', array(), filemtime(get_theme_file_path('/js/splide.min.js')) , true );

    //wp_enqueue_script( 'debug', get_template_directory_uri() . '/js/debugcss.js', array(), filemtime(get_theme_file_path('/js/debugcss.js')) , true );
}
add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );

#enqueue scripts and styles for admin
function admin_theme_scripts() {
    wp_enqueue_style( 'theme-fonts', get_template_directory_uri() . '/font/font.css',false,'1.0','all');
    wp_enqueue_style( 'theme-editor', get_template_directory_uri() . '/css/editor.css',false,'1.0','all');

    wp_enqueue_script( 'theme-editor-script', get_template_directory_uri() . '/js/editor.js', array(), filemtime(get_theme_file_path('/js/editor.js')) , true );
}
add_action( 'admin_enqueue_scripts', 'admin_theme_scripts' );



function create_widget( $name, $id, $description ) {

    register_sidebar(array(
        'name' => __($name),
        'id' => $id,
        'description' => __( $description ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h6>',
        'after_title' => '</h6>'
    ));

}



add_action( 'widgets_init', 'wbdvpl_widgets_init' );
function wbdvpl_widgets_init() {
    create_widget( 'Sidebar', 'sidebar', '' );
    create_widget( 'footer 1', 'footer_1', '' );
    create_widget( 'footer 2', 'footer_2', '' );
    create_widget( 'footer 3 ', 'footer_3', '' );
    create_widget( 'footer 4 ', 'footer_4', '' );
    create_widget( 'header', 'header', '' );
}




// function vc_remove_wp_ver_css_js( $src ) {
//     if ( strpos( $src, 'ver=' ) )
//     $src = remove_query_arg( 'ver', $src );
//     return $src;
// }

// add_filter( 'style_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
// add_filter( 'script_loader_src', 'vc_remove_wp_ver_css_js', 9999 );


function author_page_redirect() {
    if ( is_author() ) {
        wp_redirect( home_url() );
    }
}
add_action( 'template_redirect', 'author_page_redirect' );


function action_init() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'template_redirect', 'rest_output_link_header', 11 );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
	remove_action( 'wp_head', 'rest_output_link_wp_head' );
}
add_action( 'init', 'action_init' );



function post_by_id($id){?>

    <article class="post_item">
        <a href="<?php echo get_the_permalink(  $id ); ?>">
            <div class="thumb"><?php echo get_the_post_thumbnail( $id, 'medium' ); ?></div>
            <h3><?php echo get_the_title(  $id ); ?></h3>
        </a>
    </article>

<?php
}