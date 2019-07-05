<?php
/*
Template Name: Full Width
*/
?>
<?php get_header(); ?>
    
    	<div id="post-wrap" class="full-width-wrap">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        			<?php the_content(); ?>
				<?php endwhile; ?>
				<?php endif; ?>	
				
				<?php comments_template(); ?>  
        </div><!-- END post-wrap -->
     
<?php get_footer(); ?>