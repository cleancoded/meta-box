( function ( $, cleancoded ) {
	'use strict';

	function toggleTree() {
		var $this = $( this ),
			$children = $this.closest( 'li' ).children( 'ul' );

		if ( $this.is( ':checked' ) ) {
			$children.removeClass( 'hidden' );
		} else {
			$children.addClass( 'hidden' ).find( 'input' ).prop( 'checked', false );
		}
	}

	function toggleAll( e ) {
		e.preventDefault();

		var $this = $( this ),
			checked = $this.data( 'checked' );

		if ( undefined === checked ) {
			checked = true;
		}

		$this.parent().siblings( '.cleancoded-input-list' ).find( 'input' ).prop( 'checked', checked ).trigger( 'change' );

		checked = ! checked;
		$this.data( 'checked', checked );
	}

	function init( e ) {
		$( e.target ).find( '.cleancoded-input-list.cleancoded-collapse input[type="checkbox"]' ).each( toggleTree );
	}

	cleancoded.$document
		.on( 'mb_ready', init )
		.on( 'change', '.cleancoded-input-list.cleancoded-collapse input[type="checkbox"]', toggleTree )
		.on( 'clone', '.cleancoded-input-list.cleancoded-collapse input[type="checkbox"]', toggleTree )
		.on( 'click', '.cleancoded-input-list-select-all-none', toggleAll );
} )( jQuery, cleancoded );
