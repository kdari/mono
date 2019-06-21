<?php

// Theme Prefix: dcs_

/* ========================================= Constants ========================================= */

if(!defined('DCS_THEME_DIR')) {
	define('DCS_THEME_DIR', dirname(__FILE__));
}

/* ========================================= File Includes ========================================= */

include(DCS_THEME_DIR . '/includes/scripts.php');

/* ========================================= General Things We Need ========================================= */

add_editor_style(); // Adds CSS to the editor to match the front end of the site.
add_theme_support('automatic-feed-links');
if ( ! isset( $content_width ) ) $content_width = 590; // This is the max width of the content, thus the max width of large images that are uploaded.
require_once(dirname(__FILE__) . "/includes/support/support.php"); // Load support tab

// Load Language File
load_theme_textdomain('designcrumbs', get_template_directory() . '/languages');
$locale = get_locale();
$locale_file = get_template_directory() . '/languages/$locale.php';
if ( is_readable($locale_file) )
	require_once($locale_file);
	
// Check for Options Framework Plugin
of_check();

function of_check() {
	if ( !function_exists('of_get_option') ) {
		wp_enqueue_script('thickbox', null, array('jquery'));
		add_action('admin_notices', 'of_check_notice');
	}
}

// The Admin Notice
function of_check_notice() {
?>
  <div class='updated fade'>
    <p>The <strong>Options Framework plugin</strong> is required for this theme to function properly. <a href="<?php echo network_admin_url('plugin-install.php?tab=plugin-information&plugin=options-framework&TB_iframe=true&width=640&height=517'); ?>" class="thickbox onclick">Install now</a>.</p>
  </div>
<?php
}

// Check for WP Email Capture
dcs_wpemailcapture_check();

function dcs_wpemailcapture_check() {
	if ( function_exists('wp_email_capture_plugins_loaded') ) {
		update_option('wp_email_capture_theme_affiliate_link', 'https://www.e-junkie.com/ecom/gb.php?ii=1130727&c=ib&aff=236565&cl=24404');
	}
}

/* =================================== Options Framework =================================== */

if ( !function_exists( 'of_get_option' ) ) {
	function of_get_option($name, $default = false) {
	    $optionsframework_settings = get_option('optionsframework');
	    
	    // Gets the unique option id
	    $option_name = $optionsframework_settings['id'];
	    if ( get_option($option_name) ) {
	        $options = get_option($option_name);
	    }
	    if ( isset($options[$name]) ) {
	        return $options[$name];
	    } else {
	        return $default;
	    }
	}
}

/* This one shows/hides the an option when a checkbox is clicked. */
 
add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');
 
function optionsframework_custom_scripts() { ?>
 
<script type="text/javascript">
jQuery(document).ready(function() {

	// adds support tab
	jQuery(".embed-themes").html("<iframe width='770' height='390' src='http://themes.designcrumbs.com/iframe/index.html'></iframe>");
 
 	// Checks for body style
	jQuery('#campaign-body_display-body_span').click(function() {
  		jQuery('#section-sticky_header').fadeIn(400);
	});
	
	jQuery('#campaign-body_display-body_boxed').click(function() {
  		jQuery('#section-sticky_header').fadeOut(400);
	});
 
	if (jQuery('#campaign-body_display-body_boxed').is(':checked')) {
		jQuery('#section-sticky_header').hide();
	};
	
	// Checks for home page video content
	jQuery('#campaign-video_type-none').click(function() {
  		jQuery('#section-youtube_id').hide();
  		jQuery('#section-vimeo_id').hide();
  		jQuery('#section-video_title').hide();
  		jQuery('#section-video_desc').hide();
	});
	
	jQuery('#campaign-video_type-youtube').click(function() {
  		jQuery('#section-vimeo_id').hide();
  		jQuery('#section-youtube_id').fadeIn(400);
  		jQuery('#section-video_title').fadeIn(400);
  		jQuery('#section-video_desc').fadeIn(400);
	});
	
	jQuery('#campaign-video_type-vimeo').click(function() {
  		jQuery('#section-youtube_id').hide();
  		jQuery('#section-vimeo_id').fadeIn(400);
  		jQuery('#section-video_title').fadeIn(400);
  		jQuery('#section-video_desc').fadeIn(400);
	});
 
	if (jQuery('#campaign-video_type-none').is(':checked')) {
		jQuery('#section-youtube_id').hide();
  		jQuery('#section-vimeo_id').hide();
  		jQuery('#section-video_title').hide();
  		jQuery('#section-video_desc').hide();
	};
	
	if (jQuery('#campaign-video_type-youtube').is(':checked')) {
		jQuery('#section-vimeo_id').hide();
	};
	
	if (jQuery('#campaign-video_type-vimeo').is(':checked')) {
		jQuery('#section-youtube_id').hide();
	};
	
	// Checks for home page post cats
	jQuery('#campaign-home_posts_selection-posts_specific').click(function() {
  		jQuery('#section-home_posts_cat').fadeIn(400);
	});
	
	jQuery('#campaign-home_posts_selection-posts_all').click(function() {
  		jQuery('#section-home_posts_cat').fadeOut(400);
	});
 
	if (jQuery('#campaign-home_posts_selection-posts_all').is(':checked')) {
		jQuery('#section-home_posts_cat').hide();
	};

});
</script>
 
<?php
}
 
