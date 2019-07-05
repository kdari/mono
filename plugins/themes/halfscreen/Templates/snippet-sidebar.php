{if isset($override)}
  {var $wrapper => $post->options('page_sidebar')->wrapSidebars}
{else}
  {if $templateType == homepage}
    {var $wrapper => $themeOptions->globals->wrapHomepageSidebars}  
  {elseif $templateType == single}
    {var $wrapper => $themeOptions->globals->wrapPostsSidebars}
  {elseif $templateType == page || $templateType == search || $site->is404}
    {var $wrapper => $themeOptions->globals->wrapSubpageSidebars}
  {elseif $templateType == index || $templateType == archive || $templateType == author || $templateType == category || $templateType == tag}
    {var $wrapper => $themeOptions->globals->wrapBlogSidebars}
  {/if}
{/if}

{if $widgets}
  {if isset($wrapper)}
    {foreach $widgets as $widget}
    	{if is_active_sidebar($widget)}
    	<div class="tabs-container">
    		<div class="tabs-panels">
    		  {dynamicSidebar $widget}
    		</div> <!-- /.tabs-panels -->
    	</div> <!-- /.tabs-container -->
    
    	{/if}
    {/foreach}
    
    {include general-search-form.php}
  {else}
    {if $templateType == homepage}
      {dynamicSidebar "sidebar-widgets-col-2"}
    {elseif $templateType == single}
      {dynamicSidebar "post-widgets-area"}
    {elseif $templateType == page || $templateType == search || $site->is404}      
      {dynamicSidebar "subpage-widgets"}
    {elseif $templateType == index || $templateType == archive || $templateType == author || $templateType == category || $templateType == tag}
      {dynamicSidebar "blog-widgets-area"}
    {/if}
  {/if}
{/if}