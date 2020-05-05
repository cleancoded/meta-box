( function ( $, cleancoded ) {
	'use strict';

	/**
	 * Update text value.
	 */
	function update() {
		var $this = $( this ),
			$output = $this.siblings( '.cleancoded-output' );

		$this.on( 'input propertychange change', function () {
			$output.html( $this.val() );
		} );
	}

	function init( e ) {
		$( e.target ).find( '.cleancoded-range' ).each( update );
	}

	cleancoded.$document
		.on( 'mb_ready', init )
		.on( 'clone', '.cleancoded-range', update );
} )( jQuery, cleancoded );
