<?php

// Theme Name: Brightness
// Edit this file on your own risk!

add_action('admin_menu', 'brightness_settings'); // Theme Menu "Brightness Settings"
add_action('admin_head', 'brightnesspage_css'); // CSS For "Brightness Settings" Page

if ( function_exists('register_sidebar') ) // Sidebar Widget
    register_sidebar(array(
        'before_widget' => '<div class="item">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));

function cat_display() { // Display Category list on "Brightness Settings" Page
	$cat = wp_dropdown_categories('orderby=id&order=ASC&hide_empty=0&echo=0');
	$cat = str_replace("\n", "", $cat);
	$cat = str_replace("\t", "", $cat);
	$cat = str_replace("<select name='cat' id='cat' class='postform' ><option value=\"", "", $cat);
	$cat = str_replace("</option><option value=\"", "_", $cat);
	$cat = str_replace("\">", "-", $cat);
	$cat = str_replace("</option></select>", "", $cat);
	
	
	$cat = explode("_", $cat);
	foreach($cat as $category)
	{
	
		$category = explode("-", $category);
		$cat_number = $category[0];
		$cat_name = $category[1];
	
			if (get_option("cat$cat_number") == "yes") { $select = ' selected="selected"'; }
			if (get_option("cat$cat_number") == "") { $selected = ' selected="selected"'; }
			if (get_option("cat$cat_number") == "no") { $selected = ' selected="selected"'; }
			echo "<div class=\"category-select\">";
				echo "<h3><strong>$cat_name</strong> - Display this category as a news section?</h3>";
					echo "<select name=\"cat$cat_number\" id=\"$cat_number$i\">";
						echo "<option value=\"yes\"";
							if (get_option("cat$cat_number") == "yes") { echo ' selected="selected"'; }
						echo ">Yes</option>";
						echo "<option value=\"no\"";
							if (get_option("cat$cat_number") == "no") { echo ' selected="selected"'; }
							if (get_option("cat$cat_number") == NULL) { echo ' selected="selecter"'; } 
						echo ">No</option>";
					echo "</select>";
			echo "</div>";

	} // End Foreach

}

function featured_cat() { // Display Category list on "Brightness Settings" Page
	$fcat = wp_dropdown_categories('orderby=id&order=ASC&hide_empty=0&echo=0');
	$fcat = str_replace("\n", "", $fcat);
	$fcat = str_replace("\t", "", $fcat);
	$fcat = str_replace("<select name='cat' id='cat' class='postform' ><option value=\"", "", $fcat);
	$fcat = str_replace("</option><option value=\"", "_", $fcat);
	$fcat = str_replace("\">", "-", $fcat);
	$fcat = str_replace("</option></select>", "", $fcat);
	
	echo "<select name=\"featuredcat\" id=\"featuredcat\">";
	
	$fcat = explode("_", $fcat);
	foreach($fcat as $category)
	{

		$category = explode("-", $category);
		$cat_number = $category[0];
		$cat_name = $category[1];
	
			echo "<option name=\"$cat_name\"";
				if (get_option("featuredcat") == $cat_name) { echo ' selected="selecter"'; }
			echo ">$cat_name</option>";

	} // End Foreach;

	echo "</select>";
	
}

function brightness(){ // Updates "Brightness Settings" Page Form
    if(isset($_POST['submitted']) && $_POST['submitted'] == "yes"){
        //Get form data
		
		$catname = $_POST['catname'];
		$catnamed = $_POST['catnamed'];
		$catnamet = $_POST['catnamet'];
		$eadv = $_POST['eadv'];
		$ens = $_POST['ens'];
		$efeatured = $_POST['efeatured'];
		$featuredcat = $_POST['featuredcat'];
		$etext = $_POST['etext'];
		$redtext = stripslashes($_POST['redtext']);
		
		$small_ad = stripslashes($_POST['small_ad']);
		$big_ad = stripslashes($_POST['big_ad']);
		
		update_option("etext", $etext);
		update_option("redtext", $redtext);
		update_option("featuredcat", $featuredcat);
		update_option("efeatured", $efeatured);
		update_option("ens", $ens);
		update_option("eadv", $eadv);
		update_option("catname", $catname);
		update_option("catnamed", $catnamed);
		update_option("catnamet", $catnamet); 
		update_option("small_ad", $small_ad);
		update_option("big_ad", $big_ad);

		$cat = wp_dropdown_categories('orderby=id&order=ASC&hide_empty=0&echo=0');
		$cat = str_replace("\n", "", $cat);
		$cat = str_replace("\t", "", $cat);
		$cat = str_replace("<select name='cat' id='cat' class='postform' ><option value=\"", "", $cat);
		$cat = str_replace("</option><option value=\"", "_", $cat);
		$cat = str_replace("\">", "-", $cat);
		$cat = str_replace("</option></select>", "", $cat);
	
		$cat = explode("_", $cat);
		foreach($cat as $category)
		{
			$category = explode("-", $category);
			$cat_number = $category[0];
			$cat_name = $category[1];
			update_option("cat$cat_number", $_POST["cat$cat_number"]);
			
		} //foreach
		
		
	
        echo "<div id=\"message\" class=\"updated fade\"><p><strong>Your settings have been saved.</strong></p></div>";
    }
	
		
?>

<div class="wrap">
	
	<form method="post" name="brightness" target="_self">
		<p class="submit">
			<input name="submitted" type="hidden" value="yes" />
			<input type="submit" name="Submit" value="Update &raquo;" />
		</p>
		<h2>Blog Title (logo):</h2>
		<p>You can enable/disable red section from your header logo, you can change it build a custom title.</p>
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Title Construction:</th>
				<td>
					<p style="margin: 0px;"><strong>Display red text?</strong></p>
					<select name="etext">
						<option value="display"<?php if(get_option('etext') == "display") { echo ' selected="selected"'; } ?>>Display</option>
						<option value="hide"<?php if(get_option('etext') == "hide") { echo ' selected="selected"'; } ?>>Hide</option>
					</select>
					<p style="margin: 10px 0 0 0;"><strong>Red Text (default: "News"):</strong></p>
					<input type="text" name="redtext" id="redtext" value="<?php echo get_option("redtext"); ?>" />
				</td>
			<tr>
		</table>
		
		<div style="Display: block; height: 15px; width: 100%;"></div>
		<h2>Featured Category:</h2>
		<p>Posts published in featured category will be displayed, one by one, on the top section from homepage.<br />
		You can enable/disable featured section, you can choose a certain category to be featured and you can change it any time.</p>
		
			<table class="form-table">
				<tr valign="top">
					<th scope="row">Enable / Disable Featured Section:</th>
					<td>
						<select name="efeatured">
							<option value="enable"<?php if(get_option('efeatured') == "enable") { echo ' selected="selected"'; } ?>><?php if(get_option('efeatured') == "enable") { echo "Enabled"; } else { echo "Enable"; } ?></option>
							<option value="disable"<?php if(get_option('efeatured') == "disable") { echo ' selected="selected"'; } ?>><?php if(get_option('efeatured') == "disable") { echo "Disabled"; } else { echo "Disable"; } ?></option>
						</select>
						<p style="margin: 0px;"><?php if(get_option('efeatured') !== NULE) { ?>Featured section is currently <span style="color: #D13E12; font-weight: strong;"><?php $eadv = get_option('efeatured'); echo $eadv; ?>d</span>.<?php } ?></p>					
					</td>
				</tr>
				<tr valign="top" <?php $eadv = get_option('efeatured'); if ($eadv == "disable") { ?>style="display: none;"<?php } ?>>
					<th scope="row">Featured Category:</th>
					<td>
						<?php featured_cat(); ?>
					</td>
				</tr>
			</table>

		
		<div style="Display: block; height: 15px; width: 100%;"></div>
		<h2>Advertising Codes:</h2>
		<p>Brightness is coming with two advertising sposts: 300px / 250px and 160px / 600px.<br />
		First is displayed on featured section from homepage, on single posts and blog archive. The second is displayed under de homepage sidebar.<br /></p>
		
			<table class="form-table">
				<tr valign="top">
					<th scope="row">Enable / Disable Advertising Spaces:</th>
					<td>
						<select name="eadv">
							<option value="enable"<?php if(get_option('eadv') == "enable") { echo ' selected="selected"'; } ?>><?php if(get_option('eadv') == "enable") { echo "Enabled"; } else { echo "Enable"; } ?></option>
							<option value="disable"<?php if(get_option('eadv') == "disable") { echo ' selected="selected"'; } ?>><?php if(get_option('eadv') == "disable") { echo "Disabled"; } else { echo "Disable"; } ?></option>
						</select>
						<p style="margin: 0px;"><?php if(get_option('eadv') !== NULE) { ?>Advertising Spaces are currently <span style="color: #D13E12; font-weight: strong;"><?php $eadv = get_option('eadv'); echo $eadv; ?>d</span>.<?php } ?></p>
					</td>
				</tr>
				<tr valign="top" <?php $eadv = get_option('eadv'); if ($eadv == "disable") { ?>style="display: none;"<?php } ?>>
					<th scope="row">120px / 600px Advertisment</th>
					<td>
						<p style="margin: 0px 0px 5px 0px;">Displayed on homepage sidebar.</p>
						<textarea name="small_ad" cols="60" rows="7" id="small_ad"><?php echo get_option("small_ad"); ?></textarea>
					</td>
				</tr>
				<tr valign="top" <?php $eadv = get_option('eadv'); if ($eadv == "disable") { ?>style="display: none;"<?php } ?>>
					<th scope="row">300px / 250px Advertisment</th>
					<td>
						<p style="margin: 0px 0px 5px 0px;">Displayed on Featured Section (homepage), Single Post and Archive Sidebar.</p>
						<textarea name="big_ad" cols="60" rows="7" id="big_ad"><?php echo get_option("big_ad"); ?></textarea>
					</td>
				</tr>
			</table>
			
			
		<div style="Display: block; height: 15px; width: 100%;"></div>
		<h2>News Sections:</h2>
		<p>News Sections are items displayed under latest posts on homepage (<a href="<?php bloginfo('template_directory'); ?>/images/help/newssections.jpg" title="News Sections Example">see image</a>). Select "Yes" or "No" under each category if you want it to be displayed as a news section or not.</p>
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Enable / Disable News Sections:</th>
				<td>
					<select name="ens">
						<option value="enable"<?php if(get_option('ens') == "enable") { echo ' selected="selected"'; } ?>><?php if(get_option('ens') == "enable") { echo "Enabled"; } else { echo "Enable"; } ?></option>
						<option value="disable"<?php if(get_option('ens') == "disable") { echo ' selected="selected"'; } ?>><?php if(get_option('ens') == "disable") { echo "Disabled"; } else { echo "Disable"; } ?></option>
					</select>
					<p style="margin: 0px;"><?php if(get_option('ens') !== NULE) { ?>News Sections are currently <span style="color: #D13E12; font-weight: strong;"><?php $ens = get_option('ens'); echo $ens; ?>d</span>.<?php } ?></p>
				</td>
			</tr>
			<tr valign="top" <?php $ens = get_option('ens'); if ($ens == "disable") { ?>style="display: none;"<?php } ?>>
				<th scope="row">Displayed Categories:</th>
				<td>
					<?php echo cat_display(); ?>
				</td>
			</tr>
		</table>

		<p class="submit">
			<input name="submitted" type="hidden" value="yes" />
			<input type="submit" name="Submit" value="Update &raquo;" />
		</p>
	</form>
	<table class="form-table">
		<tr>
			<th class="row">
				Donate! Help DailyWP.com!
			</th>
			<td>
				<p style="margin: 0px;">Brightness Theme is FREE! Help DailyWP.com to stay alive and provide more and more free stuff!</p>
				<p><form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----MIIHTwYJKoZIhvcNAQcEoIIHQDCCBzwCAQExggEwMIIBLAIBADCBlDCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20CAQAwDQYJKoZIhvcNAQEBBQAEgYCmqZqsWhNZYbuHQ89h1tWgW2g1YSJRIIRK0gkbebqqqEcCkmmFmp4a0YQorkjqV3Vcn+QCGB7RFg3gQyY43/OS/3OlWhTG8J0/pkZD4xmO4yMkXIrbIagG93cnD45HVrrDpdyws/LcN96jnLw6mhC+io/HvH3qtt1lzAPELJerqzELMAkGBSsOAwIaBQAwgcwGCSqGSIb3DQEHATAUBggqhkiG9w0DBwQIWTEZ0DT/pL2AgahYjVAubki7lBuvqwYwq2wvVFqCiTSadVwGKUkdEqZkhOyL95cAmo/m1Q9+/GOYGu3ifHDdveDbxiKH6wVr3WMSftLP8Pqj+QqeFT+v82wE/0nwLL+tKN5O7xuiDt7YAeeRJ3xqM76EFlQcGKzITjNEi3FdfZky5LfC6lOVrLJUOzuTO49P/hUPKc4EgjtUrnb5wpjzoZPdWfe5c3APf5d05Y7XWP5gtGmgggOHMIIDgzCCAuygAwIBAgIBADANBgkqhkiG9w0BAQUFADCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20wHhcNMDQwMjEzMTAxMzE1WhcNMzUwMjEzMTAxMzE1WjCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20wgZ8wDQYJKoZIhvcNAQEBBQADgY0AMIGJAoGBAMFHTt38RMxLXJyO2SmS+Ndl72T7oKJ4u4uw+6awntALWh03PewmIJuzbALScsTS4sZoS1fKciBGoh11gIfHzylvkdNe/hJl66/RGqrj5rFb08sAABNTzDTiqqNpJeBsYs/c2aiGozptX2RlnBktH+SUNpAajW724Nv2Wvhif6sFAgMBAAGjge4wgeswHQYDVR0OBBYEFJaffLvGbxe9WT9S1wob7BDWZJRrMIG7BgNVHSMEgbMwgbCAFJaffLvGbxe9WT9S1wob7BDWZJRroYGUpIGRMIGOMQswCQYDVQQGEwJVUzELMAkGA1UECBMCQ0ExFjAUBgNVBAcTDU1vdW50YWluIFZpZXcxFDASBgNVBAoTC1BheVBhbCBJbmMuMRMwEQYDVQQLFApsaXZlX2NlcnRzMREwDwYDVQQDFAhsaXZlX2FwaTEcMBoGCSqGSIb3DQEJARYNcmVAcGF5cGFsLmNvbYIBADAMBgNVHRMEBTADAQH/MA0GCSqGSIb3DQEBBQUAA4GBAIFfOlaagFrl71+jq6OKidbWFSE+Q4FqROvdgIONth+8kSK//Y/4ihuE4Ymvzn5ceE3S/iBSQQMjyvb+s2TWbQYDwcp129OPIbD9epdr4tJOUNiSojw7BHwYRiPh58S1xGlFgHFXwrEBb3dgNbMUa+u4qectsMAXpVHnD9wIyfmHMYIBmjCCAZYCAQEwgZQwgY4xCzAJBgNVBAYTAlVTMQswCQYDVQQIEwJDQTEWMBQGA1UEBxMNTW91bnRhaW4gVmlldzEUMBIGA1UEChMLUGF5UGFsIEluYy4xEzARBgNVBAsUCmxpdmVfY2VydHMxETAPBgNVBAMUCGxpdmVfYXBpMRwwGgYJKoZIhvcNAQkBFg1yZUBwYXlwYWwuY29tAgEAMAkGBSsOAwIaBQCgXTAYBgkqhkiG9w0BCQMxCwYJKoZIhvcNAQcBMBwGCSqGSIb3DQEJBTEPFw0wODA2MTgxNDIyNThaMCMGCSqGSIb3DQEJBDEWBBS30ooc1+gi/HK7bkvmm0yboLXIcjANBgkqhkiG9w0BAQEFAASBgFj45hXR4SOFGqDrTMh1smq3BvENBnL76+A0sdw9+r22bmHHpSaAjoJoyd88+IaFRv5WIEMglmXuDe9iniBjwd+xCn5iiOpn37XKfewSiqH9HAaxN90mzJOVxQtQ5PuuhFSHK+tQJKBDFBFephI4GY5ixy/PtvY102F19K7hUrZD-----END PKCS7-----
">
</form></p>
			</td>
		</tr>
	</table>
</div>

<?php 
}

function brightness_settings() { // Adds Dashboard Menu Item
	add_menu_page('Brightness Settings', 'Brightness Settings', 'edit_themes', __FILE__, 'brightness');
}

function brightnesspage_css() { // Adds Dashboard Head Style
	echo "
		<style type=\"text/css\">
			.category-select { display: block; background: #ffffff; padding: 10px; margin-bottom: 10px; }
			.category-select h3 { margin: 0px 0px 5px 0px; color: #555555; }
			.category-select h3 strong { font-size: 18px; color: #000000; }
			.category-select .option { width: 60px; padding: 3px; background: #EAF3FA; float: left; display: block; margin-right: 6px; }
		</style>
	";
}

?>