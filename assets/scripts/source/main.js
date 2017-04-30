/* =Main site js
 ----------------------------------------------- */
(function($) {

    // Gallery popup
    const gallery = $('.gallery');
    if (gallery.length > 0) {
        gallery.magnificPopup({
            delegate: 'a[href*="wp-content/uploads"]',
            type: 'image',
            gallery: {
                enabled: true,
                preload: [0, 2],
                navigateByImgClick: true,
                arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',
                tPrev: '<',
                tNext: '>',
                tCounter: '%curr% of %total%'
            }
        });
    }

    // Scroll to top
    const toTop = $('.to-top');
    toTop.on('click', function() {
        $('html, body').animate( {
            scrollTop: 0
        }, 500);
    });

    // Show scroll to top
    $(window).scroll(function() {
        if($(window).scrollTop() > 50) {
            toTop.addClass('fadeIn');
        } else {
            toTop.removeClass('fadeIn');
        }
    });

})(jQuery);
