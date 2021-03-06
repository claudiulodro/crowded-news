<!doctype html>
<html ⚡>
<head>
	<meta charset="utf-8">
	<link rel="canonical" href="<?php echo the_permalink() ?>">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
	<link  rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC:800|Source+Sans+Pro">
  	<style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
	<script async src="https://cdn.ampproject.org/v0.js"></script>
	<script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>	
	<style amp-custom>
		<?php require get_template_directory().'/assets/amp-style.css' ?>
	</style>
	<?php do_action( 'cn_amp_head' ) ?>
</head>
 <body>
 	<?php do_action( 'cn_amp_body' ) ?>

 	<div class="site">
 		<?php if ( ! cn_is_viewscreen() ): ?>
		 	<div class="m-nav">
		 		<a href="<?php echo site_url() ?>">
		 			<span class="logo">
		 				<?php cn_the_amp_image( get_theme_mod( 'custom_logo' ), 'amp-logo' ) ?>
		 			</span>
		 		</a>
		 		<div class="tagline">
					<?php echo esc_html( get_bloginfo( 'description' ) ) ?>
				</div>
		 	</div>
	 	<?php endif ?>
