<?php
/**
 * Ezekiel functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, ezekiel_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'ezekiel_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Ezekiel
 * @since Ezekiel 3.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640;

/** Tell WordPress to run ezekiel_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'ezekiel_setup' );

if ( ! function_exists( 'ezekiel_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override ezekiel_setup() in a child theme, add your own ezekiel_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Ten 1.0
 */
 


/*-----------------------------------------------------------------------------------*/
/* Options Framework Functions
/*-----------------------------------------------------------------------------------*/

/* Set the file path based on whether the Options Framework is in a parent theme or child theme */

if ( STYLESHEETPATH == TEMPLATEPATH ) {
	define('OF_FILEPATH', TEMPLATEPATH);
	define('OF_DIRECTORY', get_bloginfo('template_directory'));
} else {
	define('OF_FILEPATH', STYLESHEETPATH);
	define('OF_DIRECTORY', get_bloginfo('stylesheet_directory'));
}

/* These files build out the options interface.  Likely won't need to edit these. */

require_once (OF_FILEPATH . '/admin/admin-functions.php');		// Custom functions and plugins
require_once (OF_FILEPATH . '/admin/admin-interface.php');		// Admin Interfaces (options,framework, seo)

/* These files build out the theme specific options and associated functions. */

require_once (OF_FILEPATH . '/admin/theme-options.php'); 		// Options panel settings and custom settings
require_once (OF_FILEPATH . '/admin/theme-functions.php'); 	// Theme actions based on options settings


/*-----------------------------------------------------------------------------------*/
/* END OF Options Framework Functions
/*-----------------------------------------------------------------------------------*/

//define links to functions and includes
$functions_path = TEMPLATEPATH . '/functions/';
$includes_path = TEMPLATEPATH . '/includes/';

//Custom Post Types
require_once ($includes_path . 'custom-post-types.php'); 			// Options panel settings and custom settings

//sermon RSS
require_once ($includes_path . 'sermon-popup/sermon-rss.php'); 			// Options panel settings and custom settings

//Podcast RSS
require_once ($includes_path . 'podcast.php'); 			// Options panel settings and custom settings


//Get current Page name:
function curPageName() {
 return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
}

//ADMIN ColorBox Popup Javascript
function colorbox (){
	if (curPageName() != "nav-menus.php"){
	?>
    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>-->
	<link type="text/css" media="screen" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/colorbox/colorbox.css" />
	<script src="<?php echo get_template_directory_uri(); ?>/js/colorbox/jquery.colorbox.js"></script>
    <script>
        $(document).ready(function(){
            //Examples of how to assign the ColorBox event to elements
            
            $(".fileupload").colorbox({width:"700px", height:"500px", iframe:true});
            
            
            //Example of preserving a JavaScript event for inline calls.
            $("#click").click(function(){ 
                $('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
                return false;
            });
        });
    </script>
    <?php
	}
}        
add_action('admin_head', 'colorbox');



function ezekiel_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'ezekiel', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'ezekiel' ),
	) );

	
}
endif;

