<?php /** Functions file for Reverence theme. **/

/********************* DEFINE MAIN PATHS ********************/

define('Reverence_PLUGINS',  get_template_directory() . '/plugins' ); // Shortcut to the /plugins/ directory

$adminPath 	=  get_template_directory() . '/library/admin/';
$funcPath 	=  get_template_directory() . '/library/functions/';
$incPath 	=  get_template_directory() . '/library/includes/';

global $al_options;
$al_options = isset($_POST['options']) ? $_POST['options'] : get_option('al_general_settings');
/************************************************************/

/** REMOVE UNNECESSARY STUFF THE WORDPRESS LOADS BY DEFAULT**/

remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wp_generator');

/*********** LOAD ALL REQUIRED SCRIPTS AND STYLES ***********/
function loadScripts()
{
	if( !is_admin())
	{
		// Register or enqueue styles
		wp_enqueue_style('pretty-photo-styles',  get_template_directory_uri().'/css/prettyPhoto.css');
		wp_enqueue_style('jplayer-styles',  get_template_directory_uri().'/js/jplayer/skin/blue.monday/jplayer.blue.monday.css',false,'3.0.1','all');
		wp_enqueue_style('flex-styles',  get_template_directory_uri().'/sliders/flex/flexslider.css');
		wp_register_style('revolution-styles',  get_template_directory_uri().'/sliders/revolution/css/settings.css');
		wp_register_style('revolution-settings',  get_template_directory_uri().'/sliders/revolution/css/fullwidth.css');
		wp_register_style('nivo-styles',  get_template_directory_uri().'/sliders/nivo/nivo-slider.css');
		wp_register_style('nivo-theme',  get_template_directory_uri().'/sliders/nivo/themes/default/default.css');
		wp_register_style('camera-styles',  get_template_directory_uri().'/sliders/camera/css/camera.css');
		wp_register_style('iview-styles',  get_template_directory_uri().'/sliders/iview/css/iview.css');
		wp_register_style('iview-skin',  get_template_directory_uri().'/sliders/iview/css/skin4/style.css');
		wp_register_style('reverence-styles',  get_template_directory_uri().'/sliders/reverence/css/reverence.css');
		
		// Register or enqueue scripts
		wp_enqueue_script('jquery');
		wp_enqueue_script('pretty-photo',  get_template_directory_uri(). '/js/jquery.prettyPhoto.js');
		wp_enqueue_script('top-menu',  get_template_directory_uri(). '/js/menu.js');
		wp_enqueue_script('isotope',  get_template_directory_uri(). '/js/jquery.isotope.min.js');
	  	wp_enqueue_script('carouFredSel',  get_template_directory_uri(). '/js/jquery.carouFredSel-6.1.0-packed.js', array('jquery'), '3.0.1' );
		wp_enqueue_script('fitvid', get_template_directory_uri() .'/sliders/flex/js/jquery.fitvid.js');	
		wp_enqueue_script('flex-slider', get_template_directory_uri() .'/sliders/flex/js/jquery.flexslider-min.js');	
		wp_enqueue_script('froogaloop', get_template_directory_uri() .'/sliders/flex/js/froogaloop.js');	
		wp_enqueue_script('modernizr', get_template_directory_uri() .'/sliders/flex/js/modernizr.js');	
		wp_enqueue_script('mobile-menu', get_template_directory_uri() .'/js/jquery.mobilemenu.js');
		wp_enqueue_script('jquery-tools',  get_template_directory_uri(). '/js/jquery.tools.min.js', array('jquery'), '1.2.6' );
		wp_enqueue_script('jplayer-audio',  get_template_directory_uri().'/js/jplayer/jquery.jplayer.min.js',array('jquery'));
		//wp_enqueue_script('jplayer-audio-playlist',  get_template_directory_uri().'/js/jplayer/jplayer.playlist.min.js',array('jquery'));
		wp_enqueue_script('my-custom-scripts', get_template_directory_uri(). '/js/custom.js');
		
		$al_options = get_option('al_general_settings'); 
		$slider = $al_options['al_active_slider'] !='' ? $al_options['al_active_slider'] : 'revolution';
		//$slider = isset($_GET['slider_type']) ? $_GET['slider_type'] : 'revolution';
		
		if($slider == 'nivo')
		{
			wp_enqueue_style('nivo-styles');
			wp_enqueue_style('nivo-theme');
			wp_enqueue_script('nivo-slider',  get_template_directory_uri(). '/sliders/nivo/jquery.nivo.slider.pack.js');
		}
		
		elseif($slider == 'revolution')
		{
			wp_enqueue_style('revolution-styles');
			wp_enqueue_style('revolution-settings');
			wp_enqueue_script('revolution-slider', get_template_directory_uri() .'/sliders/revolution/js/jquery.themepunch.plugins.min.js');	
			wp_enqueue_script('revolution-misc', get_template_directory_uri() .'/sliders/revolution/js/jquery.themepunch.revolution.min.js');	
		}
		
		elseif($slider == 'camera')
		{
			wp_enqueue_script('camera-slider', get_template_directory_uri() .'/sliders/camera/js/camera.min.js');	
			wp_enqueue_script('camera-mobile', get_template_directory_uri() .'/sliders/camera/js/jquery.mobile.customized.min.js');
			wp_enqueue_style('camera-styles');			
		}
		
		elseif($slider == '3d')
		{
			wp_enqueue_script('3d-slider', get_template_directory_uri() .'/sliders/3d/swfobject/swfobject.js');		
		}
		
		elseif($slider == 'iview')
		{
			wp_enqueue_script('iview-slider', get_template_directory_uri() .'/sliders/iview/js/iview.min.js');	
			wp_enqueue_script('iview-raphael', get_template_directory_uri() .'/sliders/iview/js/raphael-min.js');
			wp_enqueue_style('iview-styles');	
			wp_enqueue_style('iview-skin');	
		}
		
		elseif($slider == 'reverence')
		{
			wp_enqueue_script('reverence-slider', get_template_directory_uri() .'/sliders/reverence/js/jquery.eislideshow.js');	
			wp_enqueue_style('reverence-styles');			
		}
	}
}
add_action( 'init', 'loadScripts' ); //Load All Scripts


