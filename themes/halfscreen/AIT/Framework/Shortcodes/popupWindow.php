<?php
require '../../../../../../wp-load.php';

$data = NNeon::decode(file_get_contents('./'.$_REQUEST['plugin'].'/config.neon', true));

?>

<script type="text/javascript">	
		
    	jQuery('#popup-shortcode-form .ait-colorpicker').cp();
    	   	
    	// init show only selected type
		jQuery('#popup-shortcode-form select.type-select option:selected[class^="shortcodeName-"]').each(function(index) {
			var className = jQuery(this).attr('class');
			var showedName = className.replace("shortcodeName-","");
			
			jQuery('#popup-shortcode-form tr').hide();
			jQuery('#popup-shortcode-form tr.type-'+showedName).show();
			jQuery('#popup-shortcode-form tr.type-all').show();
		});
		// show by actual selected item
		jQuery('#popup-shortcode-form select.type-select').change(function () {
			jQuery("#popup-shortcode-form select.type-select option:selected").each(function () {
				var className = jQuery(this).attr('class');
				var showedName = className.replace("shortcodeName-","");
				
				jQuery('#popup-shortcode-form tr').hide();
				jQuery('#popup-shortcode-form tr.type-'+showedName).show();
				jQuery('#popup-shortcode-form tr.type-all').show();
			});
		});
		
		jQuery('#popup-shortcode-form .button.submit').click(function() {
			
			var shortcodeName = '<?php echo $data['shortcodeName']; ?>';
	    	var shortcodeAttr = '';
	    	var paired = '<?php echo $data['paired']; ?>';
	    	var insertContent = '<?php echo $data['insertContent']; ?>';
	    	var content = '<?php echo $data['content']; ?>';
	    	
	    	var shortcodeType = 'all';
	    	
	    	// seleced shortcode type
			jQuery('#popup-shortcode-form select.type-select option:selected[class^="shortcodeName-"]').each(function(index) {
				var className = jQuery(this).attr('class');
				// rename shortcode name
				shortcodeName = className.replace("shortcodeName-","");
				
				shortcodeType = shortcodeName;
			});
	    	// textfield
		    jQuery('#popup-shortcode-form input:text').each(function(){
		    	if(!jQuery(this).hasClass('hide-option') && (jQuery(this).hasClass('type-'+shortcodeType) || jQuery(this).hasClass('type-all'))){
		    		shortcodeAttr += ' ' + jQuery(this).attr('name') + '="' + jQuery(this).val() + '"';
		    	}
		    });
		    // checkbox
		    jQuery('#popup-shortcode-form input:checkbox').each(function(){
		    	if(!jQuery(this).parent().hasClass('hide-option') && (jQuery(this).parent().hasClass('type-'+shortcodeType) || jQuery(this).parent().hasClass('type-all'))){
			    	if(jQuery(this).is(':checked')){
			    		shortcodeAttr += ' ' + jQuery(this).attr('name') + '="yes"';
			    	} else {
			    		shortcodeAttr += ' ' + jQuery(this).attr('name') + '="no"';
			    	}
		    	}
		    });
		    // select
		    jQuery('#popup-shortcode-form select option:selected').each(function(index) {
		    	if(!jQuery(this).parent().hasClass('hide-option') && (jQuery(this).parent().hasClass('type-'+shortcodeType) || jQuery(this).parent().hasClass('type-all'))){
					shortcodeAttr += ' ' + jQuery(this).parent().attr('name') + '="' + jQuery(this).val() + '"';
				}
			});
			
	    	// generate shortcode string
	    	if(paired == '1'){
	    		if(insertContent == '1'){
	    			var shortcodeString = '[' + shortcodeName + shortcodeAttr + ']' + tinyMCE.activeEditor.selection.getContent() + '[/' + shortcodeName + ']'; 
	    		} else {
	    			var shortcodeString = '[' + shortcodeName + shortcodeAttr + ']' + content + '[/' + shortcodeName + ']'; 
	    		}
	    	} else {
	    		var shortcodeString = '[' + shortcodeName + shortcodeAttr + ']';
	    	}
	    	
	        // insert shortcode
	        tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, shortcodeString );
			
			tb_remove();	
		});

