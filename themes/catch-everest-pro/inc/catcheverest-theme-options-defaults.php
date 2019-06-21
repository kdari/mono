<?php
/**
 * @package Catch Themes
 * @subpackage Catch_Everest
 * @since Catch Everest 1.0
 */


if ( ! function_exists( 'catcheverest_available_fonts' ) ) :
/**
 * Returns an array of fonts available to the theme.
 *
 * @since Catch Box Pro 1.0
 */
function catcheverest_available_fonts() {	

	return array(
		'arial-black'			=> '"Arial Black", Gadget, sans-serif',
		'allan'					=> 'Allan, sans-serif',
		'allerta'				=> 'Allerta, sans-serif',
		'amaranth'				=> 'Amaranth, sans-serif',
		'arial'					=> 'Arial, Helvetica, sans-serif',
		'bitter'				=> 'Bitter, sans-serif',
		'cabin'					=> 'Cabin, sans-serif',
		'cantarell'				=> 'Cantarell, sans-serif',
		'century-gothic'		=> '"Century Gothic", sans-serif',
		'courier-new'			=> '"Courier New", Courier, monospace',
		'crimson-text'			=> '"Crimson Text", sans-serif',
		'cuprum'				=> '"Cuprum", sans-serif',
		'dancing-script'		=> '"Dancing Script", sans-serif',
		'droid-sans'			=> '"Droid Sans", sans-serif',
		'droid-serif'			=> '"Droid Serif", sans-serif',
		'georgia'				=> 'Georgia, "Times New Roman", Times, serif',
		'helvetica'				=> 'Helvetica, "Helvetica Neue", Arial, sans-serif',
		'helvetica-neue'		=> '"Helvetica Neue",Helvetica,Arial,sans-serif',
		'istok-web'				=> '"Istok Web", sans-serif',
		'impact'				=> 'Impact, Charcoal, sans-serif',
		'lato'					=> '"Lato", sans-serif',
		'lucida-sans-unicode'	=> '"Lucida Sans Unicode", "Lucida Grande", sans-serif',
		'lucida-grande'			=> '"Lucida Grande", "Lucida Sans Unicode", sans-serif',
		'lobster'				=> 'Lobster, sans-serif',
		'lora'					=> '"Lora", serif',
		'monaco'				=> 'Monaco, Consolas, "Lucida Console", monospace, sans-serif',
		'nobile'				=> 'Nobile, sans-serif',
		'open-sans'				=> '"Open Sans", sans-serif',
		'oswald'				=> '"Oswald", sans-serif',
		'palatino'				=> 'Palatino, "Palatino Linotype", "Book Antiqua", serif',	
		'patua-one'				=> '"Patua One", sans-serif',
		'playfair-display'		=> '"Playfair Display", sans-serif',
		'pt-sans'				=> '"PT Sans", sans-serif',
		'pt-serif'				=> '"PT Serif", serif',
		'quattrocento-sans' 	=> '"Quattrocento Sans", sans-serif',
		'sans-serif'			=> 'Sans Serif, Arial',
		'tahoma'				=> 'Tahoma, Geneva, sans-serif',
		'trebuchet-ms'			=> '"Trebuchet MS", "Helvetica", sans-serif',
		'times-new-roman'		=> '"Times New Roman", Times, serif',
		'ubuntu'				=> 'Ubuntu, sans-serif',
		'verdana'				=> 'Verdana, Geneva, sans-serif',
		'yanone-kaffeesatz' 	=> '"Yanone Kaffeesatz", sans-serif'
	);
	
}
endif;


/**
 * Set the default values for all the settings. If no user-defined values
 * is available for any setting, these defaults will be used.
 */
