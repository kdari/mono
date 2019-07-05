<?php

require_once('library/common-functions.php');            // core functions (don't remove)

/*-----------------------------------------------------------------------------------*/
/*	Set content width
/*-----------------------------------------------------------------------------------*/
if ( ! isset( $content_width ) )
	$content_width = 640;


/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'single-post-thumbnail', 400, 9999 );
add_image_size( 'header-image', 640, 150, true );
add_image_size( 'tab-thumb', 200, 134, true );

//add_image_size( 'lop-thumb-300', 300, 100, true );

/************* ACTIVE SIDEBARS ********************/
/*-----------------------------------------------------------------------------------*/
/*	Register Sidebars
/*-----------------------------------------------------------------------------------*/
function lop_register_sidebars() {

	// Home Page Sidebar
	register_sidebar( array(
		'name' => __( 'Home Sidebar', 'lop' ),
		'id' => 'sidebar-home',
		'description' => __( 'The home page sidebar widget area', 'lop' ),
		'before_widget' => '<aside id="%1$s" class="lop-widget %2$s">',
		'after_widget' => '<div class="divider"></div></aside>',
		'before_title' => '<h3 class="widget-title replace">',
		'after_title' => '</h3>',
	) );

	// Primary Sidebar
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'lop' ),
		'id' => 'sidebar-main',
		'description' => __( 'The primary sidebar widget area', 'lop' ),
		'before_widget' => '<aside id="%1$s" class="lop-widget %2$s">',
		'after_widget' => '<div class="divider"></div></aside>',
		'before_title' => '<h3 class="widget-title replace">',
		'after_title' => '</h3>',
	) );

 // Primary Sidebar
	register_sidebar( array(
		'name' => __( 'Home Content', 'lop' ),
		'id' => 'home-main',
		'description' => __( 'The home content', 'lop' ),
		
	) );



	// Footer - Col 1. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Footer', 'lop' ),
		'id' => 'first-footer-widget',
		'description' => __( 'The first footer widget area', 'lop' ),
		'before_widget' => '<aside id="%1$s" class="lop-footer-widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h6 class="widget-title tshadow">',
		'after_title' => '</h6>',

	) );

	// Footer - Col 2. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Footer', 'lop' ),
		'id' => 'second-footer-widget',
		'description' => __( 'The second footer widget area', 'lop' ),
		'before_widget' => '<aside id="%1$s" class="lop-footer-widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h6 class="widget-title tshadow">',
		'after_title' => '</h6>',
	) );

	// Footer - Col 3. Empty by default.
	register_sidebar( array(
		'name' => __( 'Third Footer', 'lop' ),
		'id' => 'third-footer-widget',
		'description' => __( 'The third footer widget area', 'lop' ),
		'before_widget' => '<aside id="%1$s" class="lop-footer-widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h6 class="widget-title tshadow">',
		'after_title' => '</h6>',
	) );

}


/************* SEARCH FORM LAYOUT *****************/
/*-----------------------------------------------------------------------------------*/
/*	Search Form
/*-----------------------------------------------------------------------------------*/
function lop_wpsearch($form) {
	   $form = '<form action="' . home_url( '/' ) . '" class="navbar-search" role="search" method="get">
        			<input type="text" placeholder="' . __('Search', 'lop') . '" class="search-query" value="' . get_search_query() . '" name="s">
      			</form>';
    return $form;
}


/*-----------------------------------------------------------------------------------*/
/*	Register scripts
/*-----------------------------------------------------------------------------------*/
function lop_reg_script() {
	if (!is_admin()) {
		// comment out the next two lines to load the local copy of jQuery
		wp_deregister_script('jquery');
		wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js', false, '1.7.1');
		wp_register_script('superfish', get_template_directory_uri() . '/library/js/superfish-compile.js', 'jquery');
		wp_register_script('modernizr', get_template_directory_uri() . '/library/js/modernizr.full.min.js', 'jquery');
		wp_register_script('popup', get_template_directory_uri() . '/library/js/popup.js', 'jquery');
		wp_register_script('custom', get_template_directory_uri() . '/library/js/init.js', 'jquery', '', true);
		wp_register_script('nivoslider', get_template_directory_uri() . '/library/js/jquery.nivo.slider.js', 'jquery');

		//Single only
		wp_register_script('addthis', 'http://s7.addthis.com/js/250/addthis_widget.js', '','','true');

		//All
		wp_enqueue_script('jquery');
		wp_enqueue_script('superfish');
		wp_enqueue_script('modernizr');
		wp_enqueue_script('popup');
		wp_enqueue_script('custom');
	}
}

// Add ie conditional html5 shim to header
function lop_ie_html5_shim () {
    echo '<!--[if lt IE 9]>';
    echo '<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>';
    echo '<![endif]-->';
}
add_action('wp_head', 'lop_ie_html5_shim');

// Flexslider scripts
function lop_slider_script() {
	if ( is_page_template('template-home.php') ) {
 	wp_enqueue_script('nivoslider'); }
}
add_action('wp_print_scripts', 'lop_slider_script');

