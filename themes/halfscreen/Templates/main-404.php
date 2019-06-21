{extends 'main-layout.php'}
{block content}

<!-- SUBPAGE -->
<div id="container" class="subpage-line clear">
	<!-- MAINBAR -->
	<div id="content" class="mainbar entry-content defaultContentWidth" style="margin-bottom: 20px;">
		<div id="content-wrapper">
			<h1>{_}This is somewhat embarrassing, isn't it?{/_}</h1>

			<p>{_}It seems we can't find what you are looking for. Use the search bar to find the content.{/_}</p>

			{include general-search-form.php}

		</div><!-- end of content-wrapper -->
	</div><!-- end of mainbar -->

</div><!-- end of container -->
{/block}