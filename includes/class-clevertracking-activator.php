<?php

/**
 * Fired during plugin activation
 *
 * @link       https://cleverconnected.nl
 * @since      0.0.1
 *
 * @package    CleverTracking
 * @subpackage CleverTracking/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      0.0.1
 * @package    CleverTracking
 * @subpackage CleverTracking/includes
 * @author     Rrobin Dommisse <robin.dommisse@ambition4clients.nl>
 */
class CleverTracking_Activator {

	/**
	 * @since    0.0.1
	 */
	public static function activate() {

		add_option('clevertracking_local', '1');

	}

	

}