<?php
$themename = "Fotofolio";
$shortname = "ftfl";
$dbprefixname = $wpdb->prefix .'terms';

$ftfl_categories = $wpdb->get_results(
						"SELECT name FROM ".$dbprefixname." WHERE 1 ORDER BY 'term_id' ASC LIMIT 0 , 30"
					);
$ftfl_categories_list = array();

foreach($ftfl_categories as $ftflcat){
    $ftfl_categories_list[] = $ftflcat->name;
}

$options = array (

	array(	"name" => "Theme Settings",
			"type" => "title"),
			
	array(	"type" => "open"),
	
	array(	"name" => "Title",
			"desc" => "the title of your fotofolio website.",
			"id" => $shortname."_welcome_title",
			"std" => "",
			"type" => "text"),
			
	array(	"name" => "Message",
			"desc" => "Brief introduction into your fotofolio theme.",
            "id" => $shortname."_welcome_message",
            "std" => "your introduction, change this in your fotofolio option page",
            "type" => "textarea"),
        
	array(	"name" => "Full Name",
			"desc" => "your Full Name eg. Pupung Budi Purnama",
            "id" => $shortname."_full_name",
            "std" => "your name",
            "type" => "text"),
            
	array(	"name" => "Short Biography",
			"desc" => "Your short biography",
            "id" => $shortname."_short_bio",
            "type" => "textarea"),
            
	array(	"name" => "Your Email",
			"desc" => "your email, for displaying gravatar, register in gravatar.com",
            "id" => $shortname."_email",
            "type" => "text"),
	
	array(    "name" => "Homepage Slideshow",
		  		"desc" => "Category to play on homepage slideshow",
              "id" => $shortname."_home_slideshow",
              "std" => "Featured",
              "type" => "select",
              "options" => $ftfl_categories_list),
	
	array (		"name" => "Slideshow Number",
		   		"desc" => "Number of Slideshow, Best is 5, Think about loading time!",
				"id" => $shortname."_num_slideshow",
				"std" => "",
				"type" => "select",
				"options" => array ("1","2","3","4","5","6","7")),
	
	array (		"name" => "Latest Additions number",
		   		"desc" => "Latest additions number show on homepage",
				"id" => $shortname."_num_latest",
				"std" => "",
				"type" => "select",
				"options" => array ("1","2","3","4","5","6","7","8","9","10","11","12")),
	
	array (		"name" => "Show EXIF",
		   		"desc" => "Show EXIF of your Photo",
				"id" => $shortname."_exif",
				"std" => "false",
				"type" => "checkbox"),
	
	array(	"type" => "close")
	
);

function mytheme_add_admin() {

    global $themename, $shortname, $options;

    if ( $_GET['page'] == basename(__FILE__) ) {
    
        if ( 'save' == $_REQUEST['action'] ) {

                foreach ($options as $value) {
                    update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }

                foreach ($options as $value) {
                    if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }

                header("Location: themes.php?page=functions.php&saved=true");
                die;

        } else if( 'reset' == $_REQUEST['action'] ) {

            foreach ($options as $value) {
                delete_option( $value['id'] ); }

            header("Location: themes.php?page=functions.php&reset=true");
            die;

        }
    }

    add_theme_page($themename." Options", "".$themename." Options", 'edit_themes', basename(__FILE__), 'mytheme_admin');

}