// Comment scripts for the threaded comment reply functionality.
function lop_comment_script() {
	if ( is_singular() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' ); }
}
add_action('wp_print_scripts', 'lop_comment_script');

// Single page scripts
function lop_single_script() {
	if ( is_single() ) {
		wp_enqueue_script('addthis'); 
	}
}
add_action('wp_print_scripts', 'lop_single_script');



/*-----------------------------------------------------------------------------------*/
/* Slide
/*-----------------------------------------------------------------------------------*/
function lop_slider() {
	if (is_page_template('template-home.php') ) {
		global $data;
		$effect = $data['lop_slide_effect'];
		$animSpeed = $data['lop_slide_animspeed'];
		$pauseTime = $data['lop_slide_pausetime'];
		$directionNav = $data['lop_slide_dirnav'];
		$controlNav = $data['lop_slide_control'];
		?>
		<script type="text/javascript">
            jQuery(document).ready(function() {
				if (jQuery().nivoSlider) {
					jQuery('#slider').nivoSlider({
						<?php if($effect ) : ?> effect: "<?php echo $effect; ?>", <?php endif; ?>
						<?php if($animSpeed ) : ?> animSpeed: <?php echo $animSpeed; ?>, <?php endif; ?>
						<?php if($pauseTime ) : ?> pauseTime: <?php echo $pauseTime; ?>, <?php endif; ?>					
						<?php if($directionNav == 0 ) : ?> directionNav: false, <?php endif; ?>
						<?php if($controlNav == 0 ) : ?> controlNav: false <?php endif; ?>
					 });
				};
			});
		</script>
		<?php
	}
}
add_action('wp_head', 'lop_slider');

/*-----------------------------------------------------------------------------------*/
/*	Add this
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'lop_addthis' )):

function lop_addthis() {
		if(is_single() && !is_page()){
			echo '<div class="addthis_toolbox addthis_default_style">
				<a class="addthis_button_preferred_1"></a>
				<a class="addthis_button_preferred_2"></a>
				<a class="addthis_button_preferred_3"></a>
				<a class="addthis_button_compact"></a>
				<a class="addthis_button_google_plusone"></a>
				<a class="addthis_button_tweet"></a>
				<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
			</div>';
		};
}
endif;

/*-----------------------------------------------------------------------------------*/
/*	Custom WP Admin Login Logo
/*-----------------------------------------------------------------------------------*/
function lop_custom_login_logo() {
	global $data;
	if ( $data['lop_custom_login'] )   {
	echo '<style type="text/css">h1 a { background-image:url('.$data['lop_custom_login'].') !important; } </style>'; }
}

add_action('login_head', 'lop_custom_login_logo');

/*-----------------------------------------------------------------------------------*/
/* Google Analytics
/*-----------------------------------------------------------------------------------*/
function lop_analytics(){
	global $data;
	if ( $data['lop_ga_code'] != '') {
	echo stripslashes($data['lop_ga_code'])  ;
	}
}
add_action('wp_footer','lop_analytics');



/*-----------------------------------------------------------------------------------*/
/* Custom CSS */
/*-----------------------------------------------------------------------------------*/
function lop_custom_css(){
global $data;

$css_script_container = array();
$css_array = array();

$custom_css = $data['lop_custom_css'];
$google_font = $data['lop_google_font'];
$custom_bg_img = $data['lop_bg_image'];
$custom_body_bg_img = $data['lop_body_bg_image'];
$footer_bg_color = $data['lop_footer_bg_color'];

    //custom css
	if(!empty($custom_css)){
     array_push(          $css_array,$custom_css);
	}

	//google web fonts
    if( $google_font ){
	        $google_font_link = '<link href="http://fonts.googleapis.com/css?family='.$google_font.'" rel="stylesheet" type="text/css" />'."\n";
			$google_font_code = '.replace  {font-family:\''.$google_font.'\', Helvetica, Arial, sans-serif;}'."\n";
			array_push($css_script_container,$google_font_link);
			array_push($css_array,$google_font_code);
	}

	//add custom header background
    if( $custom_bg_img ){
			$background_code = 	'#wrapper  { background:  url('.$custom_bg_img.') repeat-x top center; }'."\n";
			array_push($css_array,$background_code);
	}

	//add custom body background
    if( $custom_body_bg_img  ){
			$body_background_code =  'body  { background:  url('.$custom_body_bg_img.') repeat; }'."\n";
			array_push($css_array,$body_background_code);
	}

	//add footer background color
    if( $footer_bg_color ){
			$footer_bg_color_code = '#footer-wrapper { background:'.$footer_bg_color.'; }'."\n";
			array_push($css_array,$footer_bg_color_code);
	}

	//print <head>
	if(!empty($css_array)){
	  echo"<style type='text/css'>\n";
			foreach($css_array as $css_item){
			 echo $css_item."\n";
			}
	  echo"</style>\n";
	}

	if(!empty($css_script_container)){
	   foreach($css_script_container as $css_link){
		echo $css_link."\n";
	   }
	}

}
add_action('wp_head','lop_custom_css',30);


/*-----------------------------------------------------------------------------------*/
/*	Widgets
/*-----------------------------------------------------------------------------------*/
include("library/widgets/widget-ad245.php");
include("library/widgets/widget-flickr.php");
include("library/widgets/widget-video.php");
include("library/widgets/widget-twitter.php");
include("library/widgets/widget-newsletter.php");
include("library/widgets/widget-request.php");

/*-----------------------------------------------------------------------------------*/
// Options Framework
/*-----------------------------------------------------------------------------------*/

require_once ('admin/index.php');



?>