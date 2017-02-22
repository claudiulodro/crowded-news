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

<div class="site">
	<div class="m-nav">

		<div class="m-nav--main">
			<div class="logo">
				<?php the_custom_logo() ?>
			</div>
			<div class="meta">
				<div class="search">
					<?php get_search_form(); ?>
				</div>
			</div>
			<div class="social">
				<a href="#" class="social-icon facebook">
					<i class="fa fa-facebook-square"></i>
				</a>
				<a href="#" class="social-icon twitter">
					<i class="fa fa-twitter-square"></i>
				</a>
				<a href="#" class="social-icon rss">
					<i class="fa fa-rss-square"></i>
				</a>
			</div>
		</div>

		<?php if ( is_home() ): ?>
			<div class="m-nav--latest-news h-latest-news">
				<div class="heading">Latest News</div>
				<div class="items h-unslider">
					<ul>
						<?php while( have_posts() ): the_post(); ?>
							<li><a class="item" href="<?php the_permalink() ?>"><?php the_title() ?></a></li>
						<?php endwhile ?>
					</ul>
				</div>
				<div class="date">
					<?php echo date( 'l, F j Y' ) ?>
				</div>
			</div>
		<?php endif ?>

	</div>