<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		$shortname = "lop";

		//Access the WordPress Categories via an Array
		$of_categories = array();  
		$of_categories_obj = get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp = array_unshift($of_categories, "Select a category:");    
	       
		
		// Pull all the pages into an array (Custom)
		$options_pages = array();  
		$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
		$options_pages[''] = 'Select a page:';
		foreach ($options_pages_obj as $page) {
			$options_pages[$page->ID] = $page->post_title;
		}
	
		//Testing 
		$of_options_select = array("one","two","three","four","five"); 
		$of_options_radio = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
		
		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		( 
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_one"		=> "Block One",
				"block_two"		=> "Block Two",
				"block_three"	=> "Block Three",
			), 
			"enabled" => array (
				"placebo" => "placebo", //REQUIRED!
				"block_four"	=> "Block Four",
			),
		);


		//Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets = array();
		
		if ( is_dir($alt_stylesheet_path) ) 
		{
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) 
		    { 
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) 
		        {
		            if(stristr($alt_stylesheet_file, ".css") !== false)
		            {
		                $alt_stylesheets[] = $alt_stylesheet_file;
		            }
		        }    
		    }
		}


		//Background Images Reader
		$bg_images_path = STYLESHEETPATH. '/images/bg/'; // change this to where you store your bg images
		$bg_images_url = get_bloginfo('template_url').'/images/bg/'; // change this to where you store your bg images
		$bg_images = array();
		
		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) { 
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
		                $bg_images[] = $bg_images_url . $bg_images_file;
		            }
		        }    
		    }
		}
		

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr = wp_upload_dir();
		$all_uploads_path = $uploads_arr['path'];
		$all_uploads = get_option('of_uploads');
		$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();


/*====== GENERAL =====*/
					
$of_options[] = array( "name" => __('General','lop'),
					"type" => "heading");
					
$of_options[] = array( "name" => __('Addthis','lop'),
					"desc" => __('Display Addthis in Single Posts.','lop'),
					"id" => $shortname."_addthis_bar",
					"std" => 0,
					"type" => "checkbox");	
					
$of_options[] = array( "name" => __('Footer logo image','lop'),
					"desc" => __('Enter the URL of your custom logo. e.g. http://yourwebsite.com/logo.png. Maximum width: 300px.','lop'),
					"id" => $shortname."_logo_footer",
					"type" => "upload",
					"std" => "");	
						
$of_options[] = array( "name" => __('Footer text','lop'),
					"desc" => __('Copyright note in the footer','lop'), 
					"id" => $shortname."_footer_text",
					"std" => "",
					"type" => "textarea");
					
$of_options[] = array( "name" => __('Tracking code','lop'),
					"desc" => __('Enter the tracking code, e.g., Google Analytics, with the &lt;script&gt; tag.','lop'),
					"id" =>  $shortname."_ga_code",
					"std" => "",
					"type" => "textarea");	
					

/*====== Appearance =====*/

$of_options[] = array( "name" => __('Appearance','lop'),
					"type" => "heading");
					
$of_options[] = array( "name" => __('Color scheme','lop'),
					"desc" =>  __('Select color scheme','lop'),
					"id" => $shortname."_stylesheet",
					"std" => "",
					"type" => "select",
					"options" => array( "","style-blue.css","style-orange.css","style-red.css"
						)
					);

$of_options[] = array( "name" => __('Header background image','lop'),
					"desc" => __('Upload the header background image','lop'),
					"id" => $shortname."_bg_image",
					"type" => "upload");
					
$of_options[] = array( "name" => __('Background image','lop'),
					"desc" => __('Upload the body background image','lop'),
					"id" => $shortname."_body_bg_image",
					"type" => "upload");
					
$of_options[] = array( "name" => __('Footer background color','lop'),
					"desc" => __('Select the color of footer background. No color selected by default.','lop'),
					"id" => $shortname."_footer_bg_color",
					"type" => "color");
										
$of_options[] = array( "name" => __('Logo','lop'),
					"desc" => __('Upload custom logo image','lop'),
					"id" => $shortname."_custom_logo",
					"type" => "upload");
					
