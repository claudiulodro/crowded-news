<?php
$args = array( 
	'posts_per_page' => 5,
	'cat' => $category->term_id
);

$category_query = new WP_Query( $args );
?>
<div class="m-home-category">
	<h3 class="title"><?php echo esc_attr( $category->name ) ?></h3>
	<?php if ( $category_query->have_posts() ): $category_query->the_post(); ?>
		<div class="featured-item">
			<div class="thumbnail">
				<a href="<?php the_permalink() ?>">THUMB</a>
			</div>
			<div class="title">
				<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
			</div>
		</div>
	<?php endif ?>
	<div class="items">
		<?php while( $category_query->have_posts() ): $category_query->the_post(); ?>
			<div class="item">
				<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
			</div>
		<?php endwhile ?>
	</div>
</div>
<?php wp_reset_postdata() ?>