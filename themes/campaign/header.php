<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes() ?>>
	<head>
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<title><?php global $page, $paged;

				wp_title( '|', true, 'right' );

				// Add the blog name.
				bloginfo( 'name' );

				// Add the blog description for the home/front page.
				$site_description = get_bloginfo( 'description', 'display' );
				if ( $site_description && ( is_home() || is_front_page() ) )
				echo " | $site_description";

				// Add a page number if necessary:
				if ( $paged >= 2 || $page >= 2 )
					echo ' | ' . sprintf( __( 'Page %s', 'designcrumbs' ), max( $paged, $page ) ); ?>
		</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS" href="<?php bloginfo('rss2_url'); ?>" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		
		<!-- CSS -->
		<style type="text/css">
		a {
			color:<?php echo stripslashes(of_get_option('link_color')); ?>;
		}
		ul.commentlist .bypostauthor img.avatar {
			border:1px solid <?php echo stripslashes(of_get_option('link_color')); ?>;
		}
		</style>
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
		
		<?php wp_head(); //leave for plugins ?>
	
		<?php if (of_get_option('favicon') != '') { ?>
		<link rel="shortcut icon" href="<?php echo stripslashes(of_get_option('favicon')) ?>" />
		<?php } ?>
	</head>
	<body <?php body_class(''. stripslashes(of_get_option('layout')) .' '. stripslashes(of_get_option('bg_pattern')) .' '. stripslashes(of_get_option('body_display')) .' scheme_'. stripslashes(of_get_option('color_scheme')) .''); ?>>
		<div id="main_wrap">
			<div class="wrapper" id="header">
				<div id="pre_header"></div>
				<div class="container">
					<div id="logo_wrap">
						<div id="the_logo">
							<?php if (of_get_option('logo') != '') { ?>
							<a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>" class="left the_logo">
								<img src="<?php echo stripslashes(of_get_option('logo')); ?>" alt="<?php bloginfo('name'); ?>" id="logo" />
							</a>
							<?php } else { ?>
								<h1><a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></h1>
							<?php } ?>					
						</div>
						<?php /* Social media area */
   					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('social_box') ) : ?><?php endif; ?>
						
						<?php get_search_form(); ?>
						<div class="clear"></div>
					</div>
					<div id="clear"></div>
				</div>
				<div id="main_menu">
					<div class="container">
						<div id="main_menu_wrap">
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'depth' => '9' ) ); ?>
						<?php if (of_get_option('donate_link') != '') { ?>
							<a id="donate_now" class="button" href="<?php echo stripslashes(of_get_option('donate_link')); ?>" title="Make A Donation" target="_blank"><?php echo stripslashes(of_get_option('donate_text')); ?></a>
						<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<div class="wrapper" id="content"> <!-- #content ends in footer.php -->
				<div class="container">		