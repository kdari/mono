<?php

if ( function_exists('register_sidebar') )
{
    register_sidebar(array(
        'before_widget' => '<div class="widget %2$s" id="%1$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="widget_title">',
        'after_title' => '</div>',
    ));
}

function cdt_subpages()
{
	global $post, $wpdb;
	
	if ( is_page() )
	{
		$subpages = false;

		if ( $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_status='page' AND post_parent = ".$post->ID) > 0 ){
			$subpages = $post->ID;
		}
		else if ( $post->post_parent != 0 ){
			$subpages = $post->post_parent;
		}

		if ($subpages)
		{
			echo '<div class="box">' . "\n";
			echo '<div class="box_title">Subpages</div>' . "\n";
			echo '<div class="box_body">' . "\n";
			echo '<ul>' . "\n";
			wp_list_pages('title_li=&child_of='.$subpages);
			echo '</ul>' . "\n";
			echo '</div>' . "\n";
			echo '<div class="box_bottom"></div>' . "\n";
			echo '</div>' . "\n";

		}
	}
}

function cdt_list_pages($args=false)
{
	$args = ($args) ? $args . '&echo=0' : 'echo=0';
	$pagecode = wp_list_pages($args);

	echo preg_replace('/<a(.+)>(.+?)<\/a>/', '<a\\1><span>\\2</span></a>', $pagecode);
}

?>