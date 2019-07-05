<?php get_header(); ?>

	<div id="content">

		<?php if (have_posts()) : ?>
		
		<?php while (have_posts()) : the_post(); ?>
			<div class="section">
			<div class="post" id="post-<?php the_ID(); ?>">
				
				<div class="posttitle">
					<h1 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h1>
					<div class="entry">
					<?php the_content('Read the rest of this entry &raquo;'); ?>
					</div>
					<span class="small"><?php edit_post_link('Edit', '', ' | '); ?></span>
				</div>
				
				
				
			</div>
			</div>
			<?php endwhile; ?>
			<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>
			
			<?php else : ?>

					<h2 class="center">Not Found</h2>
					<p class="center">Sorry, but you are looking for something that isn't here.</p>
					
			<?php endif; ?>

	</div>
</div>
<?php get_sidebar(); ?>

<?php include (TEMPLATEPATH . '/sidebar-right.php'); ?>

<?php get_footer(); ?>