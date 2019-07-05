<?php
	/* Template Name: Home Page (With Portfolio) */
	get_header();
?>


<?php
	$al_options = get_option('al_general_settings'); 
	$slider = isset($al_options['al_active_slider']) && $al_options['al_active_slider'] !='' ? $al_options['al_active_slider'] : 'revolution';
	//$slider = isset($_GET['slider_type']) ? $_GET['slider_type'] : 'revolution';
	if ($slider)
	{
		include('sliders/'.$slider.'/slider.php');
	}
	wp_reset_query();	
?>
<div id="content-wrapper">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Homepage Top Sidebar") ) : ?> <?php   endif;?>
	<div class="container">		
		<?php include('portfolio-template.php'); ?>		
		