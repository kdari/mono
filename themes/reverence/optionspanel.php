<script type="text/javascript" src="<?php echo get_template_directory_uri()?>/js/colorchanger/farbtastic.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri()?>/js/jquery.cookie.js"></script>
<link rel="stylesheet" href="<?php echo get_template_directory_uri()?>/js/colorchanger/farbtastic.css" type="text/css" />
<script type="text/javascript">
<!--
jQuery(document).ready(function(){	
						
	jQuery('#options-handler').toggle(function() {
		jQuery(this).animate({"marginLeft": "+=216px"}, "slow").addClass('active');
		jQuery('#switch-panel').animate({"marginLeft": "+=216px"}, "slow"); 
	}, 

	function() {
		jQuery('#switch-panel').animate({"marginLeft": "-=216px"}, "slow");
		jQuery(this).animate({"marginLeft": "-=216px"}, "slow").removeClass('active'); 
	});
});
/********** THEME SWITCHER ***********/

function setColor (color)
{
	jQuery ('#header-top, .ei-slider,.tabs a.current, .cn-slideshow,.flexslider').css('border-top-color', color);
	jQuery ('.button, input[type="submit"],input[type="reset"], .car-prev,.textholder a,.list.type2 li').css('border-left-color', color);
	jQuery ('.ei-slider-thumbs li a,.iview-caption.caption3, .step-box > span, #wp-calendar tbody td a').css('background-color', color);
	jQuery('#options li a.selected, .wpl-desc a, .tabs a, #wp-calendar tfoot a,.inner-divider span, .textSlider span,.more-link, #twitter_update_list a,#menu ul .current > a, .current-menu-item > a, .current_page_item > a, .current_page_parent > a, .current-menu-parent > a, #breadcrumb li,.service-block h3 span,#options li a.current, .widget a,label.error,.sf-menu > li.top > a.active-item,.post-block a,.post-comment a, .post-author a,.content-block a,.tabs a:active,.tabs a.current,.wp-pagenavi span.current,.toggle > li a:hover, .toggle > li > a.active,.promo-text span,.blockquote p.author,#pricing-table h2 span,ol.commentlist li div.vcard cite.fn, cite.fn a.url,#similar-posts li p,.cn-nav-content-current span,.post-comment a, .post-author,ol.commentlist li cite.fn, cite.fn a.url,.widget_archive li:hover a,div.toggle-trigger.active,.caption.very_big_orange,.caption.big_orange, caption span, .color, .commentlist a, #commentform a').css('color', color);	
	jQuery('#pricing-table .column.featured .table-head, .highlight, mark').css('background', color);
	jQuery('#pricing-table .column.featured h2 span').css ('color', '#111');
}

jQuery(document).ready(function(){

	/* cookie vars */
	var cookie_name = "Reverence_skin";
	var cookie_options = { path: '/', expires: 1 };
	
	var get_cookie = jQuery.cookie('Reverence_skin');
	
	if (get_cookie == null)
	{
		get_cookie = '#5FBF41';
	}
	setColor (get_cookie);
	
	
	jQuery('#picker').farbtastic(function() {
		setColor ( jQuery.farbtastic('#picker').color);
	});
	
	jQuery('#reset-switcher').bind('click', function(){
		setColor ('#5FBF41');
		jQuery.cookie('Reverence_skin',  '#5FBF41', cookie_options); 
		get_cookie = '#5FBF41';
		return false;
	});
	
	jQuery('.sf-menu .sub-menu a, input[type="submit"], input[type="reset"]').hover( function() {
		if (jQuery.farbtastic('#picker').color == null)  jQuery.farbtastic('#picker').color = '#5FBF41';
		jQuery(this).css('background-color', jQuery.farbtastic('#picker').color);	
	},
	function () {
		jQuery(this).css('background-color', 'rgba(0,0,0,0)');
	});
	
	jQuery('.sf-menu > li.top > a').hover( function() {
		$color = jQuery(this).css('color');
		jQuery(this).css('color', jQuery.farbtastic('#picker').color);
	}, function() {
		jQuery(this).css('color', '#111');
	});
	
	jQuery('.tabs a, #options li a, #footer-menu a').hover( function() {
		$color = jQuery(this).css('color');
		jQuery(this).css('color', jQuery.farbtastic('#picker').color);
	}, function() {
		jQuery(this).css('color', $color);
	});
	
	jQuery('.tabs a, .tabs a.current').hover( function() {
		$color = jQuery(this).css('color');
		jQuery(this).css('border-top-color', jQuery.farbtastic('#picker').color);
	}, function() {
		jQuery(this).css('border-top-color', $color);
	});
	
	jQuery('#pricing-table .column').not('.featured').hover( function() {
		if (jQuery.farbtastic('#picker').color == null)  jQuery.farbtastic('#picker').color = '#5FBF41';
		jQuery(this).find('h2 span').css ('color', '#111');
		jQuery(this).find('.table-head').css('background-color', jQuery.farbtastic('#picker').color);
	}, function() {
		if (jQuery.farbtastic('#picker').color == null)  jQuery.farbtastic('#picker').color = '#5FBF41';
		jQuery(this).find('h2 span').css('color', jQuery.farbtastic('#picker').color);
		jQuery(this).find('.table-head').css('background-color', '#333');		
	});
	
});
-->
</script>

<div id="options-handler"></div>
<div id="switch-panel">

    <h4>Choose skin <span>color</span></h4>
    <div id="picker"></div>
	<p class="top10"><a href="#" id="reset-switcher" class="button">Reset to default</a></p>
</div>