<?php
/**
 * The template for displaying Tag Results pages.
 *
 * @package WordPress
 * @subpackage Ezekiel
 * @since Ezekiel 3.0
 */

get_header(); ?>

<section id="page">

		<section class="post-list">
			<header>
				<h2>Tags for "<?php echo get_search_query(); ?>"</h2>
			</header>
			
            
 <?php if (have_posts()) : ?>
 <ul class="articles">
            <?php while (have_posts()) : the_post(); ?>
            
            <li class="article">
				<?php
                //get the post thumbnail for this post
                $image_id = get_post_thumbnail_id();  
                if ($image_id != ""){ 
					$image_url = wp_get_attachment_image_src($image_id,'full');  
					$image_url = $image_url[0];  
					?>
					<a href="<?php the_permalink(); ?>"><img src="<?php bloginfo( 'template_directory' ); ?>/thumb.php?src=<?php if (is_multisite()){echo get_current_site(1)->path; echo str_replace(get_blog_option($blog_id,'fileupload_url'),get_blog_option($blog_id,'upload_path'),$image_url); }else{ echo $image_url;}?>&h=115&w=115&zc=1" alt="" /></a>
                <?php } ?>
                <aside>
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <span class="meta"><?php the_time('F j, Y'); ?>, <a href="#"><?php comments_number('0','1','%'); ?> Comments</a></span>
                    <p>
                      <?php the_excerpt(); ?>
                        <a class="read-more" href="<?php the_permalink(); ?>">Read more <span class="read-arrow">&raquo;</span></a>
                    </p>
                </aside>
            </li>
            <?php endwhile; // end of the loop. ?>
            </ul>
            <?php get_template_part ('includes/pagination'); ?>
<?php else : ?>
					<h2><?php _e( 'Nothing Found', 'ezekiel' ); ?></h2>
					<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'ezekiel' ); ?></p>
					<?php get_search_form(); ?>
<?php endif; ?>

            
			

		</section>
        </section>   
                
                	
<?php get_sidebar(); ?>
           
<?php get_footer(); ?>