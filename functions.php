<?php

define( 'CN_VERSION', '2.0.0' );

add_theme_support( 'post-thumbnails' );
add_theme_support( 'custom-logo' );

add_image_size( 'home-carousel', 590, 300, true );
add_image_size( 'home-category-carousel', 370, 160, true );
add_image_size( 'home-category', 60, 60, true );

add_image_size( 'amp-logo', 130, 60, false );
add_image_size( 'amp-featured', 640, 480, true );

register_sidebar( array(
	'name' => 'Homepage',
	'id' => 'cn-homepage',
	'class' => 'm-home-sidebar',
	'before_widget' => '<div class="m-sidebar-widget %2$s" id="%1$s">',
	'after_widget' => '</div>'
) );

function cn_register_nav_menu() {
	register_nav_menu( 'cn-footer-menu', 'Footer' );
}
add_action( 'init', 'cn_register_nav_menu' );

function cn_excerpt_length( $length ) {
    return 30;
}
add_filter( 'excerpt_length', 'cn_excerpt_length' );

function cn_get_version() {
	if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
		return rand();
	}

	return CN_VERSION;
}
require 'lib/include.php';