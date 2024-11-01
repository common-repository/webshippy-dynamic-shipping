<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              www.linkedin.com/in/docker
 * @since             1.0.0
 * @package           Ws_Dynamic_Shipping
 *
 * @wordpress-plugin
 * Plugin Name:       Webshippy Dynamic Shipping
 * Plugin URI:        https://webshippy.com/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.2.1
 * Author:            Webshippy Ltd.
 * Author URI:        https://help.webshippy.com/hu/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ws-dynamic-shipping
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
define( 'WS_DYNAMIC_SHIPPING_VERSION', '1.2.1' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-ws-dynamic-shipping-activator.php
 */
function activate_ws_dynamic_shipping() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wsds-activator.php';
	Ws_Dynamic_Shipping_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-ws-dynamic-shipping-deactivator.php
 */
function deactivate_ws_dynamic_shipping() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wsds-deactivator.php';
	Ws_Dynamic_Shipping_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_ws_dynamic_shipping' );
register_deactivation_hook( __FILE__, 'deactivate_ws_dynamic_shipping' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wsds.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_ws_dynamic_shipping() {

	$plugin = new Ws_Dynamic_Shipping();
	$plugin->run();

}
run_ws_dynamic_shipping();
