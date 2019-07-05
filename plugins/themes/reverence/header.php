<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"  <?php language_attributes( ) ?>> <!--<![endif]-->
<head>

    <meta charset="utf-8">
	<!--[if lt IE 9]>   <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() ?>/css/ie.css" /> <![endif]-->
    <meta name="description" content="">
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
    <title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
    
	<link rel="alternate" type="application/rss+xml" title="RSS2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	
    <link rel="stylesheet" type="text/css"  media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
    
	<link href='http://fonts.googleapis.com/css?family=News+Cycle|PT+Sans:400,400italic,700,700italic' rel='stylesheet' type='text/css' />
	<style type="text/css">@import url("http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz");</style>
	<?php  $al_options = get_option('al_general_settings'); ?>
	
   	<?php if(!empty($al_options['al_favicon'])):?>
	<link rel="shortcut icon" href="<?php echo $al_options['al_favicon'] ?>" /> 
 	<?php endif?>
   
   <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
   <!--[if lt IE 9]><script src="<?php echo get_template_directory_uri() ?>/js/html5.js"></script><![endif]-->

	<?php include (TEMPLATEPATH . '/css/dynamic-styles.php'); ?>
    <?php 
   		$bodyFont = isset($al_options['al_body_font']) ? $al_options['al_body_font'] : 'off';
		$headingsFont =(isset($al_options['al_headings_font']) && $al_options['al_headings_font'] !== 'off') ? $al_options['al_headings_font'] : 'off';
		$menuFont = (isset($al_options['al_menu_font']) && $al_options['al_menu_font'] !== 'off') ? $al_options['al_menu_font'] : 'off';
	
		$fonts['body, p, a, ol, li, label, .contact-details span, .contact-details p, .post-date, #copyright'] = $bodyFont;
		$fonts['h1, h2, h3, h4'] = $headingsFont;
		$fonts['.sf-menu > li.top > a'] = $menuFont;
		
		foreach ($fonts as $value => $key)
		{
			if($key != 'off' && $key != ''){ 
				$api_font = str_replace(" ", '+', $key);
				$font_name = font_name($key);
				
				echo '<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family='.$api_font.'" />';
				echo "<style type=\"text/css\">".$value."{ font-family: '".$key."' !important; }</style>";			
			}
		}
	?>
	<?php wp_head(); ?>
</head>

<body  <?php body_class(); ?>>

<?php include ('optionspanel.php') ?>

<!-- BEGIN Top bar -->
<?php if (isset ($al_options['al_header_social']) && $al_options['al_header_social'] !=''):?>
	<div class="topbar-wrapper">
		<div class="container">
			<div id="topbar">       
				<div id="social">
					<?php echo do_shortcode ($al_options['al_header_social']) ?>
				</div>
				<div class="clear"></div>
			 </div>
		</div>
	</div>
<?php endif?>   
<!-- END TOP bar -->

<!-- BEGIN Header -->
<div class="header-wrapper"> 
	<header class="container">        
		<!--Logo-->
		<div id="logo" class="four columns">
			
			<a href="<?php echo home_url() ?>">
				<?php if(!empty($al_options['al_logo'])):?>
					<img src="<?php echo $al_options['al_logo'] ?>" alt="<?php echo $al_options['al_logotext']?>" id="logo-image" />
				<?php else:?>
					<?php echo isset($al_options['al_logotext']) ? $al_options['al_logotext'] : 'Reverence' ?>
				<?php endif?>
			</a>
			
		</div>
		<nav class="twelve columns last">       
			<?php 
				if(function_exists('wp_nav_menu')):
					wp_nav_menu( 
					array( 
						'menu' =>'primary_nav', 
						'container'=>'', 
						'depth' => 4, 
						'menu_class' => 'sf-menu'
						)  
					); 
				else:
					?><ul class="sf-menu top-level-menu"><?php wp_list_pages('title_li=&depth=4'); ?></ul><?php
				endif; 
			?>
		 </nav>
		 <div class="clear"></div>
	</header>
</div>