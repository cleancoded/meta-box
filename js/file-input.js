( function ( $, cleancoded ) {
	'use strict';

	var frame;

	function openSelectPopup( e ) {
		e.preventDefault();
		var $el = $( this );

		// Create a frame only if needed
		if ( ! frame ) {
			frame = wp.media( {
				className: 'media-frame cleancoded-file-frame',
				multiple: false,
				title: cleancodedFileInput.frameTitle
			} );
		}

		// Open media uploader
		frame.open();

		// Remove all attached 'select' event
		frame.off( 'select' );

		// Handle selection
		frame.on( 'select', function () {
			var url = frame.state().get( 'selection' ).first().toJSON().url;
			$el.siblings( 'input' ).val( url ).trigger( 'change' ).siblings( 'a' ).removeClass( 'hidden' );
		} );
	}

	function clearSelection( e ) {
		e.preventDefault();
		$( this ).addClass( 'hidden' ).siblings( 'input' ).val( '' ).trigger( 'change' );
	}

	function hideRemoveButtonWhenCloning() {
		$( this ).siblings( '.cleancoded-file-input-remove' ).addClass( 'hidden' );
	}

	cleancoded.$document
		.on( 'click', '.cleancoded-file-input-select', openSelectPopup )
		.on( 'click', '.cleancoded-file-input-remove', clearSelection )
		.on( 'clone', '.cleancoded-file_input', hideRemoveButtonWhenCloning );
} )( jQuery, cleancoded );
