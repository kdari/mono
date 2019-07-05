				<section>
				{foreach $posts as $post}
				{if $post->thumbnailSrc}
				  <article id="post-{$post->id}" class="{$post->htmlClasses}">
				{else}
				  <article id="post-{$post->id}" class="{$post->htmlClasses} no-thumbnail">
				{/if}
					<header class="entry-header">

						{if $post->thumbnailSrc}
						<h2 class="entry-title"><a href="{$post->permalink}" title="Permalink to {$post->title}" rel="bookmark">{$post->title}</a></h2>
            	<div class="entry-thumbnail">

								<div class="entry-thumb-img">
									<a href="{$post->permalink}"><img src="{$timthumbUrl}?src={$post->thumbnailSrc}&w=433&h=198" alt=""/></a>
								</div>
							</div>


						{else}

							<div class="title-no-thumbnail">
								<h2 class="entry-title no-thumbnail"><a href="{$post->permalink}" title="Permalink to {$post->title}" rel="bookmark">{$post->title}</a></h2>
  						</div>
						{/if}


            <div class="info-box">
              <div class="post-links">
                <a href="#" rel="prettySociable" class="share-link">share</a>
                {editPostLink $post->id}
              </div>
              <div class="info-box-inside">
                <h3 class="entry-date"><a href="{$site->url}{$post->date|date:"/Y/m/d"}" class="entry-date" >{$post->date|date:"j M"}</a></h3>
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

					</header><!-- .entry-header -->

					{if $site->isSearch}
					<div class="entry-summary">
						{$post->excerpt}
					</div><!-- .entry-summary -->
					{else}
					<div class="entry-content no-thumbnail">
						{!$post->content}
						{postContentPager}
					</div><!-- .entry-content -->
					{/if}
              <!-- /.entry-meta -->
				</article><!-- /#post-{$post->id} -->
				{/foreach}
				</section>