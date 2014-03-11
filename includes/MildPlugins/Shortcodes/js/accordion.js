/**
 * Accordion.js
 */

( function( $ ) {

	var accordion = $( '.accordion' );

	accordion.find( '.accordion-content' ).hide();

	accordion.on( 'click', '.accordion-title', function() {
		$( this ).parent( '.accordion' ).find( '.accordion-content' ).slideToggle();
	});

} )( jQuery );