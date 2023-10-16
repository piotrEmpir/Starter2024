<?php

add_action( 'init', 'register_acf_blocks', 5 );
function register_acf_blocks(){
    register_block_type( __DIR__ . '/logo-slider' );
    register_block_type( __DIR__ . '/article-slider');
    register_block_type( __DIR__ . '/article-grid' );
}
