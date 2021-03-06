<?php get_header(); ?>
	
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
	<div id="post-<?php the_ID(); ?>">

		<h1 class="decay"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h1>
			
		<div class="descr"><?php the_time('F jS, Y') ?> by <?php the_author() ?></div>

		<div class="entry">

			<?php the_content('Read the rest of this entry &raquo;'); ?>

		</div>

		<p class="postinfo">Posted in <?php the_category(', ') ?> | <?php edit_post_link('Edit','',' |'); ?> <?php comments_popup_link('No Comments &raquo;', '1 Comment &raquo;', '% Comments &raquo;'); ?></p>

	</div>

	<?php comments_template(); ?>

		<?php endwhile; ?>

	<p align="center"><?php next_posts_link('&laquo; Previous Entries') ?> <?php previous_posts_link('Next Entries &raquo;') ?></p>

	<?php else : ?>

	<h1 class="decay">Not Found</h1>

	<p>Sorry, but you are looking for something that isn't here.</p>

	<?php endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
