<?php get_header(); ?>
<div class="wrap">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="singlepost">
			<div class="heading">
				<span class="smalltitle">Viewing page:</span>
			</div>
			<div class="posthead">
				<h2><?php the_title(); ?></h2>
				<p></p>
			</div>
			<div class="postcontent">
				<?php the_content(); ?>
			</div>
		</div>
	<?php endwhile; endif; ?>
	<?php include (TEMPLATEPATH . '/singlesidebar.php'); ?>
	<div class="clear"></div>
</div>
<?php get_footer(); ?>