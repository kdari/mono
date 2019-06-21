{if $options->headerType == 'slider'}

<div class="slider{if $layoutStyle != 'wide'} defaultPageWidth{/if}">
<div id="slider-container">

	<div id="slider-delay" style="display:none">8000</div>
    <div id="slider-animTime" style="display:none">2000</div>
    <div id="slider-height" style="display:none">{$imageSize}</div>

    <div id="preload-background-slider-images">
    	{foreach $slides as $slide}
    	{if $slide->options->slideType == 'normal'}
    		{if $slide->options->backgroundImage}
    		  <img src="{$slide->options->backgroundImage}" alt="Background Image" style="background: {!$slide->options->slideBackgroundColor}"/>
    		{else}
    		  <img src="#" alt="Background Image" />
    		{/if}
       {/if}
    	{/foreach}
    </div>

	<ul id="slider" class="slide clear">
		{foreach $slides as $slide}
		{if $slide->options->slideType == 'normal'}
		<li>
			<a href="{$slide->options->link}">
			{ifset $slide->options->topImage}
			{if $slide->options->topImage != ""}
			  {if $slide->options->descriptionPosition == 'left'}
		        <img class="slider-container-img-right" src="{$slide->options->topImage}" alt="{$slide->options->description}" />
		
		        {elseif $slide->options->descriptionPosition == 'right'}
		        <img class="slider-container-img-left" src="{$slide->options->topImage}" alt="{$slide->options->description}" />
		
		        {else}
		        <img class="slider-container-img-left" src="{$slide->options->topImage}" alt="{$slide->options->description}" />
		        {/if}
		    {/if}
			{/ifset}
			</a>
			{ifset $slide->options->backgroundImage}
			<div class="background-image" style="display:none;"><img src="{$slide->options->backgroundImage}" alt=""></div>
			{/ifset}
			
			{ifset $slide->options->slideBackgroundColor}
			<div class="background-color" style="display:none;">{$slide->options->slideBackgroundColor}</div>
			{/ifset}
      {ifset $slide->options->slideRepeating}
			<div class="background-repeat" style="display:none;">{$slide->options->slideRepeating}</div>
			{/ifset}
			{ifset $slide->options->slideBackgroundPosX}
			<div class="background-posX" style="display:none;">{$slide->options->slideBackgroundPosX}</div>
			{/ifset}
			{ifset $slide->options->slideBackgroundPosY}
			<div class="background-posY" style="display:none;">{$slide->options->slideBackgroundPosY}</div>
			{/ifset}


			{if $slide->options->descriptionPosition != 'hide'}
			<div class="caption-{$slide->options->descriptionPosition}">
               	{!$slide->options->description}
      </div>
      {/if}

		</li>
		{/if}
		{/foreach}
	</ul>
	
	<style type="text/css" scoped="scoped">
		.slider-content   { padding-top: {$options->topPadding}px !important; padding-bottom: {$options->bottomPadding}px !important; }
		.white-space      { height: {$options->whitespaceHeight}px !important; }
		.anythingControls { bottom: {$options->controllersBottomPosition}px !important; }
	</style>
</div><!-- end of slider -->
</div>

{elseif $options->headerType == '3dslider'}
<div class="slider{if $layoutStyle != 'wide'} defaultPageWidth{/if}">
<div class="3d-slider-container">
  <div id="piecemakerCat" style="display: none">{$options->sliderType}</div>
  <div id="piecemaker">
    <div class="defaultContentWidth" style="margin-top: 45px;">
      {var $mycounter = 0}
      {foreach $slides as $slide}
        {if $slide->options->slideType == 'advanced'}
          {if $mycounter == 0}
          <center>
          <img src="{$slide->options->advancedImageSource}" title="{$slide->options->advancedImageTitle}"/>
          </center>
          {var $mycounter = 1}
          {/if}
        {/if}
      {/foreach}
    </div>
  </div>
</div>
</div>
    <script type="text/javascript">
      var flashvars = {};
      flashvars.cssSource = "{!$themeUrl}/design/css/piecemaker/piecemaker.css";

      flashvars.xmlSource = '{!$themeUrl}/piecemaker-xml.php?t={!$sliderType}';

      var params = {};
      params.play = "true";
      params.menu = "true";
      params.scale = "showall";
      params.wmode = "transparent";
      params.allowfullscreen = "true";
      params.allowscriptaccess = "always";
      params.allownetworking = "all";

      swfobject.embedSWF('{!$themeUrl}/design/swf/piecemaker.swf', 'piecemaker', '100%', '500', '10', null, flashvars,
      params, null);

      $j('.slider-content').css({"height":"480px"});
    </script>
{elseif $options->headerType == 'none'}
  
{/if}