( function ( $, cleancoded ) {
	'use strict';

	var file = {};

	/**
	 * Handles a click on add new file.
	 * Expects `this` to equal the clicked element.
	 *
	 * @param event Click event.
	 */
	file.addHandler = function ( event ) {
		event.preventDefault();

		var $this = $( this ),
			$clone = $this.prev().clone();

		$clone.insertBefore( this ).val( '' );

		var $fieldInput = $this.closest( '.cleancoded-input' );
		file.updateVisibility.call( $fieldInput.find( '.cleancoded-uploaded' ) );
		file.setRequired.call( $fieldInput );
	};

	/**
	 * Handles a click on delete new file.
	 * Expects `this` to equal the clicked element.
	 *
	 * @param event Click event.
	 */
	file.deleteHandler = function ( event ) {
		event.preventDefault();

		var $this = $( this ),
			$item = $this.closest( 'li' ),
			$uploaded = $this.closest( '.cleancoded-uploaded' ),
			$metaBox = $uploaded.closest( '.cleancoded-meta-box' );

		$item.remove();
		file.updateVisibility.call( $uploaded );

		file.setRequired.call( $uploaded.parent() );

		if ( 1 > $uploaded.data( 'force_delete' ) ) {
			return;
		}

		$.post( ajaxurl, {
			action: 'cleancoded_delete_file',
			_ajax_nonce: $uploaded.data( 'delete_nonce' ),
			field_id: $uploaded.data( 'field_id' ),
			object_type: $metaBox.data( 'object-type' ),
			object_id: $metaBox.data( 'object-id' ),
			attachment_id: $this.data( 'attachment_id' )
		}, function ( response ) {
			if ( ! response.success ) {
				alert( response.data );
			}
		}, 'json' );
	};

	/**
	 * Sort uploaded files.
	 * Expects `this` to equal the uploaded file list.
	 */
	file.sort = function () {
		$( this ).sortable( {
			items: 'li',
			start: function ( event, ui ) {
				ui.placeholder.height( ui.helper.outerHeight() );
				ui.placeholder.width( ui.helper.outerWidth() );
			},
			update: function( event, ui ) {
				ui.item.find( cleancoded.inputSelectors ).first().trigger( 'mb_change' );
			}
		} );
	};

	/**
	 * Update visibility of upload inputs and Add new file link.
	 * Expect this equal to the uploaded file list.
	 */
	file.updateVisibility = function () {
		var $uploaded = $( this ),
			max = parseInt( $uploaded.data( 'max_file_uploads' ), 10 ),
			$new = $uploaded.siblings( '.cleancoded-file-new' ),
			$add = $new.find( '.cleancoded-file-add' ),
			numFiles = $uploaded.children().length,
			numInputs = $new.find( '.cleancoded-file-input' ).length;

		$uploaded.toggle( 0 < numFiles );
		if ( 0 === max ) {
			return;
		}
		$new.toggle( numFiles < max );
		$add.toggle( numFiles + numInputs < max );
	};

	// Reset field when cloning.
	file.resetClone = function() {
		var $this = $( this ),
			$clone = $this.closest( '.cleancoded-clone' ),
			$list = $clone.find( '.cleancoded-uploaded' ),
			$key = $clone.find( '.cleancoded-file-index' ),
			inputName = '_file_' + cleancoded.uniqid();

		$list.empty();
		$clone.find( '.cleancoded-file-input' ).attr( 'name', inputName + '[]' ).not( ':first' ).remove();

		$key.val( inputName );

		file.updateVisibility.call( $list );
	};

	// Set 'required' attribute. 'this' is the wrapper field input.
	file.setRequired = function() {
		var $this = $( this ),
			$uploaded = $this.find( '.cleancoded-uploaded' ),
			$inputs = $this.find( '.cleancoded-file-new input' );
		$inputs.prop( 'required', false );

		if ( $uploaded.children().length ) {
			return;
		}

		var $firstInput = $inputs.first();
		if ( 1 === $firstInput.data( 'required' ) ) {
			$firstInput.prop( 'required', true );
		}
	};

	function init( e ) {
		var $el = $( e.target ),
			$uploaded = $el.find( '.cleancoded-uploaded' );

		$uploaded.each( file.sort );
		$uploaded.each( file.updateVisibility );

		$el.find( '.cleancoded-file-wrapper' ).each( file.setRequired );
	}

	cleancoded.$document
		.on( 'mb_ready', init )
		.on( 'click', '.cleancoded-file-add', file.addHandler )
		.on( 'click', '.cleancoded-file-delete', file.deleteHandler )
		.on( 'clone', '.cleancoded-file-input', file.resetClone );
} )( jQuery, cleancoded );
