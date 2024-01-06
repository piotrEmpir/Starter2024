<?php

add_action( 'init', 'register_acf_blocks', 5 );
function register_acf_blocks(){





register_block_type( __DIR__ . '/locations' ); 
register_block_type( __DIR__ . '/contact-card' ); 
register_block_type( __DIR__ . '/intro-image' ); 
register_block_type( __DIR__ . '/testimonials' ); 
register_block_type( __DIR__ . '/logo-grid' ); 
register_block_type( __DIR__ . '/employees' );
register_block_type( __DIR__ . '/social-media' );
register_block_type( __DIR__ . '/image-text' );
register_block_type( __DIR__ . '/accordion' );
register_block_type( __DIR__ . '/google-map' );
register_block_type( __DIR__ . '/map' );
register_block_type( __DIR__ . '/article-list' );


    register_block_type( __DIR__ . '/logo-slider' );
    register_block_type( __DIR__ . '/article-slider');
    register_block_type( __DIR__ . '/article-grid' );
}
