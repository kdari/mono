<?php
/**
 * The Template for displaying all single photo albums.
 *
 * @package WordPress
 * @subpackage Ezekiel
 * @since Ezekiel 3.0
 */

get_header(); ?>

<section id="page">
		<section id="gallery">
			

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
					
            <header>
				<h2><?php the_title(); ?></h2>
			</header>
			<ul id="gallery-list">
            <!-- Row 1 -->
				<?php
				$args = array(
					'post_type' => 'attachment',
					'numberposts' => -1,
					'post_status' => null,
					'post_parent' => $post->ID
					); 
				$attachments = get_posts($args);
				$currentAttachmentNum = 0;
				//
				if ($attachments) {
					$currentAttachmentNum = 0;
					foreach ($attachments as $attachment1) {?>
                                
               		 <li><a href="<?php bloginfo('url'); echo ("/?attachment_id=" . $attachment1->ID); ?>"><img src="<?php bloginfo( 'template_directory' ); ?>/thumb.php?src=<?php if (is_multisite()){echo get_current_site(1)->path; echo str_replace(get_blog_option($blog_id,'fileupload_url'),get_blog_option($blog_id,'upload_path'), $attachment1->guid); }else{ echo $attachment1->guid;}?>&h=180&w=180&zc=1" alt="<?php the_title(); ?>" alt="img_carousel" /></a></li> 
				<?php } }?>
			</ul>
			<?php endwhile; // end of the loop. ?>
            </section>
</section>


<?php //comments_template( '', true ); ?>		

<?php get_footer(); ?>