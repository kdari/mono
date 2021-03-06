<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Ezekiel
 * @since Ezekiel 3.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 * We filter the output of wp_title() a bit -- see
	 * ezekiel_filter_wp_title() in functions.php.
	 */
	wp_title( '|', true, 'right' );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />

<!--[if lt IE 9]>
		<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/html/shiv.js"></script>
		<link rel="stylesheet" media="screen" href="<?php bloginfo( 'template_url' ); ?>/css/ie.css" />
	<![endif]-->


<!-- JavaScript / jQuery -->

<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/jquery.js"></script>
<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/theme.js"></script>

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>

<body>

	<div class="head-wrap"><div class="head-texture">
		<header class="global">
			<hgroup>
				<h1>
                <a href="/"><img src="/files/2019/01/cross-creek-logo-white.png" height="112" width="468" alt="Cross Creek Church" />  </a>
                </h1>
				<h6><?php bloginfo( 'description' ); ?></h6>
			</hgroup>

           <nav>
                <?php wp_nav_menu( array( 'menu_class' => 'global', 'theme_location' => 'primary' ) ); ?>
			</nav>

            </header>
	</div></div>