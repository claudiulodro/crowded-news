<?php

/**
 * Get the Facebook share url for a post
 * @param $post_id - int - optional post id to fetch URL for
 * @return string
 **/
function cn_get_facebook_share_url( $post_id = null ) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	$link = get_permalink( $post_id );

	return "https://www.facebook.com/sharer/sharer.php?u=" . urlencode( $link );
}

/**
 * Output the Facebook share url for a post
 * @param $post_id - int - optional post id to fetch URL for
 **/
function cn_the_facebook_share_url( $post_id = null ) {
	echo cn_get_facebook_share_url( $post_id );
}

/**
 * Get the Twitter share url for a post
 * @param $post_id - int - optional post id to fetch URL for
 * @return string
 **/
function cn_get_twitter_share_url( $post_id = null ) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	$link = get_permalink( $post_id );

	return "https://twitter.com/home?status=" . urlencode( $link );
}

/**
 * Output the Twitter share url for a post
 * @param $post_id - int - optional post id to fetch URL for
 **/
function cn_the_twitter_share_url( $post_id = null ) {
	echo cn_get_twitter_share_url( $post_id );
}

function cn_related_posts() {
	$related_posts = get_posts( array( 'orderby' => 'rand', 'posts_per_page' => 3, 'post__not_in' => array( get_the_ID() ) ) );
	?>
	<div class="m-related-posts">
		<h4>Other stuff:</h4>
		<div class="items">
			<?php foreach( $related_posts as $post ): ?>
				<div class="item">
					<div class="item-thumbnail">
						<a href="<?php echo get_permalink( $post->ID ) ?>">
							<?php echo get_the_post_thumbnail( $post->ID, 'home-category' ) ?>
						</a>
					</div>
					<div class="title">
						<a href="<?php echo get_permalink( $post->ID ) ?>">
							<?php echo esc_html( $post->post_title ) ?>
						</a>
					</div>
				</div>
			<?php endforeach ?>
		</div>
	</div>
	<?php
}

function cn_is_viewscreen() {
	return ! empty( $_GET['viewscreen'] );
}

/**
 * Manages general theme settings
 **/
class CN_Settings {
	const OPTION_FACEBOOK_URL = 'cn_facebook_page_url';
	const OPTION_TWITTER_URL = 'cn_twitter_url';
	const OPTION_GA_ID = 'cn_google_analytics_id';
	const OPTION_GTM_ID = 'cn_gtm_id';

	/**
	 * Render a Google Tag Manager snippet if GTM ID is set
	 **/
	public static function render_gtm_snippet() {
		$id = get_option( CN_Settings::OPTION_GTM_ID, false );
		if ( ! $id ) {
			return;
		}

		$protocol = is_ssl() ? 'https' : 'http';
		?>
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'<?php echo $protocol ?>://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','<?php echo esc_attr( $id ) ?>');</script>
		<?php
	}

	/**
	 * Render an AMP Google Analytics snippet if GA ID is set
	 **/
	public static function render_amp_ga_snippet() {
		$id = get_option( CN_Settings::OPTION_GA_ID, false );
		if ( ! $id || is_preview() ) {
			return;
		}
		?>
		<amp-analytics type="googleanalytics">
			<script type="application/json">
			{
				"vars": {
					"account": "<?php echo esc_attr( $id ) ?>"
			  	},
			  	"triggers": {
			    	"trackPageview": {
			      		"on": "visible",
			      		"request": "pageview"
			    	}
			  	}
			}
			</script>
		</amp-analytics>
		<?php
	}

	/**
	 * Get the site Facebook page URL
	 * @return string
	 **/
	public static function get_facebook_page_url() {
		return esc_url( get_option( CN_Settings::OPTION_FACEBOOK_URL, "" ) );
	}

	/**
	 * Get the site Twitter page URL
	 * @return string
	 **/
	public static function get_twitter_url() {
		return esc_url( get_option( CN_Settings::OPTION_TWITTER_URL, "" ) );
	}

	public function __construct() {
		add_action( 'admin_init', array( $this, 'register_settings' ) );
		add_action( 'wp_head', array( 'CN_Settings', 'render_gtm_snippet' ) );
		add_action( 'cn_amp_body', array( 'CN_Settings', 'render_amp_ga_snippet' ) );
	}

	public function register_settings() {
		add_settings_field(
			CN_Settings::OPTION_FACEBOOK_URL,
			'Facebook Page URL (http://facebook...)',
			array( $this, 'render_facebook_page_setting' ),
			'general'
		);
		register_setting( 'general', CN_Settings::OPTION_FACEBOOK_URL, 'esc_url' );

		add_settings_field(
			CN_Settings::OPTION_TWITTER_URL,
			'Twitter Url (http://twitter...)',
			array( $this, 'render_twitter_handle_setting' ),
			'general'
		);
		register_setting( 'general', CN_Settings::OPTION_TWITTER_URL, 'esc_url' );

		add_settings_field(
			CN_Settings::OPTION_GA_ID,
			'Google Analytics ID (UA-XXXXX-Y)',
			array( $this, 'render_ga_setting' ),
			'general'
		);
		register_setting( 'general', CN_Settings::OPTION_GA_ID, 'esc_attr' );

		add_settings_field(
			CN_Settings::OPTION_GTM_ID,
			'Google Tag Manager ID (GTM-XXXX)',
			array( $this, 'render_gtm_setting' ),
			'general'
		);
		register_setting( 'general', CN_Settings::OPTION_GTM_ID, 'esc_attr' );
	}

	public function render_facebook_page_setting() {
		$saved = esc_url( get_option( CN_Settings::OPTION_FACEBOOK_URL, "" ) );
		?><input type="text" name="<?php echo CN_Settings::OPTION_FACEBOOK_URL ?>" value="<?php echo $saved ?>" /><?php
	}

	public function render_twitter_handle_setting() {
		$saved = esc_url( get_option( CN_Settings::OPTION_TWITTER_URL, "" ) );
		?><input type="text" name="<?php echo CN_Settings::OPTION_TWITTER_URL ?>" value="<?php echo $saved ?>" /><?php
	}

	public function render_ga_setting() {
		$saved = esc_attr( get_option( CN_Settings::OPTION_GA_ID, "" ) );
		?><input type="text" name="<?php echo CN_Settings::OPTION_GA_ID ?>" value="<?php echo $saved ?>" /><?php
	}

	public function render_gtm_setting() {
		$saved = esc_attr( get_option( CN_Settings::OPTION_GTM_ID, "" ) );
		?><input type="text" name="<?php echo CN_Settings::OPTION_GTM_ID ?>" value="<?php echo $saved ?>" /><?php
	}
}
new CN_Settings();