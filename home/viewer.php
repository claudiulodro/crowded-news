<div class="m-viewer">
	<div class="links">
		<?php while( have_posts() ): the_post() ?>
			<a href="<?php the_permalink() ?>" class="link"><?php the_title() ?></a>
		<?php endwhile ?>
	</div>
	<div class="viewer">
		<iframe class="viewscreen" width="800" height="800" src=""></iframe>
	</div>
</div>