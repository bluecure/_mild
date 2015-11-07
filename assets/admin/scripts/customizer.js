/**
 * Theme Customizer js.
 *
 * Contains handlers to make the Theme Customizer preview reload changes asynchronously.
 */

(function( $ ) {

	/*** General ***/
	var text = {
		'blogname'        : '.site-title',
		'blogdescription' : '.site-description'
	};
	$.each( text, function( id, select ) {
		wp.customize( id, function( value ) {
			value.bind( function( to ) {
				$( select ).text( to );
			} );
		} );
	} );

	/*** Images ***/
	var images = {
		'logo' : [ '.site-logo', '.site-branding a' ]
	};
	$.each( images, function( id, select ) {
		wp.customize( id, function( value ) {
			value.bind( function( to ) {
				var link = $( select[0] );
				if ( link.length > 0 ) {
					link.attr( 'src', to );
				} else {
					$( select[1] ).html( '<img src="' + to + '">' );
				}
			} );
		} );
	} );

	/*** Colors ***/
	var colors = {
		'header_text'        : [ '.site-header', 'color' ],
		'content_text'       : [ '.site-content', 'color' ],
		'footer_text'        : [ '.site-footer', 'color' ],
		'header_links'       : [ '.site-header a', 'color' ],
		'content_links'      : [ '.site-content a', 'color' ],
		'footer_links'       : [ '.site-footer a', 'color' ],
		'header_background'  : [ '.site-header', 'background-color' ],
		'content_background' : [ '.site-content', 'background-color' ],
		'footer_background'  : [ '.site-footer', 'background-color' ]
	};
	$.each( colors, function( id, select ) {
		wp.customize( id, function( value ) {
			value.bind( function( to ) {
				to = to || '';
				$( select[0] ).css( select[1], to );
			} );
		} );
	} );

	/*** Social ***/
	var social = {
		'facebook'    : 'fa-facebook',
		'twitter'     : 'fa-twitter',
		'google_plus' : 'fa-google-plus',
		'linkedin'    : 'fa-linkedin',
		'instagram'   : 'fa-instagram',
		'flickr'      : 'fa-flickr',
		'youtube'     : 'fa-youtube',
		'vimeo'       : 'fa-vimeo-square'
	};
	$.each( social, function( id, select ) {
		wp.customize( id, function( value ) {
			value.bind( function( to ) {
				var link = $( '.' + select );
				if ( ! to && link.length > 0 ) {
					link.remove();
				} else if ( link.length > 0 ) {
					link.attr( 'href', to );
				} else {
					$( '.site-social .social-links' ).append( '<a href="' + to + '" class="fa ' + select + '" target="_blank"></a>' );
				}
			} );
		} );
	} );

})( jQuery );