function loadPrimaryScripts(){
	if( !is_admin())
	{
		
		if (is_page_template('contact-template.php')){
			$al_options = get_option('al_general_settings'); 
			if (!empty($al_options['al_contact_address']))
			{
				wp_enqueue_script('Google-map-api',  'http://maps.google.com/maps/api/js?sensor=false',array('jquery'));
				wp_enqueue_script('Google-map',  get_template_directory_uri().'/js/gmap3.min.js',array('jquery'));
			}
			
			wp_enqueue_script('Validate',  get_template_directory_uri().'/js/validate.js',array('jquery'));
		}				
	}
}
add_action( 'wp_print_scripts', 'loadPrimaryScripts' ); 

/************************************************************/


/********************* DEFINE MAIN PATHS ********************/

require_once ($incPath . 'the_breadcrumb.php');
require_once ($incPath . 'portfolio_walker.php');
require_once ($funcPath . 'sidebar-generator.php');
require_once ($funcPath . 'options.php');
require_once ($funcPath . 'post-types.php');
require_once ($funcPath . 'widgets.php');
require_once ($funcPath . 'shortcodes.php');


require_once ($adminPath . 'custom-fields.php');
require_once ($adminPath . 'scripts.php');
require_once ($adminPath . 'admin-panel/admin-panel.php');

// Redirect To Theme Options Page on Activation
if (is_admin() && isset($_GET['activated'])){
	wp_redirect(admin_url('admin.php?page=adminpanel'));
}

/************** ADD SUPPORT FOR LOCALIZATION ***************/

load_theme_textdomain( 'Reverence',  get_template_directory() . '/languages' );

	$locale = get_locale();

	$locale_file =  get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

/************************************************************/


/**************** ADD SUPPORT FOR POST THUMBS ***************/

add_theme_support( 'post-thumbnails');

// Define various thumbnail sizes
//add_image_size('portfolio-thumb-3cols', 200, 176, true); 

add_image_size('portfolio-4-col', 201, 188, true);
add_image_size('portfolio-3-col', 276, 176, true); 
add_image_size('portfolio-2-col', 425, 240, true); 


add_image_size('blog-thumb', 55, 55, true); 
add_image_size('blog-thumb2', 64, 50, true); 
add_image_size('blog-list', 250, 192, true);

/************************************************************/

// Remove empty paragraph and br tags

$option_posts_per_page = get_option( 'posts_per_page' );
add_action( 'init', 'my_modify_posts_per_page', 0);
function my_modify_posts_per_page() {
    add_filter( 'option_posts_per_page', 'my_option_posts_per_page' );
}
function my_option_posts_per_page( $value ) {
    global $option_posts_per_page;
    if ( is_tax( 'portfolio_category') ) {
		$pageId = get_page_ID_by_page_template('portfolio-template.php');
		$custom =  get_post_custom($pageId);
		$items_per_page = isset ($custom['_page_portfolio_num_items_page']) ? $custom['_page_portfolio_num_items_page'][0] : '777';
        return $items_per_page;
    } else {
        return $option_posts_per_page;
    }
}

