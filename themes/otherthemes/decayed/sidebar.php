	<div id="footer">

		<span class="left">&copy; <?=date('Y');?> <a href="<?php bloginfo('url');?>/"><?php bloginfo('name');?></a>. Valid <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> &amp; <a href="http://validator.w3.org/check?uri=referer">XHTML</a></span>

		<span class="right"><a href="http://templates.arcsin.se/">Theme</a> by <a href="http://arcsin.se/">Arcsin</a></span>

		<div class="clearer"><span></span></div>

	</div>

</div>

<div id="navigation">

	<div id="sidebar">

<?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar() ) : ?>

		<h2 class="decay">Pages</h2>
		<ul>
		<?php wp_list_pages('title_li='); ?>
		</ul>		
			
		<h2 class="decay">Categories</h2>

		<ul>
		
			<?php wp_list_cats('sort_column=name&hierarchical=0'); ?>

		</ul>

		<h2 class="decay">Archives</h2>

		<ul>
			<?php wp_get_archives('type=monthly'); ?>
		</ul>

		<h2 class="decay"><?php _e('Blogroll'); ?></h2>

		<ul>
			<?php wp_list_bookmarks('title_li=&categorize=0'); ?>
		</ul>

		<h2 class="decay">Search</h2>

		<ul>

			<li>

			<form method="get" id="searchform" action="<?php echo $_SERVER['PHP_SELF']; ?>">

				<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" size="12" class="sfield" /> <input type="submit" id="searchsubmit" value="Search" style="font-size: 10px;" />

			</form>

			</li> 

		</ul>
		
		<h2 class="decay">Tag cloud</h2>

		<ul>

			<li>
				<?php wp_tag_cloud(); ?>
			</li> 

		</ul>	
		
		<h2 class="decay"><?php _e('Meta'); ?></h2>

		<ul>

			<li><a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS'); ?>"><?php _e('<abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>

			<li><a href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php _e('The latest comments to all posts in RSS'); ?>"><?php _e('Comments <abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>

			<li><a href="http://validator.w3.org/check/referer" title="<?php _e('This page validates as XHTML 1.0 Transitional'); ?>"><?php _e('Valid <abbr title="eXtensible HyperText Markup Language">XHTML</abbr>'); ?></a></li>

			<li><a href="http://gmpg.org/xfn/"><abbr title="XHTML Friends Network">XFN</abbr></a></li>

			<?php wp_meta(); ?>

		</ul>		
		
<?php endif; ?>

	</div>
			
</div>
