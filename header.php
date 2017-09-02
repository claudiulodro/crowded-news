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
			<div class="tagline">
				<?php echo esc_html( get_bloginfo( 'description' ) ) ?>
			</div>
			<div class="meta">
				<div class="search">
					<?php get_search_form(); ?>
				</div>
			</div>
			<div class="social">
				<?php if ( $fb_url = CN_Settings::get_facebook_page_url() ): ?>
					<a target="_blank" href="<?php echo $fb_url ?>" class="social-icon facebook">
						<i class="fa fa-facebook-square"></i>
					</a>
				<?php endif ?>

				<?php if ( $twitter_url = CN_Settings::get_twitter_url() ): ?>
					<a target="_blank" href="<?php echo $twitter_url ?>" class="social-icon twitter">
						<i class="fa fa-twitter-square"></i>
					</a>
				<?php endif ?>

				<a target="_blank" href="<?php echo site_url( '/feed/' ) ?>" class="social-icon rss">
					<i class="fa fa-rss-square"></i>
				</a>
			</div>
		</div>
	</div>