<?php
if ( function_exists('register_sidebar') )
{
    register_sidebar(array(
        'before_widget' => '',
    'after_widget' => '',
 'before_title' => '<h1>',
        'after_title' => '</h1>',
    ));
}

// WP-fluid Pages Box 	
function widget_fluid_pages() {
?>

<h1><?php _e('Pages'); ?></h1>
   <ul>
<li class="page_item"><a href="<?php bloginfo('url'); ?>">Home</a></li>

<?php wp_list_pages('title_li='); ?>

 </ul>

<?php
}
if ( function_exists('register_sidebar_widget') ){
    register_sidebar_widget(__('Pages'), 'widget_fluid_pages');
}


// WP-fluid Search Box 	
function widget_fluid_search() {
?>
   
 <h1><?php _e('Search:'); ?></h1>

<ul>

<li>
<form method="get" id="searchform" action="<?php echo $_SERVER['PHP_SELF']; ?>">

<input type="text" value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="s" /><input type="submit" id="sidebarsubmit" value="Search" />

 </form>
</li>
 </ul>

<?php
}
if ( function_exists('register_sidebar_widget') ){
    register_sidebar_widget(__('Search'), 'widget_fluid_search');
}

// WP-fluid Blogroll 	
function widget_fluid_blogroll() {
?>

<h1><?php _e('Blogroll'); ?></h1>

<ul>
	<?php get_links(-1, '<li>', '</li>', '', FALSE, 'name', FALSE, FALSE, -1, FALSE); ?>
</ul>

<?php
}
if ( function_exists('register_sidebar_widget') ){
    register_sidebar_widget(__('Blogroll'), 'widget_fluid_blogroll');
}

/*
Description: Returns a list of the most recent posts.
Version: 1.1
Author: Nick Momrik
Author URI: http://mtdewvirus.com/
*/

function mdv_recent_posts($no_posts = 5, $before = '<li>', $after = '</li>', $hide_pass_post = true, $skip_posts = 0, $show_excerpts = false, $include_pages = false)
{
    global $wpdb;
	$time_difference = get_settings('gmt_offset');
	$now = gmdate("Y-m-d H:i:s",time());
    $request = "SELECT ID, post_title, post_excerpt FROM $wpdb->posts WHERE post_status = 'publish' ";
	if($hide_pass_post) $request .= "AND post_password ='' ";
	if($include_pages) $request .= "AND (post_type='post' OR post_type='page') ";
	else $request .= "AND post_type='post' ";
	$request .= "AND post_date_gmt < '$now' ORDER BY post_date DESC LIMIT $skip_posts, $no_posts";
    $posts = $wpdb->get_results($request);
	$output = '';
    if($posts) {
		foreach ($posts as $post) {
			$post_title = stripslashes($post->post_title);
			$permalink = get_permalink($post->ID);
			$output .= $before . '<a href="' . $permalink . '" rel="bookmark" title="Permanent Link: ' . htmlspecialchars($post_title, ENT_COMPAT) . '">' . $post_title . '</a>';
			if($show_excerpts) {
				$post_excerpt = stripslashes($post->post_excerpt);
				$output.= '<br />' . $post_excerpt;
			}
			$output .= $after;
		}
	} else {
		$output .= $before . "None found" . $after;
	}
    echo $output;
}

?>