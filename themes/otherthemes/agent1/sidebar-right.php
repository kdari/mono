<?php
/**
Template Name: Sidebar - Right
 */
?>
	<div id="sidebar-right" class="span-5 last">
		<ul>
			<?php if ( !function_exists('dynamic_sidebar')
		|| !dynamic_sidebar('sidebar-right') ) : ?>
			<?php endif; ?>		
		</ul>
  		
  	</div>

