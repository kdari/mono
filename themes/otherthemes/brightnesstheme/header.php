<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11"><meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; Blog Archive <?php } ?> <?php wp_title(); ?></title>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<!--[if lte IE 6]>
	<style type="text/css">
		#headlogo {  background: none; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php bloginfo('template_directory'); ?>/images/headbg.png', sizingMethod='fixed');  background-repeat: no-repeat; }
		.header ul li.current_page_item a {  background: none; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php bloginfo('template_directory'); ?>/images/menubg.png', sizingMethod='fixed');  background-repeat: no-repeat; }
		.footer h1{  background: none; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php bloginfo('template_directory'); ?>/images/footerlogo.png', sizingMethod='fixed');  background-repeat: no-repeat; }
	</style>
	<![endif]-->
	<?php wp_head(); ?>
</head>
<body>
<div class="wrap">
	<div class="header">
		<h1><a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>" id="headlogo"><?php bloginfo('name'); ?> <?php $etext = get_option('etext'); $redtext = get_option('redtext'); if($etext !== "hide") { if($redtext == NULL) { echo "<span>News</span>"; } else { echo '<span>'.$redtext.'</span>'; } } ?></a></h1>
		<ul>
			<li class="page_item<?php if (is_home() || is_single()) {echo ' current_page_item';} ?>"><a href="<?php bloginfo('url'); ?>">Homepage</a></li>
			<?php wp_list_pages('sort_column=menu_order&title_li=&depth=1'); ?>				
		</ul>
		<div style="clear:both;"></div>
	</div>
</div>

