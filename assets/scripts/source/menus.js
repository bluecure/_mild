/* =Global js
 ----------------------------------------------- */
(function($) {

    // Primary menu
    const primaryMenu = $('.primary-navigation .menu');
    // Show primary menu
    $('.primary-toggle').on('click', function() {
        $(this).toggleClass('primary-toggle-open');
        primaryMenu.slideToggle('easeOutQuad');
    });
    // Add submenu buttons
    primaryMenu.find('.menu-item-has-children').prepend('<i class="show-submenu fa fa-angle-down"></i>');
    // Show submenu on click
    primaryMenu.on('click', '.show-submenu, .menu-item-has-children > a', function() {
        if ($(this).hasClass('show-submenu') || $(this).attr('href') === '#') {
            const hasSub = $(this).parent('.menu-item ');
            hasSub.find('> .sub-menu').slideToggle('easeOutQuad');
            hasSub.toggleClass('is-open');
        }
    });

})(jQuery);