/* Removes the code stripping */
 
add_action('admin_init','optionscheck_change_santiziation', 100);
 
function optionscheck_change_santiziation() {
    remove_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );
    add_filter( 'of_sanitize_textarea', 'of_sanitize_textarea_custom' );
}
 
function of_sanitize_textarea_custom($input) {
    global $allowedposttags;
        $of_custom_allowedtags["embed"] = array(
			"src" => array(),
			"type" => array(),
			"allowfullscreen" => array(),
			"allowscriptaccess" => array(),
			"height" => array(),
			"width" => array()
		);
		$of_custom_allowedtags["script"] = array(
			"type" => array()
		);
		$of_custom_allowedtags["iframe"] = array(
			"height" => array(),
			"width" => array(),
			"src" => array(),
			"frameborder" => array(),
			"allowfullscreen" => array()
		);
		$of_custom_allowedtags["object"] = array(
			"height" => array(),
			"width" => array()
		);
		$of_custom_allowedtags["param"] = array(
			"name" => array(),
			"value" => array()
		);
 
	$of_custom_allowedtags = array_merge($of_custom_allowedtags, $allowedposttags);
	$output = wp_kses( $input, $of_custom_allowedtags);
	return $output;
}

/* =================================== Add Fancybox to linked Images =================================== */

/**
 * Attach a class to linked images' parent anchors
 * e.g. a img => a.img img
 */
function give_linked_images_class($html, $id, $caption, $title, $align, $url, $size, $alt = '' ){
	$classes = 'lightbox'; // separated by spaces, e.g. 'img image-link'

	// check if there are already classes assigned to the anchor
	if ( preg_match('/<a.*? class=".*?">/', $html) ) {
		$html = preg_replace('/(<a.*? class=".*?)(".*?>)/', '$1 ' . $classes . '$2', $html);
	} else {
		$html = preg_replace('/(<a.*?)>/', '$1 class="' . $classes . '" >', $html);
	}
	return $html;
}
add_filter('image_send_to_editor','give_linked_images_class',10,8);

/* =================================== Add Menus =================================== */
add_theme_support( 'menus' );

register_nav_menus( array(
	'primary' => __( 'Main Menu', 'designcrumbs' )
) );

/* ========================================= Featured Images ========================================= */

add_theme_support( 'post-thumbnails', array( 'post', 'slides' ) ); /* ===== ADDS FEATURED IMAGE TO PAGES ===== */
add_image_size( 'blog_image', 590, 400, true ); /* ===== SETS FEATURED IMAGE SIZE  ===== */
add_image_size( 'slide_image', 600, 300, true ); /* ===== SETS FEATURED IMAGE SIZE  ===== */
add_image_size( 'single_latest', 170, 120, true ); /* ===== SETS FEATURED IMAGE SIZE  ===== */

/* =================================== Add Slides Post Type =================================== */

register_post_type('slides', array(
	'label' => __('Slides', 'designcrumbs'),
	'singular_label' => __('Slide', 'designcrumbs'),
	'public' => true,
	'show_ui' => true, // UI in admin panel
	'_builtin' => false, // It's a custom post type, not built in!
	'_edit_link' => 'post.php?post=%d',
	'capability_type' => 'post',
	'hierarchical' => false,
	'has_archive' => false,
	'supports' => array(
			'title',
			'thumbnail',)
	));
	
/* ====================================================== Slide Meta Box ====================================================== */

