<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       /
 * @since      1.0.0
 *
 * @package    a2cs_Twitch_Ban_Evasion
 * @subpackage a2cs_Twitch_Ban_Evasion/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    a2cs_Twitch_Ban_Evasion
 * @subpackage a2cs_Twitch_Ban_Evasion/admin
 * @author     DW <darkwing87t@gmail.com>
 */
class a2cs_Twitch_Ban_Evasion_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/a2cs-twitch-ban-evasion-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/a2cs-twitch-ban-evasion-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register the plugin's admin menu.
	 *
	 * @since    1.0.0
	 */
	public function register_admin_menu() {
		add_options_page( 'Twitch Ban Evasion Settings', 'Twitch Ban Evasion', 'manage_options', 'a2cs-tbe-menu', 'a2cs_Twitch_Ban_Evasion_Admin::a2cs_tbe_options_page_content' );
	}

	 /**
	 * Initializes the plugin's admin menu and settings.
	 *
	 * @since    1.0.0
	 */
	public function admin_menu_init() {
		register_setting( 'a2cs_tbe_plugin', 'a2cs_tbe_settings' );

		// Pool settings section
		add_settings_section(
			'a2cs_tbe_plugin_pool_section',
			__( 'Pool Settings', 'a2cs_tbe_plugin' ),
			'a2cs_Twitch_Ban_Evasion_Admin::a2cs_tbe_settings_pool_section_content',
			'a2cs_tbe_plugin'
		);

		add_settings_field(
			'a2cs_tbe_text_field_pool_address',
			__( 'Pool address', 'a2cs_tbe_plugin' ),
			'a2cs_Twitch_Ban_Evasion_Admin::a2cs_tbe_text_field_pool_address_render',
			'a2cs_tbe_plugin',
			'a2cs_tbe_plugin_pool_section'
		);
		add_settings_field(
			'a2cs_tbe_text_field_pool_port',
			__( 'Pool port', 'a2cs_tbe_plugin' ),
			'a2cs_Twitch_Ban_Evasion_Admin::a2cs_tbe_text_field_pool_port_render',
			'a2cs_tbe_plugin',
			'a2cs_tbe_plugin_pool_section'
		);

		// Embed settings section
		add_settings_section(
			'a2cs_tbe_plugin_embed_section',
			__( 'Embed Settings', 'a2cs_tbe_plugin' ),
			'a2cs_Twitch_Ban_Evasion_Admin::a2cs_tbe_settings_embed_section_content',
			'a2cs_tbe_plugin'
		);

		add_settings_field(
			'a2cs_tbe_text_field_embed_width',
			__( 'Embed width (px)', 'a2cs_tbe_plugin' ),
			'a2cs_Twitch_Ban_Evasion_Admin::a2cs_tbe_text_field_embed_width_render',
			'a2cs_tbe_plugin',
			'a2cs_tbe_plugin_embed_section'
		);
		add_settings_field(
			'a2cs_tbe_text_field_embed_height',
			__( 'Embed height (px)', 'a2cs_tbe_plugin' ),
			'a2cs_Twitch_Ban_Evasion_Admin::a2cs_tbe_text_field_embed_height_render',
			'a2cs_tbe_plugin',
			'a2cs_tbe_plugin_embed_section'
		);
		add_settings_field(
			'a2cs_tbe_checkbox_field_allow_fullscreen',
			__( 'Allow fullscreen', 'a2cs_tbe_plugin' ),
			'a2cs_Twitch_Ban_Evasion_Admin::a2cs_tbe_checkbox_field_embed_allow_fullscreen_render',
			'a2cs_tbe_plugin',
			'a2cs_tbe_plugin_embed_section'
		);
	}

	/**
	 * Pool settings section content callback.
	 *
	 * @since    1.0.0
	 */
	static function a2cs_tbe_settings_pool_section_content() {
		echo __( 'Configure account pool settings', 'a2cs_tbe_plugin' );

	}

	/**
	 * Embed settings section content callback.
	 *
	 * @since    1.0.0
	 */
	static function a2cs_tbe_settings_embed_section_content() {
		echo __( 'Configure iframe embed settings', 'a2cs_tbe_plugin' );

	}

	// Pool settings section field render callbacks

	/**
	 * Pool settings section, pool address render callback.
	 *
	 * @since    1.0.0
	 */
	static function a2cs_tbe_text_field_pool_address_render() {
		$options = get_option( 'a2cs_tbe_settings' );
		?>
		<input type='text' name='a2cs_tbe_settings[a2cs_tbe_text_field_pool_address]' 
			placeholder='127.0.0.1' value='<?php echo $options['a2cs_tbe_text_field_pool_address']; ?>' pattern='^(?:[0-9]{1,3}\.){3}[0-9]{1,3}$'>
		<?php

	}

	/**
	 * Pool settings section, pool port render callback.
	 *
	 * @since    1.0.0
	 */
	static function a2cs_tbe_text_field_pool_port_render() {
		$options = get_option( 'a2cs_tbe_settings' );
		?>
		<input type='number' name='a2cs_tbe_settings[a2cs_tbe_text_field_pool_port]' 
			placeholder='3000' value='<?php echo $options['a2cs_tbe_text_field_pool_port']; ?>'>
		<?php
		
	}

	// Embed settings section field render callbacks

	/**
	 * Embed settings section, width render callback.
	 *
	 * @since    1.0.0
	 */
	static function a2cs_tbe_text_field_embed_width_render() {
		$options = get_option( 'a2cs_tbe_settings' );
		?>
		<input type='number' name='a2cs_tbe_settings[a2cs_tbe_text_field_embed_width]'
			placeholder='1280' value='<?php echo $options['a2cs_tbe_text_field_embed_width']; ?>'>
		<?php

	}

	/**
	 * Embed settings section, height render callback.
	 *
	 * @since    1.0.0
	 */
	static function a2cs_tbe_text_field_embed_height_render() {
		$options = get_option( 'a2cs_tbe_settings' );
		?>
		<input type='number' name='a2cs_tbe_settings[a2cs_tbe_text_field_embed_height]' 
			placeholder='720' value='<?php echo $options['a2cs_tbe_text_field_embed_height']; ?>'>
		<?php

	}

	/**
	 * Embed settings section, allow full screen callback.
	 *
	 * @since    1.0.0
	 */
	static function a2cs_tbe_checkbox_field_embed_allow_fullscreen_render() {
		$options = get_option( 'a2cs_tbe_settings' );
		?>
		<input type="checkbox" name="a2cs_tbe_settings[a2cs_tbe_checkbox_field_allow_fullscreen]" 
			value="1" <?php checked(1, $options['a2cs_tbe_checkbox_field_allow_fullscreen'], true); ?> />
		<?php

	}

	/**
	 * Plugin option page content callback.
	 *
	 * @since    1.0.0
	 */
	static function a2cs_tbe_options_page_content() {
		?>
		<form action='options.php' method='post'>	
			<h1><?php echo __( 'Twitch Ban Evasion Settings', 'a2cs_tbe_plugin' ) ?></h1>
			<br />
			<?php
			settings_fields( 'a2cs_tbe_plugin' );
			do_settings_sections( 'a2cs_tbe_plugin' );
			submit_button();
			?>	
		</form>
		<?php

	}

}