$of_options[] = array( "name" => __('Login logo','lop'),
					"desc" => __('Upload custom WordPress login image. Max 325px x 80px.','lop'),
					"id" => $shortname."_custom_login",
					"type" => "upload");
					
$of_options[] = array( "name" => __('Custom favicon','lop'),
					"desc" => __('Upload custom favicon image (.ico)','lop'),
					"id" => $shortname."_custom_favicon",
					"type" => "upload");
					
$of_options[] = array( "name" => __('Custom CSS','lop'),
					"desc" => __('Enter custom CSS style.','lop'),
					"id" =>  $shortname."_custom_css", 
					"std" => "",
					"type" => "textarea");	
																
$of_options[] = array( "name" => __('Google Web Fonts','lop'),
					"desc" => __('Insert the font type for the headings, e.g, Dosis, Berkshire Swash, Londrina Solid, etc. <a href="http://goo.gl/v2hiB" taret="_blank">Google Web Fonts</a> will replace the default Font Face.','lop'),
					"id" => $shortname."_google_font",
					"std" => "",
					"type" => "text");

/*====== HOMEPAGE =====*/

$of_options[] = array( "name" => __('Home Page','lop'),
					"type" => "heading");
					
/*$of_options[] = array( "name" => __('Homepage layout manager','lop'),
					"desc" => __('Organize how you want the layout to appear on the homepage','lop'),
					"id" => "homepage_mods",
					"std" => $of_options_homepage_mods,
					"type" => "sorter");
										*/

$of_options[] = array( "name" => __('Latest Post','lop'), 
					"desc" => __('Display Lates Post','lop'),
					"id" => $shortname."_latest_posts",
					"std" => 0,
					"type" => "checkbox");
					
$of_options[] = array( "name" => __('Tab 1','lop'), 
					"desc" => __('Display Tab 1','lop'),
					"id" => $shortname."_tab_1",
					"std" => 1,
					"type" => "checkbox");
					
$of_options[] = array( 
					"desc" => __('Tab 1 Heading','lop'),
					"id" => $shortname."_tab_1_title",
					"std" => "",
					"type" => "text");
					
$of_options[] = array( 
					"desc" => __('Tab 1 Query','lop'),
					"id" => $shortname."_tab_1_id",
					"std" => "",
					"type" => "text");
					
$of_options[] = array( 
					"desc" => "Select the post style.",
					"id" => $shortname."_tab_1_style",
					"std" => "",
					"type" => "select",
					"options" => array(
						'thumbnail' => 'thumbnail',
						'title' => 'title',
						'full' => 'full')
					);


															 
$of_options[] = array( "name" => __('Tab 2','lop'), 
					"desc" => __('Display Tab 2','lop'),
					"id" => $shortname."_tab_2",
					"std" => 1,
					"type" => "checkbox"); 
					
$of_options[] = array( 
					"desc" => __('Tab 2 Heading','lop'),
					"id" => $shortname."_tab_2_title",
					"std" => "",
					"type" => "text");
										
$of_options[] = array( 
					"desc" => __('Tab 2 Query','lop'),
					"id" => $shortname."_tab_2_id",
					"std" => "",
					"type" => "text");
					
$of_options[] = array( 
					"desc" => "Select the post style.",
					"id" => $shortname."_tab_2_style",
					"std" => "",
					"type" => "select",
					"options" => array(
						'thumbnail' => 'thumbnail',
						'title' => 'title',
						'full' => 'full')
					);					

$of_options[] = array( "name" => __('Tab 3','lop'), 
					"desc" => __('Display Tab 3','lop'),
					"id" => $shortname."_tab_3",
					"std" => 1,
					"type" => "checkbox"); 
					
$of_options[] = array(
				"desc" => __('Tab 3 Heading','lop'),
				"id" => $shortname."_tab_3_title",
				"std" => "",
				"type" => "text");
										
$of_options[] = array( 
					"desc" => __('Tab 3 Query','lop'),
					"id" => $shortname."_tab_3_id",
					"std" => "",
					"type" => "text");					
					
