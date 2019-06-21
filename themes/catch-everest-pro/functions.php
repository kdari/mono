<?php
/**
 * Catch Everest functions and definitions
 *
 * @package Catch Themes
 * @subpackage Catch Everest
 * @since Catch Everest 1.0
 */

if ( ! function_exists( 'catcheverest_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since Catch Everest 1.0
 */
function catcheverest_setup() {
	
	global $content_width;
	/**
	 * Global content width.
	 */
	 if (!isset($content_width))
     	$content_width = 690;
				
	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Catch Everest, use a find and replace
	 * to change 'catcheverest' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'catcheverest', get_template_directory() . '/languages' );	
	
	/**
	 * Add callback for custom TinyMCE editor stylesheets. (editor-style.css)
	 * @see http://codex.wordpress.org/Function_Reference/add_editor_style
	 */
	add_editor_style();	
	
	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );
	
	/**
	 * Theme Options Defaults
	 */	
	require( get_template_directory() . '/inc/catcheverest-theme-options-defaults.php' );	

	/**
	 * Custom Theme Options
	 */
	require( get_template_directory() . '/inc/panel/theme-options.php' );	
	
	/**
	 * Custom functions that act independently of the theme templates
	 */
	require( get_template_directory() . '/inc/catcheverest-functions.php' );	
	
	/**
	 * Metabox
	 */
	require( get_template_directory() . '/inc/catcheverest-metabox.php' );

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Register Sidebar and Widget.
	 */
	require( get_template_directory() . '/inc/widgets.php' );
	
	/**
	 * Load up our new theme update notifier.
	 */	
	require( get_template_directory() . '/update_notifier.php' );		
	
	/*
	 * This theme supports custom background color and image, and here
	 * 
	 */	
	// WordPress 3.4+
	if ( function_exists( 'get_custom_header') ) {
		//add_theme_support( 'custom-background' );
		add_theme_support( 'custom-background', array( 'wp-head-callback' => 'catcheverest_background_callback' ) );
	} else {
		// Backward Compatibility for WordPress Version 3.3
		add_custom_background( 'catcheverest_background_callback' );
	}	

	/**
     * This feature enables custom-menus support for a theme.
     * @see http://codex.wordpress.org/Function_Reference/register_nav_menus
     */		
	register_nav_menu( 'primary', __( 'Primary Menu', 'catcheverest' ) );

	/**
	 * Add support for the Aside Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio' ) );
	
	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'slider', 1140, 450, true); //Featured Post Slider Image
	add_image_size( 'featured', 690, 462, true); //Featured Image
	add_image_size( 'small-featured', 390, 261, true); //Small Featured Image
	
	//Redirect to Theme Options Page on Activation
	global $pagenow;
	if ( is_admin() && isset($_GET['activated'] ) && $pagenow =="themes.php" ) {
		wp_redirect( 'themes.php?page=theme_options' );
	}		

}
endif; // catcheverest_setup
add_action( 'after_setup_theme', 'catcheverest_setup' );


/**
 * Implement the Custom Header feature
 */
require( get_template_directory() . '/inc/custom-header.php' );


function catcheverest_background_callback() {

	/* Get the background image. */
	$image = get_background_image();

	/* If there's an image, just call the normal WordPress callback. We won't do anything here. */
	if ( !empty( $image ) ) {
		_custom_background_cb();
		return;
	}

	/* Get the background color. */
	$color = get_background_color();

	/* If no background color, return. */
	if ( empty( $color ) )
		return;

	/* Use 'background' instead of 'background-color'. */
	$style = "background: #{$color};";

?>
<style type="text/css">body { <?php echo trim( $style ); ?> }</style>
<?php
}

function beacon_gcal_func( $atts ){
 $embed_code = '<iframe src="https://www.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%233366ff&amp;src=3qmh22i7p2tamdsa1j3jj0rih4%40group.calendar.google.com&amp;color=%23182C57&amp;ctz=America%2FNew_York" style=" border:solid 1px #777 " width="800" height="600" frameborder="0" scrolling="no"></iframe>
<iframe src="https://www.google.com/calendar/embed?showNav=0&amp;showTabs=0&amp;showTz=0&amp;mode=AGENDA&amp;height=600&amp;wkst=1&amp;bgcolor=%233366ff&amp;src=3qmh22i7p2tamdsa1j3jj0rih4%40group.calendar.google.com&amp;color=%232952A3&amp;ctz=America%2FNew_York" style=" border:solid 1px #777 " width="800" height="600" frameborder="0" scrolling="no"></iframe>';
 return $embed_code;
}
add_shortcode( 'beaconcal', 'beacon_gcal_func' );

/**
 * Adds support for WooCommerce Plugin
 */
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	
	/**
	 * Add Suport for WooCommerce Plugin
	 */
	add_theme_support( 'woocommerce' );	
	
    require( get_template_directory() . '/inc/catcheverest-woocommerce.php' );
}