<?php get_header(); ?>

	<?php if (have_posts()) : ?>

		<?php if (is_paged()) : ?>

		<div class="pagenavigation">
			<div class="pagenav">
				<div class="left"><?php next_posts_link('&laquo; Older Entries') ?></div>
				<div class="right"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
				<div class="clearer">&nbsp;</div>
			</div>
			<div class="pagenav_bottom"></div>
		</div>

		<?php endif;?>

		<?php while (have_posts()) : the_post(); ?>

			<div class="post" id="post-<?php the_ID(); ?>">
				
				<div class="post_title">
					<h1 class="left"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
					<div class="post_date right"><?php the_time('F jS, Y') ?></div>
					<div class="clearer">&nbsp;</div>
				</div>

				<div class="post_body">
					<?php the_content('Read the rest of this entry &raquo;'); ?>
					<div class="clearer">&nbsp;</div>
					<?php edit_post_link('Edit this entry', '<p>', '</p>'); ?>

					<div class="post_metadata">
						<div class="content">
							<div class="left">
								Posted in <?php the_category(', ') ?><?php the_tags(', tagged: ', ', '); ?>
							</div>
							<div class="right"><span class="comment"><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?></span></div>
							<div class="clearer">&nbsp;</div>
						</div>
					</div>
					
				</div>

				
				<div class="post_bottom"></div>

			</div>

		<?php endwhile; ?>

		<?php if ( count($posts) >= get_option('posts_per_page') ) : ?>

		<div class="pagenavigation">
			<div class="pagenav">
				<div class="left"><?php next_posts_link('&laquo; Older Entries') ?></div>
				<div class="right"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
				<div class="clearer">&nbsp;</div>
			</div>
			<div class="pagenav_bottom"></div>
		</div>

		<?php endif;?>

	<?php else : ?>

		<div class="post">

			<div class="post_title"><h1>Not Found</h1></div>

			<div class="post_body">
				<p>Sorry, but you are looking for something that isn't here.</p>
			</div>

			<div class="post_bottom"></div>

		</div>		

	<?php endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
