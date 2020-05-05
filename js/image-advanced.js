( function ( $, cleancoded ) {
	'use strict';

	var views = cleancoded.views = cleancoded.views || {},
		MediaField = views.MediaField,
		MediaItem = views.MediaItem,
		MediaList = views.MediaList,
		ImageField;

	ImageField = views.ImageField = MediaField.extend( {
		createList: function () {
			this.list = new MediaList( {
				controller: this.controller,
				itemView: MediaItem.extend( {
					className: 'cleancoded-image-item attachment',
					template: wp.template( 'cleancoded-image-item' ),
					initialize: function( models, options ) {
						MediaItem.prototype.initialize.call( this, models, options );
						this.$el.addClass( this.controller.get( 'imageSize' ) );
					}
				} )
			} );
		}
	} );

	/**
	 * Initialize image fields
	 */
	function initImageField() {
		var $this = $( this ),
			view = $this.data( 'view' );

		if ( view ) {
			return;
		}

		view = new ImageField( { input: this } );

		$this.siblings( '.cleancoded-media-view' ).remove();
		$this.after( view.el );
		$this.data( 'view', view );
	}

	function init( e ) {
		$( e.target ).find( '.cleancoded-image_advanced' ).each( initImageField );
	}

	cleancoded.$document
		.on( 'mb_ready', init )
		.on( 'clone', '.cleancoded-image_advanced', initImageField );
} )( jQuery, cleancoded );
