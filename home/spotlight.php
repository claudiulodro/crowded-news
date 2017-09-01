<?php
$spotlight_query = CN_PostSections::get_spotlight_query();
$count = 0;
?>
<div class="m-home-spotlight">
	<div class="items-container">
		<div class="items main">
			<?php while ( $spotlight_query->have_posts() ): $spotlight_query->the_post(); ?>
				<div class="item">
					<h3 class="title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
					<h4 class="date"><a href="<?php the_permalink() ?>"><?php echo get_the_date() ?></a></h4>
					<p class="excerpt"><a href="<?php the_permalink() ?>"><?php the_excerpt() ?></a></p>
				</div>
				<?php ++$count ?>
				<?php if ( $count > 3 ): break; endif; ?>
			<?php endwhile ?>
		</div>
		<div class="items secondary">
			<?php while ( $spotlight_query->have_posts() ): $spotlight_query->the_post(); ?>
				<?php ++$count ?>
				<div class="item">
					<h4 class="title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
				</div>
			<?php endwhile ?>
		</div>
	</div>
</div>
<?php wp_reset_postdata() ?>