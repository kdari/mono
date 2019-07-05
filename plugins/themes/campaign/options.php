<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "", strtolower($themename) );
	
	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);
	
	// echo $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

function optionsframework_options() {

	$heading_fonts = array("bitter" => "Bitter","droidsans" => "Droid Sans","droidserif" => "Droid Serif","franchise" => "Franchise","museo" => "Museo Slab","ubuntu" => "Ubuntu","rokkitt" => "Rokkitt");
	
	// Pull all the categories into an array
	$options_categories = array();  
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all the pages into an array
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = __('Select a page:', 'designcrumbs');
	foreach ($options_pages_obj as $page) {
    	$options_pages[$page->ID] = $page->post_title;
	}
		
	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';
		
	$options = array();
		
	$options[] = array( "name" => __('Basic Settings', 'designcrumbs'),
						"type" => "heading");
						
	$options[] = array( "name" => __('Logo', 'designcrumbs'),
						"desc" => __('Upload your logo. Height should be 80px, if it is bigger, it will be resized.', 'designcrumbs'),
						"id" => "logo",
						"type" => "upload");
						
	$options[] = array( "name" => __('Favicon', 'designcrumbs'),
						"desc" => __('The Favicon is the little 16x16 icon that appears next to your URL in the browser. It is not required, but recommended.', 'designcrumbs'),
						"id" => "favicon",
						"type" => "upload");
						
	$options[] = array( "name" => __('Site Layout', 'designcrumbs'),
						"desc" => __('Select a layout for the site.', 'designcrumbs'),
						"id" => "layout",
						"std" => "content_left",
						"type" => "images",
						"options" => array(
							'content_right' => $imagepath . '2cl.png',
							'content_left' => $imagepath . '2cr.png',)
						);
						
	$options[] = array( "name" => __('Body Display Style', 'designcrumbs'),
						"desc" => __('Choose if you want your site design to be boxed in or span the width of the browser.', 'designcrumbs'),
						"id" => "body_display",
						"std" => "body_boxed",
						"type" => "radio",
						"options" => array("body_boxed" => __('Boxed', 'designcrumbs'),"body_span" => __('Full Width', 'designcrumbs')));
	
	$options[] = array( "name" => __('Sticky Header', 'designcrumbs'),
						"desc" => __('Would you like the header to stick to the top of the browser as the user scrolls down the site?', 'designcrumbs'),
						"id" => "sticky_header",
						"std" => "yes",
						"type" => "radio",
						"options" => array("yes" => __('Yes', 'designcrumbs'),"no" => __('No', 'designcrumbs')));					
						
	$options[] = array( "name" => __('Tracking Code', 'designcrumbs'),
						"desc" => __('Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme. If you need analytics, you can <a href="http://www.google.com/analytics" target="_blank">go here</a>.', 'designcrumbs'),
						"id" => "analytics",
						"std" => "",
						"type" => "textarea");
						
	$options[] = array( "name" => __('Credit Where Credit Is Due', 'designcrumbs'),
						"desc" => __('Checking this box will give credit to Jake Caputo and the Campaign theme in the footer.', 'designcrumbs'),
						"id" => "give_credit",
						"std" => "1",
						"type" => "checkbox");
						
	$options[] = array( "name" => __('Presstrends', 'designcrumbs'),
						"desc" => __('This theme makes use of Presstrends to track how users are using the theme. This will allow Jake Caputo / Design Crumbs make improvements and adjustments to the theme based on how it\'s being used. To learn more about Presstrends you can view their <a target="_blank" href="http://presstrends.io/terms">terms</a> or their <a target="_blank" href="http://presstrends.io/privacy">privacy policy</a>. <strong>No personal information is transferred.</strong>', 'designcrumbs'),
						"id" => "presstrends",
						"std" => "optin",
						"type" => "radio",
						"options" => array(
							'optin' => __('Opt In', 'designcrumbs'),
							'optout' => __('Opt Out', 'designcrumbs')));
	
	$options[] = array( "name" => "Campaign",
						"type" => "heading");
						
	$options[] = array( "name" => __('Donate Button Link', 'designcrumbs'),
						"desc" => __('Enter the link to your donation form. This will enable a <strong>Donate</strong> button in the menu. If you want to set up a PayPal donate link, <a href="http://en.support.wordpress.com/paypal/" target="_blank">WordPress has a tutorial of how to set that up and get the link here</a>.', 'designcrumbs'),
						"id" => "donate_link",
						"std" => "",
						"type" => "textarea");
						
	$options[] = array( "name" => __('Donate Button Text', 'designcrumbs'),
						"desc" => __('The text for your Donate button.', 'designcrumbs'),
						"id" => "donate_text",
						"std" => "Make A Donation",
						"type" => "text");
						
	$options[] = array( "name" => __('"Paid For" Text', 'designcrumbs'),
						"desc" => __('Filling in this will make a 1px bordered box appear in the footer of the site. <strong>This is required in the USA by the FEC for political committees.</strong> <a href="http://www.fec.gov/pages/brochures/notices.shtml#disclaimers" target="_blank">Learn more here</a>.', 'designcrumbs'),
						"id" => "paid_for",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => __('Footer Slogan', 'designcrumbs'),
						"desc" => __('This is for a large slogan at the top of your footer. Optional', 'designcrumbs'),
						"id" => "footer_slogan",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => __('Home Page', 'designcrumbs'),
						"type" => "heading");
						
	$options[] = array( "name" => __('Slider FX', 'designcrumbs'),
						"desc" => __('Select your slide transition.', 'designcrumbs'),
						"id" => "slider_fx",
						"type" => "select",
						"std" => "fade",
						"options" => array("fade" => __('Fade', 'designcrumbs'),"slide" => __('Slide', 'designcrumbs')));
						
	$options[] = array( "name" => __('Slider Time', 'designcrumbs'),
						"desc" => __('How long in seconds (use a whole number) would you like a slide to hold for before moving on to the next one? Setting this to 0 (zero) will not autoplay the slides. Zero is recommended if you are using videos in your slider.', 'designcrumbs'),
						"id" => "slider_time",
						"type" => "text",
						"class" => "mini",
						"std" => "8");
						
	$options[] = array( "name" => __('Home Page Video', 'designcrumbs'),
						"desc" => __('Would you like a video on the home page, and if so, from where?', 'designcrumbs'),
						"id" => "video_type",
						"std" => "none",
						"type" => "radio",
						"options" => array("none" => __('None', 'designcrumbs'),"youtube" => __('YouTube', 'designcrumbs'),"vimeo" => __('Vimeo', 'designcrumbs')));
						
	$options[] = array( "name" => __('YouTube ID', 'designcrumbs'),
						"desc" => __('If the YouTube link is http://www.youtube.com/watch?v=Iv69kB_e9KY, the ID is Iv69kB_e9KY.', 'designcrumbs'),
						"id" => "youtube_id",
						"std" => "",
						"class" => "mini",
						"type" => "text");
						
	$options[] = array( "name" => __('Vimeo ID', 'designcrumbs'),
						"desc" => __('If the Vimeo link is http://vimeo.com/22639018, the ID is 22639018.', 'designcrumbs'),
						"id" => "vimeo_id",
						"std" => "",
						"class" => "mini",
						"type" => "text");
						
	$options[] = array( "name" => __('Video Title', 'designcrumbs'),
						"desc" => __('The title to your video.', 'designcrumbs'),
						"id" => "video_title",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => __('Video Description', 'designcrumbs'),
						"desc" => __('A short description about your video.', 'designcrumbs'),
						"id" => "video_desc",
						"std" => "",
						"type" => "textarea");
						
	$options[] = array( "name" => __('Home Page Posts Title', 'designcrumbs'),
						"desc" => __('The title for your latest posts on the home page.', 'designcrumbs'),
						"id" => "home_posts_title",
						"std" => "Latest Posts",
						"type" => "text");
					
	$options[] = array( "name" => __('Which Posts Should Be On The Home Page?', 'designcrumbs'),
						"desc" => __('Would you like the home page posts to be all posts, or posts from a specific category?', 'designcrumbs'),
						"id" => "home_posts_selection",
						"std" => "posts_all",
						"type" => "radio",
						"options" => array("posts_all" => __('All Posts', 'designcrumbs'),"posts_specific" => __('Specific Category', 'designcrumbs')));
						
	$options[] = array( "name" => __('Home Page Posts Category', 'designcrumbs'),
						"desc" => __('Select the category you would like to pull posts from.', 'designcrumbs'),
						"id" => "home_posts_cat",
						"type" => "select",
						"options" => $options_categories);
						
	$options[] = array( "name" => __('Number of posts for the home page', 'designcrumbs'),
						"desc" => __('On the home page blog posts are displayed 3 wide, so this number should be a multiple of 3.', 'designcrumbs'),
						"id" => "home_posts_total",
						"std" => "3",
						"class" => "mini",
						"type" => "text");			
						
	$options[] = array( "name" => __('Styles', 'designcrumbs'),
						"type" => "heading");
						
	$options[] = array( "name" => __('Color Scheme', 'designcrumbs'),
						"desc" => __('Select the color scheme for your header.', 'designcrumbs'),
						"id" => "color_scheme",
						"std" => "blue",
						"type" => "select",
						"options" => array("blue" => __('Blue', 'designcrumbs'),"red" => __('Red', 'designcrumbs'),"yellow" => __('Yellow', 'designcrumbs'),"green" => __('Green', 'designcrumbs')));
						
	$options[] = array( "name" => __('Background Pattern', 'designcrumbs'),
						"desc" => __('Choose the overall background pattern for the site. <em>Note: this only works with the <strong>Boxed</strong> Body Display Style.</em>', 'designcrumbs'),
						"id" => "bg_pattern",
						"std" => "bg_fabric",
						"type" => "select",
						"options" => array("bg_cork" => __('Cork', 'designcrumbs'),"bg_fabric" => __('Fabric', 'designcrumbs'),"bg_freckles" => __('Freckle Squares', 'designcrumbs'),"bg_linen" => "Linen","bg_pinstripe" => __('Pinstripes', 'designcrumbs'),"bg_none" => __('None', 'designcrumbs')));
						
	$options[] = array( "name" => __('Heading Font', 'designcrumbs'),
						"desc" => __('Select the font for the headings of the site.', 'designcrumbs'),
						"id" => "heading_font",
						"std" => "ubuntu",
						"type" => "select",
						"options" => $heading_fonts);
						
	$options[] = array( "name" => __('Link Color', 'designcrumbs'),
						"desc" => __('Select the color for your links.', 'designcrumbs'),
						"id" => "link_color",
						"std" => "",
						"type" => "color");
										
	$options[] = array( "name" => __('Social Networks', 'designcrumbs'),
						"type" => "heading");
					
	$options[] = array( "name" => __('Twitter', 'designcrumbs'),
						"desc" => __('Enter the URL to your Twitter profile.', 'designcrumbs'),
						"id" => "twitter",
						"type" => "text"); 

	$options[] = array( "name" => __('Facebook', 'designcrumbs'),
						"desc" => __('Enter the URL to your Facebook profile.', 'designcrumbs'),
						"id" => "facebook",
						"type" => "text");
						
	$options[] = array( "name" => __('Google+', 'designcrumbs'),
						"desc" => __('Enter the URL to your Google+ profile.', 'designcrumbs'),
						"id" => "google",
						"type" => "text");
					
	$options[] = array( "name" => __('Flickr', 'designcrumbs'),
						"desc" => __('Enter the URL to your Flickr Profile.', 'designcrumbs'),
						"id" => "flickr",
						"type" => "text");
					
	$options[] = array( "name" => __('Tumblr', 'designcrumbs'),
						"desc" => __('Enter the URL to your Tumblr Profile.', 'designcrumbs'),
						"id" => "tumblr",
						"type" => "text");
						
	$options[] = array( "name" => __('YouTube', 'designcrumbs'),
						"desc" => __('Enter the URL to your YouTube Profile.', 'designcrumbs'),
						"id" => "youtube",
						"type" => "text");
					
	$options[] = array( "name" => __('Vimeo', 'designcrumbs'),
						"desc" => __('Enter the URL to your Vimeo Profile.', 'designcrumbs'),
						"id" => "vimeo",
						"type" => "text");
						
		// Support
						
	$options[] = array( "name" => "Support",
						"type" => "heading");					
						
	$options[] = array( "name" => __('Theme Documentation & Support', 'designcrumbs'),
						"desc" => "<p class='dc-text'>Theme support and documentation is available for all customers. Visit the <a target='blank' href='http://support.designcrumbs.com'>Design Crumbs Support Forum</a> to get started. Simply follow the instructions on the home page to verify your purchase and get a support account.</p>
						
						<div class='dc-buttons'><a target='blank' class='dc-button help-button' href='http://support.designcrumbs.com/help_files/campaignwp/'><span class='dc-icon icon-help'>Help File</span></a><a target='blank' class='dc-button support-button' href='http://support.designcrumbs.com'><span class='dc-icon icon-support'>Support Forum</span></a><a target='blank' class='dc-button custom-button' href='http://www.designcrumbs.com/theme-customization-request'><span class='dc-icon icon-custom'>Customize Theme</span></a></div>
						
						<h4 class='heading'>More Themes by Design Crumbs</h4>
						
						<div class='embed-themes'></div>
						
						",
						"type" => "info");	
				
	return $options;
}