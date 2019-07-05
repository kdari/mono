<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; Blog Archive <?php } ?><?php wp_title(); ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<!--[if lte IE 7]><link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory') ?>/ie_fixes.css" media="screen" /><![endif]-->
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php wp_head(); ?>
</head>

<body>

<div id="layout_wrapper">
<div id="layout_edgetop"></div>
<div id="layout_container">

	<div id="site_title">
		<h1 class="left"><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
		<h2 class="right"><?php bloginfo('description'); ?></h2>
		<div class="clearer">&nbsp;</div>
	</div>

	<div id="top_separator"></div>

	<div id="navigation">

		<div id="tabs">
			
			<ul>
				<?php cdt_list_pages('depth=1&title_li=') ?>
			</ul>

			<div class="clearer">&nbsp;</div>

		</div>

	</div>

	<div class="spacer h5"></div>

	<div id="main">

		<div class="left" id="main_left">

			<div id="main_left_content">
