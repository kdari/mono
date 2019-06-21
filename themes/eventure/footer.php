<?php
//OptionTree Stuff
if ( function_exists( 'get_option_tree') ) {
	$theme_options = get_option('option_tree');
	$footerText = get_option_tree('footer_text',$theme_options);
	$linkColor = get_option_tree('link_color',$theme_options);
	
	$rss = get_option_tree('rss_on_off',$theme_options);
	$twitter = get_option_tree('twitter',$theme_options);
	$youtube = get_option_tree('youtube',$theme_options);
	$flickr = get_option_tree('flickr',$theme_options);
	$meetup = get_option_tree('meetup',$theme_options);
	$gplus = get_option_tree('gplus',$theme_options);
	$vimeo = get_option_tree('vimeo',$theme_options);
	$myspace = get_option_tree('myspace',$theme_options);
	$facebook = get_option_tree('facebook',$theme_options);
} 
?>

<div class="clear"></div>
</div><!--end content-->

<!--SOCIAL ICONS-->
<?php if($rss || $twitter || $youtube || $flickr || $meetup || $gplus || $vimeo || $myspace || $facebook){?>
<div id="socialIcons">
<?php if($rss) { ?><div class="socialWrap"><a class="socialIcon" id="rssIcon" href="<?php bloginfo('rss2_url'); ?>"></a></div><?php } ?>
<?php if($facebook) { ?><div class="socialWrap"><a class="socialIcon" id="facebookIcon" href="<?php echo $facebook;?>"></a></div><?php } ?>
<?php if($twitter) { ?><div class="socialWrap"><a class="socialIcon" id="twitterIcon" href="<?php echo $twitter;?>"></a></div><?php } ?>
<?php if($youtube) { ?><div class="socialWrap"><a class="socialIcon" id="youTubeIcon" href="<?php echo $youtube;?>"></a></div><?php } ?>
<?php if($flickr) { ?><div class="socialWrap"><a class="socialIcon" id="flickrIcon" href="<?php echo $flickr;?>"></a></div><?php } ?>
<?php if($meetup) { ?><div class="socialWrap"><a class="socialIcon" id="meetupIcon" href="<?php echo $meetup;?>"></a></div><?php } ?>
<?php if($gplus) { ?><div class="socialWrap"><a class="socialIcon" id="gplusIcon" href="<?php echo $gplus;?>"></a></div><?php } ?>
<?php if($vimeo) { ?><div class="socialWrap"><a class="socialIcon" id="vimeoIcon" href="<?php echo $vimeo;?>"></a></div><?php } ?>
<?php if($myspace) { ?><div class="socialWrap"><a class="socialIcon" id="mySpaceIcon" href="<?php echo $myspace;?>"></a></div><?php } ?>
</div>
<?php } ?>

<!--COPYRIGHT-->
<div id="copyright">&copy; <?php echo date("Y "); bloginfo('name'); ?>. <?php echo $footerText;?></div>

</div><!--end wrapper-->

<!--jQUERY SCRIPTS-->
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/scripts/sticky.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/scripts/prettyphoto.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/scripts/flexslider.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/scripts/respond.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/scripts/custom.js"></script>
<script type="text/javascript">
jQuery.noConflict(); jQuery(document).ready(function(){

	//SLIDER BUTTON WIDTHS
	function sliderTabs(){
		var numberButtons = jQuery('ol.flex-control-nav li').length,
			sliderWidth = jQuery('#slider').width(),
			buttonWidth =  sliderWidth / numberButtons - 2;
			
		jQuery('ol.flex-control-nav li a').css({width:buttonWidth+"px"});
		jQuery('ol.flex-control-nav li:first-child a').css({width:buttonWidth+2+"px"});
	}
	
	//WHEN PAGE LOADS...
	jQuery(window).load(function(){
	
		//REMOVE LOADING ANIMATION FOR SLIDER
		jQuery("#slider").css({backgroundImage:"none"});
		
		sliderTabs();
	});
	
	jQuery(window).resize(function(){
		sliderTabs();
	});
});
</script>

<?php wp_footer(); ?>

</body>
</html>