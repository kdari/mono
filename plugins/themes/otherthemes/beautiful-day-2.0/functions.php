<?php

if ( function_exists('register_sidebar') ){
    register_sidebar(array(
        'before_widget' => '',
    'after_widget' => '',
 'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
}

function the_subpages()
{
	global $post, $wpdb;
	
	if ( is_page() )
	{
		if ( $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_type='page' AND post_parent = ".$post->ID) > 0 ){
			$subpages = $post->ID;
		}
		else if ( $post->post_parent != 0 ){
			$subpages = $post->post_parent;
		}

		if ($subpages)
		{
			echo '<h2>Subpages</h2>' . "\n";
			echo '<ul>' . "\n";
			wp_list_pages('title_li=&child_of='.$subpages);
			echo '</ul>' . "\n";
		}
	}
}


?>