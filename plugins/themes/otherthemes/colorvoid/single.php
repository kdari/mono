<?php get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="post" id="post-<?php the_ID(); ?>">

			<div class="post_title">
				<h1 class="left"><?php the_title(); ?></h1>
				<div class="post_date right"><?php the_time('F jS, Y') ?></div>
				<div class="clearer">&nbsp;</div>
			</div>

			<div class="post_body">
				
				<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>
				<div class="clearer">&nbsp;</div>
				<?php edit_post_link('Edit this entry', '<p>', '</p>'); ?>
				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

				<div class="post_metadata">
					<div class="content">
					<?php if ($post->comment_status == 'open') : ?>
						<div class="left">Posted in <?php the_category(', ') ?><?php the_tags(', tagged: ', ', '); ?></div>
						<div class="right"><span class="comment"><a href="#respond">Leave a reply</a></span></div>
						<div class="clearer">&nbsp;</div>

					<?php else : ?>
						Posted in <?php the_category(', ') ?><?php the_tags(', tagged: ', ', '); ?>
					<?php endif;?>						
					</div>
				</div>

			</div>

			<div class="post_bottom"></div>

		</div>

	<?php comments_template(); ?>

	<?php endwhile; else: ?>

	<div class="post">

		<div class="post_title"><h1>Not Found</h1></div>

		<div class="post_body">
			<p>Sorry, no posts matched your criteria.</p>
		</div>

		<div class="post_bottom"></div>

	</div>

<?php endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
