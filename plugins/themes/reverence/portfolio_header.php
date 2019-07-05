<?php 
$al_options = get_option('al_general_settings');
$cats = '';
if (isset($post->ID))
{
	$cats =  get_post_meta($post->ID, "_page_portfolio_cat", $single = true);
}
?>
<script>
	jQuery(function(){jQuery.fn.css = jQuery.fn.cssOriginal;});
</script>
<div id="content-wrapper">
    <div class="container">
    	<div class="sixteen columns">
        	<div id="content-top">
               	<?php if(class_exists('the_breadcrumb')){ $albc = new the_breadcrumb; } ?>
               	<div class="four columns last" id="search-global">
                   <?php get_search_form(); ?>
                </div>
            </div> 
			<div class="medium_separator"></div>			
        </div>
        <div class="clear"></div>