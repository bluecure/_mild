/* =Global js
----------------------------------------------- */
(function( $ ) {

    // Main menu
    var menuToggle = $( '.menu-toggle' ),
        mainMenu = $( '.primary-navigation .menu' );
    // Show menu
    menuToggle.on( 'click', function() {
        mainMenu.slideToggle();
    });
    // Add submenu buttons
    mainMenu.find( '.menu-item-has-children' ).prepend( '<i class="show-submenu fa fa-angle-down"></i>' );
    // Show submenu
    mainMenu.on( 'click', '.show-submenu', function() {
        $(this).parent( '.menu-item ' ).toggleClass( 'is-open' );
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