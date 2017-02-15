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

class CN_CategorySections {

	const META_CAROUSEL = 'cn_include_category_carousel';
	const META_HOMEPAGE = 'cn_include_category_homepage';

	public function __construct() {
		add_action( 'edit_category_form_fields', array( $this, 'render_metabox' ), 20 );
		add_action( 'edited_category', array( $this, 'save_metabox' ) );
	}

	public static function get_carousel_categories() {
		return CN_CategorySections::get_checked_meta_terms( CN_CategorySections::META_CAROUSEL );
	}

	public static function get_homepage_categories() {
		return CN_CategorySections::get_checked_meta_terms( CN_CategorySections::META_HOMEPAGE );
	}

	public static function get_checked_meta_terms( $meta_key ) {
		$args = array(
			'meta_query' => array(
				array(
					'key' => $meta_key,
					'value' => 1
				)
			)
		);

		return get_terms( $args );
	}

	public function render_metabox( $term ) {
		$saved_carousel = (bool) get_term_meta( $term->term_id, CN_CategorySections::META_CAROUSEL, true );
		$saved_homepage = (bool) get_term_meta( $term->term_id, CN_CategorySections::META_HOMEPAGE, true );

		?>
		<tr class="form-field">
			<th scope="row" valign="top" style="text-decoration:underline">Homepage Settings</th>
			<td> </td>
		</tr>
		<tr class="form-field">
			<th scope="row" valign="top">Include in Category Carousel</th>
			<td>
				<input type="hidden" name="<?php echo CN_CategorySections::META_CAROUSEL ?>" value="0">
				<input type="checkbox" name="<?php echo CN_CategorySections::META_CAROUSEL ?>" value="1" <?php checked( $saved_carousel ) ?> >
        	</td>
		</tr>
		<tr class="form-field">
			<th scope="row" valign="top">Include in Homepage Categories</th>
			<td>
				<input type="hidden" name="<?php echo CN_CategorySections::META_HOMEPAGE ?>" value="0">
				<input type="checkbox" name="<?php echo CN_CategorySections::META_HOMEPAGE ?>" value="1" <?php checked( $saved_homepage ) ?> >
		    </td>
		</tr>
		<?php
	}

	public function save_metabox( $term_id ) {
		if ( isset( $_REQUEST[ CN_CategorySections::META_CAROUSEL ] ) ) {
			$carousel = (bool) $_REQUEST[ CN_CategorySections::META_CAROUSEL ];
			update_term_meta( $term_id, CN_CategorySections::META_CAROUSEL, $carousel );
		}

		if ( isset( $_REQUEST[ CN_CategorySections::META_HOMEPAGE ] ) ) {
			$homepage = (bool) $_REQUEST[ CN_CategorySections::META_HOMEPAGE ];
			update_term_meta( $term_id, CN_CategorySections::META_HOMEPAGE, $homepage );
		}
	}
}
new CN_CategorySections();