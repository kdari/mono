jQuery.noConflict();

jQuery(document).ready(function () {
	jQuery(".toggle-container").hide();
	jQuery("#al_body_font, #al_headings_font, #al_menu_font").after('<div class="font-preview"></div>');
    if (jQuery('.color-picker').size() > 0) {
        jQuery('.color-picker').ColorPicker({
            onSubmit: function (hsb, hex, rgb, el) {
                jQuery(el).val('#' + hex);
                jQuery(el).ColorPickerHide();
            },
            onBeforeShow: function () {
                jQuery(this).ColorPickerSetColor(this.value);
            }
        }).bind('keyup', function () {
            jQuery(this).ColorPickerSetColor(this.value);
        });
    }
	
	// Drag & Drop sorting 
	
	jQuery(function($) {
		$('#sortable-table tbody').sortable({
			axis: 'y',
			handle: '.column-order img',
			placeholder: 'ui-state-highlight',
			forcePlaceholderSize: true,
			update: function(event, ui) {
				var theOrder = $(this).sortable('toArray');
	
				var data = {
					action: 'sneek_update_post_order',
					postType: $(this).attr('data-post-type'),
					order: theOrder
				};
	
				$.post(ajaxurl, data);
			}
		}).disableSelection();
	
	});
	
	jQuery(function($) {
		$('#sortable-table-portfolio tbody').sortable({
			axis: 'y',
			handle: '.column-order img',
			placeholder: 'ui-state-highlight',
			forcePlaceholderSize: true,
			update: function(event, ui) {
				var theOrder = $(this).sortable('toArray');
	
				var data = {
					action: 'portfolio_update_post_order',
					postType: $(this).attr('data-post-type'),
					order: theOrder
				};
	
				$.post(ajaxurl, data);
			}
		}).disableSelection();
	
	});
    
}) 