if ( ! function_exists( 'ezekiel_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in ezekiel_setup().
 *
 * @since Twenty Ten 1.0
 */
function ezekiel_admin_header_style() {
?>
<style type="text/css">
/* Shows the same border as on front end */
#headimg {
	border-bottom: 1px solid #000;
	border-top: 4px solid #000;
}
/* If NO_HEADER_TEXT is false, you would style the text with these selectors:
	#headimg #name { }
	#headimg #desc { }
*/
</style>
<?php
}
endif;

/**
 * Makes some changes to the <title> tag, by filtering the output of wp_title().
 *
 * If we have a site description and we're viewing the home page or a blog posts
 * page (when using a static front page), then we will add the site description.
 *
 * If we're viewing a search result, then we're going to recreate the title entirely.
 * We're going to add page numbers to all titles as well, to the middle of a search
 * result title and the end of all other titles.
 *
 * The site title also gets added to all titles.
 *
 * @since Twenty Ten 1.0
 *
 * @param string $title Title generated by wp_title()
 * @param string $separator The separator passed to wp_title(). Twenty Ten uses a
 * 	vertical bar, "|", as a separator in header.php.
 * @return string The new title, ready for the <title> tag.
 */
function ezekiel_filter_wp_title( $title, $separator ) {
	// Don't affect wp_title() calls in feeds.
	if ( is_feed() )
		return $title;

	// The $paged global variable contains the page number of a listing of posts.
	// The $page global variable contains the page number of a single post that is paged.
	// We'll display whichever one applies, if we're not looking at the first page.
	global $paged, $page;

	if ( is_search() ) {
		// If we're a search, let's start over:
		$title = sprintf( __( 'Search results for %s', 'ezekiel' ), '"' . get_search_query() . '"' );
		// Add a page number if we're on page 2 or more:
		if ( $paged >= 2 )
			$title .= " $separator " . sprintf( __( 'Page %s', 'ezekiel' ), $paged );
		// Add the site name to the end:
		$title .= " $separator " . get_bloginfo( 'name', 'display' );
		// We're done. Let's send the new title back to wp_title():
		return $title;
	}

	// Otherwise, let's start by adding the site name to the end:
	$title .= get_bloginfo( 'name', 'display' );

	// If we have a site description and we're on the home/front page, add the description:
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $separator " . $site_description;

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $separator " . sprintf( __( 'Page %s', 'ezekiel' ), max( $paged, $page ) );

	// Return the new title to wp_title():
	return $title;
}
add_filter( 'wp_title', 'ezekiel_filter_wp_title', 10, 2 );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since Twenty Ten 1.0
 */
function ezekiel_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'ezekiel_page_menu_args' );

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since Twenty Ten 1.0
 * @return int
 */
function ezekiel_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'ezekiel_excerpt_length' );


/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Twenty Ten's style.css.
 *
 * @since Twenty Ten 1.0
 * @return string The gallery style filter, with the styles themselves removed.
 */
function ezekiel_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'ezekiel_remove_gallery_css' );


/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override ezekiel_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since Twenty Ten 1.0
 * @uses register_sidebar
 */
 
 
 if ( function_exists('register_sidebar') ){
    register_sidebar(array(
        'name' => 'Front Page Box 1',
    	'id' => 'f_p_box1',
        'description' => __( 'If using a different size image than 220px by 170px be sure to set the width and height to those dimensions in the widget, or the image may go outside of the box.' ),
        'before_widget' => '<div id="box1">',
        'after_widget' => '</div>',

));
}

if ( function_exists('register_sidebar') ){
    register_sidebar(array(
        'name' => 'Front Page Box 2',
        'id' => 'f_p_box2',
        'before_widget' => '<div id="box2">',
        'after_widget' => '</div>',

));
}
 
 
 
function ezekiel_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'ezekiel' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'ezekiel' ),
		'before_widget' => '<section>',
		'after_widget' => '</section>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	
}
/** Register sidebars by running ezekiel_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'ezekiel_widgets_init' );



// Get author image URL
global $wp_version;

if ( empty($wp_version) || version_compare($wp_version, '2.5', '<') ) { // WP 2.4 or less
    wp_die(__('This version of GetAvatarImg Plugin requires WordPress version 2.5 or newer.'));
}


// use it just as get_avatar
function get_avatar_img($id_or_email, $size = '96', $default = '', $alt = false){
	// retrieves the avatar
	$avatar = get_avatar($id_or_email, $size, $default, $alt);
	// image parsing
	$openPos = strpos($avatar, 'src=\'');
	$closePos = strpos(substr($avatar, ($openPos+5)), '\'');
	$newAvatar = substr($avatar, ($openPos+5), ($closePos-($openPos+5)) );
	
	// returns the url
	return $newAvatar;
}
/**--------------------------------------------
/**--------------------------------------------Widgets
/**--------------------------------------------
 * linksWidget Class
 */
