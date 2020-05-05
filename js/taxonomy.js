( function ( $, cleancoded ) {
	'use strict';

	function toggleAddInput( e ) {
		e.preventDefault();
		this.nextElementSibling.classList.toggle( 'cleancoded-hidden' );
	}

	cleancoded.$document.on( 'click', '.cleancoded-taxonomy-add-button', toggleAddInput );
} )( jQuery, cleancoded );
