<?php
$carousel_query = CN_PostSections::get_carousel_query();
?>
<div class="m-home-carousel h-home-carousel">
	<div class="items h-unslider">
		<ul>
			<?php while ( $carousel_query->have_posts() ): $carousel_query->the_post(); ?>
				<li class="item">
					<div class="thumb" style="background:url('<?php the_post_thumbnail_url( get_the_ID(), 'home-carousel' ) ?>') no-repeat center">
						<a href="<?php the_permalink() ?>"></a>
					</div>
					<h3 class="title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
				</li>
			<?php endwhile ?>
		</ul>
	</div>
</div>
<?php wp_reset_postdata() ?>