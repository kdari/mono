// JavaScript Document

jQuery(function() {
	
	jQuery("#accordion").accordion({
		autoHeight: false
	});
	
	jQuery('a[rel=tipsy]').tipsy({gravity: 'sw'});
	
	jQuery("#display-volume").html(jQuery("#hidden-volume").val());
	jQuery("#slider").slider({
		range: "min",
		value: jQuery("#hidden-volume").val(),
		min: 0,
		max: 200,
		slide: function(event, ui) {
			jQuery("#display-volume").html(ui.value);
			jQuery("#hidden-volume").val(ui.value);
		}
	});
	
	//Border
	jQuery('#bgcolor-picker').farbtastic('#bgcolor');
	jQuery('#bgcolor1-picker').farbtastic('#bgcolor1');
	jQuery('#bgcolor2-picker').farbtastic('#bgcolor2');
	
	//Colors of the player bar
	jQuery('#playercolor-picker').farbtastic('#playercolor');
	jQuery('#loadingcolor-picker').farbtastic('#loadingcolor');
	jQuery('#buttoncolor-picker').farbtastic('#buttoncolor');
	jQuery('#buttonovercolor-picker').farbtastic('#buttonovercolor');
	jQuery('#slidercolor1-picker').farbtastic('#slidercolor1');
	jQuery('#slidercolor2-picker').farbtastic('#slidercolor2');
	jQuery('#sliderovercolor-picker').farbtastic('#sliderovercolor');
	
	//Buffer display
	jQuery('#buffercolor-picker').farbtastic('#buffercolor');
	jQuery('#bufferbgcolor-picker').farbtastic('#bufferbgcolor');
	
	//Title
	jQuery('#titlecolor-picker').farbtastic('#titlecolor');
	
	//Subtitles
	jQuery('#srtcolor-picker').farbtastic('#srtcolor');
	jQuery('#srtbgcolor-picker').farbtastic('#srtbgcolor');
	
	//Video icons
	jQuery('#iconplaycolor-picker').farbtastic('#iconplaycolor');
	jQuery('#iconplaybgcolor-picker').farbtastic('#iconplaybgcolor');
	
	//Miscellaneous
	jQuery('#videobgcolor-picker').farbtastic('#videobgcolor');
	
	//Color picker focus handler
	jQuery('#bgcolor, #bgcolor1, #bgcolor2, #playercolor, #loadingcolor, #buttoncolor, #buttonovercolor, #slidercolor1, #slidercolor2, #sliderovercolor, #buffercolor, #bufferbgcolor, #titlecolor, #srtcolor, #srtbgcolor, #iconplaycolor, #iconplaybgcolor, #videobgcolor').focus(function() {
		jQuery(this).next().next().show();
	});
	
	//Color picker blur handler
	jQuery('#bgcolor, #bgcolor1, #bgcolor2, #playercolor, #loadingcolor, #buttoncolor, #buttonovercolor, #slidercolor1, #slidercolor2, #sliderovercolor, #buffercolor, #bufferbgcolor, #titlecolor, #srtcolor, #srtbgcolor, #iconplaycolor, #iconplaybgcolor, #videobgcolor').blur(function() {
		jQuery(this).next().next().hide();
	});
	
	jQuery('#wposflv-options-form').submit(function(){
		$result = true;
		$checkInputs = jQuery(this).find('.validate-color');
		$checkInputs.next().hide();
		var pattern = new RegExp(/^#([0-9a-fA-F]{6})$/);
		for(i=0; i<$checkInputs.length; i++) {			
			if(!pattern.test($checkInputs.eq(i).val())) {
				$checkInputs.eq(i).next().show();
				$result = false;
			}
		}
		return $result;
	})
});