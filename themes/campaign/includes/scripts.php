<?php

function dcs_load_scripts() {

	// load WP's included jQuery library
	wp_enqueue_script('jquery');

	// global scripts
	wp_enqueue_script('jquery-slabtext', get_template_directory_uri() . '/includes/js/jquery.slabtext.min.js');
	wp_enqueue_script('jquery-easing', get_template_directory_uri() . '/includes/js/jquery.easing.1.3.js');
	wp_enqueue_script('jquery-mousewheel', get_template_directory_uri() . '/includes/fancybox/jquery.mousewheel-3.0.4.pack.js');
	wp_enqueue_script('jquery-fancybox', get_template_directory_uri() . '/includes/fancybox/jquery.fancybox-1.3.4.pack.js');
	wp_enqueue_script('jquery-mobilemenu', get_template_directory_uri() . '/includes/js/jquery.mobilemenu.js');
	
	// front page scripts
	if (is_front_page()) { 
		wp_enqueue_script('jquery-slides', get_template_directory_uri() . '/includes/js/slides.jquery.js');
	}
	
	// sticky header
	if ((of_get_option('sticky_header') == 'yes') && (of_get_option('body_display') == 'body_span')) {
		wp_enqueue_script('jquery-sticky', get_template_directory_uri() . '/includes/js/jquery.sticky.js');
	}
	
	// load singular (posts and pages) scripts
	if ( is_singular() ) {
		wp_enqueue_script( 'comment-reply' ); //enable nested comments 
	}
	
	// global styles
	wp_enqueue_style('jquery-fancybox', get_template_directory_uri() . '/includes/fancybox/jquery.fancybox-1.3.4.css');
	wp_enqueue_style('heading-font', get_template_directory_uri() . '/fonts/style-' . stripslashes(of_get_option('heading_font')) . '.css');
		
	// load in footer
	function dcs_add_footer_js() {
    	get_template_part('includes/js/campaignjs');
	}
	add_action('wp_footer', 'dcs_add_footer_js');
		
}
add_action('wp_enqueue_scripts', 'dcs_load_scripts');