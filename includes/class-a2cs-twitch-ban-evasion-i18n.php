<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       /
 * @since      1.0.0
 *
 * @package    a2cs_Twitch_Ban_Evasion
 * @subpackage a2cs_Twitch_Ban_Evasion/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    a2cs_Twitch_Ban_Evasion
 * @subpackage a2cs_Twitch_Ban_Evasion/includes
 * @author     DW <darkwing87t@gmail.com>
 */
class a2cs_Twitch_Ban_Evasion_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'a2cs-twitch-ban-evasion',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
