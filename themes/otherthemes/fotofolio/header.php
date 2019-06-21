<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php bloginfo('name'); ?> | <?php bloginfo('description'); ?></title>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<script src="<?php bloginfo("template_directory") ?>/js/jquery.js" type="text/javascript"></script>
<script src="<?php bloginfo("template_directory") ?>/js/imgpreview.js" type="text/javascript"></script>
<script src="<?php bloginfo("template_directory") ?>/js/jquery.innerfade.js" type="text/javascript"></script>
<script src="<?php bloginfo("template_directory") ?>/js/effects.js" type="text/javascript"></script>
<?php wp_head(); ?>
</head>

<body>
<div id="container">
	<div id="header">
    	<h1><a href="<?php echo get_option('home'); ?>"><?php bloginfo('name'); ?></a> <span><?php bloginfo('description'); ?></span></h1>
    </div><!-- #header -->
    
