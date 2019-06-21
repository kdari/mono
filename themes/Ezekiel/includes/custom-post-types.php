<?php
//---------News--------------------News--------------------News--------------------News--------------------News-----------:
/**
 * Enable Custom Post Types for News
 */
function cpt_news_posttype() {
register_post_type( 'cpt_news',
		array(
			'labels' => array(
				'name' => __( 'News' ),
				'singular_name' => __( 'News' ),
				'add_new' => __( 'Add News' ),
				'add_new_item' => __( 'Add News' ),
				'edit_item' => __( 'Edit News' ),
				'new_item' => __( 'Add News' ),
				'view_item' => __( 'View News' ),
				'search_items' => __( 'Search News' ),
				'not_found' => __( 'No news found' ),
				'not_found_in_trash' => __( 'No news found in trash' )
			),
			'public' => true,
			'supports' => array( 'title', 'editor', 'thumbnail', 'author', 'comments'),
			'capability_type' => 'post',
			'rewrite' => array("slug" => "cpt_news"), // Permalinks format
			'menu_icon' => get_bloginfo('stylesheet_directory') . '/css/_img/cpt_news.png',  // Icon Path
			'menu_position' => '21'
		)
	);
}
 
add_action( 'init', 'cpt_news_posttype' );

//---------News--------------------News--------------------News--------------------News--------------------News--------------------News-----------
//---------Event--------------------Event--------------------Event--------------------Event--------------------Event-----------:
/**
 * Enable Custom Post Types for Events
 */
 
// Registers the new post type and taxonomy
 
function event_posttype() {
	register_post_type( 'cpt_events',
		array(
			'labels' => array(
				'name' => __( 'Events' ),
				'singular_name' => __( 'Event' ),
				'add_new' => __( 'Add New Event' ),
				'add_new_item' => __( 'Add New Event' ),
				'edit_item' => __( 'Edit Event' ),
				'new_item' => __( 'Add New Event' ),
				'view_item' => __( 'View Event' ),
				'search_items' => __( 'Search Event' ),
				'not_found' => __( 'No events found' ),
				'not_found_in_trash' => __( 'No events found in trash' )
			),
			'public' => true,
			'supports' => array( 'title', 'editor', 'thumbnail', 'comments' ),
			'capability_type' => 'post',
			'rewrite' => array("slug" => "cpt_events"), // Permalinks format
			'menu_icon' => get_bloginfo('stylesheet_directory') . '/css/_img/cpt_events.png',  // Icon Path
			'menu_position' => '20'
		)
	);
}
 
add_action( 'init', 'event_posttype' );

// Change the "Scheduled for" text on Event post types changing the translation
// http://blog.ftwr.co.uk/archives/2010/01/02/mangling-strings-for-fun-and-profit/
function translation_mangler($translation, $text, $domain) {
        global $post;
	if ($post->post_type == 'cpt_events') {
 
		$translations = &get_translations_for_domain( $domain);
		if ( $text == 'Scheduled for: <b>%1$s</b>') {
			return $translations->translate( 'Event Date: <b>%1$s</b>' );
		}
		if ( $text == 'Published on: <b>%1$s</b>') {
			return $translations->translate( 'Event Date: <b>%1$s</b>' );
		}
		if ( $text == 'Publish <b>immediately</b>') {
			return $translations->translate( 'Event Date: <b>%1$s</b>' );
		}
	}
 
	return $translation;
}
 
add_filter('gettext', 'translation_mangler', 10, 4);

// Show Scheduled Posts
 
function show_scheduled_posts($posts) {
   global $wp_query, $wpdb;
   if(is_single() && $wp_query->post_count == 0) {
      $posts = $wpdb->get_results($wp_query->request);
   }
   return $posts;
}
 
add_filter('the_posts', 'show_scheduled_posts');


//
add_action("admin_init", "admin_init_cpt_events");
add_action('save_post', 'save_event_info');

function admin_init_cpt_events(){
	add_meta_box("cpt_eventsInfo-meta", "Event Info", "cpt_events_meta_options", "cpt_events", "normal", "high");
}

function cpt_events_meta_options(){
	?>
    <p class="meta-options">
	<?php
	//call the fields
	cpt_events_address_options();
	cpt_events_map_options();
	?>
	</p>
    <?php
}

function cpt_events_address_options(){
global $post;
$custom = get_post_custom($post->ID);
$address = get_post_meta($post->ID, 'address', true);
?>
<br />
<label><strong>Address:</strong></label><br />
<input name="address" type="text" value="<?php echo $address; ?>" />
<br/><br/>

<?php
}
function cpt_events_map_options(){
global $post;
$custom = get_post_custom($post->ID);
$map = get_post_meta($post->ID, 'map', true);
?>

<label><strong>Url to Google Map or Mapquest:</strong></label><br />
<input name="map" type="text" value="<?php echo $map; ?>" />
<br/><br/>

<?php
}



