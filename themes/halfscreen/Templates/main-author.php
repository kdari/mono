{extends 'main-layout.php'}
{block content}

<!-- SUBPAGE -->
<div id="container" class="subpage defaultContentWidth subpage-line clear">
	<!-- MAINBAR -->
	<div id="content" class="mainbar entry-content">
		<div id="content-wrapper">

			{if $posts}

                <h1 class="page-title author">
                    {_}Author Archives:{/_}
                    <span class="vcard">
                        <a class="url fn n" href="{$author->postsUrl}" title="{$author->name}" rel="me">{$author->name}</a>
                    </span>
                </h1>


				{include 'general-content-nav.php' location => 'nav-above'}

				{if !empty($author->bio)}
				<div id="author-info">
					<div id="author-avatar">
						{$author->avatar(60)}
					</div><!-- #author-avatar -->
					<div id="author-description">
						{_}About{/_} {$author->name}
						{$author->bio}
					</div><!-- #author-description	-->
				</div><!-- #entry-author-info -->
				{/if}

				{include snippet-content-loop.php posts => $posts}

				{include 'general-content-nav.php' location => 'nav-below'}

			{else}

				<article id="post-0" class="post no-results not-found">

					<h1 class="entry-title">{_}Nothing Found{/_}</h1>

					<div class="entry-content">
						<p>{_}Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post{/_}</p>
						{include 'general-search-form.php'}
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			{/if}

		</div><!-- end of content-wrapper -->
	</div><!-- end of mainbar -->

	<!-- SIDEBAR -->
	<div class="sidebar">

		{block sidebar}
  		{include snippet-sidebar.php, widgets => $site->widgets('blog'), templateType => author, override => $post->options('page_sidebar')->overrideGlobalSidebars}
		{/block}

	</div><!-- end of sidebar -->

</div><!-- end of container -->
{/block}
