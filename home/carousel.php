<?php
$carousel_query = CN_PostSections::get_carousel_query();
?>
<div class="m-home-carousel">
	<div class="items">
		<?php while ( $carousel_query->have_posts() ): $carousel_query->the_post(); ?>
			<div class="item">
				<div class="thumb">THUMB</div>
				<h3 class="title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
			</div>
		<?php endwhile ?>
	</div>
</div>