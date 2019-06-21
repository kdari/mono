<?php
	// load the theme options
	$options = get_option( 'my_corporation_theme_settings' ); 
?>
<?php get_header(); ?>
	<div id="post-content">  
    <div class="single-entry clearfix">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        
        <h1><?php the_title(); ?></h1>
        
		<div class="post-entry-date-single">Posted on <?php the_time('j') ?> <?php the_time('M') ?> in <?php the_category(' '); ?></div>
        <?php if ($options['disable_single_social'] != true) { ?>
                <div class="social">
        			<div class="tweet-this">
        				<a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-related="WPExplorer">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
                    </div>
                    <!-- END tweet-this -->
            	<div class="facebook-like">
           			<iframe src="http://www.facebook.com/plugins/like.php?href=<?php the_permalink(' ') ?>&amp;send=false&amp;layout=button_count&amp;width=85&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=arial&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:85px; height:21px;" allowTransparency="true"></iframe>
            	</div>
                <!-- END facebook-like -->
        </div>
        <!-- END Social -->
        <?php } ?>
        <?php if ( has_post_thumbnail() ) { ?>
        <?php if ($options['disable_single_image'] != true) { ?>
        	<div id="single-featured-image">
        		<?php the_post_thumbnail('post-image'); ?>
            </div><!-- END single-featured-image -->
        <?php } } ?>
		<?php the_content(); ?>
        <div class="clear"></div>
		<?php endwhile; ?>
		<?php endif; ?>	
        
        <?php wp_link_pages('before=<div id="post-page-navigation">&after=</div>'); ?>
         
        <div class="post-entry-bottom">
        <?php the_tags('<div class="post-tags">',' ','</div>'); ?>
        <!-- END post-category -->
        </div>
        <!-- END post-entry-bottom -->
        
        
        </div>
        <!-- END post-entry -->
        
         <div id="post-author" class="clearfix">
            	
                <div id="author-avatar">
					<?php echo get_avatar( get_the_author_email(), '50' ); ?>
                </div><!-- END author-avatar -->
                
                <div id="author-description">
                	<h4>About The Author</h4>
					<?php the_author_description(); ?>
                </div><!-- END author-description -->
       	</div><!-- END post-author -->
       
        
        <div id="related-posts" class="clearfix">
		<h3>Related Posts</h3>
			<?php
    			$category = get_the_category(); //get first current category ID
    			$this_post = $post->ID; // get ID of current post
    			$posts = get_posts('numberposts=3&orderby=rand&category=' . $category[0]->cat_ID . '&exclude=' . $this_post);
   			?>

  		<?php
   			foreach($posts as $post) {
   		?>
                <?php if ( has_post_thumbnail() ) { ?>
					<div class="related-post clearfix">
						<div class="related-posts-thumbnail">
   	     					<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="opacity"><?php the_post_thumbnail('related-posts'); ?></a>
           				</div><!-- /related-posts-thumbnail -->
                   	 	<div class="related-posts-content">
                    		<h4><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
                   		 <?php the_news_excerpt('10','','','plain','no'); ?>
                    	</div>
                    <!-- /related-posts-content -->
                    </div>
                    <!-- /related-post -->
                
                <?php } ?>
			 <?php } wp_reset_postdata(); ?>
	</div><!-- END related-posts -->
    <div class="clear"></div>
                
	<?php comments_template(); ?>  
                
	</div>
	<!-- END post-content -->
            
<?php get_sidebar(); ?>
<div class="clear"></div>
<?php get_footer(); ?>