<?php

add_theme_support( 'post-thumbnails' );
add_theme_support( 'custom-logo' );

add_image_size( 'home-carousel', 590, 300, true );

function cn_excerpt_length( $length ) {
    return 30;
}
add_filter( 'excerpt_length', 'cn_excerpt_length' );

require 'lib/include.php';