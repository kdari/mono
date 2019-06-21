<!doctype html>
<html class="no-js" lang="{$site->language}">
<head>
	<meta charset="{$site->charset}">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{title}</title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="{$site->pingbackUrl}">

	{if $themeOptions->fonts->fancyFont->type == 'google'}
	<link href="http://fonts.googleapis.com/css?family={$themeOptions->fonts->fancyFont->font}" rel="stylesheet" type="text/css">
	{/if}

	<link id="ait-style" rel="stylesheet" type="text/css" media="all" href="{less $site->stylesheetUrl}">
	
	<script src="http://maps.google.com/maps/api/js?v=3.2&sensor=false"></script>
	{head}

</head>
<body class="{bodyClasses $bodyClasses, ait-hafscreen}" data-themeurl="{$themeUrl}">

{* shortcut variable *}
{var $layoutStyle = $themeOptions->general->layoutStyle}

<div class="mainpage" style="margin: {if $layoutStyle == 'wide'}0{else}30{/if}px auto;">

  <!-- HEADER -->

<header class="header{if $layoutStyle != 'wide'} defaultPageWidth{/if}">
	<div class="header-layout">
	  <div id="header-background-debug" style="display: none">{$debugIterator}</div>
    	<div id="header-background-using" style="display: none">{$headerHeightUse}</div>
    	<div id="header-background-height" style="display: none">{$imageSize}</div>
		<div class="background" id="main-header-background-bottom" style="display: none"></div>
    	<div class="background" id="main-header-background-top" style="display: none"></div>
		
    {block headerSettings}
      {if isset($themeOptions->header->displayPattern)}
        <div class="pattern{if $layoutStyle != 'wide'} defaultPageWidth{/if}" style="background:none">
      {else}
        <div class="pattern{if $layoutStyle != 'wide'} defaultPageWidth{/if}">
      {/if}
    {/block}
			<div class="top-strip-line"></div>
			<div class="header-container">
				<div class="header-content defaultContentWidth">
					<div id="topstrip-dropdown-duration" style="display: none;">{$themeOptions->globals->topStripDropdownTime}</div>
					<div id="topstrip-dropdown-easing" style="display: none;">{$themeOptions->globals->topStripDropdownAnimation}</div>
					<div class="top-strip">
						{block top-strips}
							{include snippet-custom-top-strips.php, strips => $site->create('top-strip',$themeOptions->globals->globalTopStrips)}
						{/block}
					</div>
					<div class="logo">
						{if !empty($themeOptions->general->logo_img)}
						<a href="{$homeUrl}"><img src="{$themeOptions->general->logo_img}" alt="logo" /></a>
						{else}
						<a href="{$homeUrl}"><span>{$themeOptions->general->logo_text}</span></a>
					{/if}
					</div>

					<div id="mainmenu-dropdown-duration" style="display: none;">{$themeOptions->globals->mainmenu_dropdown_time}</div>
					<div id="mainmenu-dropdown-easing" style="display: none;">{$themeOptions->globals->mainmenu_dropdown_animation}</div>
					{if $themeOptions->globals->displayDescription}
						{menu 'theme_location' => 'primary_menu', 'fallback_cb' => 'default_menu', 'container' => 'nav', 'container_class' => 'mainmenu', 'menu_class' => 'menu clear'}
					{else}
						{menu 'theme_location' => 'primary_menu', 'fallback_cb' => 'default_page_menu', 'container' => 'nav', 'container_class' => 'mainmenu', 'menu_class' => 'menu clear'}
					{/if}
				</div>
				<div class="line"></div>
			</div>

			<div class="slider-container">
        <div class="slider-content" id="slider-holder">
					{block slider}
						
					{/block}
					<div class="white-space"></div>
				</div>
			</div>
		</div>
    </div>
</header>


<div class="content {if $layoutStyle != 'wide'}defaultPageWidth{/if}">
	{define sectionA}
		{block service-boxes}
			{include snippet-custom-services-boxes.php, boxes => $site->create('service-box',$themeOptions->globals->globalServiceBoxes)}
		{/block}
	{/define}




	{define sectionB}
		{include #content}
	{/define}

	{define sectionC}
		{block staticText}
		  {if $themeOptions->globals->staticText}
			<div class="static-text onecolumn defaultContentWidth clear">
			 <div class="text-content entry-content">
			   {doShortcode $themeOptions->globals->staticText}
			 </div>
			</div>
			{/if}
		{/block}
	{/define}

	{if !isset($sectionsOrder)}
		{var $sectionsOrder = $themeOptions->globals->sectionsOrder}
	{/if}

	{foreach $sectionsOrder as $section}
		{if $section == 'serviceBoxes'}
			{include #sectionA}
		{elseif $section == 'content'}
			{include #sectionB}
		{elseif $section == 'staticText'}
			{include #sectionC}
		{/if}
	{/foreach}
</div>

<!-- FOOTER -->
<footer class="footer{if $layoutStyle != 'wide'} defaultPageWidth{/if}">
	<div class="footer-widgets clear">
		<style type="text/css" scoped="scoped">
		  .footer-widgets .col-1 { width: {!$themeOptions->globals->footerWidthFirst} }
		  .footer-widgets .col-2 { width: {!$themeOptions->globals->footerWidthSecond} }
		  .footer-widgets .col-3 { width: {!$themeOptions->globals->footerWidthThird} }
		  .footer-widgets .col-4 { width: {!$themeOptions->globals->footerWidthFourth} }
		  .footer-widgets .col-5 { width: {!$themeOptions->globals->footerWidthFifth} }
		  .footer-widgets .col-6 { width: {!$themeOptions->globals->footerWidthSixth} }
		</style>
    <div class="footer-widgets-container">
		{dynamicSidebar "footer-widgets-area"}
		</div>
	</div>
	<div class="footer-links clear">
		<div class="copyright">{!do_shortcode($themeOptions->general->footer_text)}</div>
		<div class="links">
			{menu 'theme_location' => 'footer-menu','fallback_cb' => 'default_footer_menu', 'container' => 'nav', 'container_class' => 'footer-menu', 'menu_class' => 'menu clear', 'depth' => 1 }
		</div>
	</div>
</footer><!-- end of footer -->

</div><!-- end of mainpage -->

{ifset $themeOptions->general->displayThemebox}
	{var $themeboxDir = AIT_FRAMEWORK_DIR . '/ThemeBox'}
	{include "$themeboxDir/ThemeBoxTemplate.php"}
{/ifset}

{footer}

{if $themeOptions->fonts->fancyFont->type == 'cufon' or $themeOptions->general->displayThemebox}
	{cufon
		fonts,
		fancyFont,
		"$themeUrl/design/js/libs/cufon.js",
		THEME_FONTS_URL . "/{$themeOptions->fonts->fancyFont->file}",
		$themeOptions->fonts->fancyFont->font,
		$themeOptions->general->displayThemebox
	}
{/if}

{if isset($themeOptions->general->ga_code) && ($themeOptions->general->ga_code!="")}
<script type="text/javascript">
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', {$themeOptions->general->ga_code}]);
	_gaq.push(['_trackPageview']);

	(function() {
	var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
</script>
{/if}

<script type="text/javascript" src="{$themeJsUrl}/libs/cluster.js"></script>
</body>
</html>
