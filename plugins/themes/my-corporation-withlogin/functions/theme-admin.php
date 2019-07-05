<?php
function my_corporation_theme_settings_init(){
	register_setting( 'my_corporation_theme_settings', 'my_corporation_theme_settings' );
}
function my_corporation_scripts() {
	
wp_enqueue_script("theme-admin", get_bloginfo('stylesheet_directory')."/functions/functions.js", false, "1.0");
wp_enqueue_script('media-upload');
wp_enqueue_script('thickbox');
wp_enqueue_script('bbq', get_bloginfo('stylesheet_directory') . '/functions/jquery.ba-bbq.min.js');
}

function my_corporation_style() {
wp_enqueue_style("theme-admin", get_bloginfo('stylesheet_directory')."/functions/functions.css", false, "1.0", "all");
wp_enqueue_style('thickbox');
}

function my_corporation_echo_scripts()
{
?>

<?php
}
if (isset($_GET['page']) && $_GET['page'] == 'my_corporation-settings')
{
add_action('admin_print_scripts', 'my_corporation_scripts'); 
add_action('admin_print_styles', 'my_corporation_style');
}
add_action('admin_head', 'my_corporation_echo_scripts');

//menu
function my_corporation_add_settings_page() {
add_menu_page( __( 'My Corporation Settings' ), __( 'My Corporation Settings' ), 'manage_options', 'my_corporation-settings', 'my_corporation_theme_settings_page');
}

add_action( 'admin_init', 'my_corporation_theme_settings_init' );
add_action( 'admin_menu', 'my_corporation_add_settings_page' );

//options
$slider_effects = array("random", "fade", "fold", "slideInRight", "slideInLeft", "sliceDown", "sliceDownLeft", "sliceUp", "sliceUpLeft", "sliceUpDown", "sliceUpDownLeft", "boxRandom", "boxRain", "boxRainReverse", "boxRainGrow", "boxRainGrowReverse");
$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array();

