<?php

add_action( 'init', 'register_acf_blocks', 5 );
function register_acf_blocks(){





register_block_type( __DIR__ . '/image-text' ); 
register_block_type( __DIR__ . '/accordion' ); 
register_block_type( __DIR__ . '/google-map' ); 
register_block_type( __DIR__ . '/article-list' ); 


    register_block_type( __DIR__ . '/logo-slider' );
    register_block_type( __DIR__ . '/article-slider');
    register_block_type( __DIR__ . '/article-grid' );
}
