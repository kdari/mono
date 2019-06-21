<?php
//4eI91fQVon7gsz4Kx0pYkZrewaZQaxZuL4L



 
// theme admin
include('functions/theme-admin.php');
include('functions/better-excerpts.php');
include('functions/slides-meta.php');

// get scripts
add_action('wp_enqueue_scripts','my_theme_scripts_function');

function my_theme_scripts_function() {
	
	wp_deregister_script('jquery'); 
	wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"), false, '1.4.2'); 
	wp_enqueue_script('jquery');
   
	wp_enqueue_script('sliding effect', get_stylesheet_directory_uri() . '/js/sliding_effect.js');
	wp_enqueue_script('superfish', get_stylesheet_directory_uri() . '/js/superfish.js');
	wp_enqueue_script('supersubs', get_stylesheet_directory_uri() . '/js/supersubs.js');
	
	if(is_front_page()) :
	wp_enqueue_script('nivoSlider', get_stylesheet_directory_uri() . '/js/jquery.nivo.slider.pack.js');
	endif;
}

//Add Pagination Support
include('functions/pagination.php');

// Limit Post Word Count
function new_excerpt_length($length) {
	return 50;
}
add_filter('excerpt_length', 'new_excerpt_length');

//Replace Excerpt Link
function new_excerpt_more($more) {
       global $post;
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

//Activate post-image functionality (WP 2.9+)
if ( function_exists( 'add_theme_support' ) )
add_theme_support( 'post-thumbnails' );

// featured image sizes
if ( function_exists( 'add_image_size' ) ) {
add_image_size( 'full-size',  9999, 9999, false );
add_image_size( 'post-image',  150, 150, true );
add_image_size( 'related-posts',  50, 50, true );
add_image_size( 'home-highlights',  290, 140, true );
add_image_size( 'portfolio',  215, 160, true );
add_image_size( 'featured-image',  920, 350, true );
}

// Enable Custom Background
add_custom_background();

// register navigation menus
register_nav_menus(
	array(
	'main nav'=>__('Main Nav'),
	)
);
/// add home link to menu
function home_page_menu_args( $args ) {
$args['show_home'] = true;
return $args;
}
add_filter( 'wp_page_menu_args', 'home_page_menu_args' );


// menu fallback
function default_menu() {
	require_once (TEMPLATEPATH . '/includes/default-menu.php');
}

add_action( 'init', 'create_post_types' );
function create_post_types() {
// Define Post Type For Homepage Highlights
  register_post_type( 'highlights',
    array(
      'labels' => array(
		'name' => _x( 'HP Highlights', 'post type general name' ), // Tip: _x('') is used for localization
		'singular_name' => _x( 'Homepage Highlight', 'post type singular name' ),
		'add_new' => _x( 'Add New', 'Homepage Highlight' ),
		'add_new_item' => __( 'Add New Homepage Highlight' ),
		'edit_item' => __( 'Edit Homepage Highlight' ),
		'new_item' => __( 'New Homepage Highlight' ),
		'view_item' => __( 'View Homepage Highlight' ),
		'search_items' => __( 'Search Homepage Highlights' ),
		'not_found' =>  __( 'No Homepage Highlights found' ),
		'not_found_in_trash' => __( 'No Homepage Highlights found in Trash' ),
		'parent_item_colon' => ''
      ),
      'public' => true,
	  'exclude_from_search' => true,
	  'supports' => array('title','thumbnail','editor'),
	  'menu_icon' => get_stylesheet_directory_uri() . '/images/admin/highlights.png',
    )
  );
// Define Post Type For Slider
  register_post_type( 'slides',
    array(
      'labels' => array(
		'name' => _x( 'Slides', 'post type general name' ), // Tip: _x('') is used for localization
		'singular_name' => _x( 'Slide', 'post type singular name' ),
		'add_new' => _x( 'Add New', 'Slide' ),
		'add_new_item' => __( 'Add New Slide' ),
		'edit_item' => __( 'Edit Slide' ),
		'new_item' => __( 'New Slide' ),
		'view_item' => __( 'View Slide' ),
		'search_items' => __( 'Search Slides' ),
		'not_found' =>  __( 'No Slides found' ),
		'not_found_in_trash' => __( 'No Slides found in Trash' ),
		'parent_item_colon' => ''
      ),
      'public' => true,
	  'exclude_from_search' => true,
	  'supports' => array('title','thumbnail'),
	  'menu_icon' => get_stylesheet_directory_uri() . '/images/admin/slides.png',
    )
  );

// Define Post Type For Portfolio
register_post_type( 'Portfolio',
    array(
      'labels' => array(
        'name' => __( 'Portfolio' ),
        'singular_name' => __( 'Portfolio' ),		
		'add_new' => _x( 'Add New', 'Portfolio Project' ),
		'add_new_item' => __( 'Add New Portfolio Project' ),
		'edit_item' => __( 'Edit Portfolio Project' ),
		'new_item' => __( 'New Portfolio Project' ),
		'view_item' => __( 'View Portfolio Project' ),
		'search_items' => __( 'Search Portfolio Projects' ),
		'not_found' =>  __( 'No Portfolio Projects found' ),
		'not_found_in_trash' => __( 'No Portfolio Projects found in Trash' ),
		'parent_item_colon' => ''
		
      ),
      'public' => true,
	  'supports' => array('title','editor','thumbnail', 'comments' ),
	  'menu_icon' => get_stylesheet_directory_uri() . '/images/admin/portfolio.png',
	  'query_var' => true,
	  'rewrite' => array( 'slug' => 'portfolio' ),
    )
  );
}

//Register Sidebars
if ( function_exists('register_sidebar') )
register_sidebar(array(
'name' => 'Sidebar',
'description' => 'Widgets in this area will be shown in the sidebar.',
'before_widget' => '<div class="sidebar-box clearfix">',
'after_widget' => '</div>',
'before_title' => '<h4>',
'after_title' => '</h4>',
));

// functions run on activation --> important flush to clear rewrites
if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {
	$wp_rewrite->flush_rules();
}
?>
