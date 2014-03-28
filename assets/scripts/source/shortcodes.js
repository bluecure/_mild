/* =Shortcodes js
----------------------------------------------- */
jQuery(document).ready(function($) {

	// Accordian
	var accordion = $( '.accordion' );
	if ( accordion ) {
		accordion.on( 'click', '.accordion-title', function() {
			$( this ).parent( '.accordion' ).find( '.accordion-content' ).slideToggle();
		});
	}

});
