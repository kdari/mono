<?php
	// load the theme options
	$options = get_option( 'my_corporation_theme_settings' ); 
?>
<?php get_header(); ?>
	<div id="post-content">
    <div class="post-entry single-entry clearfix">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        
        <h1 class="page-title"><?php the_title(); ?></h1>
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
             
	<?php comments_template(); ?>  
                
	</div>
	<!-- END post-content -->
            
<?php get_sidebar(); ?>
<div class="clear"></div>
<?php get_footer(); ?>