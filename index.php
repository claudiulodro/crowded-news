<?php get_header(); ?>

<div class="m-archive home">
	<div class="container">
		<div class="section">
			<div class="wrap">
				<?php get_template_part( 'home/viewer' ) ?>
				<?php get_template_part( 'home/carousel-rows' ) ?>
				<?php get_template_part( 'home/categories' ) ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
