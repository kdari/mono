jQuery(document).ready(function($) {
	$( '.vfbp-form' ).parsley({
		namespace: 'data-vfb-',
		errorClass: 'vfb-has-error',
		successClass: 'vfb-has-success',
		classHandler: function(ParsleyField) {
	        return ParsleyField.$element.parents( 'div[class*="vfb-col-"]' );
	    },
	    errorsContainer: function(ParsleyField) {
		    return ParsleyField.$element.parents( 'div[class*="vfb-col-"]' );
	    },
	    errorsWrapper: '<span class="vfb-help-block">',
		errorTemplate: '<div></div>',
		excluded: 'input[type=button], input[type=submit], input[type=reset], input[type=hidden], [disabled], :hidden'
	});

	if ( $.fn.phoenix ) {
		$( '.vfbp-form' ).submit( function() {
			if ( $( '.vfbp-form' ).parsley( 'isValid' ) ) {
				$( '.vfbp-form :input' ).phoenix( 'remove' );
			}
		});
	}
});