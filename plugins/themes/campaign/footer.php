<div class="clear"></div>
</div><!-- end div.container, begins in header.php -->
</div><!-- end div.wrapper, begins in header.php -->
</div><!-- end div#main_wrap, begins in header.php -->
<div id="footer" class="wrapper">
	<div class="container">
		<?php if (of_get_option('footer_slogan') != '') { ?>
			<h1 id="footer_slogan"><?php echo stripslashes(of_get_option('footer_slogan')) ?></h1>
		<?php } ?>
		<div id="footer_widgets" class="<?php $sb_count = wp_get_sidebars_widgets(); if (count( $sb_count['Footer']) <= '5') { ?>footer_widget_count<?php count_sidebar_widgets( 'Footer' );?><?php } else { ?>footer_widget_overflow<?php } ?>">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer') ) : endif; ?>
			<div class="clear"></div>
		</div>
		<div id="post_footer">
		<?php if ((of_get_option('twitter') != '') || (of_get_option('facebook') != '') || (of_get_option('google') != '') || (of_get_option('flickr') != '') || (of_get_option('vimeo') != '') || (of_get_option('youtube') != '') || (of_get_option('tumblr') != '') ) { ?>
			<div id="socnets_wrap">	
				<div id="socnets">
						<?php if (of_get_option('twitter') != '') { ?>
					<a href="<?php echo stripslashes(of_get_option('twitter')); ?>" title="Twitter"><img src="<?php echo get_template_directory_uri(); ?>/images/socnets/twitter.png" alt="Twitter" /></a>
						<?php } if (of_get_option('facebook') != '') { ?>
					<a href="<?php echo stripslashes(of_get_option('facebook')); ?>" title="Facebook"><img src="<?php echo get_template_directory_uri(); ?>/images/socnets/facebook.png" alt="Facebook" /></a>
						<?php } if (of_get_option('google') != '') { ?>
					<a href="<?php echo stripslashes(of_get_option('google')); ?>" title="Google+"><img src="<?php echo get_template_directory_uri(); ?>/images/socnets/google.png" alt="Google+" /></a>
						<?php } if (of_get_option('flickr') != '') { ?>
					<a href="<?php echo stripslashes(of_get_option('flickr')); ?>" title="Flickr"><img src="<?php echo get_template_directory_uri(); ?>/images/socnets/flickr.png" alt="Flickr" /></a>
						<?php } if (of_get_option('tumblr') != '') { ?>
					<a href="<?php echo stripslashes(of_get_option('tumblr')); ?>" title="Tumblr"><img src="<?php echo get_template_directory_uri(); ?>/images/socnets/tumblr.png" alt="Tumblr" /></a>
						<?php } if (of_get_option('vimeo') != '') { ?>
					<a href="<?php echo stripslashes(of_get_option('vimeo')); ?>" title="Vimeo"><img src="<?php echo get_template_directory_uri(); ?>/images/socnets/vimeo.png" alt="Vimeo" /></a>
						<?php } if (of_get_option('youtube') != '') { ?>
					<a href="<?php echo stripslashes(of_get_option('youtube')); ?>" title="YouTube"><img src="<?php echo get_template_directory_uri(); ?>/images/socnets/youtube.png" alt="YouTube" /></a>
						<?php } ?>
				</div>
				<div class="clear"></div>
			</div>
		<?php } ?>
		<?php if (of_get_option('paid_for') != '') { ?>
		<div id="paid_for"><?php echo stripslashes(of_get_option('paid_for')) ?></div>
		<?php } ?>
		<div id="site_info">
			&copy; <?php echo date("Y"); ?> <?php bloginfo('name'); ?>&nbsp;&nbsp;:&nbsp;
			<?php if (of_get_option('give_credit') == '1') { ?>
			<a href="http://themes.designcrumbs.com" title="Campaign WordPress Theme"><?php _e("Campaign Theme", "designcrumbs"); ?></a> <?php _e("by", "designcrumbs"); ?> <a href="http://themes.designcrumbs.com" title="Design Crumbs"><?php _e("Design Crumbs", "designcrumbs"); ?></a>
			<?php } else { ?>
			<?php echo bloginfo('description'); ?>
			<?php } ?><div id="attribution">Created by <a href="http://webdesignsri.com" target="_blank">www.webdesignsri.com</a> and <a href="http://www.eyeonsuccess.net" target="_blank">www.eyeonsuccess.net</a></div>
		</div>
		</div>
	</div>
</div>
<?php wp_footer(); //leave for plugins ?>
<?php echo stripslashes(of_get_option('analytics')); ?>
</body>
</html>