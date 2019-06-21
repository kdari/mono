<?php
/*
Plugin Name: Sugar Events Calendar for WordPress
Plugin URI: http://pippinsplugins.com/sugar-calendar-wordpress
Description: A sweet, simple Event Calendar for WordPress
Author: Pippin Williamson
Author URI: http://pippinsplugins.com
Version: 1.2
Text Domain: pippin_sc
Domain Path: /languages/
*/


/*
|--------------------------------------------------------------------------
| CONSTANTS
|--------------------------------------------------------------------------
*/

// plugin folder url
if(!defined('SC_PLUGIN_URL')) {
	define('SC_PLUGIN_URL', plugin_dir_url( __FILE__ ));
}
// plugin folder path
if(!defined('SC_PLUGIN_DIR')) {
	define('SC_PLUGIN_DIR', plugin_dir_path( __FILE__ ));
}
// plugin root file
if(!defined('SC_PLUGIN_FILE')) {
	define('SC_PLUGIN_FILE', __FILE__);
}
if(!defined('SEC_PLUGIN_VERSION')) {
	define('SEC_PLUGIN_VERSION', '1.2');
}


/*
|--------------------------------------------------------------------------
| INTERNATIONALIZATION
|--------------------------------------------------------------------------
*/

function sc_textdomain() {
	load_plugin_textdomain( 'pippin_sc', false, dirname( plugin_basename( SC_PLUGIN_FILE ) ) . '/languages/' );
}
add_action('init', 'sc_textdomain', 1);


/*
|--------------------------------------------------------------------------
| File Includes
|--------------------------------------------------------------------------
*/

if(is_admin()) {
	if(!class_exists('Custom_Plugin_Updater')) {
		include_once(SC_PLUGIN_DIR . '/class-custom-plugin-updater.php' );
		// setup the plugin updater
		$sc_updater = new Custom_Plugin_Updater( 'http://pippinsplugins.com/updater/api/', SC_PLUGIN_FILE, array( 'version' => SEC_PLUGIN_VERSION  ));
	}
}
include_once( SC_PLUGIN_DIR . '/includes/install.php');
include_once( SC_PLUGIN_DIR . '/includes/post-types.php');
include_once( SC_PLUGIN_DIR . '/includes/taxonomies.php');
include_once( SC_PLUGIN_DIR . '/includes/list-table-columns.php');
include_once( SC_PLUGIN_DIR . '/includes/scripts.php');
include_once( SC_PLUGIN_DIR . '/includes/ajax.php');
include_once( SC_PLUGIN_DIR . '/includes/widgets.php');
include_once( SC_PLUGIN_DIR . '/includes/meta-boxes.php');
include_once( SC_PLUGIN_DIR . '/includes/calendar.php');
include_once( SC_PLUGIN_DIR . '/includes/events-list.php');
include_once( SC_PLUGIN_DIR . '/includes/functions.php');
include_once( SC_PLUGIN_DIR . '/includes/shortcodes.php');
include_once( SC_PLUGIN_DIR . '/includes/event-display.php');
include_once( SC_PLUGIN_DIR . '/includes/query-filters.php');
include_once( SC_PLUGIN_DIR . '/includes/plugin-compatibility.php');
