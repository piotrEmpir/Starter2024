<?php

include 'blocks/blocks.php';

load_theme_textdomain( 'wbdvpl', get_template_directory() . '/languages' );

add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 1400, 788, true );

add_theme_support( 'wp-block-styles' );
add_editor_style( 'style.css' );

if ( function_exists( 'add_image_size' ) ) {
    add_image_size( 'image-4k', 3840, 2160, true );
    add_image_size( 'image-fullhd', 1920, 1080, true );
    add_image_size( 'image-laptop', 1400, 788, true );
    add_image_size( 'image-tablet', 800, 450, true );
    add_image_size( 'image-phone', 500, 280, true );
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
add_post_type_support( 'page', 'excerpt' );

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

    //wp_enqueue_style( 'splide-css', get_template_directory_uri() . '/css/splide-core.min.css',false,'1.0','all');

    wp_enqueue_style( 'theme-fonts', get_template_directory_uri() . '/font/font.css',false,'1.0','all');
    wp_enqueue_style( 'theme', get_template_directory_uri() . '/css/theme.css',false, filemtime(get_theme_file_path('/css/theme.css')) ,'all');

    wp_enqueue_script( 'theme', get_template_directory_uri() . '/js/theme.js', array(), filemtime(get_theme_file_path('/js/theme.js')) , true );

    //wp_enqueue_script( 'slide', get_template_directory_uri() . '/js/splide.min.js', array(), filemtime(get_theme_file_path('/js/splide.min.js')) , true );

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

//splide script
function register_splide_script() {

    wp_register_script( 'splide-js', get_template_directory_uri() . '/js/splide.min.js', array(), filemtime(get_theme_file_path('/js/splide.min.js')) , true );

    wp_register_style( 'splide-css', get_template_directory_uri() . '/css/splide-core.min.css',false,'1.0','all');
}
add_action( 'init', 'register_splide_script' );


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

function my_acf_init() {

    acf_update_setting('google_api_key', get_field( 'google_maps_api_key', 'option' ));
}

add_action('acf/init', 'my_acf_init');

add_filter('acf/load_field/name=post_type', 'acf_load_post_types');

function acf_load_post_types($field)
{
    foreach ( get_post_types( '', 'names' ) as $post_type ) {
       $field['choices'][$post_type] = $post_type;
    }

    // return the field
    return $field;
}




// Step 1: Define Callback Function
function custom_endpoint_callback( $data ) {
    // Retrieve parameters from the request
    $anlass = $data->get_param( 'anlass' );
    $musikstills = $data->get_param( 'musikstills' );
    $regions = $data->get_param( 'regions' );
    $skills = $data->get_param( 'skills' );

    // Set up query arguments based on parameters
    $query_args = array(
        'post_type' => 'artist', // Custom post type
        'posts_per_page' => -1, // Retrieve all posts
        'post_status' => 'publish', // Retrieve only published posts
        'tax_query' => array(
            'relation' => 'AND', // Combine taxonomies with AND relation
        ),
    );

    // Add taxonomy parameters if provided
    if ( $anlass && $anlass !== '0') {
        $query_args['tax_query'][] = array(
            'taxonomy' => 'anlass',
            'field' => 'slug',
            'terms' => $anlass,
        );
    }
    if ( $musikstills && $musikstills !== '0') {
        $query_args['tax_query'][] = array(
            'taxonomy' => 'musikstill',
            'field' => 'slug',
            'terms' => $musikstills,
        );
    }
    if ( $regions && $regions !== '0') {
        $query_args['tax_query'][] = array(
            'taxonomy' => 'region',
            'field' => 'slug',
            'terms' => $regions,
        );
    }
    if ( $skills && $skills !== '0') {
        $query_args['tax_query'][] = array(
            'taxonomy' => 'skill',
            'field' => 'slug',
            'terms' => $skills,
        );
    }

    // Query the database
    $artists = new WP_Query( $query_args );

    // Prepare response data
    $response = array(
        'artists' => array(),
        'query' => $query_args, // Optional: Return query arguments for debugging
    );

    // Populate response with artist data
    if ( $artists->have_posts() ) {
        while ( $artists->have_posts() ) {
            $artists->the_post();
            // You can customize the data returned for each artist
            $response['artists'][] = array(
                'id' => get_the_ID(),
                'title' => get_the_title(),
                // Add more fields as needed
            );
        }
        wp_reset_postdata(); // Restore global post data
    }

    // Return the response
    return rest_ensure_response( $response );
}

// Step 2: Register Custom Route
function register_custom_rest_endpoint() {
    register_rest_route(
        'custom/v1', // Namespace
        '/endpoint/', // Route
        array(
            'methods' => 'GET', // HTTP methods
            'callback' => 'custom_endpoint_callback', // Callback function
            'permission_callback' => '__return_true', // Permission callback
            'args' => array( // Define parameters for the endpoint
                'anlass' => array(
                    'required' => false,
                    'sanitize_callback' => 'sanitize_text_field',
                ),
                'musikstills' => array(
                    'required' => false,
                    'sanitize_callback' => 'sanitize_text_field',
                ),
                'regions' => array(
                    'required' => false,
                    'sanitize_callback' => 'sanitize_text_field',
                ),
                'skills' => array(
                    'required' => false,
                    'sanitize_callback' => 'sanitize_text_field',
                ),
            ),
        )
    );
}
add_action( 'rest_api_init', 'register_custom_rest_endpoint' );