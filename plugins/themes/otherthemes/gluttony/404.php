<?php get_header(); ?>
<?php get_sidebar(); ?>

	<div class="maincolumn">
		<div id="menu">
			<ul>
				<li<?php if(is_home()) { echo (' class="current_page_item"'); } ?>><a href="<?php bloginfo('url'); ?>" title="Home page">Home</a></li>
				<?php wp_list_pages('depth=1&title_li='); ?>
				<li><a href="http://www.wpdesigner.com/feed/" title="Subscribe by RSS"><span class="feed">RSS</span></a></li>
			</ul>
		</div>
		<div id="content">

			<div id="banner"><img src="<?php bloginfo('template_directory'); ?>/images/banner.jpg" alt="banner" /></div>
			<div class="clear"></div>

			<div class="post">
				<div class="entry-wrap">
					<div class="entry-content">
						<p>404 Error: The page you're looking for is not here.</p>
					</div>
					<div class="rc"></div>
				</div>
			</div>

		</div>
	</div>

<?php get_footer(); ?>