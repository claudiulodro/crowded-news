<?php

get_header(); ?>

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php the_title(); ?>
				<?php the_permalink(); ?>
			<?php endwhile; ?>

		<?php else : ?>

			Nothing found!

		<?php endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>