add_filter( 'cmb_meta_boxes', 'dcs_metaboxes' );
function dcs_metaboxes( array $meta_boxes ) {

	$prefix = '_dc_';

	$meta_boxes[] = array(
	    'id' => 'dc_slides_info',
	    'title' => __('Slide Contents (for image slide only)', 'designcrumbs'),
	    'pages' => array('slides'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
	    'fields' => array(
	   		array(
		        'name' => __('Slide Text', 'designcrumbs'),
		        'desc' => __('Enter text to be overlaid on the bottom of the slide image. Optional.', 'designcrumbs'),
		        'id' => $prefix . 'slide_text',
		        'type' => 'text'
		    ),
	        array(
		        'name' => __('Link', 'designcrumbs'),
		        'desc' => __('Enter a link (including the http://) if you would like the slide to link to somewhere. Optional.', 'designcrumbs'),
		        'id' => $prefix . 'slide_link',
		        'type' => 'text'
		    ),
	    )
	);
	$meta_boxes[] = array(
	    'id' => 'dc_slides',
	    'title' => __('Slide Video Embeds', 'designcrumbs'),
	    'pages' => array('slides'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
	    'fields' => array(
	        array(
		        'name' => __('YouTube Video ID', 'designcrumbs'),
		        'desc' => __('If the YouTube link is http://www.youtube.com/watch?v=Iv69kB_e9KY, the ID is Iv69kB_e9KY. Enter that ID above.', 'designcrumbs'),
		        'id' => $prefix . 'video_youtube',
		        'type' => 'text'
		    ),
	        array(
		        'name' => __('Vimeo Video ID', 'designcrumbs'),
		        'desc' => __('If the Vimeo link is http://vimeo.com/22639018, the ID is 22639018. Enter that ID above.', 'designcrumbs'),
		        'id' => $prefix . 'video_vimeo',
		        'type' => 'text'
		    )
	    )
	);
	$meta_boxes[] = array(
	    'id' => 'dc_media',
	    'title' => __('Video Embeds', 'designcrumbs'),
	    'pages' => array('post'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
	    'fields' => array(
	        array(
		        'name' => __('YouTube Video ID', 'designcrumbs'),
		        'desc' => __('If the YouTube link is http://www.youtube.com/watch?v=Iv69kB_e9KY, the ID is Iv69kB_e9KY. Enter that ID above.', 'designcrumbs'),
		        'id' => $prefix . 'media_youtube',
		        'type' => 'text'
		    ),
	        array(
		        'name' => __('Vimeo Video ID', 'designcrumbs'),
		        'desc' => __('If the Vimeo link is http://vimeo.com/22639018, the ID is 22639018. Enter that ID above.', 'designcrumbs'),
		        'id' => $prefix . 'media_vimeo',
		        'type' => 'text'
		    ),
	    )
	);
	return $meta_boxes;
}

add_action( 'init', 'dcs_initialize_cmb_meta_boxes', 9999 );
function dcs_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'lib/metabox/init.php';

}

/* =================================== The Excerpt =================================== */

function improved_trim_excerpt($text) {
        global $post;
        if ( '' == $text ) {
                $text = get_the_content('');
                $text = apply_filters('the_content', $text);
                $text = str_replace('\]\]\>', ']]&gt;', $text);
                $text = strip_tags($text, '<p>');
                $excerpt_length = 85;
                $words = explode(' ', $text, $excerpt_length + 1);
                if (count($words)> $excerpt_length) {
                        array_pop($words);
                        array_push($words, '...');
                        $text = implode(' ', $words);
                }
        }
        return $text;
}

remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'improved_trim_excerpt');

/* =================================== Count How Many Widgets are in a Sidebar =================================== */

function count_sidebar_widgets( $sidebar_id, $echo = true ) {
    $the_sidebars = wp_get_sidebars_widgets();
    if( !isset( $the_sidebars[$sidebar_id] ) )
        return __( 'Invalid sidebar ID', 'designcrumbs' );
    if( $echo )
        echo count( $the_sidebars[$sidebar_id] );
    else
        return count( $the_sidebars[$sidebar_id] );
}

// To call it on the front end - count_sidebar_widgets( 'some-sidebar-id' );

/* ========================================= Checks for subcategories for the archives ========================================= */

// If is category or subcategory of $cat_id
if (!function_exists('is_category_or_sub')) {
	function is_category_or_sub($cat_id = 0) {
	    foreach (get_the_category() as $cat) {
	    	if ($cat_id == $cat->cat_ID || cat_is_ancestor_of($cat_id, $cat)) return true;
	    }
	    return false;
	}
}

/* ========================================= Creates function to check if single page is in child category ========================================= */

if ( ! function_exists( 'post_is_in_descendant_category' ) ) {
	function post_is_in_descendant_category( $cats, $_post = null ) {
		foreach ( (array) $cats as $cat ) {
			// get_term_children() accepts integer ID only
			$descendants = get_term_children( (int) $cat, 'category' );
			if ( $descendants && in_category( $descendants, $_post ) )
				return true;
		}
		return false;
	}
}

/* ========================================= Sidebars ========================================= */

if ( function_exists('register_sidebars') )
	register_sidebar(array(
		'name' => 'Overall_Sidebar',
		'id' => 'Overall_Sidebar',
		'description' => __('These widgets will show up on every page and post, including to the side of the home page.', 'designcrumbs'),
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>'
	));
	register_sidebar(array(
		'name' => 'Pages_Sidebar',
		'id' => 'Pages_Sidebar',
		'description' => __('These widgets will show up only on all pages, except the home page.', 'designcrumbs'),
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>'
	));
	register_sidebar(array(
		'name' => 'Blog_Sidebar',
		'id' => 'Blog_Sidebar',
		'description' => __('These widgets will show up in the blog and on blog posts.', 'designcrumbs'),
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>'
	));
	register_sidebar(array(
		'name' => 'Top_Sidebar',
		'id' => 'Top_Sidebar',
		'description' => __('You have room here for one widget to go next to the slider on the home page. It&#39;s recommended to put an email signup, such as the WP Email Capture plugin by Rhys Wynne, or contact form here. On all other pages this widget will be displayed first in the sidebar', 'designcrumbs'),
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name' => 'Home_Page_Banner',
		'id' => 'Home_Page_Banner',
		'description' => __('These widgets show up in the banner just below the slider.', 'designcrumbs'),
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name' => 'Footer',
		'id' => 'Footer',
		'description' => __('These widgets will appear in the footer.', 'designcrumbs'),
		'before_widget' => '<div class="footer_widget">',
		'after_widget' => '</div>',
		'before_title' => '<h6 class="widgettitle">',
		'after_title' => '</h6>'
	));
	
	if ( function_exists('register_sidebar') ){
    register_sidebar(array(
        'name' => 'Social Widget area',
    	'id' => 'social_box',
        'description' => __( 'Social widget goes here' ),
        'before_widget' => '<div id="social">',
        'after_widget' => '</div>',

));
}
	


/* =================================== User Extras =================================== */

add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );

