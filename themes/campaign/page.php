<?php get_header(); ?>
<div id="page" class="posts-wrap">
	<h2 class="entry-title"><?php the_title(); ?></h2>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div <?php post_class(); ?>>
		<div class="entry-content" id="page-content">
			<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
			<?php wp_link_pages(); ?>
			<div class="clear"></div>
		</div>
	</div>
	<?php endwhile; endif; ?>
	<div class="clear"></div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>