<!-- NEW SERVICE BOX LAYOUT :: START -->
{if $boxes}
  <div class="service-boxes clear">
    <div class="service-boxes-container">
      {foreach $boxes as $box}
        <div class="service-box shadow_service" id="sbox{$iterator->counter}">
          <div class="service-box-content" style="width: {$box->options->boxWidth}px">
            <h2><a href="{$box->options->boxLink}"><img src="{$box->thumbnailSrc}" class="sbox-icon" style="width: {$box->options->boxWidth}px; height: 109px;" alt="" />{$box->title}</a></h2>
            <p>{$box->options->boxText}</p>
          </div>
        </div>
      {/foreach}
    </div>
  </div>
{/if}
<!-- NEW SERVICE BOX LAYOUT :: END -->