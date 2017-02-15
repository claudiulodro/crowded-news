<?php $categories = CN_CategorySections::get_homepage_categories() ?>

<div class="m-home-homepage-categories">
	<?php foreach( $categories as $category ): ?>
		<?php include locate_template('home/category.php') ?>
	<?php endforeach ?>
</div>