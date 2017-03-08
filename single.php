<?php global $page ?>
<?php get_header( 'single' ); ?>

<div class="m-single">
	<div class="wrap">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php $thumb_id = 1 == $page ? get_post_thumbnail_id() : false ?>
			<?php $thumb = $thumb_id ? cn_get_amp_image( $thumb_id, 'amp-featured', true ) : "" ?>
			<?php $caption = $thumb_id ? get_post_field( 'post_excerpt', $thumb_id ) : "" ?>
			<h1 class="title"><?php the_title() ?></h1>

			<?php if ( $thumb ) : ?>
				<div class="thumbnail"><?php echo $thumb ?></div>
				<?php if ( $caption ) : ?>
					<div class="header-caption"><?php echo wp_kses_post( $caption ) ?></div>
				<?php endif ?>
			<?php endif ?>

			<div class="social">
				<a target="_blank" href="<?php cn_the_facebook_share_url() ?>" class="social-icon facebook"><amp-img src="<?php echo get_template_directory_uri() ?>/assets/facebook-icon.png" width="40" height="40"></a>
				<a target="_blank" href="<?php cn_the_twitter_share_url() ?>" class="social-icon twitter"><amp-img src="<?php echo get_template_directory_uri() ?>/assets/twitter-icon.png" width="40" height="40"></a>
			</div>

			<div class="content">
				<?php the_content() ?>
				<div class="pagination">
					<?php wp_link_pages( array(
						'before' => '',
						'next_or_number' => 'next'
					) ) ?>
				</div>
			</div>

			<div class="byline">
				<span class="date">Published <?php the_date() ?></span> in <span class="categories"><?php the_category( ', ' ) ?></span>
				<div class="author">By <?php the_author_posts_link() ?></div>
				<div class="site-title"><a href="<?php echo site_url() ?>"><?php bloginfo( 'name' ) ?></a></div>
			</div>
		<?php endwhile; ?>
	</div>
</div>

<?php get_footer( 'single' ); ?>