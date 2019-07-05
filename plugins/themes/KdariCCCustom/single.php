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
					<p class="meta">Author <a href="mailto: <?php the_author_meta('user_email'); ?>"><?php the_author(); ?></a>, Written   <?php the_time('M j, Y'); ?></p>
				</div>
                <?php if ( comments_open() ){ ?>
				<p class="comments"><span><?php echo get_comments_number(); ?></span> Comments</p>
                <?php } ?>

			</header>
            <section class="inline">
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
<div class="the-post">
<?php the_content(); ?>
</div>
</section> 

<?php comments_template( '', true ); ?>		
</article> 	
</div>
</section>

		

<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>