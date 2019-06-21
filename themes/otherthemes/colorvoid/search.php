<?php get_header(); ?>

	<?php if (have_posts()) : $odd = 'class="alt" '; ?>

		<?php if ( is_paged() || count($posts) >= get_option('posts_per_page') ) : ?>

		<div class="pagenavigation">
			<div class="pagenav">
				<div class="left"><?php next_posts_link('&laquo; Older Entries') ?></div>
				<div class="right"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
				<div class="clearer">&nbsp;</div>
			</div>
			<div class="pagenav_bottom"></div>
		</div>

		<?php endif;?>

		<div class="post">
			
			<div class="post_title">
				<h1>Search results</h1>
			</div>
			
			<div class="post_body nicelist">

				<ol>
		<?php while (have_posts()) : the_post(); ?>
				<li <?php echo $odd; ?> id="post-<?php the_ID(); ?>">

					<div class="archive_title">
						<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
					</div>

					<div class="post_search_text">
						<?php the_excerpt() ?>
					</div>

				</li>
			<?php $odd = ( empty( $odd ) ) ? 'class="alt" ' : ''; ?>
		<?php endwhile; ?>
			</div>

		</div>

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

			<div class="post_title"><h1>No posts found</h1></div>

			<div class="post_body">
				<p>Try a different search?</p>
			</div>

			<div class="post_bottom"></div>

		</div>		

	<?php endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>