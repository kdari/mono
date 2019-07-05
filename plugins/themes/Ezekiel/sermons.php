<?php
/*
Template Name: Sermons
*/


get_header(); ?>
			

<section id="page">

		<section class="sermon-list">
			<header>
            <?php 
			$blogurl = get_bloginfo('url'); 
			$blogurl = str_replace("http", "itpc", $blogurl )
			?>
				<h2>Sermons<a href="<?php echo $blogurl; ?>/?feed=podcast" class="podcast">Subscribe to Podcast</a></h2>
			</header>
			<ul class="sermon-articles">
            <?php wp_reset_query(); ?>

			<?php
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $args = array('paged' => $paged, 'post_type' => 'cpt_sermons');
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
                <ul>
                <li class="quick-read">
                    <h3>Title: <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <span class="meta"><?php the_time('F j, Y'); ?>, <a href="#"><?php comments_number('0','1','%'); ?> Comments</a>, Author: <?php echo get_post_meta($post->ID, 'sermonauthor', true); ?></span>
                    <p>
                      <?php the_excerpt(); ?>
                        <a class="read-more" href="<?php the_permalink(); ?>">Read more <span class="read-arrow">&raquo;</span></a>
                    </p>
                <li class="quick-links">
                    <ul>
                    
 
					 <script type="text/javascript">
                <!--
                function sermonPopup<?php echo $post->ID; ?>() {
                window.open( "<?php echo get_template_directory_uri();?>/includes/sermon-popup/?mp3=<?php echo get_post_meta($post->ID, 'sermonmp3', true) ?>&ogg=<?php echo get_post_meta($post->ID, 'sermonogg', true)?>&title=<?php echo get_the_title(); ?>", "myWindow", 
                "status = 1, height = 116, width = 422, resizable = 0" )
                }
                //-->
                </script>                        <li class="listen_big"><a onClick="sermonPopup<?php echo $post->ID; ?>()" href="">Listen</a></li>
                        <li class="download_big"><a href="<?php echo get_template_directory_uri();?>/includes/mp3.php?file=<?php echo get_post_meta($post->ID, 'sermonmp3', true); ?>&fname=<?php echo get_the_title(); ?>">Download</a></li>
                    </ul>
                </li>
                </ul>
                </aside>
                
            </li>
			<?php endwhile; // end of the loop. ?>
            <?php endif; ?>
            </ul>
            
			<?php get_template_part ('includes/pagination'); ?>

		</section>
        </section>   
                
                	
<?php get_sidebar(); ?>
           
<?php get_footer(); ?>