global $catcheverest_options_defaults;
$catcheverest_options_defaults = array(
	'disable_responsive'					=> '0',
	'site_title_above'						=> '0',
	'featured_header_image'					=> get_template_directory_uri().'/images/header-image.jpg',
	'featured_header_image_position'		=> 'before-menu',
	'enable_featured_header_image'			=> 'disable',
	'featured_header_image_url'				=> '',
	'featured_header_image_alt'				=> '',
	'featured_header_image_base'			=> '0',
 	'fav_icon'								=> get_template_directory_uri().'/images/favicon.ico',
 	'remove_favicon'						=> '0',
	'disable_header_right_sidebar'			=> '0',
	'color_scheme'							=> 'light',
	'header_background'						=> '#fff',
	'content_background'					=> '#fff',
	'footer_sidebar_background'				=> '#fafafa',
	'footer_background'						=> '#3a3d41',
	'title_color'							=> '#222',
	'title_hover_color'						=> '#0088cc',
	'meta_color'							=> '#757575',
	'text_color'							=> '#404040',
	'link_color'							=> '#0088cc',
	'widget_title_color'					=> '#404040',
	'widget_color'							=> '#fff',
	'widget_link_color'						=> '#757575',
	'home_headline_background'				=> '#fafafa',
	'home_headline'							=> '#404040',
	'menu_background'						=> '#3a3d41',
	'menu_color'							=> '#eee',
	'hover_active_color'					=> '#000',
	'hover_active_text_color'				=> '#eee',
	'sub_menu_bg_color'						=> '#222',
	'catcheverest_sub_menu_text_color'		=> '#fff',
	'sub_menu_text_color'					=> '#fff',
	'reset_color'							=> '2',
	'body_font'								=> 'helvetica',
	'title_font'							=> 'helvetica',
	'tagline_font'							=> 'helvetica',
	'content_tittle_font'					=> 'helvetica',
	'content_font'							=> 'helvetica',
	'headings_font'							=> 'cuprum',
	'reset_typography'						=> '2',	
	'custom_css'							=> '',	
	'sidebar_layout'						=> 'right-sidebar',
	'content_layout'						=> 'full',
	'featured_image'						=> 'featured',
	'reset_layout'							=> '2',
	'more_tag_text'							=> 'Continue Reading &rarr;',
	'reset_moretag'							=> '2',
	'excerpt_length'						=> 30,
 	'search_display_text'					=> 'Search &hellip;',
	'feed_url'								=> '',
	'homepage_headline'						=> 'Homepage Headline. ',
	'homepage_subheadline'					=> 'You can edit or disable it through Theme Options.',
	'disable_homepage_headline'				=> '0',
	'disable_homepage_subheadline'			=> '0',
	'disable_homepage_featured'				=> '0',
	'homepage_featured_headline'			=> '',
	'homepage_featured_qty'					=> 3,
	'homepage_featured_layout'				=> 'three-columns',
	'homepage_featured_image'				=> array(),
	'homepage_featured_url'					=> array(),
	'homepage_featured_base'				=> array(),
	'homepage_featured_title'				=> array(),
	'homepage_featured_content'				=> array(),
	'enable_posts_home'						=> '0',
 	'front_page_category'					=> array(),
	'select_slider_type'					=> 'post-slider',
	'enable_slider'							=> 'enable-slider-homepage',
 	'featured_slider'						=> array(),
	'featured_slider_page'					=> array(),	
	'slider_category'						=> array(),
	'featured_image_slider_image'			=> array(),
	'featured_image_slider_link' 			=> array(),
	'featured_image_slider_base'			=> array(),
	'featured_image_slider_title' 			=> array(),
	'featured_image_slider_content' 		=> array(),
	'slider_qty'							=> 4,
 	'transition_effect'						=> 'fade',
 	'transition_delay'						=> 4,
 	'transition_duration'					=> 1,	
	'exclude_slider_post'					=> 0,
 	'social_facebook'						=> '',
 	'social_twitter'						=> '',
 	'social_googleplus'						=> '',
 	'social_pinterest'						=> '',
 	'social_youtube'						=> '',
 	'social_vimeo'							=> '',
 	'social_linkedin'						=> '',
 	'social_slideshare'						=> '',
 	'social_foursquare'						=> '',
 	'social_flickr'							=> '',
 	'social_tumblr'							=> '',
 	'social_deviantart'						=> '',
 	'social_dribbble'						=> '',
 	'social_myspace'						=> '',
 	'social_wordpress'						=> '',
 	'social_rss'							=> '',
 	'social_delicious'						=> '',
 	'social_lastfm'							=> '',
	'social_instagram'						=> '',
	'social_github'							=> '',
 	'google_verification'					=> '',
 	'yahoo_verification'					=> '',
 	'bing_verification'						=> '',
 	'analytic_header'						=> '',
 	'analytic_footer'						=> '',
	'footer_code'							=> '<div class="copyright">'. esc_attr__( 'Copyright', 'catcheverest' ) . ' &copy; [the-year] <span>[site-link]</span>. '. esc_attr__( 'All Rights Reserved', 'catcheverest' ) . '.</div><div class="powered">'. esc_attr__( 'Powered by', 'catcheverest' ) . ': [wp-link] | '. esc_attr__( 'Theme', 'catcheverest' ) . ': [theme-link]</div>',
	'reset_footer'							=> '2'
);
global $catcheverest_options_settings;
$catcheverest_options_settings = catcheverest_options_set_defaults( $catcheverest_options_defaults );

function catcheverest_options_set_defaults( $catcheverest_options_defaults ) {
	$catcheverest_options_settings = array_merge( $catcheverest_options_defaults, (array) get_option( 'catcheverest_options', array() ) );
	return $catcheverest_options_settings;
}

?>