function save_event_info(){
global $post;
	if ($_POST["address"] != ""){
		update_post_meta($post->ID, "address", $_POST["address"]);
	}
	if ($_POST["map"] != ""){
		update_post_meta($post->ID, "map", $_POST["map"]);
	}
}
//---------Event--------------------Event--------------------Event--------------------Event--------------------Event--------------------Event-----------

//---------Sermon--------------------Sermon--------------------Sermon--------------------Sermon--------------------Sermon-----------:
/**
 * Enable Custom Post Types for Sermons
 */
 
// Registers the new post type and taxonomy
 
function sermon_posttype() {
	register_post_type( 'cpt_sermons',
		array(
			'labels' => array(
				'name' => __( 'Sermons' ),
				'singular_name' => __( 'Sermon' ),
				'add_new' => __( 'Add New Sermon' ),
				'add_new_item' => __( 'Add New Sermon' ),
				'edit_item' => __( 'Edit Sermon' ),
				'new_item' => __( 'Add New Sermon' ),
				'view_item' => __( 'View Sermon' ),
				'search_items' => __( 'Search Sermon' ),
				'not_found' => __( 'No sermons found' ),
				'not_found_in_trash' => __( 'No sermons found in trash' )
			),
			'public' => true,
			'supports' => array( 'title', 'editor', 'thumbnail'),
			'capability_type' => 'post',
			'rewrite' => array("slug" => "cpt_sermons"), // Permalinks format
			'menu_icon' => get_bloginfo('stylesheet_directory') . '/css/_img/cpt_sermons.png',  // Icon Path
			'menu_position' => '20'
		)
	);
}
 
add_action( 'init', 'sermon_posttype' );

// Change the "Scheduled for" text on Sermon post types changing the translation
// http://blog.ftwr.co.uk/archives/2010/01/02/mangling-strings-for-fun-and-profit/
function translation_mangler2($translation, $text, $domain) {
        global $post;
	if ($post->post_type == 'cpt_sermons') {
 
		$translations = &get_translations_for_domain( $domain);
		if ( $text == 'Scheduled for: <b>%1$s</b>') {
			return $translations->translate( 'Sermon Date: <b>%1$s</b>' );
		}
		if ( $text == 'Published on: <b>%1$s</b>') {
			return $translations->translate( 'Sermon Date: <b>%1$s</b>' );
		}
		if ( $text == 'Publish <b>immediately</b>') {
			return $translations->translate( 'Sermon Date: <b>%1$s</b>' );
		}
	}
 
	return $translation;
}
 
add_filter('gettext', 'translation_mangler2', 10, 4);






add_action("admin_init", "admin_init_cpt_sermons");
add_action('save_post', 'save_sermon_info');

function admin_init_cpt_sermons(){
	add_meta_box("cpt_sermonsInfo-meta", "Sermon Info", "cpt_sermons_meta_options", "cpt_sermons", "normal", "high");
}

function cpt_sermons_meta_options(){
	?>
    <p class="meta-options">
	<?php
	//call the fields
	cpt_sermons_file_options();
	?>
	</p>
    <?php
}


function cpt_sermons_file_options(){
global $post;
$custom = get_post_custom($post->ID);
$sermonmp3 = get_post_meta($post->ID, 'sermonmp3', true);
$sermonogg = get_post_meta($post->ID, 'sermonogg', true);
$sermonauthor = get_post_meta($post->ID, 'sermonauthor', true);
?>

<label><strong>Url to sermon MP3. <a class="thickbox menu-top menu-top-first menu-top-last" href="<?php echo bloginfo("url"); ?>/wp-admin/media-upload.php?post_id=<?php echo $post->ID; ?>&type=image&TB_iframe=1&width=640&height=324">Upload one here</a> | <a href="http://www.youtube.com/watch?feature=player_detailpage&v=fFvRDFl4GvM#t=180s" target="_blank">Help!</a></strong></label><br />
<input name="sermonmp3" type="text" value="<?php echo $sermonmp3; ?>" />
<br /><br />
<label><strong>Url to sermon OGG. <a class="thickbox menu-top menu-top-first menu-top-last" href="<?php echo bloginfo("url"); ?>/wp-admin/media-upload.php?post_id=<?php echo $post->ID; ?>&type=image&TB_iframe=1&width=640&height=324">Upload one here</a> | IMPORTANT: If you don't upload both an OGG and MP3 version the audio will not work in all browsers.</strong></label><br />
<input name="sermonogg" type="text" value="<?php echo $sermonogg; ?>" />
<br /><br />
<label><strong>Sermon Author:</strong></label><br />
<input name="sermonauthor" type="text" value="<?php echo $sermonauthor; ?>" />
<br/><br/>

<?php
}


