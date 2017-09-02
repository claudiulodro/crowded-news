<?php
$args = array( 
	'posts_per_page' => 6,
	'cat' => $category->term_id
);

$category_query = new WP_Query( $args );
?>
<div class="m-carousel-row">
	<h3 class="title"><a href="<?php echo get_category_link( $category->term_id ) ?>"><?php echo esc_attr( $category->name ) ?></a></h3>
	<div class="items">
		<?php while ( $category_query->have_posts() ): $category_query->the_post(); ?>
			<div class="featured-item">
				<div class="thumbnail" <?php if ( has_post_thumbnail() ): ?> style="background:url('<?php the_post_thumbnail_url( get_the_ID(), 'home-category-carousel' ) ?>') no-repeat center" <?php endif ?>>
					<a href="<?php the_permalink() ?>"></a>
				</div>
				<div class="title">
					<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
				</div>
			</div>
		<?php endwhile ?>
	</div>
	<div class="more">
		<a href="<?php echo get_category_link( $category->term_id ) ?>">View more</a>
	</div>
</div>
<?php wp_reset_postdata() ?>
