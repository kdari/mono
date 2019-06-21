<?php
/*
Template Name: Events
*/


get_header(); ?>
			

<section id="page">

		<section class="post-list">
			<header>
				<h2>Upcoming Events</h2>
			</header>
			<ul class="articles">
            <?php wp_reset_query(); ?>

			 <?php
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$args = array( 'post_type' => 'cpt_events',
							   'post_status' => 'future',
							   'paged' => $paged,
							   'order' => 'ASC');
				query_posts($args);		
				?>
         	   
      	    	<?php if (have_posts()) : ?>
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
                    <p><?php the_time('F j, Y'); ?>, <?php the_time('g:i a'); ?> 
                    <?php 
                    		$location = get_post_meta($post->ID, "map", true );
                    		if ( ! empty( $location ) ) { ?>
                    			@ <a href="<?php echo get_post_meta($post->ID, "map", true); ?>" target="_blank"/><?php echo get_post_meta($post->ID, "address", true); ?></a>
                    			<?php }
							$this_fb_event = get_post_meta($post->ID, "facebookevent", true);
							if ($this_fb_event <> '') {
								$this_fb_event = " | RSVP on <a href=\"" . $this_fb_event . "\">Facebook</a>";
								echo $this_fb_event;
							}
							?></p>
                    <p>
                      <?php the_excerpt(); ?>
                        <a class="read-more" href="<?php the_permalink(); ?>">More info<span class="read-arrow">&raquo;</span></a>
                    </p>
                </aside>
            </li>
			<?php endwhile; // end of the loop. ?>
            <?php endif; ?>
            </ul>
            
			<?php get_template_part ('includes/pagination'); ?>

		</section>
        </section>   
                
           
<?php get_footer(); ?>