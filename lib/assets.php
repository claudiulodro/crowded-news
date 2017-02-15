<?php

function cn_enqueue_styles() {
	wp_enqueue_style(
		'crowded-news',
		get_template_directory_uri().'/assets/style.css',
		array(),
		rand()
	);
}
add_action( 'wp_enqueue_scripts', 'cn_enqueue_styles' );