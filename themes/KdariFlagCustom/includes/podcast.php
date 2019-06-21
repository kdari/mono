<?php 

function podcastfeed() {
header('Content-type: text/xml; charset=utf-8');
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>"; ?>


<rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" version="2.0">

<channel>

<title><?php echo get_option('cap_podcast_title'); ?></title>

<link><?php bloginfo('url'); ?></link>

<language>en-us</language>

<copyright>&#x2117; &amp; &#xA9; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></copyright>

<itunes:subtitle><?php echo get_option('cap_podcast_subtitle'); ?></itunes:subtitle>

<itunes:author><?php echo get_option('cap_podcast_author'); ?></itunes:author>

<itunes:summary><?php echo get_option('cap_podcast_description'); ?></itunes:summary>

<description><?php echo get_option('cap_podcast_description'); ?></description>

<itunes:owner>

<itunes:name><?php echo get_option('cap_podcast_author'); ?></itunes:name>

<itunes:email><?php echo get_option('cap_email'); ?></itunes:email>

</itunes:owner>

<itunes:image href="<?php echo get_option('cap_podcast_image'); ?>" />

<itunes:category text="<?php echo get_option('cap_podcast_cat_1'); ?>">

<itunes:category text="<?php echo get_option('cap_podcast_cat_2'); ?>"/>

</itunes:category>



<?php wp_reset_query(); ?>

<?php
	$args = array('showposts' => 10000, 'post_type' => 'cpt_sermons');
	query_posts($args);		
?>

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<item>

<title><?php the_title(); ?></title>

<itunes:author><?php echo get_post_meta(get_the_ID(), 'sermonauthor', true); ?></itunes:author>

<itunes:subtitle><?php the_title(); ?></itunes:subtitle>

<itunes:summary><?php the_excerpt(); ?></itunes:summary>

<?php 	
//get the post thumbnail for this post
$image_id = get_post_thumbnail_id();  
if ($image_id != ""){ ?>

<?php
$image_url = wp_get_attachment_image_src($image_id,'full');  
$image_url = $image_url[0];  
?>

<?php } ?>

<itunes:image href="<?php echo $image_url; ?>" />

<enclosure url="<?php echo get_post_meta(get_the_ID(), 'sermonmp3', true); ?>" length="8727310" type="audio/mpeg" />


<guid><?php echo get_post_meta(get_the_ID(), 'sermonmp3', true); ?></guid>

<pubDate><?php the_time('r') ?></pubDate>

</item>

<?php endwhile; // end of the loop. ?>
<?php endif; ?>

</channel>

</rss>

<?php 

} //end function to create feed

function add_podcast_feeds() {
	// echo 'test';
	add_feed('podcast', 'podcastfeed');
}




add_action('init','add_podcast_feeds');
?>