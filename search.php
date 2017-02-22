<?php 

$search_string = isset( $_GET['s'] ) && ! empty( $_GET['s'] ) ? sanitize_text_field( $_GET['s'] ) : "Whatever";

get_header(); ?>

<div class="m-archive archive search">
	<h2 class="heading">
		Search: <?php echo $search_string ?>
	</h2>

	<div class="results">
		<?php if ( have_posts() ) : ?>
			<ul>
				<?php while ( have_posts() ) : the_post(); ?>
					<li>
						<a href="<?php the_permalink() ?>"><?php the_title() ?> &mdash; <?php echo get_the_date() ?></a>
					</li>
				<?php endwhile ?>
			</ul>
		<?php else: ?>
			<span class="nothing-found">Nothing found!</span>
		<?php endif ?>
	</div>

	<div class="pagination"><?php posts_nav_link(); ?></div>
</div>

<?php get_footer(); ?>