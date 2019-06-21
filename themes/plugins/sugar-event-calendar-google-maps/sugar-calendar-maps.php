<?php
/*
Plugin Name: Sugar Calendar - Google Maps
Plugin URL: https://sugarcalendar.com/downloads/google-maps/
Description: Adds simple Google maps to Sugar Event Calendar
Version: 1.3
Author: Sandhills Development, LLC
Author URI: https://sugarcalendar.com
Contributors: mordauk, johnjamesjacoby
*/


/**
 * SLoad plugin text domain
 *
 * @access      private
 * @since       1.1
 * @return      void
*/

function sc_map_load_textdomain() {

	// Set filter for plugin's languages directory
	$sc_maps_lang_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages/';

	// Traditional WordPress plugin locale filter
	$locale        = apply_filters( 'plugin_locale',  get_locale(), 'pippin_sc_maps' );
	$mofile        = sprintf( '%1$s-%2$s.mo', 'pippin_sc_maps', $locale );

	// Setup paths to current locale file
	$mofile_local  = $sc_maps_lang_dir . $mofile;
	$mofile_global = WP_LANG_DIR . '/sugar-calendar-maps/' . $mofile;

	if ( file_exists( $mofile_global ) ) {
		// Look in global /wp-content/languages/sugar-calendar-maps folder
		load_textdomain( 'pippin_sc_maps', $mofile_global );
	} elseif ( file_exists( $mofile_local ) ) {
		// Look in local /wp-content/plugins/sugar-event-calendar-google-maps/languages/ folder
		load_textdomain( 'pippin_sc_maps', $mofile_local );
	} else {
		// Load the default language files
		load_plugin_textdomain( 'pippin_sc_maps', false, $sc_maps_lang_dir );
	}

}
add_action( 'init', 'sc_map_load_textdomain' );


/**
 * Are we running Sugar Calendar 2.0?
 *
 * @access      public
 * @since       1.3
 * @return      bool
*/
function sc_maps_is_20() {

	$ret = false;

	if( defined( 'SC_PLUGIN_VERSION' ) ) {

		$sc_version = preg_replace( '/[^0-9.].*/', '', SC_PLUGIN_VERSION );
		$ret = version_compare( $sc_version, '2.0', '>=' );

	}

	return $ret;
}


/**
 * Retrieve event address
 *
 * @access      public
 * @since       1.3
 * @return      string
*/
function sc_maps_get_address( $event_id = 0 ) {

	if( empty( $event_id ) ) {
		$event_id = get_the_ID();
	}

	if( sc_maps_is_20() ) {

		$event   = sugar_calendar_get_event_by_object( $event_id );
		$address = $event->location;

	} else {

		$address = get_post_meta( $event_id, 'sc_map_address', true );

	}

	return $address;

}

/**
 * Show admin address field
 *
 * @access      private
 * @since       1.0
 * @return      void
*/

function sc_maps_add_forms_meta_box() {

	global $post;

	if( sc_maps_is_20() ) {
		return; // 2.0 has a default address field so we do not need to register one
	}

	echo '<tr class="sc_meta_box_row">';

		echo '<td class="sc_meta_box_td" colspan="2" valign="top">' . __('Event Location', 'pippin_sc_maps') . '</td>';

		echo '<td class="sc_meta_box_td" colspan="4">';

			echo '<input type="text" class="regular-text" name="sc_map_address" value="' . esc_attr( sc_maps_get_address( $post->ID ) ) . '"/>&nbsp;';

			echo '<span class="description">' . __('Enter the event address.', 'pippin_sc_maps' ) . '</span><br/>';

			echo '<input type="hidden" name="sc_maps_meta_box_nonce" value="' . wp_create_nonce( basename( __FILE__ ) ) . '" />';

		echo '</td>';

	echo '</tr>';

}
add_action( 'sc_event_meta_box_after', 'sc_maps_add_forms_meta_box' );



/**
 * Save Address field
 *
 * Save data from meta box.
 *
 * @access      private
 * @since       1.0
 * @return      void
*/

