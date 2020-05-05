( function ( $, _, cleancoded ) {
	'use strict';

	/**
	 * Show preview of oembeded media.
	 */
	function showPreview( e ) {
		e.preventDefault();

		var $this = $( this ),
			$spinner = $this.siblings( '.spinner' ),
			data = {
				action: 'cleancoded_get_embed',
				url: this.value,
				not_available: $this.data( 'not-available' ),
			};

		$spinner.css( 'visibility', 'visible' );
		$.post( ajaxurl, data, function ( response ) {
			$spinner.css( 'visibility', 'hidden' );
			$this.siblings( '.cleancoded-embed-media' ).html( response.data );
		}, 'json' );
	}

	/**
	 * Remove oembed preview when cloning.
	 */
	function removePreview() {
		$( this ).siblings( '.cleancoded-embed-media' ).html( '' );
	}

	cleancoded.$document
		.on( 'change', '.cleancoded-oembed', _.debounce( showPreview, 250 ) )
	    .on( 'clone', '.cleancoded-oembed', removePreview );
} )( jQuery, _, cleancoded );
