<?php
/**
 * @package Quintus
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'quintus_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since Quintus 1.0
 */
function quintus_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Quintus, use a find and replace
	 * to change 'quintus' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'quintus', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head.
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Custom Backgrounds.
	 */

	add_theme_support( 'custom-background' );

	/**
	* This theme uses wp_nav_menu() in one location.
	*/
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'quintus' ),
	) );

	/**
	 * Add support for Post Formats.
	 */
	add_theme_support( 'post-formats', array( 'aside', 'link', 'quote' ) );
}
endif; // quintus_setup
add_action( 'after_setup_theme', 'quintus_setup' );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function quintus_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'quintus_page_menu_args' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function quintus_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar 1', 'quintus' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'This is Quintus\' widget sidebar. Leave empty if you want a one column layout.', 'quintus' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'quintus_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function quintus_scripts() {
	wp_enqueue_style( 'quintus-style', get_stylesheet_uri() );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	$protocol = is_ssl() ? 'https' : 'http';
	wp_enqueue_style( 'lato', "$protocol://fonts.googleapis.com/css?family=Lato:100,400,700&v2&subset=latin,latin-ext" );
}
add_action( 'wp_enqueue_scripts', 'quintus_scripts' );

/**
 * Grab the first URL from a Link post
 */
function quintus_url_grabber() {
	if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ) )
		return false;

	return esc_url_raw( $matches[1] );
}

/**
 * Add special classes to the WordPress body class.
 */
function quintus_body_classes( $classes ) {

	// Add current color scheme class.
	if ( 'archaic' == quintus_current_color_scheme() )
		$classes[] = 'color-archaic';
	else
		$classes[] = 'color-default';

	// If we have one sidebar active we have secondary content
	if ( ! is_active_sidebar( 'sidebar-1' ) )
		$classes[] = 'one-column';

	return $classes;
}
add_filter( 'body_class', 'quintus_body_classes' );

/**
 * Add some useful default widgets to the Quintus sidebar
 */
function quintus_default_widgets() {
	$sidebars = get_option( 'sidebars_widgets' );

	if ( empty ( $sidebars['sidebar-1'] ) && isset( $_GET['activated'] ) ) {
		update_option( 'widget_links', array( 2 => array( 'title' => __( 'Blogs I Read', 'quintus' ) ), '_multiwidget' => 1 ) );
		update_option( 'widget_categories', array( 2 => array( 'title' => __( 'Topics', 'quintus' ) ), '_multiwidget' => 1 ) );
		update_option( 'widget_archives', array( 2 => array( 'title' => __( 'Archives', 'quintus' ) ), '_multiwidget' => 1 ) );

		update_option( 'sidebars_widgets', array(
			'wp_inactive_widgets' => array(),
			'sidebar-1' => array(
				0 => 'links-2',
				1 => 'categories-2',
				2 => 'archives-2',
			),
			'array_version' => 3
		) );
	}
}
add_action( 'after_setup_theme', 'quintus_default_widgets' );

/**
 * Allow a solid background color.
 */
function quintus_solid_background_color() {
	if ( get_background_image() == '' && get_background_color() != '' ) { ?>
		<style type="text/css">
		body {
			background-image: none;
		}
		</style>
	<?php }
}
add_action( 'wp_head', 'quintus_solid_background_color' );

/**
 *  Returns the current Quintus theme options, with default values as fallback.
 */
function quintus_get_theme_options() {
	$defaults = array(
		'color_scheme' => 'default',
	);
	$options = get_option( 'quintus_theme_options', $defaults );

	return $options;
}

/**
 *  Returns the current Quintus color scheme as selected in the theme options.
 */
function quintus_current_color_scheme() {
	$options = quintus_get_theme_options();
	return $options['color_scheme'];
}

/**
 * Register our color scheme and add them to the queue.
 */
function quintus_color_registrar() {
	$color_scheme = quintus_current_color_scheme();

	if ( 'default' == $color_scheme )
		return;

	wp_enqueue_style( $color_scheme, get_template_directory_uri() . '/colors/' . $color_scheme . '.css', null, null );
}
add_action( 'wp_enqueue_scripts', 'quintus_color_registrar' );

/**
 * Adjust the content_width value based on current template.
 *
 */
function quintus_set_full_content_width() {
	global $content_width;
	$content_width = 940;
}


/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @since Quintus 1.1
 */
function quintus_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( __( 'Page %s', 'quintus' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'quintus_wp_title', 10, 2 );

/**
 * Custom Theme Options
 */
require get_template_directory() . '/inc/theme-options.php';

/**
 * Implement the Custom Header feature
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * This theme was built with PHP, Semantic HTML, CSS, love, and a Toolbox.
 */

/**
 * Infinite Scroll Theme Assets
 *
 * Register support for @Twenty Ten and enqueue relevant styles.
 */

add_action( 'template_redirect',      'quintus_infinite_scroll_enqueue_styles', 25 );
add_action( 'infinite_scroll_render', 'quintus_infinite_scroll_render' );
add_action( 'init',                   'quintus_infinite_scroll_init' );

/**
 * Add theme support for infinity scroll
 */
function quintus_infinite_scroll_init() {
	// Theme support takes one argument: the ID of the element to append new results to.
	add_theme_support( 'infinite-scroll', 'content' );
}

/**
 * Set the code to be rendered on for calling posts,
 * hooked to template parts when possible.
 *
 * Note: must define a loop.
 */
function quintus_infinite_scroll_render() {
	while ( have_posts() ) : the_post();
		get_template_part( 'content', get_post_format() );
	endwhile;
}

/**
 * Enqueue CSS stylesheet with theme styles for infinity.
 */
function quintus_infinite_scroll_enqueue_styles() {
	// Add theme specific styles.
	wp_enqueue_style( 'infinity-quintus', plugins_url( 'quintus.css', __FILE__ ), array(), '2012-06-18' );
}

/**
 * Do we have footer widgets?
 */
function infinite_scroll_has_footer_widgets() {
	if ( jetpack_is_mobile( '', true ) && is_active_sidebar( 'sidebar-1' ) )
		return true;
	return false;
}
