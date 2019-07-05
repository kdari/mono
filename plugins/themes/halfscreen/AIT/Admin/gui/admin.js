/**
 * AIT WordPress Framework
 *
 * Copyright (c) 2011, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */

jQuery(function(){

	// Colorpickers
	jQuery.fn.cp = function(){
		return this.each(function(){
			var $input = jQuery(this),
				myColor = $input.val();

			$input.css({'border-left-width': '15px'});
			$input.css({'border-left-color': myColor});

			$input.ColorPicker({
				color: myColor,
				onSubmit: function(hsb, hex, rgb, el) {
					jQuery(el).val( '#' + hex);
					jQuery(el).ColorPickerHide();
				},
				onBeforeShow: function () {
					jQuery(this).ColorPickerSetColor(this.value);
					$input.css({'border-left-color': this.value});
				},
				onChange: function (hsb, hex, rgb){
					$input.val('#' + hex);
					$input.css({'border-left-color': '#' + hex});
				}
			}).bind('keyup', function(){
				jQuery(this).ColorPickerSetColor('#' + this.value);
			});
		});
	}

	jQuery('.ait-colorpicker').cp();



	// Help tooltip
	jQuery('.ait-form-table-help-label').hover(function(){
			jQuery(this).find('.ait-form-table-help-tooltip').stop(true).fadeIn(150);
		},
		function(){
			jQuery(this).find('.ait-form-table-help-tooltip').fadeOut(150);
	}).click(function(e){e.preventDefault();});


	// Forum iframe height
	jQuery('#ait-dashboard-page').find('#ait-support-forum').height(jQuery('body').height() - 175);

	jQuery(window).resize(function() {
		jQuery('#ait-dashboard-page').find('#ait-support-forum').height(jQuery('body').height() - 175);
	});



	// Media select button
	var mediaUpload = '';

	var $mediaSelect = jQuery('input[type="button"].media-select');

	if($mediaSelect.length){

		var formfield=null;
		$mediaSelect.click(function(){
			var buttonID = jQuery(this).attr("id").toString();
			var inputID = buttonID.replace("_selectMedia", "");
			mediaUpload = inputID;
			formfield = inputID;
			tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
			jQuery('#TB_overlay,#TB_closeWindowButton').bind("click",function(){formfield=null;});
			return false;
		});

		var formfield=null;
		window.original_send_to_editor = window.send_to_editor;
		window.send_to_editor = function(html) {
			if (formfield) {
				var imgUrl = jQuery('img', html).attr('src');
				jQuery('#'+mediaUpload).val(imgUrl);
				tb_remove();
			} else {
				window.original_send_to_editor(html);
			}
			formfield=null;
		}
	}

	jQuery("#ait-theme-doc-single a[href$='gif']").colorbox({maxHeight:"95%"});
	jQuery("#ait-theme-doc-single a[href$='jpg']").colorbox({maxHeight:"95%"});
	jQuery("#ait-theme-doc-single a[href$='png']").colorbox({maxHeight:"95%"});

});