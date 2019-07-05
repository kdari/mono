<div id="sidebar">
	<?php if (!(is_front_page())) { ?>
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Top_Sidebar') ) : endif; ?>
	<?php } ?>
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Overall_Sidebar') ) : endif; ?>
	<?php if ((is_page()) && !(is_front_page())) { ?>
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Pages_Sidebar') ) : endif; ?>
	<?php } elseif (!(is_page()) && !(is_front_page())) { ?>
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Blog_Sidebar') ) : endif; ?>
	<?php } ?>
</div>