/**
 * Theme Customizer js.
 *
 * Contains handlers to make the Theme Customizer preview reload changes asynchronously.
 */

(function( $ ) {

	// Site title
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title' ).text( to );
		} );
	} );

	// Site description
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

})( jQuery );