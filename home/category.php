<?php
$args = array( 
	'posts_per_page' => 5,
	'cat' => $category->term_id
);

$category_query = new WP_Query( $args );
?>
<div class="m-home-category">
	<h3 class="title"><a href="<?php echo get_category_link( $category->term_id ) ?>"><?php echo esc_attr( $category->name ) ?></a></h3>
	<?php while ( $category_query->have_posts() ): $category_query->the_post(); ?>
		<div class="item">
			<div class="thumbnail">
				<a href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'home-category' ) ?></a>
			</div>
			<div class="title">
				<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
			</div>
		</div>
	<?php endwhile ?>
	<a href="<?php echo get_category_link( $category->term_id ) ?>" class="more">View more</a>
</div>
<?php wp_reset_postdata() ?>