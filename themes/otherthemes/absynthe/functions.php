<?php
if ( function_exists('register_sidebar') )
register_sidebar(array(
'before_widget' => '<div class="main"><div class="middle"><div class="bottom">',
'after_widget' => '</div></div></div>',
'before_title' => '<h2>',
'after_title' => '</h2>',
));

function recent_comments(){
	global $wpdb;
	$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID,
	comment_post_ID, comment_author, comment_date_gmt, comment_approved,
	comment_type,comment_author_url,
	SUBSTRING(comment_content,1,35) AS com_excerpt
	FROM $wpdb->comments
	LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID =
	$wpdb->posts.ID)
	WHERE comment_approved = '1' AND comment_type = '' AND
	post_password = ''
	ORDER BY comment_date_gmt DESC
	LIMIT 10";
	$comments = $wpdb->get_results($sql);
	$output = $pre_HTML;
	$output .= "\n<ul>";
	foreach ($comments as $comment) {
	$output .= "\n<li>".strip_tags($comment->comment_author)
	.":" . " <a href=\"" . get_permalink($comment->ID) .
	"#comment-" . $comment->comment_ID . "\" title=\"on " .
	$comment->post_title . "\">" . strip_tags($comment->com_excerpt) . "..."
	."</a></li>";
	}
	$output .= "\n</ul>";
	$output .= $post_HTML;
	echo $output;
}

add_filter('comments_template', 'legacy_comments');
function legacy_comments($file) {
	if ( !function_exists('wp_list_comments') ) 
		$file = TEMPLATEPATH . '/legacy.comments.php';
	return $file;
}

function comment_add_microid($classes) {
	$c_email=get_comment_author_email();
	$c_url=get_comment_author_url();
	if (!empty($c_email) && !empty($c_url)) {
		$microid = 'microid-mailto+http:sha1:' . sha1(sha1('mailto:'.$c_email).sha1($c_url));
		$classes[] = $microid;
	}
	return $classes;
}
add_filter('comment_class','comment_add_microid');

?>