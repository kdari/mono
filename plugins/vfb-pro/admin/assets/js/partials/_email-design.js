jQuery(document).ready(function($) {
	// !Code Editor
	CodeMirror.defineMode( 'wordpress', function(config, parserConfig) {
		var wordpressOverlay = {
			token: function( stream ) {
				var ch;

				if ( stream.match( '[' ) ) {
					while ( typeof ( ch = stream.next() ) !== 'undefined' ) {
						if ( ch === ']' ) {
							break;
						}
					}

					return 'wordpress';
				}

				while ( typeof stream.next() !== 'undefined' && !stream.match( '[', false ) ) {}

				return null;
			}
		};

		return CodeMirror.overlayMode( CodeMirror.getMode( config, parserConfig.backdrop || 'htmlmixed'), wordpressOverlay );
	});

	if ( $( '#email-template' ).length ) {
		CodeMirror.fromTextArea( document.getElementById( 'email-template' ), {
	        lineNumbers: true,
	        lineWrapping: true,
	        mode: 'wordpress',
	        theme: 'base16-light'
	    });
    }

	// !Create color pickers
	$( '.vfb-color-picker' ).each( function() {
		var $this     = $( this ),
			id        = $this.attr( 'id' ),
			vfb_color = $( '#' + id );

		vfb_color.wpColorPicker({
            change: function(event, ui) {
                vfb_color.css( 'background-color', ui.color.toString() );
            },
            clear: function() {
                vfb_color.css( 'background-color', '' );
            }
        });
	});

	// !Tab in Textareas
	$( '#email-template' ).bind( 'keydown.vfbInsertTab', function(e) {
		var el = e.target, selStart, selEnd, val, scroll, sel;

		// Escape key
		if ( e.keyCode === 27 ) {
			$( el ).data( 'tab-out', true );
			return;
		}

		// Tab key
		if ( e.keyCode !== 9 || e.ctrlKey || e.altKey || e.shiftKey ) {
			return;
		}

		if ( $( el ).data( 'tab-out' ) ) {
			$( el ).data( 'tab-out', false );
			return;
		}

		selStart = el.selectionStart;
		selEnd   = el.selectionEnd;
		val      = el.value;

		// Not a standard DOM property, lastKey is to help stop Opera tab event. See blur handler below.
		try {
			this.lastKey = 9;
		}
		catch( err ) {
		}

		if ( document.selection ) {
			el.focus();
			sel = document.selection.createRange();
			sel.text = '\t';
		}
		else if ( selStart >= 0 ) {
			scroll   = this.scrollTop;
			el.value = val.substring( 0, selStart ).concat( '\t', val.substring( selEnd ) );
			el.selectionStart = el.selectionEnd = selStart + 1;
			this.scrollTop = scroll;
		}

		if ( e.stopPropagation ) {
			e.stopPropagation();
		}

		if ( e.preventDefault ) {
			e.preventDefault();
		}
	});

	$( '#email-template' ).bind('blur.vfbInsertTab', function() {
		if ( this.lastKey && 9 === this.lastKey ) {
			this.focus();
		}
	});

	// !Hide Font and Color options if Plain Text
	$( '#format' ).change( function() {
		var type = $( this ).val();

		$( '.vfb-email-type' ).hide();
		$( '#vfb-email-' + type ).show();
	});
});