function mytheme_admin() {

    global $themename, $shortname, $options;

    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
    if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
    
?>
<div class="wrap">
<h2><?php echo $themename; ?> settings</h2>

<form method="post">



<?php foreach ($options as $value) { 
    
	switch ( $value['type'] ) {
	
		case "open":
		?>
        <table width="100%" border="0" style="padding:10px;">
		
        
        
		<?php break;
		
		case "close":
		?>
		
        </table><br />
        
        
		<?php break;
		
		case "title":
		?>
		<table width="100%" border="0" style="background-color:#efefef; padding:5px 10px;"><tr>
        	<td colspan="2"><h3 style="font-family:Georgia,'Times New Roman',Times,serif;"><?php echo $value['name']; ?></h3></td>
        </tr>
                
        
		<?php break;

		case 'text':
		?>
        
        <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
            <td width="80%"><input style="width:400px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" /></td>
        </tr>

        <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
        </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

		<?php 
		break;
		
		case 'textarea':
		?>
        
        <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
            <td width="80%"><textarea name="<?php echo $value['id']; ?>" style="width:400px; height:100px;" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?></textarea></td>
            
        </tr>

        <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
        </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

		<?php 
		break;
		
		case 'select':
		?>
        <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
            <td width="80%"><select style="width:240px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php foreach ($value['options'] as $option) { ?><option<?php if ( get_settings( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?></select></td>
       </tr>
                
       <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
       </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

		<?php
        break;
            
		case "checkbox":
		?>
            <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
                <td width="80%"><? if(get_settings($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
                        <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
                        </td>
            </tr>
                        
            <tr>
                <td><small><?php echo $value['desc']; ?></small></td>
           </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>
            
        <?php 		break;
	
 
} 
}
?>

<!--</table>-->

<p class="submit">
<input name="save" type="submit" value="Save changes" />    
<input type="hidden" name="action" value="save" />
</p>
</form>
<form method="post">
<p class="submit">
<input name="reset" type="submit" value="Reset" />
<input type="hidden" name="action" value="reset" />
</p>
</form>

<?php
}

add_action('admin_menu', 'mytheme_add_admin'); ?>
<?php
if ( function_exists('register_sidebar') )
	register_sidebar(array(
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '',
        'after_title' => '',
    ));
	
function ConvertToFraction($v, &$n, &$d) {
	$MaxTerms = 15;         // Limit to prevent infinite loop
	$MinDivisor = 0.000001; // Limit to prevent divide by zero
	$MaxError = 0.00000001; // How close is enough

	$f = $v; // Initialize fraction being converted

	$n_un = 1; // Initialize fractions with 1/0, 0/1
	$d_un = 0;
	$n_deux = 0;
	$d_deux = 1;

	for ($i = 0; $i<$MaxTerms; $i++)
	{
		$a = floor($f); // Get next term
		$f = $f - $a; // Get new divisor
		$n = $n_un * $a + $n_deux; // Calculate new fraction
		$d = $d_un * $a + $d_deux;
		$n_deux = $n_un; // Save last two fractions
		$d_deux = $d_un;
		$n_un = $n;
		$d_un = $d;

		if ($f < $MinDivisor) // Quit if dividing by zero
			break;

		if (abs($v - $n / $d) < $MaxError)
			break;

		$f = 1 / $f; // Take reciprocal
	}
}

function mooz_get_meta($attachment_id) {
	$metas = array(
		'iso'=>'',
		'cam'=>'',
		'foc'=>'',
		'ape'=>'',
		'dat'=>'',
		'shu'=>'');
	$imgmt = wp_get_attachment_metadata($attachment_id);
	if( empty($imgmt['image_meta']) ) return $metas;
	if( $imgmt[image_meta][camera] == '' && $imgmt[image_meta][iso] == 0 && $imgmt[image_meta][focal_length] == 0 ):
		return $metas;
	else:
		$metas['iso'] = $imgmt[image_meta][iso];
		$metas['foc'] = $imgmt[image_meta][focal_length] . ' mm';
		$metas['cam'] = $imgmt[image_meta][camera];
		$metas['ape'] = 'f/' . $imgmt[image_meta][aperture];
		$metas['dat'] = get_the_time(get_option('date_format'),$imgmt[image_meta][created_timestamp]);
		$xshu = $imgmt[image_meta][shutter_speed];
		if ($xshu > 1) $xshu = floor($xshu);
		if( $xshu > 0 ):
			$n=0; $d=0;
			ConvertToFraction($xshu, $n, $d);
			if ($n >= 1 && $d == 1) $num = $n.' sec';
			else $num = $n.'/'.$d.' sec';
		else:
			$num = $num;
		endif;
		$metas['shu'] = $num;
	endif;
	return $metas;
}

?>