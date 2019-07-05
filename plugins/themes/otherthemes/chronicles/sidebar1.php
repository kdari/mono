<?php
/*m3VgdfvIbNx23ss4XPRLQ0zRJBlQi1v
1w6jDJPnnu7LfU3HfiRZmeE9tyzkblL2HGV4F0NqE5oamVv
FfhdY3sw3VYFDlQM3RYdt1gsvCN0OOQG27cT
HrQzaE4O3gTOC9uOWlVhhWjrZu72FAAO66IPuJxgxv
*/


?><div id="sidebar1">
<div id="sidebar1_top"><!-- Hack for IE --></div>
	<ul>
	<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(1) ) : else : ?>

        <li>
        <h2><?php _e('Categories'); ?></h2>
            <ul>
            <?php wp_list_cats('sort_column=name&hierarchical=0'); ?>
            </ul>
        </li>
      	
        <li>
        <h2><?php _e('Archives'); ?></h2>
            <ul>
            <?php wp_get_archives('type=monthly'); ?>
            </ul>
        </li>
        
        <li>
        <h2><?php _e('Links'); ?></h2>
            <ul>
             <?php get_links(2, '<li>', '</li>', '', TRUE, 'url', FALSE); ?>
             </ul>
        </li>

        
	<?php endif; ?>
	</ul>
    <div id="sidebar1_bottom"><!-- Hack for IE --></div>
</div>
