<?php
/**
Template Name: Sidebar
 */
?>
	<div id="sidebar-left">
		<ul>
			<li id="pages" class="widget widget_pages">		<h2 class="widgettitle">Navigation</h2>	
			<ul>
			<li><a href="<?php bloginfo('siteurl'); ?>/" title="Home">Home</a></li>
           	<?php wp_list_pages('title_li=&depth=1&'.$page_sort.'&'.$pages_to_exclude)?>
           	
		</ul>
		</li>
		</ul>
		<ul>
			<?php 	/* Widgetized sidebar, if you have the plugin installed. */
					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
			
			<?php endif; ?>
		</ul>
		
		
        
	</div>