/************* ADD SUPPORT FOR WORDPRESS 3 MENUS ************/

add_theme_support( 'menus' );

if(function_exists('register_nav_menu')):
	register_nav_menu( 'primary_nav', 'Primary Navigation');
endif;

/************************************************************/


/************* COMMENTS HOOK *************/

function Reverence_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
        <div id="comment-<?php comment_ID(); ?>">
            <div class="comment-author vcard">
				<?php 
					$defAvatar = get_template_directory_uri().'/images/avatar_generic.jpg';
					echo get_avatar($comment, $size='55', $default= "" ); 
				?>                 
            </div>
            <?php if ($comment->comment_approved == '0') : ?>
            <em><?php _e('Your comment is awaiting moderation.', 'Reverence') ?></em>
            <br />
            <?php endif; ?>
         
            <p>
                <cite class="fn"><a href="<?php echo get_comment_author_link()?>" rel="external nofollow"><?php echo get_comment_author()?></a></cite>
                <a class="comment-date"><?php printf(__('%1$s at %2$s', 'Reverence'), get_comment_date(),get_comment_time()) ?></a>
            	<?php edit_comment_link(__('(Edit)', 'Reverence'),'  ','') ?>
            </p>
            
            <?php comment_text() ?>
			<p>
				<?php if($args['max_depth']!=$depth): ?>
               		<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>                                
                <?php endif ?>
			</p>
          </div>	
	<?php	
}

/*****************************************/


/************** FOOTER WIDGETS ************/

$al_options = get_option('al_general_settings'); 
$footer_widget_count = isset($al_options['al_footer_widgets_count']) ? $al_options['al_footer_widgets_count']:4;

for($i = 1; $i<= $footer_widget_count; $i++)
{
	unregister_sidebar('Footer Widget '.$i);
  	if ( function_exists('register_sidebar') )
	register_sidebar(array(
	  	'name' => 'Footer Widget '.$i,
		'id'	=> 'footer-sidebar-'.$i,
		'before_widget' => '<div class="four columns footer-block">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3> <div class="colorbox"></div>',
	));
}

/*******************************************/


/********** GET PAGES BY PARAMS ************/

/*-- Get root parent of a page --*/
function get_root_page($page_id) 
{
	global $wpdb;
	
	$parent = $wpdb->get_var("SELECT post_parent FROM $wpdb->posts WHERE post_type='page' AND ID = '$page_id'");
	
	if ($parent == 0) 
		return $page_id;
	else 
		return get_root_page($parent);
}


/*-- Get page name by ID --*/
function get_page_name_by_ID($page_id)
{
	global $wpdb;
	$page_name = $wpdb->get_var("SELECT post_title FROM $wpdb->posts WHERE ID = '$page_id'");
	return $page_name;
}


/*-- Get page ID by Page Template --*/
function get_page_ID_by_page_template($template_name)
{
	global $wpdb;
	$page_ID = $wpdb->get_var("SELECT post_id FROM $wpdb->postmeta WHERE meta_value = '$template_name' AND meta_key = '_wp_page_template'");
	return $page_ID;
}

/*-- Get page content (Used for pages with custom post types) --*/
if(!function_exists('getPageContent'))
{
	function getPageContent($pageId)
	{
		if(!is_numeric($pageId))
		{
			return;
		}
		global $wpdb;
		$sql_query = 'SELECT DISTINCT * FROM ' . $wpdb->posts .
		' WHERE ' . $wpdb->posts . '.ID=' . $pageId;
		$posts = $wpdb->get_results($sql_query);
		if(!empty($posts))
		{
			foreach($posts as $post)
			{
				return nl2br($post->post_content);
			}
		}
	}
}


