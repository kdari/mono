<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...

	<?php $header_image = get_header_image();
	if ( ! empty( $header_image ) ) { ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
		</a>
	<?php } // if ( ! empty( $header_image ) ) ?>

 *
 * @package Catch Everest
 * @since Catch Everest 1.0
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for previous versions.
 * Use feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * @todo Rework this function to remove WordPress 3.4 support when WordPress 3.6 is released.
 *
 * @uses catcheverest_header_style()
 * @uses catcheverest_admin_header_style()
 * @uses catcheverest_admin_header_image()
 *
 * @package Catch Everest
 */
function catcheverest_custom_header_setup() {
	$args = array(
		// Text color and image (empty to use none).
		'default-text-color'     => '000',
		'default-image'          => '',
		
		// Set height and width, with a maximum value for the width.
		'height'                 => 125,
		'width'                  => 300,
		'max-width'              => 1038,
		
		// Support flexible height and width.
		'flex-height'            => true,
		'flex-width'             => true,
			
		// Random image rotation off by default.
		'random-default'         => false,	
			
		// Callbacks for styling the header and the admin preview.
		'wp-head-callback'       => 'catcheverest_header_style',
		'admin-head-callback'    => 'catcheverest_admin_header_style',
		'admin-preview-callback' => 'catcheverest_admin_header_image',
	);

	$args = apply_filters( 'catcheverest_custom_header_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		// For WordPress 3.4+
		add_theme_support( 'custom-header', $args );
	} else {
		// Compat: Versions of WordPress prior to 3.4.
		define( 'HEADER_TEXTCOLOR',    $args['default-text-color'] );
		define( 'HEADER_IMAGE',        $args['default-image'] );
		define( 'HEADER_IMAGE_WIDTH',  $args['width'] );
		define( 'HEADER_IMAGE_HEIGHT', $args['height'] );
		
		// We'll be using post thumbnails for custom header images for logos.
		// We want them to be the size of the header image that we just defined
		// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
		set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );
		
		add_custom_image_header( $args['wp-head-callback'], $args['admin-head-callback'], $args['admin-preview-callback'] );
	}
}
add_action( 'after_setup_theme', 'catcheverest_custom_header_setup' );

/**
 * Shiv for get_custom_header().
 *
 * get_custom_header() was introduced to WordPress
 * in version 3.4. To provide backward compatibility
 * with previous versions, we will define our own version
 * of this function.
 *
 * @todo Remove this function when WordPress 3.6 is released.
 * @return stdClass All properties represent attributes of the curent header image.
 *
 * @package Catch Everest
 * @since Catch Everest 1.1
 */

if ( ! function_exists( 'get_custom_header' ) ) {
	function get_custom_header() {
		return (object) array(
			'url'           => get_header_image(),
			'thumbnail_url' => get_header_image(),
			'width'         => HEADER_IMAGE_WIDTH,
			'height'        => HEADER_IMAGE_HEIGHT,
		);
	}
}

if ( ! function_exists( 'catcheverest_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see catcheverest_custom_header_setup().
 *
 * @since Catch Everest 1.0
 */
function catcheverest_header_style() {

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == get_header_textcolor() )
		return;
	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == get_header_textcolor() ) :
	?>
		#hgroup.with-logo { padding: 0; }
		#site-title,
		#site-description {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		#site-title a,
		#site-description {
			color: #<?php echo get_header_textcolor(); ?> !important;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // catcheverest_header_style

if ( ! function_exists( 'catcheverest_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see catcheverest_custom_header_setup().
 *
 * @since Catch Everest 1.0
 */
function catcheverest_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		border: none;
	}
	#headimg h1,
	#desc {
	}
	#headimg h1 {
	}
	#headimg h1 a {
	}
	#desc {
	}
	#headimg img {
	}
	</style>
<?php
}
endif; // catcheverest_admin_header_style

if ( ! function_exists( 'catcheverest_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see catcheverest_custom_header_setup().
 *
 * @since Catch Everest 1.0
 */
function catcheverest_admin_header_image() { ?>
	<div id="headimg">
		<?php
		if ( 'blank' == get_header_textcolor() || '' == get_header_textcolor() )
			$style = ' style="display:none;"';
		else
			$style = ' style="color:#' . get_header_textcolor() . ';"';
		?>
		<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<img src="<?php echo esc_url( $header_image ); ?>" alt="" />
		<?php endif; ?>
	</div>
<?php }
endif; // catcheverest_admin_header_image