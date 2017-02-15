<?php
$featured_query = CN_PostSections::get_featured_query();
?>
<div class="m-home-featured">
	<div class="items">
		<?php while ( $featured_query->have_posts() ): $featured_query->the_post(); ?>
			<div class="item">
				<h3 class="title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
				<h4 class="date"><a href="<?php the_permalink() ?>"><?php the_date() ?></a></h4>
				<p class="excerpt"><a href="<?php the_permalink() ?>"><?php the_excerpt() ?></a></p>
			</div>
		<?php endwhile ?>
	</div>
</div>