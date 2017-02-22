<?php
$args = array( 
	'posts_per_page' => 6,
	'cat' => $category->term_id
);

$category_query = new WP_Query( $args );
$carousel_unslider_class = $category_query->found_posts > 3 ? 'h-unslider' : '';
$current = 0;
?>
<div class="m-carousel-row h-carousel-row <?php echo $carousel_unslider_class ?>">
	<h3 class="title"><a href="<?php echo get_category_link( $category->term_id ) ?>"><?php echo esc_attr( $category->name ) ?></a></h3>
	<ul>
		<li>
		<?php while ( $category_query->have_posts() ): $category_query->the_post(); ?>
			<?php if ( 0 != $current && 0 == $current % 3 ): ?>
				</li><li>
			<?php endif ?>
			<div class="featured-item">
				<div class="thumbnail" style="background:url('<?php the_post_thumbnail_url( get_the_ID(), 'home-category-carousel' ) ?>') no-repeat center">
					<a href="<?php the_permalink() ?>"></a>
				</div>
				<div class="title">
					<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
				</div>
			</div>
			<?php ++$current ?>
		<?php endwhile ?>
		</li>
	</ul>
</div>
<?php wp_reset_postdata() ?>