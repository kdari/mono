<!doctype html>
<!--[if IEMobile 7 ]> <html <?php language_attributes(); ?>class="no-js iem7"> <![endif]-->
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6 oldie"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7 oldie"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8 oldie"> <![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;
	wp_title( '-', true, 'right' );
	// Add the blog name.
	bloginfo( 'name' );
	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' - ' . sprintf( __( 'Page %s', 'lop' ), max( $paged, $page ) );
	?></title>

	<!-- Favicon -->
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
    <?php 
		global $data;
		if ($data['lop_stylesheet']) { ?>
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/library/css/<?php echo $data['lop_stylesheet']; ?>"/>
	<?php }; ?>


	<!-- wordpress head functions -->
	<?php wp_head(); ?>
	<!-- end of wordpress head -->
</head>
<body <?php body_class(); ?>>
	<div id="wrapper">
		<div id="main">
        
			<header id="header" role="banner">
				<div id="logo">                    
					<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<img src="<?php /* Use the default logo (logo.png) if custom logo does not exist */
						if ( $data['lop_custom_logo']) : echo $data['lop_custom_logo']; else: bloginfo('template_directory');?>/img/logo.png<?php endif; ?>" alt="logo" />
					</a>                    
                    
                    
                </div>
                <!-- end #logo -->
                
				<?php if ( has_nav_menu( 'secondary' ) ) { /* if menu 'Secondary' menu defined then use Custom Menu */ ?>
                    <nav id="secondary-nav" role="navigation">
                       <?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_class' => 'secondary-menu tshadow') ); ?>
                       <?php 
					   global $data;    
					   if ( $data['lop_popup_menu'] == 1 ) { ?>
                           <ul class="secondary-menu popup-menu tshadow"> <li><a href="#" id="popup-trigger"><?php echo $data['lop_popup_link'] ?></a></li></ul>
					   <?php } ?>
                    </nav>
				<?php } ?>
                <!-- end #secondary-nav -->
                
				<nav id="nav" role="navigation">
					<?php if ( has_nav_menu( 'primary' ) ) { /* if menu 'Primary' menu exists then use Custom Menu */ ?>
	    				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'sf-menu' ) ); ?>
	    				<?php } else { /* else use wp_list_pages */?>
	    				<ul class="sf-menu">
	    					<?php wp_list_pages( 'title_li=&depth=2' ); ?>
	    				</ul>
					<?php } ?>
                   
                   
                    <?php get_search_form() ?>
                </nav>
                <!-- end #nav-->
                <div class="clear"></div>
            </header>
			<!-- end #header -->