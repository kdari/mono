<?php $updated = false;
if(isset($_POST['submit'])) {
	update_option('wposflv-options', serialize($_POST));
	$updated = true;
	$get_option = $_POST;
} else {
	$get_option = unserialize(get_option('wposflv-options'));
}?>
<div class="wrap">
	<div id="icon-edit" class="icon32"> <br />
	</div>
	<h2>WP OS FLV Options:</h2>
	<?php if($updated) {?>
	<div class="updated" id="message">
		<p><strong>Options updated.</strong></p>
	</div>
	<?php }?>
	<form id="wposflv-options-form" method="post" action="">
		<?php settings_fields('wposflv-settings-group'); ?>
		<div id="accordion" style="margin-top:14px;">
			<h3><a href="#">General</a></h3>
			<div>
				<table class="form-table">
					<tr valign="top">
						<th scope="row">src:</th>
						<td><input size="60" type="text" name="wposflv-flv" value="<?php echo $get_option['wposflv-flv']; ?>" />
							<a rel="tipsy" title="The URL of the FLV video to be played"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a></td>
					</tr>
					<tr valign="top">
						<th scope="row">title:</th>
						<td><input size="60" type="text" name="wposflv-title" value="<?php echo $get_option['wposflv-title']; ?>" />
							<a rel="tipsy" title="The title shown before loading the video"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a></td>
					</tr>
					<tr valign="top">
						<th scope="row">previewimage:</th>
						<td><input size="60" type="text" name="wposflv-startimage" value="<?php echo $get_option['wposflv-startimage']; ?>" />
							<a rel="tipsy" title="The URL of the JPEG file (not progressive) to be shown before loading the video"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a></td>
					</tr>
					<tr valign="top">
						<th scope="row">width:</th>
						<td><input type="text" name="wposflv-width" value="<?php echo $get_option['wposflv-width']; ?>" />
							<a rel="tipsy" title="Forces the video width"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a></td>
					</tr>
					<tr valign="top">
						<th scope="row">height:</th>
						<td><input type="text" name="wposflv-height" value="<?php echo $get_option['wposflv-height']; ?>" />
							<a rel="tipsy" title="Forces the video height"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a></td>
					</tr>
					<tr valign="top">
						<th scope="row">loop:</th>
						<td><input type="radio" <?php echo ($get_option['wposflv-loop']=='1')?'checked="checked"':'' ?> name="wposflv-loop" value="1" />
							<label>Yes</label>
							<input type="radio" <?php echo ($get_option['wposflv-loop']=='0')?'checked="checked"':'' ?> name="wposflv-loop" value="0" />
							<label>No</label>
							<a rel="tipsy" title="Yes to loop video"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a></td>
					</tr>
					<tr valign="top">
						<th scope="row">autoplay:</th>
						<td><input type="radio" <?php echo ($get_option['wposflv-autoplay']=='1')?'checked="checked"':'' ?> name="wposflv-autoplay" value="1" />
							<label>Yes</label>
							<input type="radio" <?php echo ($get_option['wposflv-autoplay']=='0')?'checked="checked"':'' ?> name="wposflv-autoplay" value="0" />
							<label>No</label>
							<a rel="tipsy" title="Yes to auto-play"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a></td>
					</tr>
					<tr valign="top">
						<th scope="row">autoload:</th>
						<td><input type="radio" <?php echo ($get_option['wposflv-autoload']=='1')?'checked="checked"':'' ?> name="wposflv-autoload" value="1" />
							<label>Yes</label>
							<input type="radio" <?php echo ($get_option['wposflv-autoload']=='0')?'checked="checked"':'' ?> name="wposflv-autoload" value="0" />
							<label>No</label>
							<a rel="tipsy" title="Yes to automatically load"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a></td>
					</tr>
					<tr valign="top">
						<th scope="row">volume:</th>
						<td><div style="width:200px;float:left;margin-right:10px;margin-top:5px" id="slider"> </div>
							<div style="float:left;font-weight:700;" id="display-volume"> <?php echo $get_option['wposflv-volume']; ?> </div>
							<input type="hidden" id="hidden-volume" name="wposflv-volume" value="<?php echo $get_option['wposflv-volume']; ?>" />
							<a style="margin-left:10px;" rel="tipsy" title="The initial volume, between 0 and 200"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a></td>
					</tr>
				</table>
			</div>
			<h3><a href="#">Border</a></h3>
			<div>
				<table class="form-table">
					<tr valign="top">
						<th scope="row">skin:</th>
						<td><input size="60" type="text" name="wposflv-skin" value="<?php echo $get_option['wposflv-skin']; ?>" />
							<a rel="tipsy" title="The URL of the JPEG file (not progressive) to load"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a></td>
					</tr>
					<tr valign="top">
						<th scope="row">margin:</th>
						<td><input type="text" name="wposflv-margin" value="<?php echo $get_option['wposflv-margin']; ?>" />
							<a rel="tipsy" title="The margin of the video with respect to the Flash object. (useful for skins)"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a></td>
					</tr>
					<tr valign="top" class="colorpickertr">
						<th scope="row">bgcolor:</th>
						<td><input onfocus="if(this.value=='') this.value = '#'" id="bgcolor" type="text" name="wposflv-bgcolor" value="<?php echo $get_option['wposflv-bgcolor']; ?>" />
							<span class="errmsg">Invalid value of color</span>
							<div id="bgcolor-picker" class="colorpicker-container"> </div>
							<a rel="tipsy" title="The background color"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a> <span class="errmsg">Invalid value of color</span></td>
					</tr>
					<tr valign="top" class="colorpickertr">
						<th scope="row">bgcolor1:</th>
						<td><input onfocus="if(this.value=='') this.value = '#'" id="bgcolor1" type="text" name="wposflv-bgcolor1" value="<?php echo $get_option['wposflv-bgcolor1']; ?>" />
							<span class="errmsg">Invalid value of color</span>
							<div id="bgcolor1-picker" class="colorpicker-container"> </div>
							<a rel="tipsy" title="The first color of the background gradient"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a> <span class="errmsg">Invalid value of color</span></td>
					</tr>
					<tr valign="top" class="colorpickertr">
						<th scope="row">bgcolor2:</th>
						<td><input onfocus="if(this.value=='') this.value = '#'" id="bgcolor2" type="text" name="wposflv-bgcolor2" value="<?php echo $get_option['wposflv-bgcolor2']; ?>" />
							<span class="errmsg">Invalid value of color</span>
							<div id="bgcolor2-picker" class="colorpicker-container"> </div>
							<a rel="tipsy" title="The second color of the background gradient"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a> <span class="errmsg">Invalid value of color</span></td>
					</tr>
				</table>
			</div>
			<h3><a href="#">Buttons of the player bar</a></h3>
			<div>
				<table class="form-table">
					<tr valign="top">
						<th scope="row">showstop:</th>
						<td><input type="radio" <?php echo ($get_option['wposflv-showstop']=='1')?'checked="checked"':'' ?> name="wposflv-showstop" value="1" />
							<label>Yes</label>
							<input type="radio" <?php echo ($get_option['wposflv-showstop']=='0')?'checked="checked"':'' ?> name="wposflv-showstop" value="0" />
							<label>No</label>
							<a rel="tipsy" title="Yes to show the STOP button"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a></td>
					</tr>
					<tr valign="top">
						<th scope="row">showvolume:</th>
						<td><input type="radio" <?php echo ($get_option['wposflv-showvolume']=='1')?'checked="checked"':'' ?> name="wposflv-showvolume" value="1" />
							<label>Yes</label>
							<input type="radio" <?php echo ($get_option['wposflv-showvolume']=='0')?'checked="checked"':'' ?> name="wposflv-showvolume" value="0" />
							<label>No</label>
							<a rel="tipsy" title="Yes to show the VOLUME button"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a></td>
					</tr>
					<tr valign="top">
						<th scope="row">showtime:</th>
						<td><input type="radio" <?php echo ($get_option['wposflv-showtime']=='1')?'checked="checked"':'' ?> name="wposflv-showtime" value="1" />
							<label>Show time</label>
							<input type="radio" <?php echo ($get_option['wposflv-showtime']=='2')?'checked="checked"':'' ?> name="wposflv-showtime" value="2" />
							<label>Show remaining time</label>
							<input type="radio" <?php echo ($get_option['wposflv-showtime']=='0')?'checked="checked"':'' ?> name="wposflv-showtime" value="0" />
							<label>No</label>
							<a rel="tipsy" title="'Show time' to show the TIME button, 'Show remaining time' to show the remaining time by default"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a></td>
					</tr>
					<tr valign="top">
						<th scope="row">showplayer:</th>
						<td><input type="radio" <?php echo ($get_option['wposflv-showplayer']=='autohide')?'checked="checked"':'' ?> name="wposflv-showplayer" value="autohide" />
							<label>autohide</label>
							<input type="radio" <?php echo ($get_option['wposflv-showplayer']=='always')?'checked="checked"':'' ?> name="wposflv-showplayer" value="always" />
							<label>always</label>
							<input type="radio" <?php echo ($get_option['wposflv-showplayer']=='never')?'checked="checked"':'' ?> name="wposflv-showplayer" value="never" />
							<label>never</label>
							<a rel="tipsy" title="Player bar display mode : 'autohide', 'always' or 'never'"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a></td>
					</tr>
					<tr valign="top">
						<th scope="row">showloading:</th>
						<td><input type="radio" <?php echo ($get_option['wposflv-showloading']=='autohide')?'checked="checked"':'' ?> name="wposflv-showloading" value="autohide" />
							<label>autohide</label>
							<input type="radio" <?php echo ($get_option['wposflv-showloading']=='always')?'checked="checked"':'' ?> name="wposflv-showloading" value="always" />
							<label>always</label>
							<input type="radio" <?php echo ($get_option['wposflv-showloading']=='never')?'checked="checked"':'' ?> name="wposflv-showloading" value="never" />
							<label>never</label>
							<a rel="tipsy" title="Loading bar display mode : 'autohide', 'always' or 'never'"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a></td>
					</tr>
					<tr valign="top">
						<th scope="row">showfullscreen:</th>
						<td><input type="radio" <?php echo ($get_option['wposflv-showfullscreen']=='1')?'checked="checked"':'' ?> name="wposflv-showfullscreen" value="1" />
							<label>Yes</label>
							<input type="radio" <?php echo ($get_option['wposflv-showfullscreen']=='0')?'checked="checked"':'' ?> name="wposflv-showfullscreen" value="0" />
							<label>No</label>
							<a rel="tipsy" title="Yes to show fullscreen button (requires Flash Player 9.0.16.60 or newer)"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a></td>
					</tr>
					<tr valign="top">
						<th scope="row">showswitchsubtitles:</th>
						<td><input type="radio" <?php echo ($get_option['wposflv-showswitchsubtitles']=='1')?'checked="checked"':'' ?> name="wposflv-showswitchsubtitles" value="1" />
							<label>Yes</label>
							<input type="radio" <?php echo ($get_option['wposflv-showswitchsubtitles']=='0')?'checked="checked"':'' ?> name="wposflv-showswitchsubtitles" value="0" />
							<label>No</label>
							<a rel="tipsy" title="Yes to show the button showing/hiding subtitles"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a></td>
					</tr>
					<tr valign="top">
						<th scope="row">playertimeout:</th>
						<td><input type="text" name="wposflv-playertimeout" value="<?php echo $get_option['wposflv-playertimeout']; ?>" />
							<a rel="tipsy" title="The timeout in milliseconds before the player hides (when 'autohide' mode is set). By default set to '1500'"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a></td>
					</tr>
				</table>
			</div>
			<h3><a href="#">Colors of the player bar</a></h3>
			<div>
				<table class="form-table">
					<tr valign="top" class="colorpickertr">
						<th scope="row">playercolor:</th>
						<td><input onfocus="if(this.value=='') this.value = '#'" id="playercolor" type="text" name="wposflv-playercolor" value="<?php echo $get_option['wposflv-playercolor']; ?>" />
							<span class="errmsg">Invalid value of color</span>
							<div id="playercolor-picker" class="colorpicker-container"> </div>
							<a rel="tipsy" title="The background color of the player bar (not the flash)"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a> <span class="errmsg">Invalid value of color</span></td>
					</tr>
					<tr valign="top">
						<th scope="row">playeralpha:</th>
						<td><input type="radio" <?php echo ($get_option['wposflv-playeralpha']=='100')?'checked="checked"':'' ?> name="wposflv-playeralpha" value="100" />
							<label>100</label>
							<input type="radio" <?php echo ($get_option['wposflv-playeralpha']=='75')?'checked="checked"':'' ?> name="wposflv-playeralpha" value="75" />
							<label>75</label>
							<input type="radio" <?php echo ($get_option['wposflv-playeralpha']=='50')?'checked="checked"':'' ?> name="wposflv-playeralpha" value="50" />
							<label>50</label>
							<input type="radio" <?php echo ($get_option['wposflv-playeralpha']=='25')?'checked="checked"':'' ?> name="wposflv-playeralpha" value="25" />
							<label>25</label>
							<input type="radio" <?php echo ($get_option['wposflv-playeralpha']=='0')?'checked="checked"':'' ?> name="wposflv-playeralpha" value="0" />
							<label>0</label>
							<a rel="tipsy" title="The transparency of the player bar, between '0' and '100'"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a></td>
					</tr>
					<tr valign="top" class="colorpickertr">
						<th scope="row">loadingcolor:</th>
						<td><input onfocus="if(this.value=='') this.value = '#'" id="loadingcolor" type="text" name="wposflv-loadingcolor" value="<?php echo $get_option['wposflv-loadingcolor']; ?>" />
							<span class="errmsg">Invalid value of color</span>
							<div id="loadingcolor-picker" class="colorpicker-container"> </div>
							<a rel="tipsy" title="The color of loading bar"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a> <span class="errmsg">Invalid value of color</span></td>
					</tr>
					<tr valign="top" class="colorpickertr">
						<th scope="row">buttoncolor:</th>
						<td><input onfocus="if(this.value=='') this.value = '#'" id="buttoncolor" type="text" name="wposflv-buttoncolor" value="<?php echo $get_option['wposflv-buttoncolor']; ?>" />
							<span class="errmsg">Invalid value of color</span>
							<div id="buttoncolor-picker" class="colorpicker-container"> </div>
							<a rel="tipsy" title="The color of the buttons"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a> <span class="errmsg">Invalid value of color</span></td>
					</tr>
					<tr valign="top" class="colorpickertr">
						<th scope="row">buttonovercolor:</th>
						<td><input onfocus="if(this.value=='') this.value = '#'" id="buttonovercolor" type="text" name="wposflv-buttonovercolor" value="<?php echo $get_option['wposflv-buttonovercolor']; ?>" />
							<span class="errmsg">Invalid value of color</span>
							<div id="buttonovercolor-picker" class="colorpicker-container"> </div>
							<a rel="tipsy" title="Hover color of buttons"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a> <span class="errmsg">Invalid value of color</span></td>
					</tr>
					<tr valign="top" class="colorpickertr">
						<th scope="row">slidercolor1:</th>
						<td><input onfocus="if(this.value=='') this.value = '#'" id="slidercolor1" type="text" name="wposflv-slidercolor1" value="<?php echo $get_option['wposflv-slidercolor1']; ?>" />
							<span class="errmsg">Invalid value of color</span>
							<div id="slidercolor1-picker" class="colorpicker-container"> </div>
							<a rel="tipsy" title="The first color of the bar gradient"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a> <span class="errmsg">Invalid value of color</span></td>
					</tr>
					<tr valign="top" class="colorpickertr">
						<th scope="row">slidercolor2:</th>
						<td><input onfocus="if(this.value=='') this.value = '#'" id="slidercolor2" type="text" name="wposflv-slidercolor2" value="<?php echo $get_option['wposflv-slidercolor2']; ?>" />
							<span class="errmsg">Invalid value of color</span>
							<div id="slidercolor2-picker" class="colorpicker-container"> </div>
							<a rel="tipsy" title="The second color of the bar gradient"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a> <span class="errmsg">Invalid value of color</span></td>
					</tr>
					<tr valign="top" class="colorpickertr">
						<th scope="row">sliderovercolor:</th>
						<td><input onfocus="if(this.value=='') this.value = '#'" id="sliderovercolor" type="text" name="wposflv-sliderovercolor" value="<?php echo $get_option['wposflv-sliderovercolor']; ?>" />
							<span class="errmsg">Invalid value of color</span>
							<div id="sliderovercolor-picker" class="colorpicker-container"> </div>
							<a rel="tipsy" title="Hover color of the bar"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a> <span class="errmsg">Invalid value of color</span></td>
					</tr>
				</table>
			</div>
			<h3><a href="#">Buffer display</a></h3>
			<div>
				<table class="form-table">
					<tr valign="top">
						<th scope="row">buffer:</th>
						<td><input type="radio" <?php echo ($get_option['wposflv-buffer']=='5')?'checked="checked"':'' ?> name="wposflv-buffer" value="5" />
							<label>5</label>
							<input type="radio" <?php echo ($get_option['wposflv-buffer']=='10')?'checked="checked"':'' ?> name="wposflv-buffer" value="10" />
							<label>10</label>
							<input type="radio" <?php echo ($get_option['wposflv-buffer']=='20')?'checked="checked"':'' ?> name="wposflv-buffer" value="20" />
							<label>20</label>
							<input type="radio" <?php echo ($get_option['wposflv-buffer']=='30')?'checked="checked"':'' ?> name="wposflv-buffer" value="30" />
							<label>30</label>
							<input type="radio" <?php echo ($get_option['wposflv-buffer']=='60')?'checked="checked"':'' ?> name="wposflv-buffer" value="60" />
							<label>60</label>
							<a rel="tipsy" title="The number of seconds to buffer. By default set to '5'"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a></td>
					</tr>
					<tr valign="top">
						<th scope="row">buffermessage:</th>
						<td><input size="60" type="text" name="wposflv-buffermessage" value="<?php echo $get_option['wposflv-buffermessage']; ?>" />
							<a rel="tipsy" title="The buffering message. By default 'Buffering _n_', '_n_' shown in percent"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a></td>
					</tr>
					<tr valign="top" class="colorpickertr">
						<th scope="row">buffercolor:</th>
						<td><input onfocus="if(this.value=='') this.value = '#'" id="buffercolor" type="text" name="wposflv-buffercolor" value="<?php echo $get_option['wposflv-buffercolor']; ?>" />
							<span class="errmsg">Invalid value of color</span>
							<div id="buffercolor-picker" class="colorpicker-container"> </div>
							<a rel="tipsy" title="The color of the buffering message"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a> <span class="errmsg">Invalid value of color</span></td>
					</tr>
					<tr valign="top" class="colorpickertr">
						<th scope="row">bufferbgcolor:</th>
						<td><input onfocus="if(this.value=='') this.value = '#'" id="bufferbgcolor" type="text" name="wposflv-bufferbgcolor" value="<?php echo $get_option['wposflv-bufferbgcolor']; ?>" />
							<span class="errmsg">Invalid value of color</span>
							<div id="bufferbgcolor-picker" class="colorpicker-container"> </div>
							<a rel="tipsy" title="The background color of the buffering message"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a> <span class="errmsg">Invalid value of color</span></td>
					</tr>
					<tr valign="top">
						<th scope="row">buffershowbg:</th>
						<td><input type="radio" <?php echo ($get_option['wposflv-buffershowbg']=='1')?'checked="checked"':'' ?> name="wposflv-buffershowbg" value="1" />
							<label>Yes</label>
							<input type="radio" <?php echo ($get_option['wposflv-buffershowbg']=='0')?'checked="checked"':'' ?> name="wposflv-buffershowbg" value="0" />
							<label>No</label>
							<a rel="tipsy" title="No to hide the background color of the buffering message"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a></td>
					</tr>
				</table>
			</div>
			<h3><a href="#">Title</a></h3>
			<div>
				<table class="form-table">
					<tr valign="top" class="colorpickertr">
						<th scope="row">titlecolor:</th>
						<td><input onfocus="if(this.value=='') this.value = '#'" id="titlecolor" type="text" name="wposflv-titlecolor" value="<?php echo $get_option['wposflv-titlecolor']; ?>" />
							<span class="errmsg">Invalid value of color</span>
							<div id="titlecolor-picker" class="colorpicker-container"> </div>
							<a rel="tipsy" title="The color of title. By default set to 'ffffff'"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a> <span class="errmsg">Invalid value of color</span></td>
					</tr>
					<tr valign="top">
						<th scope="row">titlesize:</th>
						<td><select name="wposflv-titlesize">
							<?php for($i=8; $i<=26; $i++) {?>
								<option <?php echo ($i==$get_option['wposflv-titlesize'])?'selected="selected"':"";?> value="<?php echo $i;?>"><?php echo $i;?></option>
							<?php }?>
							</select>
							<a rel="tipsy" title="The size of the title's font. By default set to '20'"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a></td>
					</tr>
				</table>
			</div>
			<h3><a href="#">Subtitles</a></h3>
			<div>
				<table class="form-table">
					<tr valign="top">
						<th scope="row">srt:</th>
						<td><input type="radio" <?php echo ($get_option['wposflv-srt']=='1')?'checked="checked"':'' ?> name="wposflv-srt" value="1" />
							<label>Yes</label>
							<input type="radio" <?php echo ($get_option['wposflv-srt']=='0')?'checked="checked"':'' ?> name="wposflv-srt" value="0" />
							<label>No</label>
							<a rel="tipsy" title="Yes to use SRT subtitles (the file must be at the same place as the video and have the same name, with .srt extension)"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a></td>
					</tr>
					<tr valign="top" class="colorpickertr">
						<th scope="row">srtcolor:</th>
						<td><input onfocus="if(this.value=='') this.value = '#'" id="srtcolor" type="text" name="wposflv-srtcolor" value="<?php echo $get_option['wposflv-srtcolor']; ?>" />
							<span class="errmsg">Invalid value of color</span>
							<div id="srtcolor-picker" class="colorpicker-container"> </div>
							<a rel="tipsy" title="The color of subtitles"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a> <span class="errmsg">Invalid value of color</span></td>
					</tr>
					<tr valign="top" class="colorpickertr">
						<th scope="row">srtbgcolor:</th>
						<td><input onfocus="if(this.value=='') this.value = '#'" id="srtbgcolor" type="text" name="wposflv-srtbgcolor" value="<?php echo $get_option['wposflv-srtbgcolor']; ?>" />
							<span class="errmsg">Invalid value of color</span>
							<div id="srtbgcolor-picker" class="colorpicker-container"> </div>
							<a rel="tipsy" title="The background color of subtitles"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a> <span class="errmsg">Invalid value of color</span></td>
					</tr>
					<tr valign="top">
						<th scope="row">srtsize:</th>
						<td><select name="wposflv-srtsize">
							<?php for($i=8; $i<=16; $i++) {?>
								<option <?php echo ($i==$get_option['wposflv-srtsize'])?'selected="selected"':"";?> value="<?php echo $i;?>"><?php echo $i;?></option>
							<?php }?>
							</select>
							<a rel="tipsy" title="Size of the subtitle's font. By default set to '11'"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a></td>
					</tr>
					<tr valign="top">
						<th scope="row">srturl:</th>
						<td><input size="60" type="text" name="wposflv-srturl" value="<?php echo $get_option['wposflv-srturl']; ?>" />
							<label><a rel="tipsy" title="L'URL of the subtitles file (if you don't want the automatic detection)"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a></label></td>
					</tr>
				</table>
			</div>
			<h3><a href="#">Mouse control</a></h3>
			<div>
				<table class="form-table">
					<tr valign="top">
						<th scope="row">onclick:</th>
						<td><input size="60" type="text" name="wposflv-onclick" value="<?php echo $get_option['wposflv-onclick']; ?>" />
							<a rel="tipsy" title="The destination URL when clicking on the video. By default 'playpause', meaning that the video is played/paused on click. To remove events, set to 'none'"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a></td>
					</tr>
					<tr valign="top">
						<th scope="row">onclicktarget:</th>
						<td><input size="60" type="text" name="wposflv-onclicktarget" value="<?php echo $get_option['wposflv-onclicktarget']; ?>" />
							<a rel="tipsy" title="The target of the URL when clicking on the video. By default '_self'. To open a new window set to '_blank'"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a></td>
					</tr>
					<tr valign="top">
						<th scope="row">ondoubleclick:</th>
						<td><input size="60" type="text" name="wposflv-ondoubleclick" value="<?php echo $get_option['wposflv-ondoubleclick']; ?>" />
							<a rel="tipsy" title="Action on double click: 'none', 'fullscreen', 'playpause', or the URL to open"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a></td>
					</tr>
					<tr valign="top">
						<th scope="row">ondoubleclicktarget:</th>
						<td><input size="60" type="text" name="wposflv-ondoubleclicktarget" value="<?php echo $get_option['wposflv-ondoubleclicktarget']; ?>" />
							<a rel="tipsy" title="The target of the URL when double clicking on the video. By default '_self'. To open a new window set to '_blank'"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a></td>
					</tr>
				</table>
			</div>
			<h3><a href="#">Images over the video</a></h3>
			<div>
				<table class="form-table">
					<tr valign="top">
						<th scope="row">top1:</th>
						<td><input size="60" type="text" name="wposflv-top1" value="<?php echo $get_option['wposflv-top1']; ?>" />
							<a rel="tipsy" title="Load an image over the video and place it at the coordinate 'x' and 'y' (for example 'url|x|y')"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a></td>
					</tr>
					<tr valign="top">
						<th scope="row">top2:</th>
						<td><input size="60" type="text" name="wposflv-top2" value="<?php echo $get_option['wposflv-top2']; ?>" />
							<a rel="tipsy" title="Load an image over the video and place it at the coordinate 'x' and 'y' (for example 'url|x|y')"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a></td>
					</tr>
					<tr valign="top">
						<th scope="row">top3:</th>
						<td><input size="60" type="text" name="wposflv-top3" value="<?php echo $get_option['wposflv-top3']; ?>" />
							<a rel="tipsy" title="Load an image over the video and place it at the coordinate 'x' and 'y' (for example 'url|x|y')"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a></td>
					</tr>
					<tr valign="top">
						<th scope="row">top4:</th>
						<td><input size="60" type="text" name="wposflv-top4" value="<?php echo $get_option['wposflv-top4']; ?>" />
							<a rel="tipsy" title="Load an image over the video and place it at the coordinate 'x' and 'y' (for example 'url|x|y')"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a></td>
					</tr>
					<tr valign="top">
						<th scope="row">top5:</th>
						<td><input size="60" type="text" name="wposflv-top5" value="<?php echo $get_option['wposflv-top5']; ?>" />
							<a rel="tipsy" title="Load an image over the video and place it at the coordinate 'x' and 'y' (for example 'url|x|y')"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a></td>
					</tr>
				</table>
			</div>
			<h3><a href="#">Video icons</a></h3>
			<div>
				<table class="form-table">
					<tr valign="top">
						<th scope="row">showiconplay:</th>
						<td><input type="radio" <?php echo ($get_option['wposflv-showiconplay']=='1')?'checked="checked"':'' ?> name="wposflv-showiconplay" value="1" />
							<label>Yes</label>
							<input type="radio" <?php echo ($get_option['wposflv-showiconplay']=='0')?'checked="checked"':'' ?> name="wposflv-showiconplay" value="0" />
							<label>No</label>
							<a rel="tipsy" title="Yes to show the PLAY icon in the middle of the video"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a></td>
					</tr>
					<tr valign="top" class="colorpickertr">
						<th scope="row">iconplaycolor:</th>
						<td><input onfocus="if(this.value=='') this.value = '#'" id="iconplaycolor" type="text" name="wposflv-iconplaycolor" value="<?php echo $get_option['wposflv-iconplaycolor']; ?>" />
							<span class="errmsg">Invalid value of color</span>
							<div id="iconplaycolor-picker" class="colorpicker-container"> </div>
							<a rel="tipsy" title="The color of the PLAY icon"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a> <span class="errmsg">Invalid value of color</span></td>
					</tr>
					<tr valign="top" class="colorpickertr">
						<th scope="row">iconplaybgcolor:</th>
						<td><input onfocus="if(this.value=='') this.value = '#'" id="iconplaybgcolor" type="text" name="wposflv-iconplaybgcolor" value="<?php echo $get_option['wposflv-iconplaybgcolor']; ?>" />
							<span class="errmsg">Invalid value of color</span>
							<div id="iconplaybgcolor-picker" class="colorpicker-container"> </div>
							<a rel="tipsy" title="The background color of the PLAY icon"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a> <span class="errmsg">Invalid value of color</span></td>
					</tr>
					<tr valign="top">
						<th scope="row">iconplaybgalpha:</th>
						<td><select name="wposflv-iconplaybgalpha">
							<?php for($i=0; $i<=100; $i++) {?>
								<option <?php echo ($i==$get_option['wposflv-iconplaybgalpha'])?'selected="selected"':"";?> value="<?php echo $i;?>"><?php echo $i;?></option>
							<?php }?>
							</select>
							<a rel="tipsy" title="The transparency of the PLAY icon between '0' and '100'"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a></td>
					</tr>
				</table>
			</div>
			<h3><a href="#">Miscellaneous</a></h3>
			<div>
				<table class="form-table">
					<tr valign="top">
						<th scope="row">showmouse:</th>
						<td><input type="radio" <?php echo ($get_option['wposflv-showmouse']=='autohide')?'checked="checked"':'' ?> name="wposflv-showmouse" value="autohide" />
							<label>autohide</label>
							<input type="radio" <?php echo ($get_option['wposflv-showmouse']=='always')?'checked="checked"':'' ?> name="wposflv-showmouse" value="always" />
							<label>always</label>
							<input type="radio" <?php echo ($get_option['wposflv-showmouse']=='never')?'checked="checked"':'' ?> name="wposflv-showmouse" value="never" />
							<label>never</label>
							<a rel="tipsy" title="Display of the mouse cursor : 'always', 'autohide', 'never'"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a></td>
					</tr>
					<tr valign="top" class="colorpickertr">
						<th scope="row">videobgcolor:</th>
						<td><input onfocus="if(this.value=='') this.value = '#'" id="videobgcolor" type="text" name="wposflv-videobgcolor" value="<?php echo $get_option['wposflv-videobgcolor']; ?>" />
							<span class="errmsg">Invalid value of color</span>
							<div id="videobgcolor-picker" class="colorpicker-container"> </div>
							<a rel="tipsy" title="Background color of the flash, when no video is shown"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a> <span class="errmsg">Invalid value of color</span></td>
					</tr>
					<tr valign="top">
						<th scope="row">loadonstop:</th>
						<td><input type="radio" <?php echo ($get_option['wposflv-loadonstop']=='1')?'checked="checked"':'' ?> name="wposflv-loadonstop" value="1" />
							<label>Yes</label>
							<input type="radio" <?php echo ($get_option['wposflv-loadonstop']=='0')?'checked="checked"':'' ?> name="wposflv-loadonstop" value="0" />
							<label>No</label>
							<a rel="tipsy" title="No to stop the video loading by cliking on STOP button"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a></td>
					</tr>
					<tr valign="top">
						<th scope="row">phpstream:</th>
						<td><input type="radio" <?php echo ($get_option['wposflv-phpstream']=='1')?'checked="checked"':'' ?> name="wposflv-phpstream" value="1" />
							<label>Yes</label>
							<input type="radio" <?php echo ($get_option['wposflv-phpstream']=='0')?'checked="checked"':'' ?> name="wposflv-phpstream" value="0" />
							<label>No</label>
							<a rel="tipsy" title="Yes to use php stream"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a></td>
					</tr>
					<tr valign="top">
						<th scope="row">shortcut:</th>
						<td><input type="radio" <?php echo ($get_option['wposflv-shortcut']=='1')?'checked="checked"':'' ?> name="wposflv-shortcut" value="1" />
							<label>Yes</label>
							<input type="radio" <?php echo ($get_option['wposflv-shortcut']=='0')?'checked="checked"':'' ?> name="wposflv-shortcut" value="0" />
							<label>No</label>
							<a rel="tipsy" title="No to deactivate keyboard shortcuts"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a></td>
					</tr>
					<tr valign="top">
						<th scope="row">netconnection:</th>
						<td><input size="60" type="text" name="wposflv-netconnection" value="<?php echo $get_option['wposflv-netconnection']; ?>" />
							<a rel="tipsy" title="RTMP server url"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a></td>
					</tr>
					<tr valign="top">
						<th scope="row">showtitleandstartimage:</th>
						<td><input type="radio" <?php echo ($get_option['wposflv-showtitleandstartimage']=='1')?'checked="checked"':'' ?> name="wposflv-showtitleandstartimage" value="1" />
							<label>Yes</label>
							<input type="radio" <?php echo ($get_option['wposflv-showtitleandstartimage']=='0')?'checked="checked"':'' ?> name="wposflv-showtitleandstartimage" value="0" />
							<label>No</label>
							<a rel="tipsy" title="Yes to show the title and the startimage at the same time"><img alt="" src="<?php echo WP_PLUGIN_URL ?>/wp-os-flv/images/help-hint.png" align="absmiddle" /></a></td>
					</tr>
				</table>
			</div>
		</div>
		<p class="submit">
			<input type="submit" class="button-primary" name="submit" value="<?php _e('Save Changes') ?>" />
		</p>
	</form>
</div>
