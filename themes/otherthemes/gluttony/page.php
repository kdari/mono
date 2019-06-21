<?php get_header(); ?>
<?php get_sidebar(); ?>

	<div class="maincolumn">
		<div id="menu">
			<ul>
				<?php wp_list_pages('depth=1&title_li='); ?>
				<li><a href="<?php bloginfo('rss2_url') ?>" title="Subscribe by RSS"><span class="feed">RSS</span></a></li>
			</ul>
		</div>
		<div id="content">

			<div id="banner"><img src="<?php bloginfo('template_directory'); ?>/images/banner.jpg" alt="banner" /></div>
			<div class="clear"></div>


			<?php while(have_posts()) : the_post(); ?>
			<div class="post" id="post-<?php the_ID(); ?>">
				<div class="entry-head">
					<h2><span class="entry-date alignright"><?php the_time('m.d'); ?></span><?php the_title(); ?></h2>
				</div>
				<div class="entry-wrap">
					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages('<p><strong>Pages:</strong> ', '</p>', 'number'); ?>
						<?php edit_post_link('Edit', '<p>', '</p>'); ?>
						<!-- <?php trackback_rdf(); ?> -->

						<div id="comments">
							<?php comments_template(); ?>
						</div>

					</div>
					<div class="rc"></div>
				</div>
			</div>
			<?php endwhile; ?>

		</div>
	</div>

<?php get_footer(); ?>