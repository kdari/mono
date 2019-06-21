<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><? bloginfo('name'); ?> <?php wp_title(); ?></title>

<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url') ?>/style.css" media="screen" />
<!--[if lt IE 8]>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url') ?>/ie.css" media="screen" />
<script src="http://ie7-js.googlecode.com/svn/version/2.0(beta3)/IE8.js" type="text/javascript"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url') ?>/print.css" media="print" />
<link rel="start" href="<?php bloginfo('url') ?>" title="Home" />

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>

</head>
<body <?php if (is_home()) { ?>id="home"<?php } else { ?>id="interior" class="<?php echo $post->post_name; ?>"<?php } ?>>

  <div id="container">
      <a title="RSS 2.0 Feed" href="<?php bloginfo('rss2_url'); ?>" id="rssfeed">RSS Feed</a>
   		<div id="header" class="clearfix">
			<h1><a href="<?php bloginfo('url') ?>"><? bloginfo('name'); ?></a> <span><?php bloginfo('description'); ?></span></h1>
			<ul id="nav">
		<?php 
        $menupages = $wpdb->get_results("SELECT ID, post_title FROM $wpdb->posts WHERE post_type = 'page' AND post_status = 'publish' AND post_parent = 0 ORDER BY menu_order ASC");
        $menupagesnumber = count($menupages);
		$menupagescount = 1;
		foreach ($menupages as $menupage) :
        ?>
	        <li><a href="<?php echo get_permalink($menupage->ID); ?>" title="<?php echo $menupage->post_title; ?>"><?php echo $menupage->post_title; ?></a></li>
		<?php endforeach; ?>
		    <li class="last"><?php include (TEMPLATEPATH . "/searchform.php"); ?></li>
			</ul>
		</div>
