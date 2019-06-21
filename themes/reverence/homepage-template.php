<?php
	/* Template Name: Home Page */
	get_header();
?>

<?php
	$al_options = get_option('al_general_settings'); 
	$custom =  get_post_custom($post->ID);
	$layout = isset ($custom['_page_layout']) ? $custom['_page_layout'][0] : '1';
	
	$slider = isset($al_options['al_active_slider']) && $al_options['al_active_slider'] !='' ? $al_options['al_active_slider'] : 'revolution';
	//$slider = isset($_GET['slider_type']) ? $_GET['slider_type'] : 'revolution';
	if ($slider)
	{
		include('sliders/'.$slider.'/slider.php');
	}
	wp_reset_query();
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

    <!--Page Content-->
    <div id="content-wrapper">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Homepage Top Sidebar") ) : ?> <?php   endif;?>
        <div class="container"> 
            <?php if ($layout == '3'):?>
				<div class="four columns"> <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Global Sidebar") ) : ?> <?php   endif;?></div>
			<?php endif?>
			<div class="<?php echo $layout == '1' ? 'sixteen' : 'twelve'?> columns">
                <?php the_content(); ?>
            </div>
			<?php if ($layout == '2'):?>
				<div class="four columns last left10"> <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Global Sidebar") ) : ?> <?php   endif;?></div>
			<?php endif?>
			<div class="clear"></div>
        </div>
    </div>
    <!--End Page Content-->
<?php endwhile; ?> 
     

<?php get_footer(); ?>		