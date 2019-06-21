<?php
/*
Template Name: Full Width Page
*/
?>

<?php get_header(); ?>

<?php
//OptionTree Stuff
if ( function_exists( 'get_option_tree') ) {
	$theme_options = get_option('option_tree');
	$eventCat = get_option_tree('event_cat',$theme_options);
} 
?>
		
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div  <?php post_class(); ?>>
		
		<div class="entry">
			<h2 id="postTitle"><?php the_title(); ?><?php edit_post_link(' <small>&#9997;</small>','',' '); ?></h2>
			<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs();?>
			<div id="twoColumns">
				<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>
			</div>
			<div class="clear"></div>
        </div><!--end entry-->
        
                    
        <div id="commentsection">
			<?php comments_template(); ?>
        </div>
	
	</div><!--end post-->

 
	<div class="clear"></div>
	<?php endwhile; endif; ?>
	
<?php get_footer(); ?>