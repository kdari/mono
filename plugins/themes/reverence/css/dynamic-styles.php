<?php //header("Content-type: text/css");
require_once( ABSPATH . 'wp-load.php');
$al_options = get_option('al_general_settings');
?>
<style type="text/css">
<?php if ( $al_options['al_custom_background'] != '' || $al_options['al_background_color'] != '' || $al_options['al_background_repeat'] != '') :?>
body{
	<?php 	if ($al_options['al_custom_background'] !='') :?>background-image:url('<?php echo $al_options['al_custom_background']?>') !important;<?php endif;?>
	<?php 
	echo $al_options['al_background_color'] != '' ? 'background-color:'.$al_options['al_background_color'].';' : '';  
	echo $al_options['al_background_repeat'] != '' ? 'background-repeat:'.$al_options['al_background_repeat'].';' : ''; 	
	?>
}
<?php endif?>
<?php if ($al_options['al_header_bg'] || $al_options['al_header_bg_color']):?>
.header-wrapper{
	<?php if (!(empty($al_options['al_header_bg']))):?> background-image:url('<?php echo $al_options['al_header_bg']?>'); <?php endif ?> 
	<?php if (!(empty($al_options['al_header_bg_repeat']))):?> background-repeat:<?php echo $al_options['al_header_bg_repeat'] ?>; <?php endif ?> 
		<?php if (!(empty($al_options['al_header_bg_color']))):?> background-color:<?php echo $al_options['al_header_bg_color'] ?>; <?php endif ?> 
}
<?php endif?>

<?php 	if ($al_options['al_custom_background'] !='') :?>
#content-wrapper .container_split, .container .container_split {background:url('<?php echo $al_options['al_custom_background']?>') !important;}
<?php endif?>
<?php if ($al_options['al_content_bg'] || $al_options['al_content_bg_static']):?>
#content-wrapper .container{
	<?php if (!(empty($al_options['al_content_bg']))):?> background-image:url('<?php echo $al_options['al_content_bg']?>'); <?php endif ?> 
	<?php if (!(empty($al_options['al_content_bg_static']))):?> background-color:<?php echo $al_options['al_content_bg_static']?>; <?php endif ?> 
	<?php if (!(empty($al_options['al_content_bg_repeat']))):?> background-repeat:<?php echo $al_options['al_content_bg_repeat']?>; <?php endif ?> 
	
}
<?php endif?>

<?php if($al_options['al_menu_color'] != ''):?>
.sf-menu > li.top > a {color:<?php echo $al_options['al_menu_color']?>}
<?php endif?>

<?php if($al_options['al_submenu_color'] != ''):?>
#menu ul ul a{color:<?php echo $al_options['al_submenu_color']?>}
<?php endif?>

<?php if($al_options['al_submenu_bg'] != ''):?>
.sf-menu .sub-menu li, .sf-menu .sub-menu a  {background-color:<?php echo $al_options['al_submenu_bg']?>}
<?php endif?>


<?php if($al_options['al_menu_hover_color'] != ''):?>
#menu ul .current a, .current-menu-item a, .current_page_item a, .current_page_parent a, .current-menu-parent a, #menu ul a:hover {color:<?php echo $al_options['al_menu_hover_color'] ?> !important;}
<?php endif?>
<?php if($al_options['al_dropdown_menu_bg'] != ''):?>
#menu ul ul {background:<?php echo $al_options['al_dropdown_menu_bg']?>;}
<?php endif?>

<?php if($al_options['al_main_color']):?>
#header-top, .ei-slider, .tabs a:active, .tabs a:hover, .tabs a.current, .tabs a.current:hover,.cn-slideshow,.flexslider{
	border-top-color: <?php echo $al_options['al_main_color']?>
}
#social-icons a, .ei-slider-thumbs li,#carousel,.cn-slideshow,.flexslider,#carousel{
	border-bottom-color: <?php echo $al_options['al_main_color']?>
}
.sub-menu a:hover, .button, input[type="submit"],input[type="reset"], .car-prev,.textholder a,.list.type6 li:hover,.list.type2 li{
	border-left-color: <?php echo $al_options['al_main_color']?>
}