class linksWidget extends WP_Widget {
    /** constructor */
    function linksWidget() {
        parent::WP_Widget(false, $name = 'Social Links');	
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {	
		?>
       <section id="social">
				<ul>
                <?php if (get_option('cap_feedburner') != "Your Feedburner URL"){ if (get_option('cap_feedburner') != ""){; ?>
					<li class="rss"><a href="<?php echo get_option('cap_feedburner'); ?>">Subscribe</a></li>
                <?php } } ?>
                <?php if (get_option('cap_twitter_username') != "Your Twitter Username"){ if (get_option('cap_twitter_username') != ""){; ?>
					<li class="follow"><a href="http://twitter.com/<?php echo get_option('cap_twitter_username'); ?>">Follow</a></li>
                <?php }} ?>
                <?php if (get_option('cap_facebook_url') != "Your Facebook URL"){ if (get_option('cap_facebook_url') != ""){; ?>
					<li class="like"><a href="<?php echo get_option('cap_facebook_url'); ?>">Like</a></li>
                <?php }} ?>
				</ul>
			</section>
            <?php wp_reset_query(); ?>
            <?php
        
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

} // class linksWidget

// register linksWidget widget
add_action('widgets_init', create_function('', 'return register_widget("linksWidget");'));

/**--------------------------------------------
/**--------------------------------------------Widgets
/**--------------------------------------------
 * adsWidget Class
 */
class adsWidget extends WP_Widget {
    /** constructor */
    function adsWidget() {
        parent::WP_Widget(false, $name = 'Advertisement Boxes');	
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {	
		?>
       <section id="advertisements">
				<ul>
                 <?php if (get_option('cap_adbox_1') != "1st Adbox Image"){ if (get_option('cap_adbox_1') != ""){; ?>
					<li>
						<a href="<?php echo get_option('cap_adbox_link_1'); ?>"><img src="<?php echo get_option('cap_adbox_1'); ?>" width="125px" height="125px" alt="Advertisement 1" /></a>
					</li>
                 <?php }} ?>
                 <?php if (get_option('cap_adbox_2') != "2nd Adbox Image"){ if (get_option('cap_adbox_2') != ""){; ?>
					<li>
						<a href="<?php echo get_option('cap_adbox_link_2'); ?>"><img src="<?php echo get_option('cap_adbox_2'); ?>" width="125px" height="125px" alt="Advertisement 2" /></a>
					</li>
                 <?php }} ?>
                 <?php if (get_option('cap_adbox_3') != "3rd Adbox Image"){ if (get_option('cap_adbox_3') != ""){; ?>
					<li>
						<a href="<?php echo get_option('cap_adbox_link_3'); ?>"><img src="<?php echo get_option('cap_adbox_3'); ?>" width="125px" height="125px" alt="Advertisement 3" /></a>
					</li>
                 <?php }} ?>
                 <?php if (get_option('cap_adbox_4') != "4th Adbox Image"){ if (get_option('cap_adbox_4') != ""){; ?>
					<li>
						<a href="<?php echo get_option('cap_adbox_link_4'); ?>"><img src="<?php echo get_option('cap_adbox_4'); ?>" width="125px" height="125px" alt="Advertisement 4" /></a>
					</li>
                 <?php }} ?>
				</ul>																			
			</section>
            <?php wp_reset_query(); ?>
            <?php
        
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

} // class adsWidget

// register adsWidget widget
add_action('widgets_init', create_function('', 'return register_widget("adsWidget");'));

/**--------------------------------------------
/**--------------------------------------------Widgets
/**--------------------------------------------
 * sermonWidget Class
 */
class sermonWidget extends WP_Widget {
    /** constructor */
    function sermonWidget() {
        parent::WP_Widget(false, $name = 'Sermon Widget');	
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {	
		?>
       <section id="latest-sermon">
				<h3>Latest Sermon</h3>
				<div class="module">
					<div class="lines-top"><div class="lines-bottom">
							 <?php
							 $argssidebar = array( 'post_type' => 'cpt_sermons', 'showposts' => 1);
							 $the__sermons_query = new WP_Query($argssidebar);	
							 global $post;
							 $sermonposts = get_posts($argssidebar);
							 
							
                       
							 foreach($sermonposts as $post) : 
                             $xml = (get_bloginfo('wpurl') . "/QUESTIONfeed=audioANDpid=" . $post->ID); ?>
 
							<script type="text/javascript">
                            <!--
                            function sidebar_sermon_popup() {
                            window.open( "<?php echo get_template_directory_uri();?>/includes/sermon-popup/?xml=<?php echo $xml; ?>", "myWindow", 
                            "status = 1, height = 116, width = 422, resizable = 0" )
                            }
                            //-->
                            </script>
                            
                       		<ul>						
							<li class="dl">
								<p class="latest-dl">Latest Sermon Download</p>
								<p class="listen"><a onClick="sidebar_sermon_popup()" href="">Listen</a></p>
                                
							</li>
							<li class="dl-details">
								<ul>
									<li>Sermon: <?php the_title(); ?></li>
									<li>Pastor: <?php echo get_post_meta($post->ID, 'sermonauthor', true); ?></li>
									<li>Date: <?php the_time('M j, Y'); ?></li>
								</ul>
							<?php endforeach; 
                            wp_reset_query();
                            ?>
							</li>
						</ul>
					</div></div>
				</div>
			</section>
            <?php wp_reset_query(); ?>
            <?php
        
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

} // class sermonWidget

// register sermonWidget widget
add_action('widgets_init', create_function('', 'return register_widget("sermonWidget");'));

/**--------------------------------------------
/**--------------------------------------------Widgets
/**--------------------------------------------
 * photosWidget Class
 */
class photosWidget extends WP_Widget {
    /** constructor */
    function photosWidget() {
        parent::WP_Widget(false, $name = 'Photos Widget');	
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {	
		?>
      <section id="latest-photos">
				<h3>Latest Photos</h3>
				<ul id="gallery-listing">
                <?php
							   $args = array( 'post_type' => 'cpt_photoalbums',
							   'showposts' => 1);
							   $the__photoalbums_query = new WP_Query($args);
							   global $post;
							   $photoalbumsposts = get_posts($args);
							   foreach($photoalbumsposts as $post) : 
								
									$args = array(
										'post_type' => 'attachment',
										'numberposts' => -1,
										'post_status' => null,
										'post_parent' => $post->ID
										); 
									$attachments = get_posts($args);
									$currentAttachmentNum = 0;
									//
									if ($attachments) {
										$currentAttachmentNum = 0;
										foreach ($attachments as $attachment1) {?>
									
										<li><a href="<?php bloginfo('url'); echo ("/?attachment_id=" . $attachment1->ID); ?>"><img src="<?php bloginfo( 'template_directory' ); ?>/thumb.php?src=<?php if (is_multisite()){echo get_current_site(1)->path; echo str_replace(get_blog_option($blog_id,'fileupload_url'),get_blog_option($blog_id,'upload_path'), $attachment1->guid); }else{ echo $attachment1->guid;}?>&h=100&w=100&zc=1" alt="<?php the_title(); ?>" alt="img_carousel" width="66" height="67" /></a></li> 
										
									   <?php } } ?>
                               <?php endforeach; ?> 
					
				</ul>			
			</section>
            <?php wp_reset_query(); ?>
            <?php
        
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

} // class photosWidget

// register photosWidget widget
add_action('widgets_init', create_function('', 'return register_widget("photosWidget");'));
	
/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * @since Twenty Ten 1.0
 */
function ezekiel_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'ezekiel_remove_recent_comments_style' );

if ( ! function_exists( 'ezekiel_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 * @since Twenty Ten 1.0
 */
function ezekiel_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'ezekiel' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'ezekiel' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'ezekiel_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Twenty Ten 1.0
 */
function ezekiel_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'ezekiel' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'ezekiel' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'ezekiel' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;


//switch posts over to new posts names - if any of the old ones still exist
global $wpdb;

$wpdb->update( $wpdb->posts, array('post_type' => 'cpt_news'), array('post_type' => 'news'));
$wpdb->update( $wpdb->posts, array('post_type' => 'cpt_events'), array('post_type' => 'events'));
$wpdb->update( $wpdb->posts, array('post_type' => 'cpt_sermons'), array('post_type' => 'sermons'));
$wpdb->update( $wpdb->posts, array('post_type' => 'cpt_photoalbums'), array('post_type' => 'photoalbums'));

function flag_gcal_func( $atts ){
 $embed_code = '<iframe frameborder="0" height="600" src="https://www.google.com/calendar/embed?src=p1vfigper041mk7fi2a0ae9tn4%40group.calendar.google.com&amp;ctz=America/New_York" style="border: 0pt none;" width="800"></iframe>';
 return $embed_code;
}
add_shortcode( 'flagcal', 'flag_gcal_func' );
?>