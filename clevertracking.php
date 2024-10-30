<?php

/**
 * The plugin bootstrap file
 *
 * @link              https://cleverconnected.nl
 * @since             0.0.1
 * @package           CleverTracking
 *
 * @wordpress-plugin
 * Plugin Name:       Clever Tracking 
 * Plugin URI: 		  https://cleverconnected.nl/
 * Description:       The Clever Tracking post all the link clicked your wordpress site and post it to your given api.
 * Version:           0.2.28
 * Author:            Ambition4Clients B.V.
 * Author URI:        https://ambition4clients.nl/
 * License:           GPL-3.0+
 * License URI:       https://www.gnu.org/licenses/lgpl-3.0.txt
 * Text Domain:       clevertracking
 * Domain Path:       /languages
 **/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Current plugin version.
 */
define( 'CLEVERTRACKING_VERSION', '0.2.28' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-clevertracking.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    0.0.1
 */
function run_clevertracking() {

	
	$plugin = new CleverTracking();
	$plugin->run();

}
run_clevertracking();