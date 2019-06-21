<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<?php wp_head(); ?>
</head>
<body>

<div id="header">
	<div class="center_wrapper">
		
		<div id="toplinks">
			<div id="toplinks_inner">
				<a href="<?php echo get_option('home'); ?>">Home</a> | <?php if ( $user_ID ) : ?><?php wp_register('', ''); ?><?php else : ?><a href="<?php bloginfo('rss2_url'); ?>">RSS Feed</a><?php endif; ?> | <?php wp_loginout(); ?>
			</div>
		</div>
		<div class="clearer">&nbsp;</div>

		<div id="site_title">
			<h1><a href="<?php echo get_option('home'); ?>"><?php bloginfo('name'); ?></a></h1>
			<p><?php bloginfo('description'); ?></p>
		</div>

	</div>
</div>

<div id="navigation">
	<div class="center_wrapper">
	
		<ul>
			<?php wp_list_pages('title_li=&depth=1'); ?>
		</ul>

		<div class="clearer">&nbsp;</div>

	</div>
</div>

<div id="main_wrapper_outer">
	<div id="main_wrapper_inner">
		<div class="center_wrapper">
					
			<div class="left" id="main">
				<div id="main_content">
