<?php get_header(); ?>

<div class="m-archive home">
	<div class="sidebar left">
		<?php get_template_part( 'sidebar/archive-left' ) ?>
	</div>

	<div class="container">
		<div class="section">
			<?php get_template_part( 'home/carousel' ) ?>
			<?php get_template_part( 'home/featured' ) ?>
		</div>
		<div class="section">
			<div class="wrap">
				<?php get_template_part( 'home/spotlight' ) ?>
				<?php get_template_part( 'home/carousel-row' ) ?>
				<?php get_template_part( 'home/carousel-row' ) ?>
				<?php get_template_part( 'home/category' ) ?>
			</div>
			<div class="sidebar right">
				<?php get_template_part( 'sidebar/archive-right' ) ?>
			</div>
		</div>

	</div>
</div>

<?php get_footer(); ?>
