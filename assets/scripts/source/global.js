/* =Global js
 ----------------------------------------------- */
(function( $ ) {

	// Primary menu
	var primaryToggle = $( '.primary-toggle' ),
		primaryMenu = $( '.primary-navigation .menu' );
	// Show primary menu
	primaryToggle.on( 'click', function() {
		primaryMenu.slideToggle('easeOutQuad');
	} );
	// Add submenu buttons
	primaryMenu.find( '.menu-item-has-children' ).prepend( '<i class="show-submenu fa fa-angle-down"></i>' );
	// Show submenu on click
	primaryMenu.on( 'click', '.show-submenu, .menu-item-has-children > a', function() {
		if ( $(this).hasClass( 'show-submenu' ) || $(this).attr( 'href' ) === '#' ) {
			var hasSub = $( this ).parent( '.menu-item ' );
			hasSub.find( '> .sub-menu' ).slideToggle('easeOutQuad');
			hasSub.toggleClass( 'is-open' );
		}
	} );

	// Scroll to top
	$( '.to-top' ).on( 'click', function() {
		$( 'html, body' ).animate( {
			scrollTop: 0
		}, 500 );
	} );

})( jQuery );