$of_options[] = array( 
					"desc" => "Select the post style.",
					"id" => $shortname."_tab_3_style",
					"std" => "",
					"type" => "select",
					"options" => array(
						'thumbnail' => 'thumbnail',
						'title' => 'title',
						'full' => 'full')
					);									  

					


					
$of_options[] = array( "name" => __('Headline Box - Title text','lop'),
	"desc" => "Enter title text to be displayed in the Headline Box.",
	"id" => $shortname."_hlbox_title",
	"type" => "text",
	"std" => "");

$of_options[] = array( "name" => __('Headline Box - Body Text','lop'),
	"desc" => "Enter body text to be displayed in the Headline Box. It can be HTML",
	"id" => $shortname."_hlbox_text",
	"type" => "textarea",
	"std" => "");





/*====== SLIDER =====*/
$of_options[] = array( "name" => __('Slider','lop'),
					"type" => "heading");
										
$of_options[] = array( "name" => __('Slider images','lop'),
					"desc" =>  __('Upload image ( 640px x 280px ).','lop'),
					"id" => $shortname."_slider_img",
					"std" => "",
					"type" => "slider");						
					
$of_options[] = array( "name" => __('Animation type','lop'),
					"desc" => __('Select the animation type.','lop'),
					"id" => $shortname."_slide_effect",
					"type" => "select",
					"std" => "fade",
					"options" => array(
						'sliceDown' => 'sliceDown',
						'sliceUp' => 'sliceUp',
						'fold' => 'fold',
						'fade' => 'fade',
						'random' => 'random',
						'slideInRight' => 'slideInRight',
						'slideInLeft' => 'slideInLeft',
						'boxRain' => 'boxRain',
						'boxRainGrow' => 'boxRainGrow' )
					);
					
$of_options[] = array( "name" => __('Animation speed','lop'),
					"desc" => __('Set the speed of the slideshow, in milliseconds. Default: 500.','lop'),
					"id" => $shortname."_slide_animspeed",
					"class" => 'mini',
					"std" => "500",
					"type" => "text");				
					
$of_options[] = array( "name" => __('Pause time','lop'),
					"desc" => __('How long each slide will show, in milliseconds. Default: 4000.','lop'),
					"id" => $shortname."_slide_pausetime",
					"class" => 'mini',
					"std" => "4000",
					"type" => "text");						
					
$of_options[] = array( "name" => __('Direction navigation','lop'), 
					"desc" => __('Display previous and next navigation','lop'),
					"id" => $shortname."_slide_dirnav",
					"std" => 1,
					"type" => "checkbox"); 
					
$of_options[] = array( "name" => __('Control navigation','lop'),
					"desc" => __('Display navigation for each slide','lop'),
					"id" => $shortname."_slide_control",
					"std" => 0,
					"type" => "checkbox"); 					
					
										
/*====== POPUP =====*/
$of_options[] = array( "name" => __('Popup','lop'),
					"type" => "heading");	
$of_options[] = array( "name" => __('Popup Window','lop'),
					"desc" => __('Display Popup Window menu in the Secondary Menu.','lop'),
					"id" => $shortname."_popup_menu",
					"std" => 1,
					"type" => "checkbox");
							
$of_options[] = array( "name" => __('Popup Menu Title','lop'),
					"desc" => __('Enter menu title.','lop'),
					"id" => $shortname."_popup_link",
					"std" => "Service Times",
					"type" => "text");	
					
$of_options[] = array( "name" => __('Popup page','lop'),
					"desc" => __('Select a page where the button linked to.','lop'),
					"id" => $shortname."_popup_page",
					"std" => 'Select a page:',
					"type" => "selectpage",
					"options" => $options_pages);	
					
					
		
					
// Backup Options
$of_options[] = array( "name" => "Backup Options",
					"type" => "heading");
					
$of_options[] = array( "name" => "Backup and Restore Options",
                    "id" => "of_backup",
                    "std" => "",
                    "type" => "backup",
					"desc" => 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
					);
					
$of_options[] = array( "name" => "Transfer Theme Options Data",
                    "id" => "of_transfer",
                    "std" => "",
                    "type" => "transfer",
					"desc" => 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".
						',
					);
					
					
					
					
	}
}
?>
