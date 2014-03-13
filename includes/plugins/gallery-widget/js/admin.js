/* Admin JavaScript */

(function ($) {
	"use strict";
	$(function () {

		var GalleryWidget = {
			init: function () {
				this.bindEvents();
			},
			// Bind events
			bindEvents : function() {
				$( '#wpbody-content .widget-liquid-right' ).on( 'click', '.gallery-widget-select, .gallery-widget-preview', this.uploader );
			},
			// Launch WordPress media manager
			uploader : function( e ) {
				e.preventDefault();
				var container = $( this ).parents( '.gallery-widget-container' );
				var frame = wp.media({
					title:    'Select images',
					library:  { type : 'image' },
					button:   { text : 'Select' },
					multiple: true
				});
				// Handle results from media manager.
				frame.on( 'close', function() {
					var attachment = frame.state().get( 'selection' ).toJSON();
					if ( $.isEmptyObject( attachment ) ) return;
					GalleryWidget.update( container, attachment );
				});
				frame.open();
				return false;
			},
			// Output Image preview and populate widget form.
			update : function( container, attachment ) {
				var galleryPreview = container.find( '.gallery-widget-preview' ),
					imagesVal = '',
					i;
				galleryPreview.empty();
				for ( i = 0; i < attachment.length; i++ ) {
					container.find( '.gallery-widget-preview' ).append(' <img src='+attachment[i].url+'> ');
					imagesVal += ',' + attachment[i].id;
				}
				container.find( '.gallery-widget-images' ).val( imagesVal.substr( 1 ) );
			}
		};

		GalleryWidget.init();

	});
}(jQuery));