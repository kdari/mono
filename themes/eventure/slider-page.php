<?php
/*
Template Name: Slider Page
*/
get_header();
get_template_part('slider');
if (have_posts()) : while (have_posts()) : the_post(); ?>

	<div  <?php post_class(); ?>>
		
		<div class="entry">
			<h2 id="postTitle"><?php the_title(); ?><?php edit_post_link(' <small>&#9997;</small>','',' '); ?></h2>
			<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs();?>
			<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>
			<div class="clear"></div>
        </div><!--end entry-->
        
                    
        <div id="commentsection">
			<?php comments_template(); ?>
        </div>
	
		<div class="clear"></div>
	</div><!--end post-->

<?php 
endwhile; endif;
get_sidebar();
get_footer(); 
?>