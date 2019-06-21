<?php
/*
 Plugin Name: WP OS FLV
 Plugin URI: http://www.kahan.in/
 Description: Easy to integrate flv player.
 Author: Amit Sidhpura
 Version: 1.1.9
 Author URI: http://www.kahan.in/
 */

include_once('wposflv-widget.php');

class WPOSFLV {	
	
	// Options page name
	public static $idCounter = 1;
	var $optionsPageName = "wp-os-flv";
	var $optionsArr = array('wposflv-flv' => '', 
							'wposflv-title' => '', 
							'wposflv-startimage' => '', 
							'wposflv-width' => '320', 
							'wposflv-height' => '240', 
							'wposflv-loop' => '0', 
							'wposflv-autoplay' => '0', 
							'wposflv-autoload' => '0', 
							'wposflv-volume' => '100', 
							'wposflv-skin' => '', 
							'wposflv-margin' => '5', 
							'wposflv-bgcolor' => '#ffffff', 
							'wposflv-bgcolor1' => '#7c7c7c', 
							'wposflv-bgcolor2' => '#333333', 
							'wposflv-showstop' => '0', 
							'wposflv-showvolume' => '0', 
							'wposflv-showtime' => '0', 
							'wposflv-showplayer' => 'autohide', 
							'wposflv-showloading' => 'autohide', 
							'wposflv-showfullscreen' => '0', 
							'wposflv-showswitchsubtitles' => '0', 
							'wposflv-playertimeout' => '1500', 
							'wposflv-playercolor' => '#000000', 
							'wposflv-playeralpha' => '100', 
							'wposflv-loadingcolor' => '#ffff00', 
							'wposflv-buttoncolor' => '#ffffff', 
							'wposflv-buttonovercolor' => '#ffff00', 
							'wposflv-slidercolor1' => '#cccccc', 
							'wposflv-slidercolor2' => '#888888', 
							'wposflv-sliderovercolor' => '#ffff00', 
							'wposflv-buffer' => '5', 
							'wposflv-buffermessage' => 'Buffering _n_', 
							'wposflv-buffercolor' => '#ffffff', 
							'wposflv-bufferbgcolor' => '#000000', 
							'wposflv-buffershowbg' => '1', 
							'wposflv-titlecolor' => '#ffffff', 
							'wposflv-titlesize' => '20', 
							'wposflv-srt' => '0', 
							'wposflv-srtcolor' => '#ffffff', 
							'wposflv-srtbgcolor' => '#000000', 
							'wposflv-srtsize' => '11', 
							'wposflv-srturl' => '', 
							'wposflv-onclick' => 'playpause', 
							'wposflv-onclicktarget' => '_self', 
							'wposflv-ondoubleclick' => 'none', 
							'wposflv-ondoubleclicktarget' => '_self', 
							'wposflv-top1' => '', 
							'wposflv-top2' => '', 
							'wposflv-top3' => '', 
							'wposflv-top4' => '', 
							'wposflv-top5' => '', 
							'wposflv-showiconplay' => '0', 
							'wposflv-iconplaycolor' => '#ffffff', 
							'wposflv-iconplaybgcolor' => '#000000', 
							'wposflv-iconplaybgalpha' => '75', 
							'wposflv-showmouse' => 'always', 
							'wposflv-videobgcolor' => '#000000', 
							'wposflv-loadonstop' => '1', 
							'wposflv-phpstream' => '0', 
							'wposflv-shortcut' => '0', 
							'wposflv-netconnection' => '', 
							'wposflv-showtitleandstartimage' => '0');
	
	function __construct() {
		add_action('admin_menu', array($this, 'addMenuItem'));
		add_filter("attachment_fields_to_edit", array($this, "insertVideoPlayerButton"), 10, 2);
		add_filter("media_send_to_editor", array($this, "sendToEditor"));
		add_filter("plugin_action_links", array($this, "addConfigureLink"), 10, 2);		
		add_shortcode('wposflv', array($this, 'insertPlayerCode'));
		add_action('widgets_init', create_function('', 'return register_widget("WPOSFLV_Widget");'));		
		register_activation_hook(__FILE__, array($this, 'activateWPOSFLV'));
		register_deactivation_hook(__FILE__, array($this, 'deactivateWPOSFLV'));
	}
	