</script>

<?php
if(!empty($data['popupOptions'])){
	
	echo '<h3 class="media-title">'.$data['title'].' Options</h3>';
	
	echo '<form id="popup-shortcode-form" name="shortcode-form">';	
	echo '<table class="form-table">';
	
	foreach ($data['popupOptions'] as $key => $value) {
		
		echo '<tr class="type-'.$value['class'].'">';
		
		echo '<th>'.$value['label'].': </th>';
		echo '<td>';
		// textfield
		if($value['type'] == 'text'){
				
			echo '<input type="text" id="ait-'.$key.'" name="'.$key.'" value="'.$value['default'].'" class="regular-text type-'.$value['class'].'">';
		
		// image-select
		} elseif($value['type'] == 'image-url'){
				
			echo '<input type="text" id="ait-'.$key.'" name="'.$key.'" value="'.$value['default'].'" class="regular-text type-'.$value['class'].'">';
			echo '<input type="button" value="Select Image" class="media-select" id="ait-'.$key.'_selectMedia" name="'.$key.'_selectMedia" >';
			
		// colorpicker
		} elseif($value['type'] == 'colorpicker'){
				
			echo '<input type="text" id="ait-'.$key.'" name="'.$key.'" value="'.$value['default'].'" class="ait-colorpicker type-'.$value['class'].'">';
		
		// select-language
		} elseif($value['type'] == 'select-language'){
			
			// require WPML plugin
			$languages = icl_get_languages('skip_missing=0');
			
			echo '<select id="ait-'.$key.'" name="'.$key.'" class="type-'.$value['class'].'">';
			foreach($languages as $language){
				echo '<option value="'.$language['language_code'].'">'.$language['translated_name'].' ('.$language['native_name'].')</option>';
			}
			echo '</select>';
		
		// select-category
		} elseif($value['type'] == 'select-category'){
			
			if($value['category']) $category = 'ait-'.$value['category'].'-category'; else $category = 'category';
			
			wp_dropdown_categories(array(
				'name' => esc_attr($key),
				'id' => 'ait-' . esc_attr($key),
				'class' => "type-".$value['class'],
				'taxonomy' => $category,
				'show_option_all' => __('All', THEME_CODE_NAME),
				'hide_empty' => 0,
				'show_count' => 1
			));
			
		// select-page
		} elseif($value['type'] == 'select-page'){
			
			if($value['pageType']) $pageType = 'ait-'.$value['pageType']; else $pageType = 'post';
			
			wp_dropdown_pages(array(
				'post_type' => 'page'
			));
		
		// select
		} elseif($value['type'] == 'select' || $value['type'] == 'type-select') {
			
			if($value['type'] == 'type-select') $hide = 'hide-option type-select'; else $hide = '';
			
			echo '<select id="ait-'.$key.'" name="'.$key.'" class="'.$hide.' type-'.$value['class'].'">';
			foreach($value['default'] as $k => $v){
				if($v['checked'] == 'true') $checked = ' selected'; else $checked = '';
				
				if($value['type'] == 'type-select'){
					echo '<option value="'.$k.'"'.$checked.' class="shortcodeName-'.$v['shortcodeName'].'">'.$v['label'].'</option>';
				} else {
					echo '<option value="'.$k.'"'.$checked.'>'.$v['label'].'</option>';
				}
			}
			echo '</select>';
		// checkbox
		} elseif($value['type'] == 'checkbox'){
			echo '<input type="checkbox" id="ait-'.$key.'" name="'.$key.'" class="type-'.$value['class'].'">';
		}
		echo '</td>';
		
		echo '</tr>';
		
	}
	
	echo '<tr class="type-all"><td><input type="button" value="Insert" class="button submit"></td></tr>';
	
	echo '</table></form>';

}
?>