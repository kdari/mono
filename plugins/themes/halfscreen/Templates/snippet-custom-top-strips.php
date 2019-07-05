{if $strips}
<div class="strip-box" id="fras">
  <div class="strip-box-left"></div>
    <div class="strip-box-content">
      <ul>
        <!-- USER DEFINED STRIP ITEMS -->
      	{foreach $strips as $strip}
      	  {if $strip->options->stripItemCategory == 'custom'}	
      		<li id="{$strip->title}">
            <a href="#" class="main-link">
            {if $strip->thumbnailSrc}
              <img src="{$strip->thumbnailSrc}"/>
            {else}
              {$strip->title}
            {/if}
            </a>
            {ifset $strip->options->stripText}              
            <div class="content">
               <div class="content-inside" style="width: {$strip->options->stripItemContentWidth}px">{!do_shortcode($strip->options->stripText)}</div>  
            </div>
            {/ifset}
          </li>
      		{/if}
      	{/foreach}
      	<!-- END OF USER DEFINED STRIP ITEMS -->
      	
      	  <!-- WPML plugin required -->
            {if function_exists(icl_get_languages)}
              {if icl_get_languages('skip_missing=0')}
                <li id="Wpml" class="wpml">
              	  <a href="#"><img id="wpml-current-lang" src="{$themeUrl}/design/img/topstripbox-dropdown-flag.png" class="base"/></a>
                  <div class="content">
              	   <div class="content-inside">
                    <ul class="wpml-content">
                    	{foreach icl_get_languages('skip_missing=0') as $lang}
                        	<li id="{$lang['language_code']}"><a href="{$lang['url']}" class="{if $lang['active'] == 1}active{/if}"><img src="{$lang['country_flag_url']}" alt="{$lang['translated_name']}" />{$lang['translated_name']}</a>
                      {/foreach}
                    </ul>
                   </div>
                  </div>
                </li>
              {/if}
            {/if}
      	  <!-- WPML plugin required -->
              	
      	<li id="Social" class="social">
      	  <a href="#"><img src="{$themeUrl}/design/img/topstripbox-dropdown-social.png" class="base"/></a>
      	  <div class="content">
               <div class="content-inside">
                  <ul class="social-content">
                    {foreach $strips as $strip}
                  	  {if $strip->options->stripItemCategory == 'social'}	
                  		<li id="{$strip->title}">
                        <a href="{$strip->options->stripLink}" title="{$strip->title}">
                          {if $strip->thumbnailSrc}
                            <img src="{$strip->thumbnailSrc}" />
                          {/if}
                          {$strip->title}
                        </a>
                      </li>
                  		{/if}
                  	{/foreach}
                  </ul>
               </div>  
            </div>      	  
      	</li>
      </ul>
    </div>
  <div class="strip-box-right"></div>
</div>
{/if}