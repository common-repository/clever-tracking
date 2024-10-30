<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * @link      https://cleverconnected.nl
 * @since      0.0.1
 *
 * @package    CleverTracking
 */


if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die;
}

delete_option('CLEVERTRACKING_VERSION');
delete_option('clevertracking_local');
delete_option('clevertracking_ga_options');


global $wpdb;

$link_table_name = $wpdb->prefix . 'clevertracking_link';
$wpdb->query( "DROP TABLE IF EXISTS $link_table_name" );
