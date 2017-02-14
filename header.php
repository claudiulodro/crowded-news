<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="m-nav">

	<div class="m-nav--main">
		<div class="logo">
			LOGO
		</div>
		<div class="meta">
			<div class="search">
				<input type="text"> [Search]
			</div>
			<div class="links">
				<a href="#">Markets</a>
				<a href="#">Weather</a>
				<a href="#">RSS</a>
				<a href="#">About</a>
			</div>
		</div>
		<div class="social">
			<a href="#" class="social-icon email">
				E
			</a>
			<a href="#" class="social-icon facebook">
				F
			</a>
			<a href="#" class="social-icon twitter">
				T
			</a>
			<a href="#" class="social-icon rss">
				R
			</a>
		</div>
	</div>

	<div class="m-nav--latest-news">
		<div class="heading">Latest News</div>
		<div class="items">
			<a class="item" href="#">Todo latest news</a>
		</div>
		<div class="date">
			<?php echo date( 'l, F j Y' ) ?>
		</div>
	</div>

</div>