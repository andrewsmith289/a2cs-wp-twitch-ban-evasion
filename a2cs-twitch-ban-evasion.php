<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              /
 * @since             1.0.0
 * @package           a2cs_Twitch_Ban_Evasion
 *
 * @wordpress-plugin
 * Plugin Name:       a2cs Twitch Ban Evasion
 * Plugin URI:        /
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            DW
 * Author URI:        /
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       a2cs-twitch-ban-evasion
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'a2cs_TWITCH_BAN_EVASION_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-a2cs-twitch-ban-evasion-activator.php
 */
function activate_a2cs_twitch_ban_evasion() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-a2cs-twitch-ban-evasion-activator.php';
	a2cs_Twitch_Ban_Evasion_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-a2cs-twitch-ban-evasion-deactivator.php
 */
function deactivate_a2cs_twitch_ban_evasion() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-a2cs-twitch-ban-evasion-deactivator.php';
	a2cs_Twitch_Ban_Evasion_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_a2cs_twitch_ban_evasion' );
register_deactivation_hook( __FILE__, 'deactivate_a2cs_twitch_ban_evasion' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-a2cs-twitch-ban-evasion.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_a2cs_twitch_ban_evasion() {

	$plugin = new a2cs_Twitch_Ban_Evasion();
	$plugin->run();

}
run_a2cs_twitch_ban_evasion();
