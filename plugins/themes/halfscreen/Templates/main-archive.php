{extends 'main-layout.php'}
{block content}

<!-- SUBPAGE -->
<div id="container" class="subpage defaultContentWidth subpage-line clear">
	<!-- MAINBAR -->
	<div id="content" class="mainbar entry-content">
		<div id="content-wrapper">

			{if $posts}

				<header class="page-header">
					<h1 class="page-title">
						{if $archive->isDay}
							Daily Archives: <span>{$posts[0]->date|date:$site->dateFormat}</span>
						{elseif $archive->isMonth}
							Monthly Archives: <span>{$posts[0]->date|date:'F Y'}</span>
						{elseif $archive->isYear}
							Yearly Archives: <span>{$posts[0]->date|date:'Y'}</span>
						{else}
							Blog Archives
						{/if}
					</h1>
				</header>

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
  		{include snippet-sidebar.php, widgets => $site->widgets('blog'), templateType => archive, override => $post->options('page_sidebar')->overrideGlobalSidebars}
		{/block}
	</div><!-- end of sidebar -->

</div><!-- end of container -->
{/block}
