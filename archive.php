<?php get_header(); ?>

<div class="m-archive archive">
	<h2 class="heading">
		<?php the_archive_title() ?>
	</h2>

	<div class="results">
		<ul>
			<?php while ( have_posts() ) : the_post(); ?>
				<li>
					<a href="<?php the_permalink() ?>"><?php the_title() ?> &mdash; <?php echo get_the_date() ?></a>
				</li>
			<?php endwhile ?>
		</ul>
	</div>

	<div class="pagination">NEXT PREV</div>
</div>

<?php get_footer(); ?>
