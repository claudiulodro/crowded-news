<?php
$args = array(
	'smallest' => 11,
	'largest' => 11,
	'format' => 'list'
);
?>

<div class="m-archive-sidebar-right">
	<div class="tag-cloud">
		<?php wp_tag_cloud( $args ) ?>
	</div>
</div>