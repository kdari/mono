<?php

/**
 * The primary plugin file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes most of the code for this plugin.
 *
 * @wordpress-plugin
 * Plugin Name:       Kdari Must Use Features.
 * Plugin URI:        kdari.com
 * Description:       This contains all the extra code we need to make the network work.
 * Version:           1.0.0
 * Author:            lgedeon
 * Author URI:        luke.gedeon.name
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       kdari-mu
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
define( 'KDARI_MU_VERSION', '1.0.0' );

add_filter(
	'cron_schedules',
	function( $schedules ) {
		if ( ! isset( $schedules['10min'] ) ) {
			$schedules['10min'] = array(
				'interval' => 10 * MINUTE_IN_SECONDS,
				'display' => __( 'Every 10 minutes' ),
			);
		}

		return $schedules;
	}
);

function __return_jp_support_10_min() {
	return '10min';
}
add_filter( 'jetpack_sync_incremental_sync_interval', '__return_jp_support_10_min' );
add_filter( 'jetpack_sync_full_sync_interval', '__return_jp_support_10_min' );
