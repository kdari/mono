<?php
/**
 * Catchthemes Update Notification
 *
 * Provides a notification everytime the theme is updated
 *
 * @package CatchThemes
 * @subpackage Catch_Everest_Pro
 * @since Catch Everest Pro 1.0
 */
function catchthemes_update_notifier_menu() {  
	$xml = get_latest_theme_version(43200); 				// This tells the function to cache the remote call for 43200 seconds (12 hours)
	$theme_data = wp_get_theme('catch-everest-pro'); 							// Get theme data from style.css (current version is what we want)
	
	if(version_compare($theme_data['Version'], $xml->latest) == -1) {
		$theme_dir = str_replace(" ","",$theme_data['Name']);
		add_dashboard_page( 
			$theme_data['Name'] . 'Theme Updates', 		//Title text to be displayed after menu is selected
			$theme_data['Name'] . '<span class="update-plugins count-1"><span class="update-count">'.__('Update','catchthemes').'</span></span>',  //Menu Title
			'administrator',										//Capability required to see the menu.
			strtolower($theme_dir) . '-updates', 
			'catchthemes_update_notifier'  					//Callback function
		); //slug name for menu
	}
}  
add_action('admin_menu', 'catchthemes_update_notifier_menu');

/**
 * Renders the Update Notification Page
 * 
 * Display the latest version available with Change log information
 */
function catchthemes_update_notifier() { 
	$xml = get_latest_theme_version(43200); 			// This tells the function to cache the remote call for 43200 seconds (12 hours)
	$theme_data = wp_get_theme('catch-everest-pro'); 	// Get theme data from style.css (current version is what we want) ?>

	<style>
		#catchthemes-notifier img { max-width: 320px }
		.update-nag {display: none;}
		#instructions {max-width: 800px;}
		h3.title {margin: 30px 0 0 0; padding: 30px 0 0 0; border-top: 1px solid #ddd;}
	</style>
	<div id="catchthemes-notifier" class="wrap">
	
		<div id="icon-tools" class="icon32"></div>
		<h2><?php printf( esc_attr__('%s Theme Updates','catchthemes'),$theme_data['Name'] ); ?></h2>
	    <div id="message" class="updated below-h2">
	    	<p>
	    		<strong>
	    			<?php printf( esc_attr__('There is a new version of the %s theme available.','catchthemes'),$theme_data['Name'] ); ?>
	    		</strong>
	    		<?php printf( esc_attr__('You have version %1$s installed. Update to version %2$s','catchthemes'),$theme_data['Version'],$xml->latest ); ?>
	    	</p>
	   	</div>
        
        <img style="float: left; margin: 0 20px 20px 0; border: 1px solid #ddd;" src="<?php echo get_bloginfo( 'template_url' ). '/screenshot.png'; ?>" />
        
        <div id="instructions" style="max-width: 800px;">
            <h3><?php _e('Update Instruction','catchthemes'); ?></h3>
            <p>
            	<strong><?php _e( 'Please note:','catchthemes'); ?></strong> <?php _e( 'make a ','catchthemes'); ?><strong><?php _e( 'backup','catchthemes'); ?></strong> <?php _e( 'of the Theme inside your WordPress installation folder','catchthemes'); ?> <strong><?php printf( esc_attr__('/wp-content/themes/%s','catchthemes'),$theme_data['Template'] ); ?></strong>
            </p>
            <p>
            	<?php _e( 'To update the Theme, login to your account at','catchthemes'); ?> <a href="<?php echo esc_url( __( 'http://catchthemes.com/login/', 'catchthemes' ) ); ?>" target="_blank"><?php _e( 'Catch Themes','catchthemes');?></a> and <strong><?php _e('download','catchthemes'); ?></strong> <?php printf( esc_attr__('the zip copy of %s Theme from your account.','catchthemes'),$theme_data['Name'] ); ?>
            </p>
            <p><strong><?php _e( 'Manual Update using FTP:','catchthemes'); ?> </strong> <?php printf( esc_attr__('Now unzip the theme file %1$s.%2$s.zip','catchthemes'),$theme_data['Template'], $xml->latest ); ?> <?php printf( esc_attr__('and use your FTP client to access your host web server. Go to /wp-content/themes/ and upload the extracted folder %s ','catchthemes'),$theme_data['Template'] ); ?></p>
            <p><strong><?php _e( 'Update using the WordPress Administration Panel','catchthemes'); ?>: </strong> <?php printf( esc_attr__('If you want to update through your WordPress Dashboard without using FTP, then you have to activate any other default theme and then delete the older version of %s Theme. After that you can upload the current version following the new theme installation process.', 'catchthemes'),$theme_data['Name'] ); ?>
            </p>
        </div><!-- #instructions -->
        
        <div class="clear"></div>
	    
	    <h3 class="title"><?php _e( 'Changelog','catchthemes'); ?></h3>
	    <?php echo $xml->changelog; ?>
	</div><!-- .wrap -->
    
<?php } 

/**
 * This function retrieves a remote xml file from our server to see if there's a new update 
 * For performance reasons this function caches the xml content in the database for XX seconds ( $interval variable)
 */
function get_latest_theme_version($interval) {
	// remote xml file location
	$notifier_file_url = 'http://catchthemes.com/update-notifier/catch-everest-pro/notifier.xml';

	$db_cache_field = 'contempo-notifier-cache';
	$db_cache_field_last_updated = 'contempo-notifier-last-updated';
	$last = get_option( $db_cache_field_last_updated );
	$now = time();

	// check the cache
	if ( !$last || ( ( $now - $last ) > $interval ) ) {
		// cache doesn't exist, or is old, so refresh it
		if( function_exists('curl_init') ) { // if cURL is available, use it...
			$ch = curl_init($notifier_file_url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			$cache = curl_exec($ch);
			curl_close($ch);
		} else {
			$cache = file_get_contents($notifier_file_url); // ...if not, use the common file_get_contents()
			//echo '<!--refressing-->';
		}
		
		if ($cache) {			
			// we got good results
			update_option( $db_cache_field, $cache );
			update_option( $db_cache_field_last_updated, time() );			
		}
		// read from the cache file
		$notifier_data = get_option( $db_cache_field );
	}
	else {
		// cache file is fresh enough, so read from it
		$notifier_data = get_option( $db_cache_field );
	}

	// Let's see if the $xml data was returned as we expected it to.
	// If it didn't, use the default 1.0 as the latest version so that we don't have problems when the remote server hosting the XML file is down
	if( strpos((string)$notifier_data, '<notifier>') === false ) {
		$notifier_data = '<?xml version="1.0" encoding="UTF-8"?><notifier><latest>1.0</latest><changelog></changelog></notifier>';
	}

	// Load the remote XML data into a variable and return it
	$xml = simplexml_load_string($notifier_data);

	return $xml;
}?>