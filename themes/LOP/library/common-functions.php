<?php

// Adding Translation Option
load_theme_textdomain( 'lop', TEMPLATEPATH.'/languages' );
$locale = get_locale();
$locale_file = TEMPLATEPATH."/languages/$locale.php";
if ( is_readable($locale_file) ) require_once($locale_file);

// Cleaning up the Wordpress Head
function lop_head_cleanup() {
	// remove header links
	// remove_action( 'wp_head', 'feed_links_extra', 3 );                    // Category Feeds
	// remove_action( 'wp_head', 'feed_links', 2 );                          // Post and Comment Feeds
	remove_action( 'wp_head', 'rsd_link' );                               // EditURI link
	remove_action( 'wp_head', 'wlwmanifest_link' );                       // Windows Live Writer
	remove_action( 'wp_head', 'index_rel_link' );                         // index link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );            // previous link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );             // start link
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); // Links for Adjacent Posts
	remove_action( 'wp_head', 'wp_generator' );                           // WP version
}
	// launching operation cleanup
	add_action('init', 'lop_head_cleanup');
	// remove WP version from RSS
	function lop_rss_version() { return ''; }
	add_filter('the_generator', 'lop_rss_version');

// loading jquery reply elements on single pages automatically
function lop_queue_js(){ if (!is_admin()){ if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) wp_enqueue_script( 'comment-reply' ); }
}
	// reply on comments script
	add_action('wp_print_scripts', 'lop_queue_js');

// Fixing the Read More in the Excerpts
// This removes the annoying […] to a Read More link
function lop_excerpt_more($more) {
	global $post;
	// edit here if you like
	return '...  <a href="'. get_permalink($post->ID) . '" title="Read '.get_the_title($post->ID).'">Read more</a>';
}
add_filter('excerpt_more', 'lop_excerpt_more');

// Adding WP 3+ Functions & Theme Support
function lop_theme_support() {
	add_theme_support('post-thumbnails');      // wp thumbnails (sizes handled in functions.php)
	set_post_thumbnail_size(200, 150, true);   // default thumb size
	add_theme_support('automatic-feed-links'); // rss thingy
	// to add header image support go here: http://themble.com/support/adding-header-background-image-support/
	// adding post format support
	add_theme_support( 'menus' );            // wp menus
	register_nav_menus(                      // wp3+ menus
		array(
			'primary' => 'Primary Menu',
			'secondary' => 'Secondary Menu'
		)
	);
}

	// launching this stuff after theme setup
	add_action('after_setup_theme','lop_theme_support');
	// adding sidebars to Wordpress (these are created in functions.php)
	add_action( 'widgets_init', 'lop_register_sidebars' );
	// adding the lop search form (created in functions.php)
	add_filter( 'get_search_form', 'lop_wpsearch' );
	add_action('init', 'lop_reg_script');





/****************** PLUGINS & EXTRA FEATURES **************************/

// Related Posts Function (call using lop_related_posts(); )
function lop_related_posts() {
	echo '<ul id="lop-related-posts">';
	global $post;
	$tags = wp_get_post_tags($post->ID);
	if($tags) {
		foreach($tags as $tag) { $tag_arr .= $tag->slug . ','; }
        $args = array(
        	'tag' => $tag_arr,
        	'numberposts' => 5, /* you can change this to show more */
        	'post__not_in' => array($post->ID)
     	);
        $related_posts = get_posts($args);
        if($related_posts) {
        	foreach ($related_posts as $post) : setup_postdata($post); ?>
	           	<li class="related_post"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
	        <?php endforeach; }
	    else { ?>
            <li class="no_related_post">No Related Posts Yet!</li>
		<?php }
	}
	wp_reset_query();
	echo '</ul>';
}

// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'filter_ptags_on_images');





?>