function save_sermon_info(){
global $post;
	if ($_POST["sermonmp3"] != ""){
		update_post_meta($post->ID, "sermonmp3", $_POST["sermonmp3"]);
	}
	if ($_POST["sermonogg"] != ""){
		update_post_meta($post->ID, "sermonogg", $_POST["sermonogg"]);
	}
	if ($_POST["sermonauthor"] != ""){
		update_post_meta($post->ID, "sermonauthor", $_POST["sermonauthor"]);
	}
	
	
}
//---------Sermon--------------------Sermon--------------------Sermon--------------------Sermon--------------------Sermon--------------------Sermon-----------

//---------Photo Album--------------------Photo Album--------------------Photo Album--------------------Photo Album--------------------Photo Album-----------:
/**
 * Enable Custom Post Types for Photo Albums
 */
 
// Registers the new post type and taxonomy
 
function photoalbum_posttype() {
	register_post_type( 'cpt_photoalbums',
		array(
			'labels' => array(
				'name' => __( 'Photo Albums' ),
				'singular_name' => __( 'Photo Album' ),
				'add_new' => __( 'Add New Photo Album' ),
				'add_new_item' => __( 'Add New Photo Album' ),
				'edit_item' => __( 'Edit Photo Album' ),
				'new_item' => __( 'Add New Photo Album' ),
				'view_item' => __( 'View Photo Album' ),
				'search_items' => __( 'Search Photo Album' ),
				'not_found' => __( 'No photoalbums found' ),
				'not_found_in_trash' => __( 'No photoalbums found in trash' )
			),
			'public' => true,
			'supports' => array( 'title', 'editor', 'thumbnail', 'comments'),
			'capability_type' => 'post',
			'rewrite' => array("slug" => "cpt_photoalbums"), // Permalinks format
			'menu_icon' => get_bloginfo('stylesheet_directory') . '/css/_img/cpt_photoalbums.png',  // Icon Path
			'menu_position' => '20'
		)
	);
	flush_rewrite_rules( false );
}
 
add_action( 'init', 'photoalbum_posttype' );

// Change the "Scheduled for" text on Photo Album post types changing the translation
// http://blog.ftwr.co.uk/archives/2010/01/02/mangling-strings-for-fun-and-profit/
function translation_mangler3($translation, $text, $domain) {
        global $post;
	if ($post->post_type == 'cpt_photoalbums') {
 
		$translations = &get_translations_for_domain( $domain);
		if ( $text == 'Scheduled for: <b>%1$s</b>') {
			return $translations->translate( 'Photo Album Date: <b>%1$s</b>' );
		}
		if ( $text == 'Published on: <b>%1$s</b>') {
			return $translations->translate( 'Photo Album Date: <b>%1$s</b>' );
		}
		if ( $text == 'Publish <b>immediately</b>') {
			return $translations->translate( 'Photo Album Date: <b>%1$s</b>' );
		}
	}
 
	return $translation;
}
 
add_filter('gettext', 'translation_mangler3', 10, 4);






add_action("admin_init", "admin_init_cpt_photoalbums");
add_action('save_post', 'save_photoalbum_info');

function admin_init_cpt_photoalbums(){
	add_meta_box("cpt_photoalbumsInfo-meta", "Photo Album Info", "cpt_photoalbums_meta_options", "cpt_photoalbums", "normal", "high");
}

function cpt_photoalbums_meta_options(){
	global $post;
	?>
    <p class="meta-options">
	<a class="thickbox menu-top menu-top-first menu-top-last" href="<?php echo bloginfo("url"); ?>/wp-admin/media-upload.php?post_id=<?php echo $post->ID; ?>&type=image&TB_iframe=1&width=640&height=324">Upload Photos</a> - <a href="http://www.youtube.com/watch?v=KZHpS1IMcWc" target="_blank"> Having Trouble? Help!</a>
	</p>
    <?php
}


function cpt_photoalbums_file_options(){
global $post;
$custom = get_post_custom($post->ID);
$photoalbumlink = get_post_meta($post->ID, 'photoalbumlink', true);
?>

<label><strong>Url to photoalbum. Make it a link to the fullscreen photoalbum. <a href="http://labnol.blogspot.com/2007/09/stretch-youtube-cpt_photoalbums-to-fit-browser.html">Tutorial for YouTube Photo Albums</a></strong></label><br />
<input name="photoalbumlink" type="text" value="<?php echo $photoalbumlink; ?>" />
<br/><br/>

<?php
}


function save_photoalbum_info(){
global $post;
	if ($_POST["photoalbumlink"] != ""){
		update_post_meta($post->ID, "photoalbumlink", $_POST["photoalbumlink"]);
	}
	
}
//---------Photo Album--------------------Photo Album--------------------Photo Album--------------------Photo Album--------------------Photo Album--------------------Photo Album-----------