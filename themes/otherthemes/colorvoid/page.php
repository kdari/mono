<?php get_header(); ?>

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<div class="post" id="post-<?php the_ID(); ?>">
			
			<div class="post_title"><h1><?php the_title(); ?></h1></div>
			
			<div class="post_body">
				<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
				<div class="clearer">&nbsp;</div>
				<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
			</div>
			
			<div class="post_bottom"></div>

		</div>

		<?php endwhile; endif; ?>		

<?php get_sidebar(); ?>

<?php get_footer(); ?>