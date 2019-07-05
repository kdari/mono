<?php

add_action('init','of_options');

if (!function_exists('of_options')) {
function of_options(){
   
// VARIABLES
$themename = get_theme_data(STYLESHEETPATH . '/style.css');
$themename = $themename['Name'];
$shortname = "cap";

// Populate OptionsFramework option in array for use in theme
global $of_options;
$of_options = get_option('of_options');

$GLOBALS['template_path'] = OF_DIRECTORY;

//Access the WordPress Categories via an Array
$of_categories = array(); 
$of_categories_obj = get_categories('hide_empty=0');
foreach ($of_categories_obj as $of_cat) {
    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
$categories_tmp = array_unshift($of_categories, "Select a category:");   

      
//Access the WordPress Pages via an Array
$of_pages = array();
$of_pages_obj = get_pages('sort_column=post_parent,menu_order');   
foreach ($of_pages_obj as $of_page) {
    $of_pages[$of_page->ID] = $of_page->post_name; }
$of_pages_tmp = array_unshift($of_pages, "Select a page:");      


$podcast_select_1 = array("Arts" , "Business " , "Comedy" , "Education" , "Games &amp; Hobbies " , "Government &amp; Organizations " , "Health" , "Kids &amp; Family" , "Music" , "News &amp; Politics" , "Society &amp; Culture " , "Sports &amp;Recreation " , "Technology" , "TV &amp; Film");

$podcast_select_2 = array("Design", "Fashion & Beauty", "Food", "Literature", "Performing Arts", "Visual Arts", "Business News", "Careers", "Investing", "Management & Marketing", "Shopping", "Education Technology", "Higher Education", "K-12", "Language Courses", "Training", "Automotive", "Aviation", "Hobbies", "Other Games", "Video Games", "Alternative Health", "Fitness & Nutrition", "Self-Help", "Sexuality", "Buddhism", "Christianity", "Hinduism", "Islam", "Judaism", "Other", "Spirituality", "Medicine", "Natural Sciences", "Social Sciences", "History", "Personal Journals", "Philosophy", "Places & Travel",  "Gadgets", "Tech News", "Podcasting", "Software How-To");

// Set the Options Array
$options = array();

$options[] = array( "name" => "General Settings",
                    "type" => "heading");
                   

$options[] = array( "name" => "Custom Logo",
                    "desc" => "Upload a logo for your theme, or specify the image address of your online logo. (http://yoursite.com/logo.png). Recomended Size: 230px by 27px.",
                    "id" => "cap_logo_image",
                    "std" => "Image URL",
                    "type" => "upload");
                   
$url =  OF_DIRECTORY . '../uploads/';

$options[] = array( "name" => "Phone Number",
                    "desc" => "Enter your phone number.",
                    "id" => "cap_phone_number",
                    "std" => "eg: 111-111-1111",
                    "type" => "text");

$options[] = array( "name" => "Email Address",
                    "desc" => "Enter your email address.",
                    "id" => "cap_email",
                    "std" => "Email Address",
                    "type" => "text");

$options[] = array( "name" => "Worship Times Title",
                    "desc" => "Enter the title for the Worship Times area on the Home Page. EG: \"Worship Times\" or \"Sunday Services\"",
                    "id" => "cap_worship_times_title",
                    "std" => "Worship Times",
                    "type" => "text");

$options[] = array( "name" => "Worship Times",
                    "desc" => "Enter your worship times.",
                    "id" => "cap_worship_times",
                    "std" => "Sundays at 10:00am",
                    "type" => "text");

$options[] = array( "name" => "Address Title",
                    "desc" => "Enter the title for the Address area on the Home Page EG: \"Church Address\"",
                    "id" => "cap_address_title",
                    "std" => "Church Address",
                    "type" => "text");

$options[] = array( "name" => "Address",
                    "desc" => "Enter your address.",
                    "id" => "cap_address",
                    "std" => "eg: 51 Fake Street, New York, NY",
                    "type" => "text");

$options[] = array( "name" => "I'm new here!",
                    "desc" => "Enter the URL where you want the \"I'm new here\" button to go to when clicked.",
                    "id" => "cap_new_here_link",
                    "std" => "New here link",
                    "type" => "text");

$options[] = array( "name" => "What we believe - Title",
                    "desc" => "Write the Title for the \"What we believe\" section on the home page.",
                    "id" => "cap_whatwebelieve_title",
                    "std" => "What We Believe",
                    "type" => "text");  

$options[] = array( "name" => "What we believe - Text",
                    "desc" => "Write the text for the \"What we believe\" section on the home page.",
                    "id" => "cap_whatwebelieve",
                    "std" => "",
                    "type" => "textarea");  

$options[] = array( "name" => "Custom Favicon",
                    "desc" => "Upload a 16px x 16px Png/Gif image that will represent your website's favicon.",
                    "id" => "cap_custom_favicon",
                    "std" => "Favicon",
                    "type" => "upload");
                                              
$options[] = array( "name" => "Tracking Code",
                    "desc" => "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
                    "id" => "cap_google_analytics",
                    "std" => "",
                    "type" => "textarea");  


//6 home images fader options ---------
   
$options[] = array( "name" => "Home Page Slider",
                    "type" => "heading");

$options[] = array( "name" => "First Slide",
					"desc" => "",
					"std" => "Enter the following information for the first slide on the home page",
					"type" => "info");

$options[] = array( "name" => "First Image Slide",
                    "desc" => "Upload the 1st image for the home page fader. 940px by 340px",
                    "id" => "cap_slider_image1",
                    "std" => "1st URL",
                    "type" => "upload");

$options[] = array( "name" => "First Image url",
                    "desc" => "Enter the url you want this image to go when clicked",
                    "id" => "cap_slider_link1",
                    "std" => "Link",
                    "type" => "text");

$options[] = array( "name" => "Second Slide",
					"desc" => "",
					"std" => "Enter the following information for the second slide on the home page",
					"type" => "info");
//
$options[] = array( "name" => "Second Image Slide",
                    "desc" => "Upload the 2nd image for the home page fader. 940px by 340px",
                    "id" => "cap_slider_image2",
                    "std" => "2nd URL",
                    "type" => "upload");

$options[] = array( "name" => "Second Image url",
                    "desc" => "Enter the url you want this image to go when clicked",
                    "id" => "cap_slider_link2",
                    "std" => "Link",
                    "type" => "text");
//
$options[] = array( "name" => "Third Slide",
					"desc" => "",
					"std" => "Enter the following information for the third slide on the home page",
					"type" => "info");

$options[] = array( "name" => "Third Image Slide",
                    "desc" => "Upload the 3rd image for the home page fader. 940px by 340px",
                    "id" => "cap_slider_image3",
                    "std" => "3rd URL",
                    "type" => "upload");

$options[] = array( "name" => "Third Image url",
                    "desc" => "Enter the url you want this image to go when clicked",
                    "id" => "cap_slider_link3",
                    "std" => "Link",
                    "type" => "text");
//
$options[] = array( "name" => "Fourth Slide",
					"desc" => "",
					"std" => "Enter the following information for the fourth slide on the home page",
					"type" => "info");

$options[] = array( "name" => "Fourth Image Slide",
                    "desc" => "Upload the 4th image for the home page fader. 940px by 440px",
                    "id" => "cap_slider_image4",
                    "std" => "4th URL",
                    "type" => "upload");

$options[] = array( "name" => "Fourth Image url",
                    "desc" => "Enter the url you want this image to go when clicked",
                    "id" => "cap_slider_link4",
                    "std" => "Link",
                    "type" => "text");
//
$options[] = array( "name" => "Fifth Slide",
					"desc" => "",
					"std" => "Enter the following information for the fifth slide on the home page",
					"type" => "info");

$options[] = array( "name" => "Fifth Image Slide",
                    "desc" => "Upload the 5th image for the home page fader. 950px by 550px",
                    "id" => "cap_slider_image5",
                    "std" => "5th URL",
                    "type" => "upload");

$options[] = array( "name" => "Fifth Image url",
                    "desc" => "Enter the url you want this image to go when clicked",
                    "id" => "cap_slider_link5",
                    "std" => "Link",
                    "type" => "text");
//
$options[] = array( "name" => "Sixth Slide",
					"desc" => "",
					"std" => "Enter the following information for the F slide on the home page",
					"type" => "info");

$options[] = array( "name" => "Sixth Image Slide",
                    "desc" => "Upload the 6th image for the home page fader. 960px by 660px",
                    "id" => "cap_slider_image6",
                    "std" => "6th URL",
                    "type" => "upload");

$options[] = array( "name" => "Sixth Image url",
                    "desc" => "Enter the url you want this image to go when clicked",
                    "id" => "cap_slider_link6",
                    "std" => "Link",
                    "type" => "text");


//4 Home Page Images
$options[] = array( "name" => "4 Home Page Images",
                    "type" => "heading");

//
$options[] = array( "name" => "1st Image",
					"desc" => "",
					"std" => "Enter the following information for the first of the 4 images on the home page",
					"type" => "info");

$options[] = array( "name" => "First Image",
                    "desc" => "Upload the 1st image for the home page. 300px by 140px",
                    "id" => "cap_home_image1",
                    "std" => "First Image",
                    "type" => "upload");

$options[] = array( "name" => "First Image Title",
                    "desc" => "Enter the text you want to appear on top of the image. ",
                    "id" => "cap_home_image1_text",
                    "std" => "Image Text",
                    "type" => "text");

$options[] = array( "name" => "First Image Link",
                    "desc" => "Enter the url you want this image to go to when clicked",
                    "id" => "cap_home_image1_link",
                    "std" => "Image Link",
                    "type" => "text");
//
$options[] = array( "name" => "2nd Image",
					"desc" => "",
					"std" => "Enter the following information for the second of the 4 images on the home page",
					"type" => "info");

$options[] = array( "name" => "Second Image",
                    "desc" => "Upload the 2nd image for the home page. 300px by 240px",
                    "id" => "cap_home_image2",
                    "std" => "Second Image",
                    "type" => "upload");

$options[] = array( "name" => "Second Image Title",
                    "desc" => "Enter the text you want to appear on top of the image. ",
                    "id" => "cap_home_image2_text",
                    "std" => "Image Text",
                    "type" => "text");

$options[] = array( "name" => "Second Image Link",
                    "desc" => "Enter the url you want this image to go to when clicked",
                    "id" => "cap_home_image2_link",
                    "std" => "Image Link",
                    "type" => "text");
//

$options[] = array( "name" => "3rd Image",
					"desc" => "",
					"std" => "Enter the following information for the third of the 4 images on the home page",
					"type" => "info");

$options[] = array( "name" => "Third Image",
                    "desc" => "Upload the 3rd image for the home page. 300px by 340px",
                    "id" => "cap_home_image3",
                    "std" => "Third Image",
                    "type" => "upload");

$options[] = array( "name" => "Third Image Title",
                    "desc" => "Enter the text you want to appear on top of the image. ",
                    "id" => "cap_home_image3_text",
                    "std" => "Image Text",
                    "type" => "text");

$options[] = array( "name" => "Third Image Link",
                    "desc" => "Enter the url you want this image to go to when clicked",
                    "id" => "cap_home_image3_link",
                    "std" => "Image Link",
                    "type" => "text");

//
$options[] = array( "name" => "4th Image",
					"desc" => "",
					"std" => "Enter the following information for the fourth of the 4 images on the home page",
					"type" => "info");

$options[] = array( "name" => "Fourth Image",
                    "desc" => "Upload the 4rd image for the home page. 300px by 340px",
                    "id" => "cap_home_image4",
                    "std" => "Third Image",
                    "type" => "upload");

$options[] = array( "name" => "Fourth Image Title",
                    "desc" => "Enter the text you want to appear on top of the image. ",
                    "id" => "cap_home_image4_text",
                    "std" => "Image Text",
                    "type" => "text");

$options[] = array( "name" => "Fourth Image Link",
                    "desc" => "Enter the url you want this image to go to when clicked",
                    "id" => "cap_home_image4_link",
                    "std" => "Image Link",
                    "type" => "text");


//Links
$options[] = array( "name" => "Social Links",
                    "type" => "heading");

$options[] = array( "name" => "Facebook URL",
                    "desc" => "Enter your Facebook URL",
                    "id" => "cap_facebook_url",
                    "std" => "Your Facebook URL",
                    "type" => "text");

$options[] = array( "name" => "Twitter Username",
                    "desc" => "Enter your Twitter Username",
                    "id" => "cap_twitter_username",
                    "std" => "Your Twitter Username",
                    "type" => "text");

$options[] = array( "name" => "Feedburner URL",
                    "desc" => "Enter your Feedburner URL",
                    "id" => "cap_feedburner",
                    "std" => "Your Feedburner URL",
                    "type" => "text");

//Adbox Widget Settings
$options[] = array( "name" => "Advertising Widget Settings",
                    "type" => "heading");

$options[] = array( "name" => "1st Image",
					"desc" => "",
					"std" => "1st Ad Image",
					"type" => "info");

$options[] = array( "name" => "Adbox Image 1",
                    "desc" => "Upload Adbox Image 1 (125px X 125px)",
                    "id" => "cap_adbox_1",
                    "std" => "1st Adbox Image",
                    "type" => "upload");

$options[] = array( "name" => "Adbox Image 1 Link",
                    "desc" => "Enter the link you want this adbox to go to when clicked.",
                    "id" => "cap_adbox_link_1",
                    "std" => "1st Adbox link",
                    "type" => "text");

//
$options[] = array( "name" => "2nd Image",
					"desc" => "",
					"std" => "2nd Ad Image",
					"type" => "info");

$options[] = array( "name" => "Adbox Image 2",
                    "desc" => "Upload Adbox Image 2 (125px X 125px)",
                    "id" => "cap_adbox_2",
                    "std" => "2nd Adbox Image",
                    "type" => "upload");

$options[] = array( "name" => "Adbox Image 2 Link",
                    "desc" => "Enter the link you want this adbox to go to when clicked.",
                    "id" => "cap_adbox_link_2",
                    "std" => "2nd Adbox Link",
                    "type" => "text");
//
$options[] = array( "name" => "3rd Image",
					"desc" => "",
					"std" => "3rd Ad Image",
					"type" => "info");

$options[] = array( "name" => "Adbox Image 3",
                    "desc" => "Upload Adbox Image 3 (125px X 125px)",
                    "id" => "cap_adbox_3",
                    "std" => "3rd Adbox Image",
                    "type" => "upload");

$options[] = array( "name" => "Adbox Image 3 Link",
                    "desc" => "Enter the link you want this adbox to go to when clicked.",
                    "id" => "cap_adbox_link_3",
                    "std" => "3rd Adbox Link",
                    "type" => "text");

//
$options[] = array( "name" => "4th Image",
					"desc" => "",
					"std" => "4th Ad Image",
					"type" => "info");

$options[] = array( "name" => "Adbox Image 4",
                    "desc" => "Upload Adbox Image 4 (125px X 125px)",
                    "id" => "cap_adbox_4",
                    "std" => "4th Adbox Image",
                    "type" => "upload");

$options[] = array( "name" => "Adbox Image 4 Link",
                    "desc" => "Enter the link you want this adbox to go to when clicked.",
                    "id" => "cap_adbox_link_4",
                    "std" => "4th Adbox Link",
                    "type" => "text");


//podcast settings ---------
   
$options[] = array( "name" => "Sermon Podcast Settings",
                    "type" => "heading");

$options[] = array( "name" => "Info",
					"desc" => "",
					"std" => "The Podcast is automatically generated by the sermons you post. Fill out the basic information below to get it started.",
					"type" => "info");
                   
$options[] = array( "name" => "Podcast Title",
                    "desc" => "Enter the title of your podcast.",
                    "id" => "cap_podcast_title",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => "Podcast Subtitle",
                    "desc" => "Enter a short subtitle for the podcast.",
                    "id" => "cap_podcast_subtitle",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => "Podcast Author",
                    "desc" => "Enter the author of the podcast.",
                    "id" => "cap_podcast_author",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => "Podcast Description",
                    "desc" => "Enter the description of the podcast.",
                    "id" => "cap_podcast_description",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => "Podcast Image",
                    "desc" => "Upload an image to represent the podcast. Recommended size 600 x 600 Pixels",
                    "id" => "cap_podcast_image",
                    "std" => "",
                    "type" => "upload");

$options[] = array( "name" => "Category",
					"desc" => "Select a category for your podcast",
					"id" => "cap_podcast_cat_1",
					"std" => "Other",
					"type" => "select",
					"class" => "mini", //mini, tiny, small
					"options" => $podcast_select_1);    

$options[] = array( "name" => "Sub-Category",
					"desc" => "Select a sub-category for your podcast",
					"id" => "cap_podcast_cat_2",
					"std" => "Other",
					"type" => "select",
					"class" => "mini", //mini, tiny, small
					"options" => $podcast_select_2);    


//styling options ---------
   
$options[] = array( "name" => "Styling Options",
                    "type" => "heading");
       
                   
$options[] = array( "name" => "Custom CSS",
                    "desc" => "Quickly add some CSS to your theme by adding it to this block.",
                    "id" => "cap_custom_css",
                    "std" => "",
                    "type" => "textarea");









update_option('of_template',$options);                      
update_option('of_themename',$themename);  
update_option('of_shortname',$shortname);

}
}
?>