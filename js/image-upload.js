( function ( $, cleancoded ) {
	'use strict';

	var views = cleancoded.views = cleancoded.views || {},
		ImageField = views.ImageField,
		ImageUploadField,
		UploadButton = views.UploadButton;

	ImageUploadField = views.ImageUploadField = ImageField.extend( {
		createAddButton: function () {
			this.addButton = new UploadButton( {controller: this.controller} );
		}
	} );

	function initImageUpload() {
		var $this = $( this ),
			view = $this.data( 'view' );

		if ( view ) {
			return;
		}

		view = new ImageUploadField( { input: this } );

		$this.siblings( '.cleancoded-media-view' ).remove();
		$this.after( view.el );

		// Init uploader after view is inserted to make wp.Uploader works.
		view.addButton.initUploader();

		$this.data( 'view', view );
	}

	function init( e ) {
		$( e.target ).find( '.cleancoded-image_upload, .cleancoded-plupload_image' ).each( initImageUpload );
	}

	cleancoded.$document
		.on( 'mb_ready', init )
		.on( 'clone', '.cleancoded-image_upload, .cleancoded-plupload_image', initImageUpload )
} )( jQuery, cleancoded );
