<?php $categories = CN_CategorySections::get_carousel_categories() ?>

<div class="m-home-carousel-categories">
	<?php foreach( $categories as $category ): ?>
		<?php include locate_template('home/carousel-row.php') ?>
	<?php endforeach ?>
</div>