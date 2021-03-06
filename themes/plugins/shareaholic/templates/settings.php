<?php ShareaholicAdmin::show_header(); ?>

<script>
window.ShareaholicConfig = {
  apiHost: "<?php echo Shareaholic::API_URL ?>",
  serviceHost: "<?php echo Shareaholic::URL ?>",
  assetHost: "<?php echo ShareaholicUtilities::asset_url_admin() ?>",
  assetFolders: true,
  origin: "wp_plugin",
  language: "<?php echo strtolower(get_bloginfo('language')) ?>"
};
</script>

<div class='wrap'>
<h2><?php echo sprintf(__('App Manager - Legacy', 'shareaholic')); ?></h2>

<div class='reveal-modal' id='editing_modal'>
  <div id='iframe_container' class='bg-loading-img' allowtransparency='true'></div>
  <a class="close-reveal-modal">&#215;</a>
</div>

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-8">
      <form name="settings" method="post" action="<?php echo $action; ?>">
      <?php wp_nonce_field($action, 'nonce_field') ?>
      <input type="hidden" name="already_submitted" value="Y">

      <div id='app_settings'>

      <div class="app">
        <h2><?php echo sprintf(__('Getting Started')); ?></h2>
        <p><?php echo sprintf(__('%sLearn the basics of how to get started and configure Shareaholic through our popular WordPress plugin.%s', 'shareaholic'), '<a href="https://support.shareaholic.com/hc/en-us/categories/200101476-WordPress-Plugin" target="_blank">','</a>'); ?> <?php echo sprintf(__('If you are upgrading from an earlier version of Shareaholic for WordPress and need help, have a question or have a bug to report, please %slet us know%s.', 'shareaholic'), '<a href="https://www.shareaholic.com/help/message" target="_blank">','</a>'); ?>
        </p>
      </div>
  
      <div class="app">
        <p><a href="<?php echo esc_url(admin_url("admin.php?shareaholic_redirect_url=shareaholic.com/signup/")); ?>" target="_blank" class="btn btn-warning btn-block" role="button" style="font-size: 14px;"><?php echo sprintf(__('Open Shareaholic Cloud Dashboard', 'shareaholic')); ?></a>
        </p>
        <p>
          <?php echo sprintf(__('Configure Apps such as Floating Share buttons, Social Share Count Recovery, Follow buttons, Share Buttons for Images, Monetization Dashboard, EU Cookie Consent bar, and more from the dashboard.', 'shareaholic')); ?>
        </p>
      </div>

      <div class="app">
        <h2><i class="icon icon-share_buttons"></i> <?php echo sprintf(__('In-Page Share Buttons', 'shareaholic')); ?></h2>
        <p>
          <?php echo sprintf(__('Pick where you want your in-page share buttons to be displayed. Click "customize" to customize look & feel, themes, share counters, alignment, and more.', 'shareaholic')); ?>
        </p>
    
        <?php foreach(array('post', 'page', 'index', 'category') as $page_type) { ?>
        <fieldset id='sharebuttons'>
          <legend><?php echo ucfirst($page_type) ?></legend>
          <?php foreach(array('above', 'below') as $position) { ?>
            <?php if (isset($settings['location_name_ids']['share_buttons']["{$page_type}_{$position}_content"])) { ?>
              <?php $location_id = $settings['location_name_ids']['share_buttons']["{$page_type}_{$position}_content"] ?>
            <?php } else { $location_id = ''; } ?>
              <div class="location">
                <input type="checkbox" id="share_buttons_<?php echo "{$page_type}_{$position}_content" ?>" name="share_buttons[<?php echo "{$page_type}_{$position}_content" ?>]" class="check"
                <?php if (isset($share_buttons["{$page_type}_{$position}_content"])) { ?>
                  <?php echo ($share_buttons["{$page_type}_{$position}_content"] == 'on' ? 'checked' : '') ?>
                <?php } ?>>
                <label for="share_buttons_<?php echo "{$page_type}_{$position}_content" ?>"><?php echo ucfirst($position) ?> Content</label>
                <button data-app='share_buttons'
                        data-location_id='<?php echo intval($location_id); ?>'
                        data-href='share_buttons/locations/{{id}}/edit'
                        class="location_item_cta btn btn-sm btn-success float-right">
                <?php _e('Customize', 'shareaholic'); ?></button>
              </div>
          <?php } ?>
        </fieldset>
        <?php } ?>
        
        <div class='fieldset-footer'>
          <p>
            <input type="checkbox" id="share_buttons_excerpts" name="shareaholic[share_buttons_display_on_excerpts]" class="check"  
            <?php if (isset($settings["share_buttons_display_on_excerpts"])) { ?>
              <?php echo ($settings["share_buttons_display_on_excerpts"] == 'on' ? 'checked' : '') ?>
            <?php } ?>>
            <label for="share_buttons_excerpts">Display on excerpts</label>
          </p>
        </div>
        
        <div class='fieldset-footer'>
          <p>
            <?php echo sprintf(__('Brand your shares with your @Twitterhandle, pick your favorite URL shortener, share buttons for images, etc.')); ?>
          </p>
          <p>
            <button class='app_wide_settings btn btn-success wide-button' data-href='share_buttons/edit'><?php _e('Edit Settings', 'shareaholic'); ?></button>
          </p>
        </div>
      </div>
  
      <div class="app">
        <h2><i class="icon icon-recommendations"></i> <?php echo sprintf(__('Related Content', 'shareaholic')); ?></h2>
        <p>
          <?php echo sprintf(__('Pick where you want the app to be displayed. Click "Customize" to customize look & feel, themes, block lists, etc.', 'shareaholic')); ?>
        </p>
        <?php foreach(array('post', 'page', 'index', 'category') as $page_type) { ?>
          <?php foreach(array('below') as $position) { ?>
            <?php if (isset($settings['location_name_ids']['recommendations']["{$page_type}_{$position}_content"])) { ?>
              <?php $location_id = $settings['location_name_ids']['recommendations']["{$page_type}_{$position}_content"] ?>
            <?php } else { $location_id = ''; } ?>
            <fieldset id='recommendations'>
              <legend><?php echo ucfirst($page_type) ?></legend>
                <div class="location">
                  <input type="checkbox" id="recommendations_<?php echo "{$page_type}_below_content" ?>" name="recommendations[<?php echo "{$page_type}_below_content" ?>]" class="check"
                  <?php if (isset($recommendations["{$page_type}_below_content"])) { ?>
                    <?php echo ($recommendations["{$page_type}_below_content"] == 'on' ? 'checked' : '') ?>
                  <?php } ?>>
                  <label for="recommendations_<?php echo "{$page_type}_below_content" ?>"><?php echo ucfirst($position) ?> Content</label>
                  <button data-app='recommendations'
                          data-location_id='<?php echo intval($location_id); ?>'
                          data-href="recommendations/locations/{{id}}/edit"
                          class="location_item_cta btn btn-sm btn-success">
                  <?php _e('Customize', 'shareaholic'); ?></button>
                </div>
              <?php } ?>
          </fieldset>
        <?php } ?>
        
        <div class='fieldset-footer'>
          <p>
            <input type="checkbox" id="recommendations_excerpts" name="shareaholic[recommendations_display_on_excerpts]" class="check"  
            <?php if (isset($settings["recommendations_display_on_excerpts"])) { ?>
              <?php echo ($settings["recommendations_display_on_excerpts"] == 'on' ? 'checked' : '') ?>
            <?php } ?>>
            <label for="recommendations_excerpts">Display on excerpts</label>
          </p>
        </div>

        <div class='fieldset-footer'>
          <p>
            <?php echo sprintf(__('Rebuild your Content Index, exclude pages from being recommended, tweak algorithms, and more.', 'shareaholic')); ?>
          </p>
          <p>
            <button class='app_wide_settings btn btn-success wide-button' data-href='recommendations/edit'><?php _e('Edit Settings', 'shareaholic'); ?></button>
          </p>
        </div>
        <div class='fieldset-footer'>
          <p>
            <?php echo sprintf(__('Note: Shareaholic offloads Related Posts processing to the cloud, so there is no additional load on your server or database, giving you the fastest and most efficient Related Posts solution on the market. The %scloud API%s starts working as soon as your site is live. Until the cloud-based system starts, we use a basic placeholder API powered by the plugin. This API is temporary and does not respect advanced settings such as content exclusion rules.', 'shareaholic'), '<a href="https://shrlc.com/1IzOGiI" target="_blank">','</a>'); ?>
          </p>
        </div>
      </div>
          
      <div class="app">
        <h2>
          <i class="icon icon-affiliate"></i> <?php echo sprintf(__('Monetization Settings', 'shareaholic')); ?>
        </h2>
        <p>
          <?php echo sprintf(__('Configure Promoted Content, Affiliate Links, Banner Ads, etc. Check your earnings at any time.', 'shareaholic')); ?>
        </p>
        <p>
          <button class='app_wide_settings btn btn-success wide-button' data-href='monetizations/edit'><?php _e('Edit Settings', 'shareaholic'); ?></button>
        </p>
      </div>
      </div>
  
      <div class="app">
        <input type='submit' class="btn btn-primary btn-lg btn-block" onclick="this.value='<?php echo sprintf(__('Saving Changes...', 'shareaholic')); ?>';" value='<?php echo sprintf(__('Save Changes', 'shareaholic')); ?>'>
      </div>
      </form>
    </div>
    <?php ShareaholicUtilities::load_template('why_to_sign_up', array('url' => Shareaholic::URL)) ?>
    </div>
  </div>
</div>
<?php ShareaholicAdmin::show_footer(); ?>
<?php ShareaholicAdmin::include_chat(); ?>

<script src="https://dsms0mj1bbhn4.cloudfront.net/assets/pub/loader-reachable.js" async></script>