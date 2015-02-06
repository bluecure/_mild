/* =Main site specific js
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

    // Gallery modal
    var gallery = $( '.gallery' );
    if ( gallery.length > 0 ) {
        gallery.magnificPopup({
            delegate: 'a',
            type: 'image',
            gallery: {
                enabled: true,
                preload: [ 0, 2 ],
                navigateByImgClick: true,
                arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',
                tPrev: '<',
                tNext: '>',
                tCounter: '%curr% of %total%'
            }
        });
    }

})( jQuery );