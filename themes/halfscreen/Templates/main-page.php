{extends 'main-layout.php'}

{var $sectionsOrder = isset($post->options('sectionsOrder')->overrideGlobalOrder) ? $post->options('sectionsOrder')->order : null}

{block content}
<!-- SUBPAGE -->
<div id="container" class="subpage defaultContentWidth subpage-line clear main-page">
	<!-- MAINBAR -->
	<div id="content" class="mainbar entry-content">
		<div id="content-wrapper">
			<h1>{$post->title}</h1>

			{if $post->thumbnailSrc != false }
			<div class="entry-thumbnail">
				<img src="{$timthumbUrl}?src={$post->thumbnailSrc}&w=640&h=200" alt="" />
			</div>
			{/if}

			{!$post->content}

			{*include snippet-comments.php*}

		</div><!-- end of content-wrapper -->
	</div><!-- end of mainbar -->

	<!-- SIDEBAR -->
	<div class="sidebar">
    {block sidebar}
  			{include snippet-sidebar.php, widgets => $site->widgets('subpage'), templateType => page, override => $post->options('page_sidebar')->overrideGlobalSidebars}
		{/block}
  		  


	</div><!-- end of sidebar -->

</div><!-- end of container -->
{/block}

{? isset($post->options('page_slider')->overrideGlobalSlider) ? $localSlider = 'slider' : $localSlider = 'someRandomNotImportantStringHome'}
{define $localSlider}
	{include snippet-custom-home-slider.php, options => $post->options('page_slider'), slides => $site->create('slider-creator', $post->options('page_slider')->sliderType), sliderType => $post->options('page_slider')->sliderType, layoutStyle => $themeOptions->general->layoutStyle}
{/define}

{? isset($post->options('page_service_boxes')->overrideGlobalServiceBox) ? $localService = 'service-boxes' : $localService = 'someRandomNotImportantStringHome2'}
{define $localService}
	{include snippet-custom-services-boxes.php, boxes => $site->create('service-box',$post->options('page_service_boxes')->serviceBoxCategory)}
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
