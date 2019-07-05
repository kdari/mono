<?php get_header(); ?>

	<div class="main">		
		
		<div class="content">
	
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<div class="post" id="post-<?php the_ID(); ?>">

				<h1><?php the_title(); ?></h1>
					
				<div class="descr"><?php the_time('F jS, Y') ?> by <?php the_author() ?></div>

				<div class="entry">

					<?php the_content('Read the rest of this entry &raquo;'); ?>

				</div>

				<p class="info">Posted in <?php the_category(', ') ?><?php edit_post_link('Edit',' | ',''); ?></p>

			</div>

			<?php comments_template(); ?>

		<?php endwhile; ?>

			<p align="center"><?php next_posts_link('&laquo; Previous Entries') ?> <?php previous_posts_link('Next Entries &raquo;') ?></p>

	<?php else : ?>

			<h2 align="center">Not Found</h2>

			<p align="center">Sorry, but you are looking for something that isn't here.</p>

	<?php endif; ?>
			</div>

	<?php get_sidebar(); ?>
			
			<div class="clearer"><span></span></div>

	</div>

<?php get_footer(); ?>