::-moz-selection, ::selection, #pricing-table .column:hover .table-head, #pricing-table .column.featured .table-head, .highlight, mark{ 
	background: <?php echo $al_options['al_main_color']?>;
}

.olist.type3 ol > li:before, .cn-nav a:hover span,.slider_button.orange,.sf-menu .sub-menu a:hover,.slider_button.red:hover, input[type="submit"]:hover, 
input[type="reset"]:hover,.ei-slider-thumbs li a,.iview-caption.caption3, .step-box > span, #wp-calendar tbody td a { 
	background-color:<?php echo $al_options['al_main_color']?>;
}
.wpl-desc a, .tabs a, #wp-calendar tfoot a,.inner-divider span, .textSlider span,.more-link, #footer-menu a:hover, #twitter_update_list a,.list li a:hover, 
.main-categories2 a:hover,#menu ul .current > a, .current-menu-item > a, .current_page_item > a, .current_page_parent > a, .current-menu-parent > a, 
#breadcrumb li,.service-block h3 span,#options li a.current, #options li a:hover, .widget a,label.error,.sf-menu > li.top > a:hover, .sf-menu > li.top > a.active-item,
.post-block a,.post-comment a, .post-author a,.content-block a,.tabs a:active, .tabs a:hover, .tabs a.current, .tabs a.current:hover,.wp-pagenavi span.current,
.wp-pagenavi a:hover,.toggle > li a:hover, .toggle > li > a.active,.promo-text span,.blockquote p.author,#pricing-table h2 span,ol.commentlist li div.vcard cite.fn, 
cite.fn a.url,#similar-posts li p,.cn-nav-content-current span,.post-comment a, .post-author,ol.commentlist li cite.fn, cite.fn a.url,.widget_archive li:hover a,
div.toggle-trigger.active,.caption.very_big_orange,.caption.big_orange, caption span, .color, .commentlist a, #commentform a{
	color:<?php echo $al_options['al_main_color']?> !important
}
<?php endif?>


<?php if($al_options['al_text_color'] != ''):?>
p,#breadcrumb li a, body, h1 span, h2 span, h3 span, .list li, 
#search-global-form input[type="text"], #portfolio-filter li a, .inner-comments h4, h5, a.comment-date{color:<?php echo $al_options['al_text_color']?>}
<?php endif?>

<?php if($al_options['al_footer_color'] != ''):?>
.footer-block *{<?php echo 'color:'.$al_options['al_footer_color'] ?>!important;}
<?php endif?>
<?php if($al_options['al_footer_bg'] != '' || $al_options['al_footer_bg_color'] != ''):?>
#footer-wrapper{
	<?php if($al_options['al_footer_bg'] != ''):?>background-image:url('<?php echo $al_options['al_footer_bg']?>'); <?php endif?>
	background-repeat:<?php echo $al_options['footer_bg_repeat'] ?>;	
	<?php if($al_options['al_footer_bg_color'] != ''):?>background-color:<?php	echo  $al_options['al_footer_bg_color'] ?><?php endif?>;
}
<?php endif?>
<?php if($al_options['al_topmenu_font_size'] != ''):?>
.sf-menu > li.top > a{font-size: <?php echo $al_options['al_topmenu_font_size']?>}
<?php endif?>
<?php if($al_options['al_dropdownmenu_font_size'] != ''):?>
.sf-menu .sub-menu a{font-size: <?php echo $al_options['al_dropdownmenu_font_size']?>}
<?php endif?>
<?php if($al_options['al_body_font_size'] != ''):?>
body, p, ul#twitter_update_list li, .crumb_navigation ul a, .copyright, .widget ul li a{font-size: <?php echo $al_options['al_body_font_size']?>}
<?php endif?>
</style>