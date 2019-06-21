<?php
	global $options;
foreach ($options as $value) {
	if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>
</div> <!-- #container -->
<div id="data">
	<div class="container">
    	<div class="top"></div>
    	<div class="about">
        	<h2>about</h2>
            <ul class="page">
            	<li><a href="<?php echo get_option('home'); ?>" accesskey="1" <?php if( is_home()) : ?> class="active" <?php endif; ?> title="Back to Frontpage">Home</a></li>
			<?php
			if( is_page() ) $curpage = $post->ID;
			$pages = get_pages('sort_column=menu_order');
			foreach( $pages as $page ) {
				$this_css = '';
				$this_link = get_page_link($page->ID);
				if( $curpage == $page->ID ) $this_css = ' class="active"';
				echo "<li><a $this_css href=\"$this_link\">" . $page->post_title . "</a></li>\n\t\t";
			} ?>
            </ul>
            <div class="ffix"></div>
        </div>
        <div class="category">
        	<h2>Portfolio</h2>
            <ul class="cats">
            	<?php wp_list_categories('title_li='); ?>
            </ul>
        </div>
        <div class="resume">
        	<h2>The Photographer</h2>
        	<?php echo get_avatar("$ftfl_email",$size='48'); ?>
            <p>
            	<?php echo $ftfl_short_bio ?>
            </p>
        </div><!-- .resume -->
        <div class="bottom"></div>
    </div>
</div><!-- .data -->
<div id="footer">
	<span>&copy; 2009 <?php bloginfo('name'); ?> | </span>
    <span><a href="http://pupungbp.erastica.com/wordpress-theme/fotofolio-wordpress-theme-for-your-online-portfolio/">Fotofolio</a> by <a href="http://pupungbp.erastica.com">Pupung Budi Purnama</a></span>
</div>
<?php wp_footer(); ?>
</body>
</html>