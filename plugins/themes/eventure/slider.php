<?php
//OptionTree Stuff
if ( function_exists( 'get_option_tree') ) {
	$theme_options = get_option('option_tree');
	$sliderCat = get_option_tree('slider_cat',$theme_options);
	$sliderNumber = get_option_tree('slider_number',$theme_options);
} 
?>

<!--SLIDER-->
<div id="slider">
	<ul class="slides">
		<?php $showPostsInCategory = new WP_Query(); $showPostsInCategory->query('cat='.$sliderCat.'&showposts='.$sliderNumber);  ?>
		<?php if ($showPostsInCategory->have_posts()) :?>
		<?php while ($showPostsInCategory->have_posts()) : $showPostsInCategory->the_post(); ?>
		<li>
			<div class="sliderInfo">
				<a class="sliderTitle" href="<?php the_permalink();?>"><?php the_title();?></a><br />
				<div class="sliderDate"><?php echo get_the_time('m.d.Y'); ?></div>
			</div>
			<?php the_post_thumbnail('slider'); ?>	
		</li>
		<?php endwhile; endif; ?>
	</ul>
</div>