	public function activateWPOSFLV() {
		$tempOptionsArr = $this->optionsArr;
		$tempOptionsArr['wposflv-flv'] = "http://wposflv.kahancreations.com/wp-content/videos/Justin-Bieber-Baby-ft.Ludacris.flv";
		$tempOptionsArr['wposflv-startimage'] = "http://wposflv.kahancreations.com/wp-content/uploads/2010/09/MWSnap019.png";
		$tempOptionsArr['wposflv-width'] = "315";
		$tempOptionsArr['wposflv-height'] = "234";
		$tempOptionsArr['wposflv-showstop'] = "1";
		$tempOptionsArr['wposflv-showvolume'] = "1";
		$tempOptionsArr['wposflv-showtime'] = "1";
		$tempOptionsArr['wposflv-showfullscreen'] = "1";		
		add_option("wposflv-options", serialize($tempOptionsArr));
		unset($tempOptionsArr);
	}
	
	public function deactivateWPOSFLV() {
		//delete_option("wposflv-options");
	}
	
	public function addConfigureLink($links, $file) {
		static $this_plugin;
		if (!$this_plugin) {
			$this_plugin = plugin_basename(__FILE__);
		}
		if ($file == $this_plugin) {
			$settings_link = '<a href="options-general.php?page=' . $this->optionsPageName . '">'.__('Settings').'</a>';
			array_unshift($links, $settings_link);
		}
		return $links;
	}
	
	public function addAdminScripts() {		
		wp_enqueue_script('farbtastic');
		wp_register_script('jquery-ui-accordion', WP_PLUGIN_URL."/wp-os-flv/js/ui.accordion.js", array('jquery-ui-core', 'jquery-ui-widget'));
		wp_enqueue_script('jquery-ui-accordion');
		wp_register_script('jquery-tipsy', WP_PLUGIN_URL."/wp-os-flv/js/tipsy/js/jquery.tipsy.js", array('jquery'));
		wp_enqueue_script('jquery-tipsy');
		wp_register_script('jquery-ui-slider', WP_PLUGIN_URL."/wp-os-flv/js/ui.slider.js", array('jquery-ui-core', 'jquery-ui-mouse', 'jquery-ui-widget'));
		wp_enqueue_script('jquery-ui-slider');		
		wp_register_script('wposflv-scripts', WP_PLUGIN_URL."/wp-os-flv/js/wposflv.js", array('jquery-ui-slider', 'farbtastic'));
		wp_enqueue_script('wposflv-scripts');
		wp_register_script('flash-script', WP_PLUGIN_URL."/wp-os-flv/js/flash/swfobject_modified.js");
		wp_enqueue_script('flash-script');
	}
	
	public function addAdminStyles() {
		wp_enqueue_style('farbtastic');		
		wp_register_style('jquery-ui-themes', WP_PLUGIN_URL."/wp-os-flv/css/ui-themes/base/jquery.ui.all.css");
		wp_enqueue_style('jquery-ui-themes');
		wp_register_style('jquery-tipsy', WP_PLUGIN_URL."/wp-os-flv/js/tipsy/css/tipsy.css");
		wp_enqueue_style('jquery-tipsy');
		wp_register_style('wposflv-styles', WP_PLUGIN_URL."/wp-os-flv/css/wposflv.css");
		wp_enqueue_style('wposflv-styles');
	}
	
	public function addMenuItem() {
		$page = add_options_page('WP OS FlV', 'WP OS FlV', 'manage_options', 'wp-os-flv', array($this, 'manageOptions'));		
		add_action('admin_init', array($this, 'registerSettings'));		
		add_action('admin_print_scripts-'.$page, array($this, "addAdminScripts"));
		add_action('admin_print_styles-'.$page, array($this, "addAdminStyles"));
	}
	
