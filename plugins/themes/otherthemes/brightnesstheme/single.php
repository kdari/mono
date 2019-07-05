<?php get_header(); ?>
<div class="wrap">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="singlepost">
			<div class="heading">
				<span class="smalltitle"><a href="<?php bloginfo('url'); ?>">Homepage</a> &raquo; <?php the_category(', '); ?> &raquo; <?php the_title(); ?> </span>
			</div>
			<div class="posthead">
				<h2><?php the_title(); ?></h2>
				<span>By <?php the_author(); ?> + <?php the_time('F jS, Y') ?></span>
				<?php the_excerpt(); ?>
			</div>
			<div class="postcontent">
				<?php the_content(); ?>
			</div>
			<?php comments_template(); ?>
		</div>
	<?php endwhile; endif; ?>
	<?php include (TEMPLATEPATH . '/singlesidebar.php'); ?>
	<div class="clear"></div>
</div>
<?php get_footer(); ?>