function my_show_extra_profile_fields( $user ) { ?>

	<h3><?php _e('Extra profile information', 'designcrumbs') ?></h3>

	<table class="form-table">

		<tr>
			<th><label for="twitter"><?php _e('Twitter', 'designcrumbs') ?></label></th>

			<td>
				<input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e('Please enter your Twitter username without the @.', 'designcrumbs') ?></span>
			</td>
		</tr>

	</table>
<?php }

add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );

function my_save_extra_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	update_user_meta( $user_id, 'twitter', $_POST['twitter'] );
}

function my_author_box() { ?>
			<div class="about_the_author">
				<?php echo get_avatar( get_the_author_meta('email'), '70' ); ?>
				<div class="author_info">
					<div class="author_title"><?php _e('This post was written by', 'designcrumbs') ?> <?php the_author_posts_link(); ?>
					</div>
					<div class="author_about">
					<?php the_author_meta( 'description' ); ?>
					</div>
					<?php if (get_the_author_meta('twitter') != '' || get_the_author_meta('url') != '' ) { ?>
					<div class="author_links">
						<?php if (get_the_author_meta('twitter') != '' ) { ?>
						<a href="http://twitter.com/<?php the_author_meta('twitter'); ?>" title="Follow <?php the_author_meta( 'display_name' ); ?> on Twitter"><?php _e('My Twitter', 'designcrumbs') ?> &raquo;</a>
						<?php } if (get_the_author_meta('url') != '' ) { ?>
						<a href="<?php the_author_meta('url'); ?>" title="My Website"><?php _e('My Website', 'designcrumbs') ?> &raquo;</a>
						<?php } ?>
					<div class="clear"></div>
					</div>
					<?php } // End check for twitter & url ?>
				</div>
				<div class="clear"></div>
			</div>
	<?php
}
	
/* =================================== Specific User Widget =================================== */

class featured_user_widget extends WP_Widget {

		//function to set up widget in admin
		function featured_user_widget() {
		
				$widget_ops = array( 'classname' => 'featured-user', 
				'description' => __('A widget that will display a specified user&#39;s gravatar, display name, bio, and link to their author post archive.', 'designcrumbs') );
				
				$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'featured-user' );
				$this->WP_Widget( 'featured-user', __('Featured User', 'designcrumbs'), $widget_ops, $control_ops );
		
		}


		//function to echo out widget on sidebar
		function widget( $args, $instance ) {
		extract( $args );
		
				$title = $instance['title'];
				
				echo $before_widget;
				echo "<div class='featured_user'>";
		
				// if user written title echo out
				if ( $title ){
				echo $before_title . $title . $after_title;
				}
			    //don't touch this!
				$userid = $instance['user_id'];
				
				//user information array
				//refer to http://codex.wordpress.org/Function_Reference/get_userdata
				$userinfo = get_userdata($userid);
				
				//user meta data
				//refer to http://codex.wordpress.org/Function_Reference/get_user_meta
				$userbio = get_user_meta($userid,'description',true);
				
				//user post url
				//refer to http://codex.wordpress.org/Function_Reference/get_author_posts_url
				$userposturl = get_author_posts_url($userid);	
				
				?>			
				
				<!--Now we print out speciifc user informations to screen!-->
				<div class='specific_user'>
				<a href='<?php echo $userposturl; ?>' title='<?php echo $userinfo->display_name; ?>'>
				<?php echo get_avatar($userid,58); ?>
				</a>
				<strong>
				<a href='<?php echo $userposturl; ?>' title='<?php echo $userinfo->display_name; ?>' class='featured_user_name'>
				<?php echo $userinfo->display_name; ?>
				</a></strong>
				<?php echo $userbio; ?>
				<?php/* <a href='<?php echo $userposturl; ?>' title='<?php echo $userinfo->display_name; ?>'>
				View Author's Posts &raquo;
				</a> */ ?>
				<div class="clear"></div>
				</div>
				<!--end-->
				
				<?php

				echo '</div>';
				echo $after_widget;
		
		 }//end of function widget



		//function to update widget setting
		function update( $new_instance, $old_instance ) {
		
				$instance = $old_instance;
				$instance['title'] = strip_tags( $new_instance['title'] );
				$instance['user_id'] = strip_tags( $new_instance['user_id'] );
				return $instance;
		
		}//end of function update


		//function to create Widget Admin form
		function form($instance) {
		
				$instance = wp_parse_args( (array) $instance, array( 'title' => '','user_id' => '') );
				
				$instance['title'] = $instance['title'];
				$instance['user_id'] = $instance['user_id'];
						
				?>

				<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title:', 'designcrumbs') ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>"
				 type="text" value="<?php echo $instance['title']; ?>" />
				</p>
				
				<p>
				<label for="<?php echo $this->get_field_id( 'user_id' ); ?>"><?php _e('Select User:', 'designcrumbs') ?></label> 
				<select id="<?php echo $this->get_field_id( 'user_id' );?>" name="<?php echo $this->get_field_name( 'user_id' );?>" class="widefat" style="width:100%;">

				<?php
				$instance = $instance['user_id'];
				$option_list = user_get_users_list_option($instance);
				echo $option_list;
				?>
				</select>
				
				</p>
				
				
				<?php
		
	      }//end of function form($instance)

}//end of  Class

