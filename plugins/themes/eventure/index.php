<?php 

get_header();

//OptionTree Stuff
if ( function_exists( 'get_option_tree') ) {
	$theme_options = get_option('option_tree');
	$calendarOn = get_option_tree('eventure_calendar',$theme_options);
	$sliderOn = get_option_tree('slider_on',$theme_options);
	$welcomeMsg = get_option_tree('welcome_msg',$theme_options);
} 

//SLIDER Stuff
if($sliderOn){ get_template_part('slider'); }

//TAGLINE Stuff
if($welcomeMsg){ ?>
<div id="tagLine"><?php echo $welcomeMsg;?></div>
<?php }

//CALENDAR Stuff
if($calendarOn){ get_template_part('calendar'); } 

get_footer(); 

?>