	public function insertVideoPlayerButton($form_fields, $post) {
		global $wp_version;
		$file = wp_get_attachment_url($post->ID);
		if ($post->post_mime_type == 'video/x-flv') {
			$form_fields["url"]["html"] .= "<button type='button' class='button urlvideoplayer video-player-".$post->ID."' value='[wposflv src=".attribute_escape($file)."]' title='[wposflv src=".attribute_escape($file)."]'>Video Player</button>";			
			if (version_compare($wp_version, "2.7", "<")) {
				$form_fields["url"]["html"] .= "<script type='text/javascript'>
				jQuery('button.video-player-".$post->ID."').bind('click', function(){jQuery(this).siblings('input').val(this.value);});
				</script>\n";
			}
		}		
		return $form_fields;
	}
	
	public function sendToEditor($html) {
		if (preg_match("/<a ([^=]+=['\"][^\"']+['\"] )*href=['\"](\[wposflv src=([^\"']+\.flv)])['\"]( [^=]+=['\"][^\"']+['\"])*>([^<]*)<\/a>/i", $html, $matches)) {
			$html = $matches[2];
		}
		return $html;
	}
	
	public function manageOptions() {
		include "wposflv-admin-view.php";
	}
	
	public function registerSettings() {
		register_setting('wposflv-settings-group', 'wposflv-options');
	}
	
	public function insertPlayerCode($atts) {		
		$flashVarsArr = unserialize(get_option('wposflv-options'));
		
		//for compatibility to previous version code starts
		$atts['flv'] = isset($atts['src'])?$atts['src']:$flashVarsArr['flv'];
		$atts['startimage'] = isset($atts['previewimage'])?$atts['previewimage']:$flashVarsArr['startimage'];
		unset($atts['src']);
		unset($atts['previewimage']);
		//for compatibility to previous version code ends
		
		if(is_array($flashVarsArr)) {
			foreach($flashVarsArr as $key => $value) {				
				$tempKey = str_replace('wposflv-', '', $key);
				if((array_key_exists($key, $this->optionsArr) && $value != $this->optionsArr[$key]  ) || isset($atts[$tempKey])) {					
					if(isset($atts[$tempKey])) {
						$flashVars .= $tempKey."=".preg_replace('/#([0-9a-f]+)/i', '$1', $atts[$tempKey])."&amp;";
						$flashVarsArr[$key] = $atts[$tempKey];
					}
					else {
						$flashVars .= $tempKey."=".preg_replace('/#([0-9a-f]+)/i', '$1', $value)."&amp;";
					}
				}				
			}
		}
		$flashVars = substr($flashVars, 0, -5);
		
		ob_start();
		
		?><div class="wposflv_container"><?php if(WPOSFLV::$idCounter <= 1) { ?><script src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/js/flash/swfobject_modified.js" type="text/javascript"></script><?php } ?><object id="FlashID<?php echo WPOSFLV::$idCounter ?>" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="<?php echo $flashVarsArr['wposflv-width'] ?>" height="<?php echo $flashVarsArr['wposflv-height'] ?>"><param name="movie" value="http://flv-player.net/medias/player_flv_maxi.swf" /><param name="allowFullScreen" value="true" /><param name="quality" value="high" /><param name="wmode" value="transparent" /><param name="swfversion" value="8.0.35.0" /><!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don't want users to see the prompt. --><param name="expressinstall" value="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/js/flash/expressInstall.swf" /><param name="FlashVars" value="<?php echo $flashVars ?>" /><!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. --><![if !IE]><object type="application/x-shockwave-flash" data="http://flv-player.net/medias/player_flv_maxi.swf" width="<?php echo $flashVarsArr['wposflv-width'] ?>" height="<?php echo $flashVarsArr['wposflv-height'] ?>"><![endif]><param name="allowFullScreen" value="true" /><param name="quality" value="high" /><param name="wmode" value="transparent" /><param name="swfversion" value="8.0.35.0" /><param name="expressinstall" value="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/js/flash/expressInstall.swf" /><param name="FlashVars" value="<?php echo $flashVars ?>" /><!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. --><div><h4>Content on this page requires a newer version of Adobe Flash Player.</h4><p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" /></a></p></div><![if !IE]></object><![endif]></object><script type="text/javascript"><!--
		swfobject.registerObject("FlashID<?php echo WPOSFLV::$idCounter ?>");
		//--></script></div><?php
		
		WPOSFLV::$idCounter++;
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
}

$objWPOSFLV = new WPOSFLV();

?>