//function to get all users
function user_get_users_list_option($instance){
$output = '';
global $wpdb; 
$users = $wpdb->get_results("SELECT display_name, ID FROM $wpdb->users");
	foreach($users as $u){
    $uname = $u->display_name;
    $uid = $u->ID;
    $output .="<option value='$uid'";
    if($instance == $uid){
    $output.= 'selected="selected"';
    } 
    $output.= ">$uname</option>";
	}
return $output;
}

register_widget('featured_user_widget');

/* =================================== Testimonial Widget =================================== */

class TestimonialWidget extends WP_Widget
{
 /**
  * Declares the TestimonialWidget class.
  *
  */
    function TestimonialWidget(){
    $widget_ops = array('classname' => 'widget_testimonial', 'description' => __('Displays a testimonial along with a name, company, and URL.', 'designcrumbs') );
    $control_ops = array('width' => 300, 'height' => 300);
    $this->WP_Widget('testimonial', __('Testimonial', 'designcrumbs'), $widget_ops, $control_ops);
    }

  /**
    * Displays the Widget
    *
    */
    function widget($args, $instance){
      extract($args);
      $testi_title = apply_filters('widget_title', empty($instance['testi_title']) ? '' : $instance['testi_title']);
      $testi_name = empty($instance['testi_name']) ? '' : $instance['testi_name'];
      $testi_company = empty($instance['testi_company']) ? '' : $instance['testi_company'];
      $testi_url = empty($instance['testi_url']) ? '' : $instance['testi_url'];
      $testi_testimonial = empty($instance['testi_testimonial']) ? '' : $instance['testi_testimonial'];

      # Before the widget
      echo '<div class="widget_testimonial widget">';

      # The title
      if ( $testi_title )
      	echo $before_title . $testi_title . $after_title;
		echo '<div class="the_testimonial">'.$testi_testimonial . '</div>';
		echo '<div class="the_testimonial_author">';
		echo '<strong>- ' . $testi_name . '</strong>';
      if ( $testi_url ) {
      	echo '<span><a href="'.$testi_url.'" title="'.$testi_company.'">' . $testi_company . '</a></span>';
      } else {
		echo '<span>' . $testi_company .'</span>';}
		echo '</div>';
		echo '<div class="clear"></div>';
		
      # After the widget
      echo '</div>';
  }

  /**
    * Saves the widgets settings.
    *
    */
    function update($new_instance, $old_instance){
      $instance = $old_instance;
      $instance['testi_title'] = strip_tags(stripslashes($new_instance['testi_title']));
      $instance['testi_name'] = strip_tags(stripslashes($new_instance['testi_name']));
      $instance['testi_company'] = strip_tags(stripslashes($new_instance['testi_company']));
      $instance['testi_url'] = strip_tags(stripslashes($new_instance['testi_url']));
      $instance['testi_testimonial'] = strip_tags(stripslashes($new_instance['testi_testimonial']));

    return $instance;
  }

