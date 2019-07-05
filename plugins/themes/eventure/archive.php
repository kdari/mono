<?php get_header();?>

	<div id="listing">
	<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs();?>

	<?php 
	//OptionTree Stuff
	if ( function_exists( 'get_option_tree') ) {
	$theme_options = get_option('option_tree');
	$eventCat = get_option_tree('event_cat',$theme_options);
	} 
	if($eventCat && in_category(''.$eventCat.'')){
	query_posts($query_string . "&order=ASC");
	}
	if (have_posts()) : while (have_posts()) : the_post(); 
	?>
	
		<div <?php post_class(); ?>>
		
		<?php get_template_part("thumbnail"); ?>
		
		<a class="dateInfo" href="<?php the_permalink() ?>">
			<div class="dayInfo"><?php echo get_the_time('d'); ?></div>
			<div class="timeInfo"><?php echo get_the_time('D @ g:i a'); ?></div>
			<div class="monthInfo"><?php echo get_the_time('M Y'); ?></div>
		</a>
		
		<div class="listContent">
		<h2 class="posttitle"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
		
		<div class="smallMeta">
		<img src="<?php echo get_template_directory_uri();?>/images/folder.gif" alt="" />&nbsp;&nbsp;<?php the_category(', '); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo get_template_directory_uri();?>/images/person.gif" alt="" />&nbsp;<?php the_author(); ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo get_template_directory_uri();?>/images/comment_left.gif" alt="" />&nbsp;<?php comments_popup_link('0 Comments', '1 Comment', '% Comments'); ?>		</div>
		
		<?php the_excerpt(); ?>
		</div><!--end listContent-->
		
        <div class="clear"></div>
		</div><!--end post-->

		<?php endwhile; ?>

		<?php get_template_part("navigation"); ?>

	<?php else : ?>
		<?php _e("<h2 class='center'>Not Found</h2><p class='center'>Sorry, but you are looking for something that isn't here.</p>");?>
	<?php endif; ?>
	
	</div><!--end listing-->
	
<?php get_sidebar();?>
	
<?php get_footer(); ?>