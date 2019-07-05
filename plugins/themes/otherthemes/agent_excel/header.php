<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<?php wp_head(); ?>
</head>
<body>
<div id="header">
    	<div class="container">
        	<div id="brand">
        		<h1 id="logo">
                	<a href="<?php echo get_option('home'); ?>/">
						<?php bloginfo('name'); ?><!--cindy smith-->
                    </a>
                </h1>
            	<p id="tagLine">
					<?php bloginfo('description'); ?><!--Phoenix Real Estate Agent-->
                </p>
            </div>
            <div id="brokerLogo">
            	<img src="<?php bloginfo('stylesheet_directory'); ?>/images/sample-broker-logo.jpg" alt="sample-broker-logo" />
            </div>
        </div>
    </div><!--/header-->

<div id="banner">
    	<div class="container">
        	<div class="widget">
				<?php include (TEMPLATEPATH . '/extra_widget.php'); ?>
            </div>
            <div class="wpHeader">
            	<img src="<?php bloginfo('stylesheet_directory'); ?>/images/wp-header.jpg" alt="" />
            </div>
        </div>
    </div><!--/banner-->

<div id="mainNav">
    	<div class="container">
            <ul>
            	<?php wp_list_pages('title_li='); ?>
            </ul>
        </div>
    </div><!--/mainNav-->