<?php get_header(); ?>
<?php get_sidebar(); ?>

	<div class="maincolumn">
		<div id="menu">
			<ul>
				<li<?php if(is_home()) { echo (' class="current_page_item"'); } ?>><a href="<?php bloginfo('url'); ?>" title="Home page">Home</a></li>
				<?php wp_list_pages('depth=1&title_li='); ?>
				<li><a href="<?php bloginfo('rss2_url') ?>" title="Subscribe by RSS"><span class="feed">RSS</span></a></li>
			</ul>
		</div>
		<div id="content">

			<div id="banner"><img src="<?php bloginfo('template_directory'); ?>/images/banner.jpg" alt="banner" /></div>
			<div class="clear"></div>


			<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
			<div class="post" id="post-<?php the_ID(); ?>">
				<div class="entry-head">
					<h2><span class="entry-date alignright"><?php the_time('m.d'); ?></span><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				</div>
				<div class="entry-wrap">
					<div class="entry-content">
						<?php the_excerpt(); ?>
						<?php edit_post_link('Edit', '<p>', '</p>'); ?>
						<!-- <?php trackback_rdf(); ?> -->
						<p class="entry-meta">
							<span class="cat-links">Filed under: <?php the_category(', ') ?><?php the_tags(', ', ', ', ''); ?></span> | <span class="comments-link"><?php comments_popup_link('Post a comment', '1 Comment', '% Comments'); ?></span>
						</p>
					</div>
					<div class="rc"></div>
				</div>
			</div>
			<?php endwhile; ?>

			<div class="navigation">
				<?php posts_nav_link(); ?>
			</div>

			<?php else : ?>

			<div class="post">
				<div class="entry-wrap">
					<div class="entry-content">
						<p>404 Error: The page you're looking for is not here.</p>
					</div>
					<div class="rc"></div>
				</div>
			</div>

			<?php endif; ?>

		</div>
	</div>

<?php get_footer(); ?>