foreach ($categories as $category_list ) {
$wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}
array_unshift($wp_cats, "Choose a category"); 
function my_corporation_theme_settings_page() {

global $wp_cats, $slider_effects;
if ( ! isset( $_REQUEST['updated'] ) )
$_REQUEST['updated'] = false;
?>

<div class="wrap">
<div id="icon-options-general" class="icon32"></div><h2>My Corporation Settings</h2>

<div id="panel-content">
<?php if ( false !== $_REQUEST['updated'] ) : ?>
<div class="updated fade"><p><strong><?php _e( 'Options saved' ); ?></strong></p></div>
<?php endif; ?>
<form method="post" action="options.php">

<?php settings_fields( 'my_corporation_theme_settings' ); ?>
<?php $options = get_option( 'my_corporation_theme_settings' ); ?>
            
            
<div id="wrap-left">
	<ul class="tabs">
		<li><a href="#tab1">Main</a></li>
        <li><a href="#tab2">Image Slider</a></li>
		<li><a href="#tab3">Disable Stuff</a></li>
		<li><a href="#tab4">Tracking code</a></li>
        <li><a href="#tab5">My Corporation</a></li>
	</ul>
</div><!-- END wrap-left -->
            
<div id="wrap-right">
<div class="tab_container">

<div id="tab1" class="tab_content">
<ul>

<li><h3><?php _e( 'Favicon' ); ?></h3>

<input id="my_corporation_theme_settings[upload_favicon]" class="regular-text upload_field" type="text" size="36" name="my_corporation_theme_settings[upload_favicon]" value="<?php esc_attr_e( $options['upload_favicon'] ); ?>" />
<input class="upload_image_button" type="button" value="Upload Image" />
<label class="description abouttxtdescription" for="my_corporation_theme_settings[upload_favicon]"><?php _e( 'Upload or type in the URL for the site favicon.' ); ?></label>
</li>

<li><h3><?php _e( 'Homepage Text' ); ?></h3>
<textarea id="my_corporation_theme_settings[home_text]" class="regular-text" name="my_corporation_theme_settings[home_text]"><?php esc_attr_e( $options['home_text'] ); ?></textarea>
<label class="description" for="my_corporation_theme_settings[home_text]"><?php _e( 'Enter your text for the homepage top part - HTML is allowed, I recommend an h2 header followed by some text' ); ?></label>
</li>

</ul>              
</div>

<div id="tab2" class="tab_content">
<ul>

<li><h3><?php _e( 'Transition' ); ?></h3>
<select name="my_corporation_theme_settings[effect]">
<?php foreach ($slider_effects as $option) { ?>
<option <?php if ($options['effect'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>					
<label class="description" for="my_corporation_theme_settings[effect]"><?php _e( 'Choose the type of transition you want your slider to have. <small>~ Default is random.</small>' ); ?></label>
</li>

<li><h3><?php _e( 'Animation Speed' ); ?></h3>
<input id="my_corporation_theme_settings[anim_speed]" class="regular-text" type="text" name="my_corporation_theme_settings[anim_speed]" value="<?php esc_attr_e( $options['anim_speed'] ); ?>" />
<label class="description" for="my_corporation_theme_settings[anim_speed]"><?php _e( 'Type in the speed for the slide transitions in milliseconds. <small>~ Default is 500.</small>' ); ?></label>
</li>


<li><h3><?php _e( 'Pause Time' ); ?></h3>
<input id="my_corporation_theme_settings[pause_time]" class="regular-text" type="text" name="my_corporation_theme_settings[pause_time]" value="<?php esc_attr_e( $options['pause_time'] ); ?>" />
<label class="description" for="my_corporation_theme_settings[pause_time]"><?php _e( 'This is the time the image is displayed before it transits to the next, in milliseconds. <small>~ Default is 3000.</small>' ); ?></label>
</li>
                        
</ul>
</div>
 
<div id="tab3" class="tab_content">
<ul>

<li><h3><?php _e( 'Disable Tweet and Facebook Buttons' ); ?></h3>
<input id="my_corporation_theme_settings[disable_single_social]" name="my_corporation_theme_settings[disable_single_social]" type="checkbox" value="1" <?php checked( '1', $options['disable_single_social'] ); ?> />
<label class="description" for="my_corporation_theme_settings[disable_single_social]"><?php _e( 'Check this box if you would like to disable the tweet this and like this button on single posts' ); ?></label>
</li>

<li><h3><?php _e( 'Disable Featured Images On Single Posts' ); ?></h3>
<input id="my_corporation_theme_settings[disable_single_image]" name="my_corporation_theme_settings[disable_single_image]" type="checkbox" value="1" <?php checked( '1', $options['disable_single_image'] ); ?> />
<label class="description" for="my_corporation_theme_settings[disable_single_image]"><?php _e( 'Check this box if you would like to disable the thumbnail images on single posts' ); ?></label>
</li>

</ul>
</div>
                
<div id="tab4" class="tab_content">
<ul>
						
<li><h3><?php _e( 'Analytics Code' ); ?></h3>
<textarea id="my_corporation_theme_settings[analytics]" class="regular-text" name="my_corporation_theme_settings[analytics]"><?php esc_attr_e( $options['analytics'] ); ?></textarea>
<label class="description" for="my_corporation_theme_settings[analytics]"><?php _e( 'Enter your analytics tracking code' ); ?></label>
</li>

</ul>
</div>

<div id="tab5" class="tab_content">
<ul>
<h3>Theme Credits</h3>
<p>The <a href="http://www.wpexplorer.com/my-corporation-wordpress-theme.html">My Corporation</a> WordPress Theme was created by AJ Clarke from <a href="http://www.wpexplorer.com"><strong>WPExplorer.com</strong></a></p>

<h3>Do You like this theme?</h3>
<br />
<iframe src="http://www.facebook.com/plugins/like.php?app_id=215260205165212&amp;href=http%3A%2F%2Fwww.wpexplorer.com%2Fmy_corporation-wordpress-theme.html&amp;send=false&amp;layout=standard&amp;width=450&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:40px;" allowTransparency="true"></iframe>

<h3>Need Help?</h3>
<p>If you are looking for help setting up this theme you can post on my forum at <a href="http://www.wpthemehelp.com">WPThemeHelp.com</a>. I will answer basic theme set-up or bug issues, but I will not help you re-design your site for free, so please do not post any CSS related questions</p>

<h3>Join Us On Facebook</h3>
<iframe src="http://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2FWPExplorerThemes&amp;width=270&amp;colorscheme=light&amp;show_faces=true&amp;stream=false&amp;header=true&amp;height=225" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:270px; height:225px;" allowTransparency="true"></iframe>

<h3>Theme Sponsors</h3>
<div class="sponsor">
  <a href="http://www.elegantthemes.com/affiliates/idevaffiliate.php?id=3272_0_1_7" target="_blank"><img border="0" src="http://www.elegantthemes.com/affiliates/banners/468x60.gif" width="468" height="60"></a>
</div>

<div class="sponsor">
<a href="http://www.wpexplorer.com/themeforest"><img
border="0" src="http://envato.s3.amazonaws.com/referrer_adverts/tf_468x60_v2.gif"
alt="ThemeForest" width="468" height="60"/></a>
<br /><br />
</div>

</ul>
</div>

</div><!--end tab container-->
</div><!-- END wrap-right -->
<div class="clear"></div>

			<p class="submit-changes">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Options' ); ?>" />
			</p>
</form>
</div><!-- END panel-content -->
</div><!-- END wrap -->

<?php
}
//sanitize and validate
function my_corporation_options_validate( $input ) {
	global $select_options, $radio_options;
	if ( ! isset( $input['option1'] ) )
		$input['option1'] = null;
	$input['option1'] = ( $input['option1'] == 1 ? 1 : 0 );
	$input['sometext'] = wp_filter_nohtml_kses( $input['sometext'] );
	if ( ! isset( $input['radioinput'] ) )
		$input['radioinput'] = null;
	if ( ! array_key_exists( $input['radioinput'], $radio_options ) )
		$input['radioinput'] = null;
	$input['sometextarea'] = wp_filter_post_kses( $input['sometextarea'] );

	return $input;
}

?>