/* -- Get page ID by Custom Field Value -- */
function get_page_ID_by_custom_field_value($custom_field, $value)
{
	global $wpdb;
	$page_ID = $wpdb->get_var("
	    SELECT wposts.ID
    	FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta
	    WHERE wposts.ID = wpostmeta.post_id 
    	AND wpostmeta.meta_key = '$custom_field' 
	    AND (wpostmeta.meta_value like '$value,%' OR wpostmeta.meta_value like '%,$value,%' OR wpostmeta.meta_value like '%,$value' OR wpostmeta.meta_value = '$value')		
    	AND wposts.post_status = 'publish' 
	    AND wposts.post_type = 'page'
		LIMIT 0, 1");

	return $page_ID;
}
/*******************************************/


/********* PRE-GENERATED SIDEBARS **********/

if ( function_exists('register_sidebar') )
{	
	register_sidebar(array(
		'name' => 'Global Sidebar',
		'id'	=> 'global-sidebar-1',
        'before_widget' => '<div id="%1$s" class="widget global_sidebar %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="uppercase">',
        'after_title' => '</h4>',
    ));
	
	register_sidebar(array(
		'name' => 'Portfolio Sidebar',
		'id'	=> 'global-portfolio-sidebar-1',
        'before_widget' => '<div id="%1$s" class="widget portfolio_sidebar %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="uppercase">',
        'after_title' => '</h4>',
    ));
	
	register_sidebar(array(
		'name' => 'Homepage Top Sidebar',
		'id'   => 'homepage-sidebar-1',
        'before_widget' => '<div id="%1$s" class="homepage-widget">',
        'after_widget' => '</div>',
        'before_title' => '',
        'after_title' => '',
    ));
}

/*******************************************/


/********* STRING MANIPULATIONS ************/

function al_trim($text, $length, $end = '[...]') {
	$text = preg_replace('`\[[^\]]*\]`', '', $text);
	$text = strip_tags($text);
	$text = substr($text, 0, $length);
	$text = substr($text, 0, last_pos($text, " "));
	$text = $text . $end;
	return $text;
}

function last_pos($string, $needle){
   $len=strlen($string);
   for ($i=$len-1; $i>-1;$i--){
       if (substr($string, $i, 1)==$needle) return ($i);
   }
   return FALSE;
}

function limit_words($string, $word_limit) {
 
	// creates an array of words from $string (this will be our excerpt)
	// explode divides the excerpt up by using a space character
 
	$words = explode(' ', $string);
 
	// this next bit chops the $words array and sticks it back together
	// starting at the first word '0' and ending at the $word_limit
	// the $word_limit which is passed in the function will be the number
	// of words we want to use
	// implode glues the chopped up array back together using a space character
 
	return implode(' ', array_slice($words, 0, $word_limit)).'...';
}

function excerpt_ellipse($text) {
   return str_replace('[...]', ' <a href="'.get_permalink().'" class="read-more" style="margin:14px 0 0 0">Read more...</a>', $text); }
add_filter('the_excerpt', 'excerpt_ellipse');

/*******************************************/


/******* POSTS RELATED BY TAXONOMY *********/

function get_taxonomy_related_posts($post_id, $taxonomy, $limit, $args=array()) {
  $query = new WP_Query();
  $terms = wp_get_object_terms($post_id, $taxonomy);
  if (count($terms)) {
    $post_ids = get_objects_in_term($terms[0]->term_id,$taxonomy);
    $post = get_post($post_id);
    $args = wp_parse_args($args,array(
      'post_type' => $post->post_type, 
      'post__in' => $post_ids,
	  'exclude' => $post_id,
      'taxonomy' => $taxonomy,
      'term' => $terms[0]->slug,
	  'posts_per_page' => $limit
    ));
    $query = new WP_Query($args);
  }
  return $query;
}

/********************************************/

/*************  ENABLE SESSIONS *************/

function cp_admin_init() {
	if (!session_id())
	session_start();
}

add_action('init', 'cp_admin_init');

/********************************************/


/**************  GOOGLE FONTS ***************/

function font_name($string){
		
	$check = strpos($string, ':');
	if($check == false){
		return $string;
	} else { 
		preg_match("/([\w].*):/i", $string, $matches);
		return $matches[1];
	} 
} 

/********************************************/

add_theme_support( 'automatic-feed-links' );
if ( ! isset( $content_width ) ) $content_width = 960;
add_filter('the_excerpt', 'do_shortcode');



/*add_filter( 'nav_menu_css_class', 'add_custom_class', 10, 2 );

function add_custom_class( $classes = array(), $menu_item = false ) {
    if ( is_single() && 538 == $menu_item->ID && ! in_array( 'current-menu-item', $classes ) ) {
        $classes[] = 'current-menu-item';
    }
    return $classes;
}
*/

/************** LIST TAXONOMY ***************/

function list_taxonomy($taxonomy, $id='')
{
	$args = array ('hide_empty' => false);
	$tax_terms = get_terms($taxonomy, $args); 
	$active = '';
	$output = '<ul id="'.$id.'">';

	foreach ($tax_terms as $tax_term) {
		if ($taxonomy  == $tax_term)
		{
			$active  = ' class="active"';
		}
		$output.='<li><a href="'.esc_attr(get_term_link($tax_term, $taxonomy)) . '"'.$active.'>'.$tax_term->name.'</a></li>';
	}
	$output.='</ul>';
	
	return $output;
}

/********************************************/

?>