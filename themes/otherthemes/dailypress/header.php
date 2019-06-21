<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; Blog Archive <?php } ?> <?php wp_title(); ?></title>
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats -->
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/tabber.js"></script>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/tab.css" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_head(); ?>
</head>
<body>
<div id="wrapper">
<div id="header">
<div id="logo"><h1><a href="<?php echo get_settings('home'); ?>"><?php bloginfo('name'); ?><?php echo $langblog;?></a></h1></div>
<div id="searchbox">
<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
<div><input type="text" value="<?php the_search_query(); ?>" name="s" id="s" class="swap_value" />
<input type="image" src="<?php bloginfo('template_directory'); ?>/images/go.gif" id="go" alt="Search" title="Search" />
</div>
</form>
</div>
</div>
<div id="nav">
<ul>
<?php wp_list_pages('sort_column=menu_order&depth=1&title_li='); ?>
</ul>
</div>
<div id="main">