<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; Blog Archive <?php } ?> <?php wp_title(); ?></title>
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats -->
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_head(); ?>
</head>
<body>
<div id="wrapper">

<div id="searchbar">
Search this blog...
<div id="searchtext"><?php include (TEMPLATEPATH . '/searchform.php'); ?></div>
</div><!--end of searchbar -->

<div id="header">
<div id="header_left_top"><!-- Hack for IE --></div>
<div id="header_left">

<div id="subscribe">
<a href="<?php bloginfo('rss2_url'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/subscribe.gif" border="0" alt="Subscribe to RSS Feed!"/></a>
</div><!--end of subscribe -->

	<div id="navigation">
    <div id="menu">
        <ul>
                <?php $params = wp_list_pages('sort_column=menu_order&depth=1&title_li='); ?>
       	</ul>
    </div><!--end of menu -->
    </div><!--end of navigation -->
	
</div><!--end of header_left -->

<div id="header_right"><br />
<h1><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
</div><!--end of header_right -->


<br clear="all" />
</div><!--end of header -->