function sc_maps_meta_box_save( $event_id ) {
	global $post;

	if( sc_maps_is_20() ) {
		return; // 2.0 has a default address field so we do not need to save one
	}

	// verify nonce
	if ( ! isset( $_POST['sc_maps_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['sc_maps_meta_box_nonce'], basename( __FILE__ ) ) ) {
		return $event_id;
	}

	// check autosave
	if ( ( defined('DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || ( defined( 'DOING_AJAX' ) && DOING_AJAX) || isset( $_REQUEST['bulk_edit'] ) ) {
		 return $event_id;
	}

	//don't save if only a revision
	if ( isset( $post->post_type ) && $post->post_type == 'revision' ) {
		return $event_id;
	}

	// check permissions
	if ( ! current_user_can( 'edit_post', $event_id ) ) {
		return $event_id;
	}

	$address = sanitize_text_field( $_POST['sc_map_address'] );

	update_post_meta($event_id, 'sc_map_address', $address);

}
add_action('save_post', 'sc_maps_meta_box_save');


/**
 * Displays the event map
 *
 * @access      private
 * @since       1.0
 * @return      void
*/

function sc_maps_show_map( $event_id ) {

	$address = sc_maps_get_address( $event_id );

	if( $address ) :

		$coordinates = sc_maps_get_coordinates( $address );

		if( ! is_array( $coordinates ) ) {
			return;
		}

		$map_id = uniqid( 'sc_map_' . $event_id ); // generate a unique ID for this map

		ob_start(); ?>
		<div class="sc_map_canvas" id="<?php echo esc_attr( $map_id ); ?>" style="width: 100%; height: 400px;"></div>
		<script type="text/javascript">
			var map_<?php echo $map_id; ?>;
			function sc_run_map_<?php echo $map_id ; ?>(){
				var location = new google.maps.LatLng("<?php echo $coordinates['lat']; ?>", "<?php echo $coordinates['lng']; ?>");
				var map_options = {
					zoom: 15,
					center: location,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				}
				map_<?php echo $map_id ; ?> = new google.maps.Map(document.getElementById( "<?php echo $map_id ; ?>"), map_options );
				var marker = new google.maps.Marker({
				position: location,
				map: map_<?php echo $map_id ; ?>
				});
			}
			sc_run_map_<?php echo $map_id ; ?>();
		</script>
		<?php
		echo ob_get_clean();
	endif;
}
add_action( 'sc_after_event_content', 'sc_maps_show_map' );


/**
 * Loads Google Map API on single event pages
 *
 * @access      private
 * @since       1.0
 * @return      void
*/

function sc_maps_load_scripts() {
	if( is_singular( 'sc_event' ) || is_post_type_archive( 'sc_event' ) ) {
		wp_enqueue_script( 'google-maps-api', '//maps.google.com/maps/api/js?key=AIzaSyA4AcYDV9EH4AmoolzFu1Mg-55Ft1mRSVY' );
	}
}
add_action( 'wp_enqueue_scripts', 'sc_maps_load_scripts' );



/**
 * Retrieve coordinates for an address
 *
 * Coordinates are cached using transients and a hash of the address
 *
 * @access      private
 * @since       1.0
 * @return      void
*/

function sc_maps_get_coordinates( $address, $force_refresh = false ) {

    $address_hash = md5( $address );

    $coordinates = get_transient( $address_hash );

    if ( $force_refresh || $coordinates === false ) {

    	$args       = array( 'address' => urlencode( $address ), 'sensor' => 'false', 'key' => 'AIzaSyA4AcYDV9EH4AmoolzFu1Mg-55Ft1mRSVY' );
    	$url        = add_query_arg( $args, 'https://maps.googleapis.com/maps/api/geocode/json' );
     	$response 	= wp_remote_get( $url );

     	if( is_wp_error( $response ) )
     		return;

     	$data = wp_remote_retrieve_body( $response );

     	if( is_wp_error( $data ) ) {
     		return;
     	}

		if ( $response['response']['code'] == 200 ) {

			$data = json_decode( $data );

			if ( $data->status === 'OK' ) {

			  	$coordinates = $data->results[0]->geometry->location;

			  	$cache_value['lat'] 	= $coordinates->lat;
			  	$cache_value['lng'] 	= $coordinates->lng;
			  	$cache_value['address'] = (string) $data->results[0]->formatted_address;

			  	// cache coordinates for 3 months
			  	set_transient($address_hash, $cache_value, 3600*24*30*3);
			  	$data = $cache_value;

			} elseif ( $data->status === 'ZERO_RESULTS' ) {
			  	return __( 'No location found for the entered address.', 'pw-maps' );
			} elseif( $data->status === 'INVALID_REQUEST' ) {
			   	return __( 'Invalid request. Did you enter an address?', 'pw-maps' );
			} else {
				return __( 'Something went wrong while retrieving your map, please ensure you have entered the short code correctly.', 'pw-maps' );
			}

		} else {
		 	return __( 'Unable to contact Google API service.', 'pw-maps' );
		}

    } else {
       // return cached results
       $data = $coordinates;
    }

    return $data;
}


/**
 * Fixes a problem with responsive themes
 *
 * @access      private
 * @since       1.2
 * @return      void
*/

function sc_maps_map_css() {
	echo '<style type="text/css">/* =Responsive Map fix
-------------------------------------------------------------- */
.sc_map_canvas img {
	max-width: none;
}</style>';

}
add_action( 'wp_head', 'sc_maps_map_css' );