  /**
    * Creates the edit form for the widget.
    *
    */
    function form($instance){
      //Defaults

      $testi_title = htmlspecialchars($instance['testi_title']);
      $testi_name = htmlspecialchars($instance['testi_name']);
      $testi_company = htmlspecialchars($instance['testi_company']);
      $testi_url = htmlspecialchars($instance['testi_url']);
      $testi_testimonial = htmlspecialchars($instance['testi_testimonial']);

    //output  
	# Title
	echo '<p><label for="' . $this->get_field_name('testi_title') . '">' . __('Title (Optional):', 'designcrumbs') . '</label><input class="widefat" id="' . $this->get_field_id('testi_title') . '" name="' . $this->get_field_name('testi_title') . '" type="text" value="' . $testi_title . '" /></p>';
	# Name
	echo '<p><label for="' . $this->get_field_name('testi_name') . '">' . __('Name:', 'designcrumbs') . '</label><input class="widefat" id="' . $this->get_field_id('testi_name') . '" name="' . $this->get_field_name('testi_name') . '" type="text" value="' . $testi_name . '" /></p>';
	# Company
	echo '<p><label for="' . $this->get_field_name('testi_company') . '">' . __('Company:', 'designcrumbs') . '</label><input class="widefat" id="' . $this->get_field_id('testi_company') . '" name="' . $this->get_field_name('testi_company') . '" type="text" value="' . $testi_company . '" /></p>';
	# URL
	echo '<p><label for="' . $this->get_field_name('testi_url') . '">' . __('URL:', 'designcrumbs') . '</label><input class="widefat" id="' . $this->get_field_id('testi_url') . '" name="' . $this->get_field_name('testi_url') . '" type="text" value="' . $testi_url . '" /></p>';
	# Testimonial
	echo '<p><label for="' . $this->get_field_name('testi_testimonial') . '">' . __('The Testimonial:', 'designcrumbs') . '</label><textarea class="widefat" id="' . $this->get_field_id('testi_testimonial') . '" cols="20" rows="6" value="' . $testi_testimonial . '" name="' . $this->get_field_name('testi_testimonial') . '">' . $testi_testimonial . '</textarea></p>';
  }

}// END class

  function TestimonialInit() {
  register_widget('TestimonialWidget');
  }
  add_action('widgets_init', 'TestimonialInit');

/* =================================== Text with a Button Widget =================================== */

class TextButtonWidget extends WP_Widget
{
 /**
  * Declares the TextButtonWidget class.
  *
  */
    function TextButtonWidget(){
    $widget_ops = array('classname' => 'widget_text_button', 'description' => __('Arbitrary text or HTML along with a button.', 'designcrumbs') );
    $control_ops = array('width' => 300, 'height' => 300);
    $this->WP_Widget('text_button', __('Text with a Button', 'designcrumbs'), $widget_ops, $control_ops);
    }

  /**
    * Displays the Widget
    *
    */
    function widget($args, $instance){
      extract($args);
      $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title']);
      $the_button_text = empty($instance['the_button_text']) ? '' : $instance['the_button_text'];
      $the_button_link = empty($instance['the_button_link']) ? '' : $instance['the_button_link'];
      $button_type = empty($instance['button_type']) ? 'button' : $instance['button_type'];
      $the_message = empty($instance['the_message']) ? '' : $instance['the_message'];

      # Before the widget
      echo $before_widget;

      # The title
      if ( $title )
      echo $before_title . $title . $after_title;

      echo '<div>' . $the_message . '</div><a href="' . $the_button_link . '" class="' . $button_type . '">' . $the_button_text . '</a>';

      # After the widget
      echo $after_widget;
  }

  /**
    * Saves the widgets settings.
    *
    */
    function update($new_instance, $old_instance){
      $instance = $old_instance;
      $instance['title'] = strip_tags(stripslashes($new_instance['title']));
      $instance['the_button_text'] = strip_tags(stripslashes($new_instance['the_button_text']));
      $instance['the_button_link'] = strip_tags(stripslashes($new_instance['the_button_link']));
      $instance['button_type'] = strip_tags(stripslashes($new_instance['button_type']));
      $instance['the_message'] = strip_tags(stripslashes($new_instance['the_message']));

    return $instance;
  }

  /**
    * Creates the edit form for the widget.
    *
    */
    function form($instance){
      //Defaults

      $title = htmlspecialchars($instance['title']);
      $the_button_text = htmlspecialchars($instance['the_button_text']);
      $the_button_link = htmlspecialchars($instance['the_button_link']);
      $button_type = htmlspecialchars($instance['button_type']);
      $the_message = htmlspecialchars($instance['the_message']);

    //output  
	# Title
	echo '<label for="' . $this->get_field_name('title') . '">' . __('Title:', 'designcrumbs') . '</label><input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" />';
	# Message
	echo '<label for="' . $this->get_field_name('the_message') . '">' . __('The Message:', 'designcrumbs') . '</label><textarea class="widefat" id="' . $this->get_field_id('the_message') . '" cols="20" rows="6" value="' . $the_message . '" name="' . $this->get_field_name('the_message') . '">' . $the_message . '</textarea>';
	# Button Text
	echo '<label for="' . $this->get_field_name('the_button_text') . '">' . __('Button Text:', 'designcrumbs') . '</label><input class="widefat" id="' . $this->get_field_id('the_button_text') . '" name="' . $this->get_field_name('the_button_text') . '" type="text" value="' . $the_button_text . '" />';
	# Button Link
	echo '<label for="' . $this->get_field_name('the_button_link') . '">' . __('Button Link (including http):', 'designcrumbs') . '</label><input class="widefat" id="' . $this->get_field_id('the_button_link') . '" name="' . $this->get_field_name('the_button_link') . '" type="text" value="' . $the_button_link . '" />';
	# Button Type
	echo '<label for="' . $this->get_field_name('button_type') . '">' . __('Button Color:', 'designcrumbs') . '</label><select class="widefat" id="' . $this->get_field_id('button_type') . '" name="' . $this->get_field_name('button_type') . '"><option value="button" '. ( ($button_type == "button") ? "selected='selected'"   : "") .'>' . __('Blue', 'designcrumbs') . '</option><option value="button button_red" '. ( ($button_type == "button button_red") ? "selected='selected'"   : "") .'>' . __('Red', 'designcrumbs') . '</option><option value="button button_gray" '. ( ($button_type == "button button_gray") ? "selected='selected'"   : "") .'>' . __('Gray', 'designcrumbs') . '</option></select>';


  }

}// END class

  function TextButtonInit() {
  register_widget('TextButtonWidget');
  }
  add_action('widgets_init', 'TextButtonInit');

