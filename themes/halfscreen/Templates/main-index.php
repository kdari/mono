{extends 'main-layout.php'}

{if !$isIndexPage}
	{var $sectionsOrder = isset($post->options('sectionsOrder')->overrideGlobalOrder) ? $post->options('sectionsOrder')->order : null}
{/if}

{block content}
<!-- SUBPAGE -->
<div id="container" class="subpage defaultContentWidth subpage-line clear">
	<!-- MAINBAR -->
	<div id="content" class="mainbar entry-content">
		<div id="content-wrapper">
			{if !$isIndexPage}
			<h1>{$post->title}</h1>
			{!$post->content}
			{/if}

			{if $posts}

				{include general-content-nav.php location => 'nav-above'}

				{include snippet-content-loop.php posts => $posts}

				{include general-content-nav.php location => 'nav-below'}

			{else}

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h2 class="entry-title">Nothing Found</h2>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p>Sorry, but nothing matched your search criteria. Please try again with some different keywords.</p>
						{include 'general-search-form.php'}
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			{/if}

		</div><!-- end of content-wrapper -->
	</div><!-- end of mainbar -->

	<!-- SIDEBAR -->
	<div class="sidebar">
    {block sidebar}
  		{include snippet-sidebar.php, widgets => $site->widgets('blog'), templateType => index}
		{/block}
	</div><!-- end of sidebar -->

</div><!-- end of container -->
{/block}

{if !$isIndexPage}
{? isset($post->options('page_slider')->overrideGlobalSlider) ? $localSlider = 'slider' : $localSlider = 'someRandomNotImportantStringHome'}
{define $localSlider}
	{include snippet-custom-home-slider.php, options => $post->options('page_slider'), slides => $site->create('slider-creator', $post->options('page_slider')->sliderType), sliderType => $post->options('page_slider')->sliderType}
{/define}

{? isset($post->options('page_service_boxes')->overrideGlobalServiceBox) ? $localService = 'service-boxes' : $localService = 'someRandomNotImportantStringHome2'}
{define $localService}
	{include snippet-custom-services-boxes.php, options=>$post->options('page_service_boxes'), boxes => $site->create('service-box',$post->options('page_service_boxes')->serviceBoxCategory)}
{/define}

{? isset($post->options('page_top_strips')->overrideGlobalTopStrip) ? $localStrip = 'top-strips' : $localStrip = 'someRandomNotImportantStringHome4'}
{define $localStrip}
	{include snippet-custom-top-strips.php, boxes => $site->create('top-strip',$post->options('page_top_strips')->topStripCategory)}
{/define}
{/if}