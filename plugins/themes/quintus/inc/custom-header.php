<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * @package Quintus
 * @since Quintus 1.0
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * @uses quintus_header_style()
 * @uses quintus_admin_header_style()
 * @uses quintus_admin_header_image()
 *
 * @package Quintus
 */
function quintus_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'quintus_custom_header_args', array(
		'default-text-color'     => 'ffffff',
		'width'                  => 1100,
		'height'                 => 250,
		'flex-height'            => true,
		'wp-head-callback'       => 'quintus_header_style',
		'admin-head-callback'    => 'quintus_admin_header_style',
		'admin-preview-callback' => 'quintus_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'quintus_custom_header_setup' );

if ( ! function_exists( 'quintus_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see quintus_custom_header_setup().
 *
 * @since Quintus 1.0
 */
function quintus_header_style() {
	$header_text_color = get_header_textcolor();
	$header_image      = get_header_image();

	if ( ! empty( $header_image ) ) :
	?>
	<style type="text/css">
		.blog-header {
			background: #181818 url(<?php header_image(); ?>) no-repeat top center !important;
			text-align: center;
		}
		.blog-header .site-branding {
			background: url(<?php echo get_template_directory_uri(); ?>/images/header.jpg) repeat;
			-moz-border-radius: 3px;
			border-radius: 3px;
			display: inline-block;
			margin: 0 auto;
			padding: 0 40px;
		}
		#site-title, #site-description {
			display: block;
		}
		#site-title a:hover {
			border-top-color: transparent;
		}
		<?php if ( HEADER_TEXTCOLOR != $header_text_color ) : ?>
		.blog-header .site-branding {
			background: none;
		}
		#site-description {
			font-weight: 300;
		}
		<?php endif; ?>
	</style>

	<?php else : ?>

	<style type="text/css">
		#ie7 .blog-header .site-branding {
			display: block;
		}
	</style>
	<?php endif;

	if ( HEADER_TEXTCOLOR != $header_text_color ) :
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
	?>
		.blog-header .site-branding {
			display: block;
			padding: 0;
		}
		#site-title,
		#site-title a {
			color: transparent;
			display: block;
			font-size: 0;
			max-width: 100%;
			min-height: 250px;
			padding: 0;
		}
		#site-title a:hover {
			border: none;
		}
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
			color: #<?php echo $header_text_color; ?>
		}
	<?php endif; ?>
	</style>
	<?php

	endif;
}endif; // quintus_header_style

if ( ! function_exists( 'quintus_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see quintus_custom_header_setup().
 *
 * @since Quintus 1.0
 */
function quintus_admin_header_style() {
	$header_image     = get_header_image();
	$background_color = get_background_color();
?>
	<style type="text/css">
		#headimg {
			background-color: #<?php echo ( '' != $background_color ? $background_color : '000' ); ?>;
			<?php
				if ( '' == $header_image && '' == $background_color ) :
					echo 'background-image: url(' . get_template_directory_uri() . '/images/header.jpg) !important;';
				elseif ( ! empty( $header_image ) ) :
					echo 'background-image: url(' . esc_url( $header_image ) . ');';
				endif;
			?>
			width: <?php echo get_custom_header()->width; ?>px;
			height: <?php echo get_custom_header()->height; ?>px;
			text-align: center;
		}
		#heading {
			display: none;
		}
		#headimg .site-branding {
			background: url(<?php echo get_template_directory_uri(); ?>/images/header.jpg) repeat;
			-moz-border-radius: 3px;
			border-radius: 3px;
			display: inline-block;
			margin: 70px auto 0 auto;
			padding: 0 40px;
		}
		#headimg h1 {
			padding: 5px 0 10px;
		}
		#headimg h1 a {
			font-family: Georgia, serif;
			font-size: 52px;
			font-weight: normal;
			text-decoration: none;
		}
		#desc {
			color: #8f8f8f;
			font-family: 'Helvetica Neue', Helvetica, sans-serif;
			font-size: 17px;
			font-weight: 100;
			margin: 0 0 18px 0;
			padding: 0;
		}
	</style>
<?php
}
endif; // quintus_admin_header_style

if ( ! function_exists( 'quintus_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see quintus_custom_header_setup().
 *
 * @since Quintus 1.0
 */
function quintus_admin_header_image() {
	$style = sprintf( ' style="color:#%s;"', get_header_textcolor() );
?>
	<div id="headimg">
		<div class="site-branding">
			<h1 class="displaying-header-text"><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
			<div class="displaying-header-text" id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		</div>
	</div>
<?php
}
endif; // quintus_admin_header_image
