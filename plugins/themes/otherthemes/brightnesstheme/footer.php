<div class="footer">
	<div class="wrap">
		<div class="left">
			<h2>Copyright &copy; 2008 - <?php bloginfo('name'); ?> News</h2>
			Powered by <a href="http://www.wordpress.org/" title="Wordpress">Wordpress</a> &lt; <a href="http://www.dailywp.com">Daily WP</a>.
		</div>
		<h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?> <?php $etext = get_option('etext'); $redtext = get_option('redtext'); if($etext !== "hide") { if($redtext == NULL) { echo "<span>News</span>"; } else { echo '<span>'.$redtext.'</span>'; } } ?></a></h1>
		<div class="clear"></div>
	</div>
</div>
</body>
</html>