/* =================================== SlabText Widget =================================== */

class SlabTextWidget extends WP_Widget
{
 /**
  * Declares the SlabTextWidget class.
  *
  */
    function SlabTextWidget(){
    $widget_ops = array('classname' => 'widget_slabtext', 'description' => __('Text headline that forms the area it&#39;s in to make some cool typography.', 'designcrumbs') );
    $control_ops = array('width' => 300, 'height' => 300);
    $this->WP_Widget('slabtext', __('Slab Text', 'designcrumbs'), $widget_ops, $control_ops);
    }

  /**
    * Displays the Widget
    *
    */
    function widget($args, $instance){
      extract($args);
      $line1 = empty($instance['line1']) ? '' : $instance['line1'];
      $line2 = empty($instance['line2']) ? '' : $instance['line2'];
      $line3 = empty($instance['line3']) ? '' : $instance['line3'];
      $line4 = empty($instance['line4']) ? '' : $instance['line4'];
      $line5 = empty($instance['line5']) ? '' : $instance['line5'];

      # Before the widget
      echo $before_widget;

      echo '<div class="slabload">
			<div class="slabwrap">
				<h1 class="slabtextdone">
					<span class="slabtext">'. strtoupper($line1) .'</span>
					<span class="slabtext">'. strtoupper($line2) .'</span>
					<span class="slabtext">'. strtoupper($line3) .'</span>
					<span class="slabtext">'. strtoupper($line4) .'</span>
					<span class="slabtext">'. strtoupper($line5) .'</span>
				</h1>
			</div>
		</div>';

      # After the widget
      echo $after_widget;
  }

  /**
    * Saves the widgets settings.
    *
    */
    function update($new_instance, $old_instance){
      $instance = $old_instance;
      $instance['line1'] = strip_tags(stripslashes($new_instance['line1']));
      $instance['line2'] = strip_tags(stripslashes($new_instance['line2']));
      $instance['line3'] = strip_tags(stripslashes($new_instance['line3']));
      $instance['line4'] = strip_tags(stripslashes($new_instance['line4']));
      $instance['line5'] = strip_tags(stripslashes($new_instance['line5']));

    return $instance;
  }

  /**
    * Creates the edit form for the widget.
    *
    */
    function form($instance){
      //Defaults

      $line1 = htmlspecialchars($instance['line1']);
      $line2 = htmlspecialchars($instance['line2']);
      $line3 = htmlspecialchars($instance['line3']);
      $line4 = htmlspecialchars($instance['line4']);
      $line5 = htmlspecialchars($instance['line5']);

    //output  
	# Line1
	echo '<label for="' . $this->get_field_name('line1') . '">' . __('Line 1:', 'designcrumbs') . '</label><input class="widefat" id="' . $this->get_field_id('line1') . '" name="' . $this->get_field_name('line1') . '" type="text" value="' . $line1 . '" />';
	# Line2
	echo '<label for="' . $this->get_field_name('line1') . '">' . __('Line 2:', 'designcrumbs') . '</label><input class="widefat" id="' . $this->get_field_id('line2') . '" name="' . $this->get_field_name('line2') . '" type="text" value="' . $line2 . '" />';
	# Line3
	echo '<label for="' . $this->get_field_name('line1') . '">' . __('Line 3:', 'designcrumbs') . '</label><input class="widefat" id="' . $this->get_field_id('line3') . '" name="' . $this->get_field_name('line3') . '" type="text" value="' . $line3 . '" />';
	# Line4
	echo '<label for="' . $this->get_field_name('line1') . '">' . __('Line 4:', 'designcrumbs') . '</label><input class="widefat" id="' . $this->get_field_id('line4') . '" name="' . $this->get_field_name('line4') . '" type="text" value="' . $line4 . '" />';
	# Line5
	echo '<label for="' . $this->get_field_name('line1') . '">' . __('Line 5:', 'designcrumbs') . '</label><input class="widefat" id="' . $this->get_field_id('line5') . '" name="' . $this->get_field_name('line5') . '" type="text" value="' . $line5 . '" />';
  }

}// END class

  function SlabTextWidget() {
  register_widget('SlabTextWidget');
  }
  add_action('widgets_init', 'SlabTextWidget');

/* ====================================================== COMMENTS ====================================================== */

