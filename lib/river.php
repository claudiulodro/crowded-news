<?php

class CN_PostSections {

	const META_CAROUSEL = 'cn_include_carousel';
	const META_FEATURED = 'cn_include_featured';
	const META_SPOTLIGHT = 'cn_include_spotlight';

	const SIZE_CAROUSEL = 5;
	const SIZE_FEATURED = 2;
	const SIZE_SPOTLIGHT = 10;

	public static function get_carousel_query( $category_id = 0 ) {
		return CN_PostSections::get_checked_meta_query( CN_PostSections::META_CAROUSEL, CN_PostSections::SIZE_CAROUSEL, $category_id );
	}

	public static function get_featured_query( $category_id = 0 ) {
		return CN_PostSections::get_checked_meta_query( CN_PostSections::META_FEATURED, CN_PostSections::SIZE_FEATURED, $category_id );
	}

	public static function get_spotlight_query( $category_id = 0 ) {
		return CN_PostSections::get_checked_meta_query( CN_PostSections::META_SPOTLIGHT, CN_PostSections::SIZE_SPOTLIGHT, $category_id );
	}

	public static function get_checked_meta_query( $meta_key, $posts_per_page, $category_id = 0 ) {
		$args = array(
			'posts_per_page' => $posts_per_page,
			'meta_query' => array(
				array(
					'key' => $meta_key,
					'value' => 1
				)
			)
		);

		if ( $category_id ) {
			$args['cat'] = $category_id;
		}

		return new WP_Query( $args );
	}

	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'register_metabox' ) );
		add_action( 'save_post', array( $this, 'save_metabox' ) );
	}

	public function register_metabox() {
		add_meta_box(
			'cn-postsections',
			'Sections',
			array( $this, 'render_metabox' ),
			'post',
			'side'
		);
	}

	public function render_metabox( $post ) {
		$saved_carousel = (bool) get_post_meta( $post->ID, CN_PostSections::META_CAROUSEL, true );
		$saved_featured = (bool) get_post_meta( $post->ID, CN_PostSections::META_FEATURED, true );
		$saved_spotlight = (bool) get_post_meta( $post->ID, CN_PostSections::META_SPOTLIGHT, true );
		
		?>
		<p>Select areas to feature this post.</p>
		<div>
			<input type="hidden" name="<?php echo CN_PostSections::META_CAROUSEL ?>" value="0" />
			<input type="checkbox" name="<?php echo CN_PostSections::META_CAROUSEL ?>" value="1" <?php checked( $saved_carousel ) ?> />
			Carousel
		</div>
		<div>
			<input type="hidden" name="<?php echo CN_PostSections::META_FEATURED ?>" value="0" />
			<input type="checkbox" name="<?php echo CN_PostSections::META_FEATURED ?>" value="1" <?php checked( $saved_featured ) ?> />
			Featured
		</div>
		<div>
			<input type="hidden" name="<?php echo CN_PostSections::META_SPOTLIGHT ?>" value="0" />
			<input type="checkbox" name="<?php echo CN_PostSections::META_SPOTLIGHT ?>" value="1" <?php checked( $saved_spotlight ) ?> />
			Spotlight
		</div>
		<?php
	}

	public function save_metabox( $post_id ) {
		if ( isset( $_REQUEST[ CN_PostSections::META_CAROUSEL ] ) ) {
			$carousel = (bool) $_REQUEST[ CN_PostSections::META_CAROUSEL ];
			update_post_meta( $post_id, CN_PostSections::META_CAROUSEL, $carousel );
		}

		if ( isset( $_REQUEST[ CN_PostSections::META_FEATURED ] ) ) {
			$featured = (bool) $_REQUEST[ CN_PostSections::META_FEATURED ];
			update_post_meta( $post_id, CN_PostSections::META_FEATURED, $featured );
		}

		if ( isset( $_REQUEST[ CN_PostSections::META_SPOTLIGHT ] ) ) {
			$spotlight = (bool) $_REQUEST[ CN_PostSections::META_SPOTLIGHT ];
			update_post_meta( $post_id, CN_PostSections::META_SPOTLIGHT, $spotlight );
		}
	}
}
new CN_PostSections();