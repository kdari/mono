<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">



<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">



<head>



<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>



<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />



<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_url'); ?>/screen.css" />



<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />

<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />



<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>



<?php wp_head(); ?>

</head>



<body>



<!-- wrap starts here -->

<div id="wrap">



	<!--header -->

	<div id="header">			

				

		<h1 id="logo-text"><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>		

		<p id="slogan"><?php bloginfo('description'); ?></p>	

		

		<div  id="nav">

			<ul>

				<li id="first" <?php if ( is_home() or is_archive() or is_single() or is_paged() or is_search() or (function_exists('is_tag') and is_tag()) ) { echo ' class="current_page_item"'; } ?>><a href="<?php echo get_option('home'); ?>/">Home</a></li>

				<?php wp_list_pages('title_li=&depth=1'); ?>	

			</ul>		

		</div>	

		

		<div id="header-image"></div>

						

	<!--header ends-->					

	</div>