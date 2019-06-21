<?php get_header(); ?>

	<div id="content">

	<?php if (have_posts()) : ?>
		
		<?php while (have_posts()) : the_post(); ?>
			<div class="section">
			<div class="post" id="post-<?php the_ID(); ?>">
				
				<div class="posttitle">
					<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h1>
					<span class="small"><?php edit_post_link('Edit', '', ' | '); ?></span><small><?php the_time('F jS, Y') ?> <!-- by <?php the_author() ?> --></small>
				</div>
				
				<div class="entry">
					<?php the_content('Continue Reading &raquo;'); ?>
					<?php wp_link_pages(); ?>
				</div>
		
				<div class="postmetadata"><p><span class="postsicon"> Category: <?php the_category(', ') ?></span></p>
				<p><?php if (has_tag()) : ?><span class="tagsicon"><?php the_tags('Tags: ', ', ', '</p>'); ?></span><?php endif; ?>
				</div>
					
				
				
				<?php comments_template(); ?>
				
			</div>
			</div>
			<?php endwhile; ?>
			
			<?php else : ?>

					<h2 class="center">Not Found</h2>
					<p class="center">Sorry, but you are looking for something that isn't here.</p>
					
			<?php endif; ?>

	</div>
</div>

<?php get_sidebar(); ?>

<?php include (TEMPLATEPATH . '/sidebar-right.php'); ?>

<?php get_footer(); ?>
