/* =Main site specific js
----------------------------------------------- */
(function( $ ) {

    // Accordian
    var accordion = $( '.accordion' );
    if ( accordion ) {
        accordion.on( 'click', '.accordion-title', function() {
            $( this ).parent( '.accordion' ).find( '.accordion-content' ).slideToggle();
        });
    }
 
    // Inline login
    var login = $( '.login-style-inline' );
    if ( login ) {
        login.find( '.input' ).focusin( function() {
            $(this).parent( 'p' ).find( 'label' ).addClass( 'is-hidden' );
        });
        login.find( '.input' ).focusout( function() {
            if ( $(this).val() === '' ) 
                $(this).parent( 'p' ).find( 'label' ).removeClass( 'is-hidden' );
        });
    }
        
})( jQuery );