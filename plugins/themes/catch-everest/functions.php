<?php
/**
 * Catch Everest functions and definitions
 *
 * @package Catch Themes
 * @subpackage Catch Everest
 * @since Catch Everest 1.0
 */


if ( ! function_exists( 'catcheverest_content_width' ) ) :
	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	function catcheverest_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'catcheverest_content_width', 690 );
	}
endif;
add_action( 'after_setup_theme', 'catcheverest_content_width', 0 );


if ( ! function_exists( 'catcheverest_template_redirect' ) ) :
	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet for different value other than the default one
	 *
	 * @global int $content_width
	 */
	function catcheverest_template_redirect() {
	    $layout  = catcheverest_get_theme_layout();

		if ( 'no-sidebar-full-width' == $layout ) {
			$GLOBALS['content_width'] = 1040;
		}
	}
endif;
add_action( 'template_redirect', 'catcheverest_template_redirect' );


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

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Catch Everest, use a find and replace
	 * to change 'catch-everest' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'catch-everest', get_template_directory() . '/languages' );

	/**
	 * Add callback for custom TinyMCE editor stylesheets. (editor-style.css)
	 * @see http://codex.wordpress.org/Function_Reference/add_editor_style
	 */
	add_editor_style();

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/*
	* Let WordPress manage the document title.
	* By adding theme support, we declare that this theme does not use a
	* hard-coded <title> tag in the document head, and expect WordPress to
	* provide it for us.
	*/
	add_theme_support( 'title-tag' );

	/**
	 * Theme Options Defaults
	 */
	require( get_template_directory() . '/inc/panel/catcheverest-theme-options-defaults.php' );

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

	/*
	 * This theme supports custom background color and image, and here
	 *
	 */
	add_theme_support( 'custom-background', array( 'wp-head-callback' => 'catcheverest_background_callback' ) );

	/**
     * This feature enables custom-menus support for a theme.
     * @see http://codex.wordpress.org/Function_Reference/register_nav_menus
     */
	register_nav_menu( 'primary', __( 'Primary Menu', 'catch-everest' ) );

	/**
	 * Add support for the Aside Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio' ) );

	/**
     * This feature enables Jetpack plugin Infinite Scroll
     */
    add_theme_support( 'infinite-scroll', array(
		'type'           => 'click',
        'container'      => 'content',
        'footer_widgets' => array( 'sidebar-2', 'sidebar-3', 'sidebar-4' ),
        'footer'         => 'page'
    ) );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'slider', 1140, 450, true); //Featured Post Slider Image
	add_image_size( 'featured', 690, 462, true); //Featured Image
	add_image_size( 'small-featured', 390, 261, true); //Small Featured Image

	//@remove Remove check when WordPress 4.8 is released
	if ( function_exists( 'has_custom_logo' ) ) {
		/**
		* Setup Custom Logo Support for theme
		* Supported from WordPress version 4.5 onwards
		* More Info: https://make.wordpress.org/core/2016/03/10/custom-logo/
		*/
		add_theme_support( 'custom-logo',
			array(
				'height'      => 125,
				'width'       => 300,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);
	}

}
endif; // catcheverest_setup
add_action( 'after_setup_theme', 'catcheverest_setup' );


if ( ! function_exists( 'catcheverest_get_theme_layout' ) ) :
	/**
	 * Returns Theme Layout prioritizing the meta box layouts
	 *
	 * @uses  get_options
	 *
	 * @action wp_head
	 *
	 * @since Catch Everest 2.7
	 */
	function catcheverest_get_theme_layout() {
		$id = '';

		global $post, $wp_query;

	    // Front page displays in Reading Settings
		$page_on_front  = get_option('page_on_front') ;
		$page_for_posts = get_option('page_for_posts');

		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();

		// Blog Page or Front Page setting in Reading Settings
		if ( $page_id == $page_for_posts || $page_id == $page_on_front ) {
	        $id = $page_id;
	    }
	    elseif ( is_singular() ) {
	 		if ( is_attachment() ) {
				$id = $post->post_parent;
			}
			else {
				$id = $post->ID;
			}
		}

		//Get appropriate metabox value of layout
		if ( '' != $id ) {
			$layout = get_post_meta( $id, 'catcheverest-sidebarlayout', true );
		}
		else {
			$layout = 'default';
		}

		//Load options data
		global $catcheverest_options_settings;
   		$options = $catcheverest_options_settings;

   		//check empty and load default
		if ( empty( $layout ) || 'default' == $layout ) {
			$layout = $options['sidebar_layout'];
		}

		return $layout;
	}
endif; //catcheverest_get_theme_layout


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


/**
 * Customizer Options
 */
require( get_template_directory() . '/inc/panel/customizer/customizer.php' );


/**
 * Migrate Logo to New WordPress core Custom Logo
 *
 * Runs if version number saved in theme_mod "logo_version" doesn't match current theme version.
 */
function catcheverest_logo_migrate() {
	$ver = get_theme_mod( 'logo_version', false );

	// Return if update has already been run
	if ( version_compare( $ver, '3.6' ) >= 0 ) {
		return;
	}

	if ( function_exists( 'the_custom_logo' ) ) {

		$header_image = get_header_image();

		if ( ! empty( $header_image ) ) {
			// Since previous logo was stored a URL, convert it to an attachment ID
			$logo = attachment_url_to_postid( $header_image );

			if ( is_int( $logo ) ) {
				set_theme_mod( 'custom_logo', $logo );
			}
		}

		//Remove header image previously set as logo
		set_theme_mod( 'header_image', '' );

		set_theme_mod( 'header_image_data', array() );

  		// Update to match logo_version so that script is not executed continously
		set_theme_mod( 'logo_version', '3.6' );
	}
}
add_action( 'after_setup_theme', 'catcheverest_logo_migrate' );


/**
 * Migrate Custom CSS to WordPress core Custom CSS
 *
 * Runs if version number saved in theme_mod "custom_css_version" doesn't match current theme version.
 */
function catcheverest_custom_css_migrate(){
	$ver = get_theme_mod( 'custom_css_version', false );

	// Return if update has already been run
	if ( version_compare( $ver, '4.7' ) >= 0 ) {
		return;
	}

	if ( function_exists( 'wp_update_custom_css_post' ) ) {
	    // Migrate any existing theme CSS to the core option added in WordPress 4.7.

	    /**
		 * Get Theme Options Values
		 */
		global $catcheverest_options_settings;
	   	$options = $catcheverest_options_settings;

	    if ( '' != $options['custom_css'] ) {
			$core_css = wp_get_custom_css(); // Preserve any CSS already added to the core option.
			$return   = wp_update_custom_css_post( $core_css . $options['custom_css'] );

	        if ( ! is_wp_error( $return ) ) {
	            // Remove the old theme_mod, so that the CSS is stored in only one place moving forward.
	            unset( $options['custom_css'] );
	            update_option( 'catcheverest_options', $options );

	            // Update to match custom_css_version so that script is not executed continously
				set_theme_mod( 'custom_css_version', '4.7' );
	        }
	    }
	}
}
add_action( 'after_setup_theme', 'catcheverest_custom_css_migrate' );