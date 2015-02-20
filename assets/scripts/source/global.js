/* =Global js
----------------------------------------------- */
(function( $ ) {

    // Main menu
    var menuToggle = $( '.menu-toggle' ),
        mainMenu = $( '.primary-navigation .menu' );
    menuToggle.on( 'click', function() {
        mainMenu.slideToggle();
    });
    mainMenu.find( 'a' ).one( 'click', function( event ) {
        var subMenu = $(this).next( 'ul' );
        if ( subMenu.length > 0 && menuToggle.is( ':visible' ) ) {
            event.preventDefault();
            subMenu.slideDown();
        }
    });

    // Mobile search
    var searchBtn = $( '.search-submit' ),
        searchField = $( '.search-field' );
    searchBtn.on( 'click', function( e ) {
        if ( ! searchField.is( ':visible' ) || ! searchField.val() ) {
            searchField.fadeToggle( 300 );
            e.preventDefault();
        }
    });

    // Scroll to top
    $( '.to-top' ).click( function() {
        $( 'html, body' ).animate({
            scrollTop: 0
        }, 500);
    });

})( jQuery );