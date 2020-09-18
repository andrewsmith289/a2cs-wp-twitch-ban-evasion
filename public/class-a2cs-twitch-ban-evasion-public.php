<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       /
 * @since      1.0.0
 *
 * @package    a2cs_Twitch_Ban_Evasion
 * @subpackage a2cs_Twitch_Ban_Evasion/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    a2cs_Twitch_Ban_Evasion
 * @subpackage a2cs_Twitch_Ban_Evasion/public
 * @author     DW <darkwing87t@gmail.com>
 */
class a2cs_Twitch_Ban_Evasion_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in a2cs_Twitch_Ban_Evasion_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The a2cs_Twitch_Ban_Evasion_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/a2cs-twitch-ban-evasion-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in a2cs_Twitch_Ban_Evasion_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The a2cs_Twitch_Ban_Evasion_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/a2cs-twitch-ban-evasion-public.js', array( 'jquery' ), $this->version, false );

	}


	/**
	 * Returns pool settings with appropriate defaults.
	 *
	 * @since    1.0.0
	 */
	public static function getPoolSettings() {
		$defaults = array(
			'a2cs_tbe_text_field_pool_address' 	=>	'localhost',
			'a2cs_tbe_text_field_pool_port' 	=>	'3000',
			'a2cs_tbe_text_field_embed_height'	=>	'720',
			'a2cs_tbe_text_field_embed_width'	=>	'1280',
			'a2cs_tbe_checkbox_field_allow_fullscreen'	=>	'1'
		);
		return wp_parse_args( array_filter( get_option( 'a2cs_tbe_settings' )), $defaults );

	}

	/**
	 * Outputs a Twitch channel embedded in an IFrame.
	 *
	 * @since    1.0.0
	 */
	public static function twitch_evasion_embed_shortcode( $atts ) {
		$accountName = self::getCurrentAccount();
		if ('' == $accountName) {
			return "Error retrieving active stream pool account name. Check php logs for more information.";
		}	

		$options = self::getPoolSettings();
		$height = $options['a2cs_tbe_text_field_embed_height'];
		$width = $options['a2cs_tbe_text_field_embed_width'];		
		$allow_fullscreen = $options['a2cs_tbe_checkbox_field_allow_fullscreen'];

		if ( $height == '' || $width == '' || $allow_fullscreen == '' ) {
			error_log( 'Error rendering shortcode: embed setting(s) not configured.' );
			return '';
		}

		return "<iframe
			src=\"https://player.twitch.tv/?channel=${accountName}&parent=two.wordpress.test\"
			height=\"${height}px\"
			width=\"${width}px\"
			frameborder=\"0\"
			scrolling=\"no\"
			allowfullscreen=\"${allow_fullscreen}\">
		</iframe>";

	}

	/**
	 * Retrieves the currently active account name from the stream pool.
	 *
	 * @since    1.0.0
	 */
	public static function getCurrentAccount() {
		$options = self::getPoolSettings();	
		$host = $options['a2cs_tbe_text_field_pool_address'];	
		$port = $options['a2cs_tbe_text_field_pool_port'];

		if ( $host == '' || $port == '' ) {
			error_log( 'Error getting current account: pool and/or address setting(s) not configured.' );
			return '';
		}

		$url = "${host}:${port}/activeUser";
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HEADER, false);

		$res = curl_exec( $curl );

		if( curl_error( $curl )) {
			error_log( 'Error getting current account: ' . curl_error( $curl ));
			return '';
		}
		curl_close( $curl );

		$res = json_decode( $res );

		return $res->username;
	}

}
