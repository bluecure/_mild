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
        if ( subMenu.length > 0 && menuToggle.is(':visible') ) {
            event.preventDefault();
            subMenu.slideDown();
        }
    });

    // Scroll to top
    $( 'a.to-top' ).click( function() {
        $( 'html, body' ).animate({
            scrollTop: 0
        }, 500);
    });

    // Mobile search
    var searchBtn = $( '.search-submit' ),
        searchField = $( '.search-field' );
    searchBtn.on( 'click', function( e ) {
       if ( ! searchField.is( ':visible' ) || ! searchField.val() ) {
           searchField.fadeToggle();
           e.preventDefault();
       }
    });

    // Main slider
    var slider = $( '.meta-slider' );
    if ( slider ) {
        slider.slick({
            autoplay: true,
            autoplaySpeed: 5000,
            speed: 500,
            fade: true,
            dots: true,
            arrows: true,
            slide: '.slide',
            slidesToShow: 1
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
                tCounter: '<span class="mfp-counter">%curr% of %total%</span>'
            }
        });
    }

})( jQuery );