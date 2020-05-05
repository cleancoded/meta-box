( function ( $, cleancoded ) {
	'use strict';

	function setActiveClass() {
		var $this = $( this ),
			type = $this.attr( 'type' ),
			selected = $this.is( ':checked' ),
			$parent = $this.parent(),
			$others = $parent.siblings();
		if ( selected ) {
			$parent.addClass( 'cleancoded-active' );
			if ( type === 'radio' ) {
				$others.removeClass( 'cleancoded-active' );
			}
		} else {
			$parent.removeClass( 'cleancoded-active' );
		}
	}

	function init( e ) {
		$( e.target ).find( '.cleancoded-image-select input' ).trigger( 'change' );
	}

	cleancoded.$document
		.on( 'mb_ready', init )
		.on( 'change', '.cleancoded-image-select input', setActiveClass );
} )( jQuery, cleancoded );
