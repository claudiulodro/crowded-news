<?php

function cn_get_amp_image( $id, $size = 'thumbnail', $responsive = false ) {
	$image_data = wp_get_attachment_image_src( $id, $size );
	if ( ! $image_data ) {
		return "";
	}

	$responsive = $responsive ? 'layout="responsive"' : "";

	ob_start();
	?>
	<amp-img <?php echo $responsive ?> src="<?php echo $image_data[0] ?>" width="<?php echo $image_data[1] ?>" height="<?php echo $image_data[2] ?>"></amp-img>
	<?php
	return ob_get_clean();
}

function cn_the_amp_image( $id, $size = 'thumbnail' ) {
	echo cn_get_amp_image( $id, $size );
}

function cn_get_amp_content( $post_id = null ) {
	return get_the_content( $post_id );
}

function cn_the_amp_content( $post_id = null ) {
	echo cn_get_amp_content( $post_id );
}