function custom_comment($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment; ?>
<li <?php comment_class(); ?> id="comment-<?php comment_ID( ); ?>">
<div class="the_comment">
<?php if(function_exists('get_avatar')) { echo get_avatar($comment, '50'); } ?>
<div class="the_comment_author"><strong><?php comment_author_link() ?></strong> <?php _e('says', 'designcrumbs'); ?></div>
<?php if ($comment->comment_approved == '0') : //message if comment is held for moderation ?>
<br><em><?php _e('Your comment is awaiting moderation', 'designcrumbs'); ?>.</em><br>
<?php endif; ?>
<div class="the_comment_text"><?php comment_text() ?></div>
<small class="commentmetadata">
<?php comment_date(get_option( 'date_format' )) ?> - <?php comment_date('g:i a') ?> - <a href="<?php comment_link() ?>" class="comment_permalink"><?php _e('Permalink', 'designcrumbs'); ?></a>
</small>
<div class="reply">
<?php edit_comment_link( __('Edit', 'designcrumbs'),'',' &nbsp;|&nbsp; '); ?><?php echo comment_reply_link(array('reply_text' => __('Reply', 'designcrumbs'), 'depth' => $depth, 'max_depth' => $args['max_depth']));  ?>
</div>
<div class="clear"></div>
</div>
<?php } function custom_pings($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment; ?>
<li <?php comment_class(); ?> id="comment-<?php comment_ID( ); ?>">
<?php _e('Trackback from', 'designcrumbs'); ?> <em><?php comment_author_link() ?></em>
<div class="the_comment_text"><?php comment_text() ?></div>
<small class="commentmetadata">
<?php comment_date(get_option( 'date_format' )) ?>
</small>
<div class="clear"></div>
<?php }

add_filter('get_comments_number', 'comment_count', 0);
function comment_count( $count ) {
	global $id;
	$comments_by_type = &separate_comments(get_comments('post_id=' . $id));
	return count($comments_by_type['comment']);
}

/* ====================================================== PRESSTRENDS ====================================================== */
if (of_get_option('presstrends') == 'optin') {

/**
* PressTrends Theme API
*/
function presstrends_theme() {

		// PressTrends Account API Key
		$api_key = '1x4ox5f40ysz73fsqt9x0npg9a2dswj0164d';
		$auth = '5nps3sw9i71opluqjs4kd2b296dothhod';

		// Start of Metrics
		global $wpdb;
		$data = get_transient( 'presstrends_theme_cache_data' );
		if ( !$data || $data == '' ) {
			$api_base = 'http://api.presstrends.io/index.php/api/sites/add/auth/';
			$url      = $api_base . $auth . '/api/' . $api_key . '/';

			$count_posts    = wp_count_posts();
			$count_pages    = wp_count_posts( 'page' );
			$comments_count = wp_count_comments();

			// wp_get_theme was introduced in 3.4, for compatibility with older versions.
			if ( function_exists( 'wp_get_theme' ) ) {
				$theme_data    = wp_get_theme();
				$theme_name    = urlencode( $theme_data->Name );
				$theme_version = $theme_data->Version;
			} else {
				$theme_data = wp_get_theme( get_stylesheet_directory() . '/style.css' );
				$theme_name = $theme_data['Name'];
				$theme_versino = $theme_data['Version'];
			}

			$plugin_name = '&';
			foreach ( get_plugins() as $plugin_info ) {
				$plugin_name .= $plugin_info['Name'] . '&';
			}
			$posts_with_comments = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts WHERE post_type='post' AND comment_count > 0" );
			$data                = array(
				'url'             => stripslashes( str_replace( array( 'http://', '/', ':' ), '', site_url() ) ),
				'posts'           => $count_posts->publish,
				'pages'           => $count_pages->publish,
				'comments'        => $comments_count->total_comments,
				'approved'        => $comments_count->approved,
				'spam'            => $comments_count->spam,
				'pingbacks'       => $wpdb->get_var( "SELECT COUNT(comment_ID) FROM $wpdb->comments WHERE comment_type = 'pingback'" ),
				'post_conversion' => ( $count_posts->publish > 0 && $posts_with_comments > 0 ) ? number_format( ( $posts_with_comments / $count_posts->publish ) * 100, 0, '.', '' ) : 0,
				'theme_version'   => $theme_version,
				'theme_name'      => $theme_name,
				'site_name'       => str_replace( ' ', '', get_bloginfo( 'name' ) ),
				'plugins'         => count( get_option( 'active_plugins' ) ),
				'plugin'          => urlencode( $plugin_name ),
				'wpversion'       => get_bloginfo( 'version' ),
				'api_version'	  => '2.4',
			);

			foreach ( $data as $k => $v ) {
				$url .= $k . '/' . $v . '/';
			}
			wp_remote_get( $url );
			set_transient( 'presstrends_theme_cache_data', $data, 60 * 60 * 24 );
		}
}

// PressTrends WordPress Action
add_action('admin_init', 'presstrends_theme');
		

}
?>