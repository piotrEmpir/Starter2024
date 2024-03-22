
<?php

// Step 1: Define Callback Function
function article_grid_filter_endpoint_callback( $data ) {
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
                'permalink' => get_the_permalink(),
                'thumbnail' => get_the_post_thumbnail_url( get_the_ID(), 'image-phone' ),
                'excerpt' => get_the_excerpt(),

            );
        }
        wp_reset_postdata(); // Restore global post data
    }

    // Return the response
    return rest_ensure_response( $response );
}

// Step 2: Register Custom Route
function register_article_grid_filter_rest_endpoint() {
    register_rest_route(
        'wbdv/v1', // Namespace
        '/article-filter/', // Route
        array(
            'methods' => 'GET', // HTTP methods
            'callback' => 'article_grid_filter_endpoint_callback', // Callback function
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
add_action( 'rest_api_init', 'register_article_grid_filter_rest_endpoint' );