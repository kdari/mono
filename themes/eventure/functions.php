<?php

if ( ! isset( $content_width ) ) $content_width = 600;

//BACKGROUND
add_custom_background();

//EXCERPT STUFF
function new_excerpt_length($length) {
	return 20;
}
add_filter('excerpt_length', 'new_excerpt_length');
function new_excerpt_more($more) {
       global $post;
	return ' ... <a href="'. get_permalink($post->ID) . '">' . 'Continue &rarr;' . '</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

//IMAGE ATTACHMENTS TOOLBOX
function attachment_toolbox($size = thumbnail) {

	if($images = get_children(array(
		'post_parent'    => get_the_ID(),
		'post_type'      => 'attachment',
		'numberposts'    => -1, // show all
		'post_status'    => null,
		'post_mime_type' => 'image',
		'orderby' => 'menu_order'
	))) {
		foreach($images as $image) {
			$attimg   = wp_get_attachment_image($image->ID,$size);
			$atturl   = wp_get_attachment_url($image->ID);
			$attlink  = get_attachment_link($image->ID);
			$postlink = get_permalink($image->post_parent);
			$atttitle = apply_filters('the_title',$image->post_title);
			echo'<li class="wrapperli"><a rel="prettyPhoto[pp_gal]" href="'.$atturl.'">'.$attimg.'</a></li>';
		}
	}
}

add_theme_support('automatic-feed-links' );

//WELCOME TO THE FUTURE
function setup_future_hook() {
 // Replace native future_post function with replacement
 remove_action('future_post', '_future_post_hook');
 add_action('future_post', 'publish_future_post_now');
}
function publish_future_post_now($id) {
 // Set new post's post_status to "publish" rather than "future."
 wp_publish_post($id);
}
add_action('init', 'setup_future_hook');

//FEATURED IMAGE SUPPORT
add_theme_support( 'post-thumbnails', array( 'post','page' ) );
set_post_thumbnail_size( 600, 350, true );
add_image_size( 'slider',900 ,350, true );
add_image_size( 'small',50 ,50, true );

//CATEGORY ID FROM NAME FOR PAGE TEMPLATES
function get_category_id($cat_name){
	$term = get_term_by('name', $cat_name, 'category');
	return $term->term_id;
}

//ADD MENU SUPPORT
add_theme_support( 'menus' );
register_nav_menu('main', 'Main Navigation Menu');

//REPLACE FOOTER INFO
function remove_footer_admin () {
    echo "Theme designed and developed by <a href='http://themeforest.net/user/themolitor/portfolio?ref=themolitor'>THE MOLITOR</a>";
} 
add_filter('admin_footer_text', 'remove_footer_admin');

//BREADCRUMBS
function dimox_breadcrumbs() {
  $delimiter = '&nbsp;/&nbsp;';
  $name = 'Home';
  $currentBefore = '<span class="current">';
  $currentAfter = '</span>';
  if ( !is_home() && !is_front_page() || is_paged() ) {
    echo '<div id="crumbs">';
    global $post;
    $home = home_url();
    echo '<a href="' . $home . '">' . $name . '</a> ' . $delimiter . ' ';
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $currentBefore . '';
      single_cat_title();
      echo '' . $currentAfter;
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('d') . $currentAfter;
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('F') . $currentAfter;
    } elseif ( is_year() ) {
      echo $currentBefore . get_the_time('Y') . $currentAfter;
    } elseif ( is_single() && !is_attachment() ) {
      $cat = get_the_category(); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo $currentBefore;
      //the_title();
      echo "Current Page";
      echo $currentAfter;
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
      echo $currentBefore;
      the_title();
      echo $currentAfter;
    } elseif ( is_page() && !$post->post_parent ) {
      echo $currentBefore;
      //the_title();
      echo "Current Page";
      echo $currentAfter;
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $currentBefore;
      //the_title();
      echo "Current Page";
      echo $currentAfter;
    } elseif ( is_search() ) {
      echo $currentBefore . 'Search Results' . $currentAfter;
    } elseif ( is_tag() ) {
      echo $currentBefore . 'Posts tagged &#39;';
      single_tag_title();
      echo '&#39;' . $currentAfter;
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $currentBefore . 'Articles posted by ' . $userdata->display_name . $currentAfter;
    } elseif ( is_404() ) {
      echo $currentBefore . 'Error 404' . $currentAfter;
    }
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
    echo '</div>';
  }
}

//SIDEBAR GENERATOR (FOR SIDEBAR AND FOOTER)-----------------------------------------------
if ( function_exists('register_sidebar') )
register_sidebar(array('name'=>'Live Widgets',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widgettitle"><span>',
		'after_title' => '</span></h3>',
));

//CUSOTM POST OPTIONS
$key = "key";

$meta_boxes = array(

"google_map" => array(
"name" => "google_map",
"title" => "Google Map Link",
"description" => "You can generate a link here: <a target='_blank' href='http://maps.google.com/'>http://maps.google.com/</a><br /><br /><img src='".get_template_directory_uri()."/images/google_map_link.png' alt='' />")

);
function create_meta_box() {
	global $key;
	if( function_exists( 'add_meta_box' ) ) {
		add_meta_box( 'new-meta-boxes', ' Custom Post Options', 'display_meta_box', 'post', 'normal', 'high' );
	}
}
function display_meta_box() {
	global $post, $meta_boxes, $key;
?>
<div class="form-wrap">
<?php wp_nonce_field( plugin_basename( __FILE__ ), $key . '_wpnonce', false, true );
foreach($meta_boxes as $meta_box) {
	$data = get_post_meta($post->ID, $key, true);
?>
<div class="form-field form-required">
	<label for="<?php echo $meta_box[ 'name' ]; ?>"><?php echo $meta_box[ 'title' ]; ?></label>
	<input type="text" name="<?php echo $meta_box[ 'name' ]; ?>" value="<?php echo htmlspecialchars( $data[ $meta_box[ 'name' ] ] ); ?>" />
	<p><?php echo $meta_box[ 'description' ]; ?></p>
</div>
<?php } ?>
</div>
<?php
}
function save_meta_box( $post_id ) {
	global $post, $meta_boxes, $key;
	foreach( $meta_boxes as $meta_box ) {
		$data[ $meta_box[ 'name' ] ] = $_POST[ $meta_box[ 'name' ] ];
	}
	if ( !wp_verify_nonce( $_POST[ $key . '_wpnonce' ], plugin_basename(__FILE__) ) )
	return $post_id;
	if ( !current_user_can( 'edit_post', $post_id ))
	return $post_id;
	update_post_meta( $post_id, $key, $data );
}
add_action( 'admin_menu', 'create_meta_box' );
add_action( 'save_post', 'save_meta_box' );


// Create a new filtering function that will add our where clause to the query
function filter_where( $where = '' ) {
// show only post in future
$now = date("Y-m-d");
$where .= " AND post_date>='$now'";
return $where;
}
// end of code
?>