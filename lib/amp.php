<?php

/**
 * Get AMPHTML for an attachment image
 * @param $id - int - attachment id
 * @param $size - string/array - valid image size
 * @param $responsive - bool - responsive image or no
 * @return string - AMPHTML
 **/
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

/**
 * Output AMPHTML for an attachment image
 * @param $id - int - attachment id
 * @param $size - string/array - valid image size
 * @param $responsive - bool - responsive image or no
 **/
function cn_the_amp_image( $id, $size = 'thumbnail', $responsive = false ) {
	echo cn_get_amp_image( $id, $size, $responsive );
}

/**
 * Converts images into a format easily convertable to AMPHTML
 * @params image_send_to_editor filter params
 * @return modified image HTML
 **/
function cn_auto_amp_content_image_data( $html, $id, $caption, $title, $align, $url, $size ) {
	$image_data = wp_get_attachment_image_src( $id, $size );
	$caption = ! empty( $caption ) ? '<div class="caption">' . sanitize_text_field( $caption ) . '</div>' : "";

	return '<img src="' . $image_data[0] . '" width="' . $image_data[1] . '" height="' . $image_data[2] . '" />' . $caption;
}
add_filter( 'image_send_to_editor', 'cn_auto_amp_content_image_data', 10, 7 );

/**
 * Convert images in the content to AMPHTML
 * @param $content - string - post content
 * @return string - modified content
 **/
function cn_auto_amp_content_images( $content ) {
	$image_capture_regex = "#(<img)(.*?)(\/>)#";
	$image_capture_replacement = '<amp-img$2layout="responsive"></amp-img>';

	if ( empty( $content ) ) {
		return $content;
	}

	return preg_replace( $image_capture_regex, $image_capture_replacement, $content );
}
add_filter( 'the_content', 'cn_auto_amp_content_images' );

/**
 * Output structured data for the current post
 **/
function cn_amp_structured_data() {
	$post_thumbnail_id = get_post_thumbnail_id();
	$image = $post_thumbnail_id ? wp_get_attachment_image_src( $post_thumbnail_id, 'full' ) : false;
	$published_date = get_the_date( 'Y-m-d\TH:i:sP' );
	$modified_date = get_the_modified_date( 'Y-m-d\TH:i:sP' );
	$author = esc_attr( get_the_author_meta( 'display_name', get_post_field( 'post_author' ) ) );
	$publisher_name = sanitize_text_field( get_bloginfo( 'name' ) );
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$publisher_image = $custom_logo_id ? wp_get_attachment_image_src( $custom_logo_id , 'amp-logo' ) : false;
	$excerpt = str_replace( '"', "'", get_the_excerpt() );

	?>
	<script type="application/ld+json">
		{
  			"@context": "http://schema.org",
  			"@type": "NewsArticle",
  			"mainEntityOfPage": {
    			"@type": "WebPage",
    			"@id": "<?php the_permalink() ?>"
  			},
  			"headline": "<?php the_title() ?>",
  			<?php if ( $image ) : ?>
	  			"image": {
	    			"@type": "ImageObject",
	    			"url": "<?php echo $image[0] ?>",
	    			"height": <?php echo $image[2] ?>,
	    			"width": <?php echo $image[1] ?>
	  			},
	  		<?php endif ?>
  			"datePublished": "<?php echo $published_date ?>",
  			"dateModified": "<?php echo $modified_date ?>",
  			"author": {
    			"@type": "Person",
    			"name": "<?php echo $author ?>"
  			},
   			"publisher": {
    			"@type": "Organization",
    			"name": "<?php echo $publisher_name ?>"
    			<?php if ( $publisher_image ) : ?>
	    			,
	    			"logo": {
	      				"@type": "ImageObject",
	      				"url": "<?php echo $publisher_image[0] ?>",
	      				"width": <?php echo $publisher_image[1] ?>,
	      				"height": <?php echo $publisher_image[2] ?>
	    			}
    			<?php endif ?>
  			},
 			 "description": "<?php echo $excerpt ?>"
		}
	</script>
	<?php
}
add_action( 'cn_amp_head', 'cn_amp_structured_data' );