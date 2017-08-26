<?php

/**
 * Enqueue the styles and scripts
 **/
function cn_enqueue_assets() {

	?><link  rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC:800|Source+Sans+Pro"><?php
	?><link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/vendor/font-awesome/css/font-awesome.min.css"><?php

	wp_enqueue_style(
		'crowded-news',
		get_template_directory_uri().'/assets/style.css',
		array(),
		cn_get_version()
	);
	wp_enqueue_style(
		'jquery-unslider',
		get_template_directory_uri().'/assets/vendor/unslider.css',
		array(),
		1
	);
	wp_enqueue_style(
		'jquery-unslider-dots',
		get_template_directory_uri().'/assets/vendor/unslider-dots.css',
		array(),
		1
	);

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 
		'jquery-unslider',
		get_template_directory_uri().'/assets/vendor/unslider-min.js',
		array( 'jquery' ),
		1
	);
	wp_enqueue_script(
		'cn-zazz',
		get_template_directory_uri().'/assets/zazz.js',
		array( 'jquery', 'jquery-unslider' ),
		cn_get_version(),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'cn_enqueue_assets' );