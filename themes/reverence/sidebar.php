<aside class="sidebar">
	 <?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('Global sidebar')){ }else { ?>
		<p class="noside"><?php _e('There Is No Sidebar Widgets Yet', 'Reverence'); ?></p>
	 <?php } ?>
</aside> <!--End Sidebar-->