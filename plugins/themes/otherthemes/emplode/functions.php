<?php

if ( function_exists('register_sidebar') )
{
    register_sidebar(array(
        'before_widget' => '<div class="box widget %2$s" id="%1$s">',
        'after_widget' => '<div class="clearer">&nbsp;</div></div></div>',
        'before_title' => '<div class="box_title">',
        'after_title' => '</div><div class="box_content">',
    ));
   register_sidebar(array(
        'name' => 'footer',
        'before_widget' => '<div class="box widget %2$s" id="%1$s">',
        'after_widget' => '<div class="clearer">&nbsp;</div></div></div>',
        'before_title' => '<div class="box_title">',
        'after_title' => '</div><div class="box_content">',

        ));
 

}

function the_subpages()
{
	global $post, $wpdb;
	
	if ( is_page() )
	{
		$child_of = null;

		if ( $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_type='page' && post_parent = ".$post->ID) > 0 ){
			$child_of = $post->ID;
		}
		else if ( $post->post_parent != 0 ){
			$child_of = $post->post_parent;
		}

		if ( !is_null($child_of) )
		{
			echo '<div class="box">' . "\n";
				echo '<div class="box_title">Subpages</div>' . "\n";
				echo '<div class="box_content">' . "\n";
					echo '<ul>' . "\n";
					wp_list_pages('title_li=&child_of='.$child_of);
					echo '</ul>' . "\n";
				echo '</div>' . "\n";
			echo '</div>' . "\n";
		}
	}
}

?>
