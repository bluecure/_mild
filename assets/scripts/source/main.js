/* =Main site specific js
----------------------------------------------- */
(function( $ ) {

    // Main menu
    var menuToggle = $( '.menu-toggle' ),
        mainMenu = $( '.main-navigation .menu' );
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
    $( 'a.to-top' ).click( function() {
        $( 'html, body' ).animate({
            scrollTop: 0
        }, 500);
    });
    
    // Meta slider
    var slider = $( '.meta-slider' );
    if ( slider ) {
        slider.owlCarousel({
            autoplay: 5000,
            animateIn: 'fadeIn',
            animateOut: 'fadeOut',
            items: 1,
            loop: true,
            dots: false,
            nav: true,
            navText: [ '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ]
        });
    }

    // Gallery popups
    var gallery = $( '.gallery, .gallery-widget-images' );
    if ( gallery ) {
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