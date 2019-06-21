{extends 'main-layout.php'}
{block content}

<!-- SUBPAGE -->
<div id="container" class="subpage defaultContentWidth subpage-line clear single.php">
	<!-- MAINBAR -->
	<div id="content" class="mainbar entry-content">
		<div id="content-wrapper">
			<h1>{$post->title}</h1>

		<div class="postitem">
		{if !isset($post->options('post_featured_images')->hideFeatured)}
			{if $post->thumbnailSrc}
			<div class="entry-thumbnail">
				<a href="{$post->thumbnailSrc}">
					<img src="{$timthumbUrl}?src={$post->thumbnailSrc}&w=433&h=198" alt="" />
				</a>
			</div>
			{/if}
		{/if}

      <div class="info-box">
      	  <div class="post-links">
            <a href="#" rel="prettySociable" class="share-link">share</a>
            {editPostLink $post->id}
          </div>
          <div class="info-box-inside">
            <h3 class="entry-date"><a href="{$site->url}{$post->date|date:"/Y/m/d"}">{$post->date|date:"j M"}</a></h3>
            <p class="post-aut">posted by <a class="url fn n" href="{$post->author->postsUrl}" title="View all posts by {$post->author->name}" rel="author">{$post->author->name}</a></p>
            {if $post->type == 'post'}
					    {if $post->categories}
            <p class="post-cat"><strong>Categories: </strong>{!$post->categories}</p>
              {/if}
              {if $post->tags}
            <p class="post-tag"><strong>Tags: </strong>{!$post->tags}</p>
              {/if}
            {/if}
            <p class="post-com"><strong>Comments: </strong>{$post->commentsCount}</p>
          </div>
        </div>
      </div>
			<div class="entry-content">
				{!$post->content}
			</div>

			{include 'snippet-post-nav.php' location=> nav-above}

			{include snippet-comments.php}

		</div><!-- end of content-wrapper -->
	</div><!-- end of mainbar -->

	<!-- SIDEBAR -->
	<div class="sidebar">
	{block sidebar}
  		{include snippet-sidebar.php, widgets => $site->widgets('post'), templateType => single, override => $post->options('page_sidebar')->overrideGlobalSidebars}
	{/block}
	</div><!-- end of sidebar -->

</div><!-- end of container -->
{/block}

{? isset($post->options('page_slider')->overrideGlobalSlider) ? $localSlider = 'slider' : $localSlider = 'someRandomNotImportantStringHome'}
{define $localSlider}
	{include snippet-custom-home-slider.php, options => $post->options('page_slider'), slides => $site->create('slider-creator', $post->options('page_slider')->sliderType), sliderType => $post->options('page_slider')->sliderType}
{/define}

{? isset($post->options('page_service_boxes')->overrideGlobalServiceBox) ? $localService = 'service-boxes' : $localService = 'someRandomNotImportantStringHome2'}
{define $localService}
	{include snippet-custom-services-boxes.php, boxes => $site->create('service-box',$post->options('page_service_boxes')->serviceBoxCategory)}
{/define}

{? isset($post->options('page_top_strips')->overrideGlobalTopStrip) ? $localStrip = 'top-strips' : $localStrip = 'someRandomNotImportantStringHome4'}
{define $localStrip}
	{include snippet-custom-top-strips.php, boxes => $site->create('top-strip',$post->options('page_top_strips')->topStripCategory)}
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
