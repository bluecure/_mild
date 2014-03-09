/* =Main site specific js
----------------------------------------------- */
jQuery(document).ready(function($) {

    // Main menu
    var menuToggle = $( '.menu-toggle' ),
        mainMenu = $( '.main-navigation .menu' );
    menuToggle.on( 'click', function() {
        mainMenu.slideToggle();
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
       if ( !searchField.is( ':visible' ) || searchField.val() === '' ) {
           searchField.fadeToggle();
           e.preventDefault();
       }
    });

    // Main slider
    var slider = $( '.main-slider' );
    if ( slider ) {
        slider.owlCarousel({
            singleItem: true,
            autoPlay : true,
            stopOnHover : true,
            navigation : true,
            navigationText: [ '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ],
            slideSpeed : 300,
            pagination : false,
            paginationSpeed : 500,
            transitionStyle : 'fade'
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

});
