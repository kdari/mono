{extends 'main-layout.php'}

{var $sectionsOrder = isset($post->options('sectionsOrder')->overrideGlobalOrder) ? $post->options('sectionsOrder')->order : null}

{block content}

<div class="central-widgets clear">
	{if $widgetsCol1}
	<!-- WIDGET COL1 -->
	<div class="widget-col1">
		{dynamicSidebar "homepage-widgets-col-1"}
	</div>
	{elseif (!$widgetsCol1) && $widgetsCol2}
	<div class="homepage-content entry-content left">
		{!$post->content}
	</div>
	{elseif (!$widgetsCol1) && (!$widgetsCol2)}
	<div class="onecolumn">
	<div class="homepage-content entry-content full">
		{!$post->content}
	</div>
	</div>
	{/if}
	
	{if $widgetsCol2}
	<!-- end of widget-col1 -->
	<!-- WIDGET COL2 -->
	<div class="widget-col2">
		{block sidebar}
		{include snippet-sidebar.php, widgets => $site->widgets('sidebar'), templateType => homepage, override => $post->options('page_sidebar')->overrideGlobalSidebars}
		{/block}
	</div>
	<!-- end of widget-col2 -->
	{/if}
</div>

{/block}

{? isset($post->options('page_slider')->overrideGlobalSlider) ? $localSlider = 'slider' : $localSlider = 'someRandomNotImportantStringHome'}
{define $localSlider}
	{include snippet-custom-home-slider.php, options => $post->options('page_slider'), slides => $site->create('slider-creator', $post->options('page_slider')->sliderType), sliderType => $post->options('page_slider')->sliderType, layoutStyle => $themeOptions->general->layoutStyle}
{/define}

{? isset($post->options('page_service_boxes')->overrideGlobalServiceBox) ? $localService = 'service-boxes' : $localService = 'someRandomNotImportantStringHome2'}
{define $localService}
	{include snippet-custom-services-boxes.php, options => $post->options('page_service_boxes'), boxes => $site->create('service-box',$post->options('page_service_boxes')->serviceBoxCategory)}
{/define}

{? isset($post->options('page_top_strips')->overrideGlobalTopStrip) ? $localStrip = 'top-strips' : $localStrip = 'someRandomNotImportantStringHome4'}
{define $localStrip}
	{include snippet-custom-top-strips.php, strips => $site->create('top-strip',$post->options('page_top_strips')->topStripCategory)}
{/define}

{? !empty($post->options('page_static_text')->staticText) ? $localStaticText = 'staticText' : $localStaticText = 'someRandomNotImportantStringHome5'}
{define $localStaticText}
      <div class="static-text onecolumn defaultContentWidth clear">
       <div class="text-content entry-content">
        {!=do_shortcode($post->options('page_static_text')->staticText)}
       </div>
      </div>
{/define}

{? isset($post->options('page_slider')->overrideGlobalSlider) ? $localHeaderSettings = 'headerSettings' : $localHeaderSettings = 'adasds'}
{define $localHeaderSettings}
	{if isset($post->options('page_slider')->displayPattern)}
		<div class="pattern{if $layoutStyle != 'wide'} defaultPageWidth{/if}" style="background:none">
	{else}
	  <div class="pattern{if $layoutStyle != 'wide'} defaultPageWidth{/if}">
	{/if}
{/define}