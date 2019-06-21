<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Ezekiel
 * @since Ezekiel 3.0
 */

get_header(); ?>

<section id="page">
<div id="single">
		<article class="single-post">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
					
             <header class="single-header">
				<div>
					<h2><?php the_title(); ?></h2>
					<p class="meta"><?php the_time('M j, Y'); ?>, Author: <?php echo get_post_meta($post->ID, 'sermonauthor', true); ?></p>
				</div>
			</header>
            <section>
<?php 	
//get the post thumbnail for this post
$image_id = get_post_thumbnail_id();  
if ($image_id != ""){ ?>

<?php
$image_url = wp_get_attachment_image_src($image_id,'full');  
$image_url = $image_url[0];  
?>
				<section id="featured-img">
					<img src="<?php bloginfo( 'template_directory' ); ?>/thumb.php?src=<?php if (is_multisite()){echo get_current_site(1)->path; echo str_replace(get_blog_option($blog_id,'fileupload_url'),get_blog_option($blog_id,'upload_path'),$image_url); }else{ echo $image_url;}?>&h=278&w=610&zc=1" alt="article_image_full" width="610" height="278" /> 
					<aside>
						<h3><?php the_title(); ?></h3>
					</aside>
				</section>
<?php } ?>

 <?php $xml = (get_bloginfo('wpurl') . "/QUESTIONfeed=audioANDpid=" . $post->ID); ?>
 
<script type="text/javascript">
<!--
function myPopup2() {
window.open( "<?php echo get_template_directory_uri();?>/includes/sermon-popup/?xml=<?php echo $xml; ?>", "myWindow", 
"status = 1, height = 116, width = 422, resizable = 0" )
}
//-->
</script>
                    
                    
<a onClick="myPopup2()" href="">Listen</a> | 
					<a href="<?php echo get_template_directory_uri();?>/includes/mp3.php?file=<?php echo get_post_meta($post->ID, 'sermonmp3', true); ?>&fname=<?php echo get_the_title(); ?>">Download</a>
<div class="the-post">
<?php the_content(); ?>
</div>
</section> 
<?php comments_template( '', true ); ?>		
</article> 
        
<?php get_sidebar(); ?>		
</div>
</section>

		

<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>