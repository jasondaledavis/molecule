// When DOM is fully loaded
jQuery(document).ready(function ($) {

    "use strict";
    
    /* Add/Remove class to header on mobile devices
    --------------------------------------------------*/
    
    var $window = $(window),
    $headerMobile = $('.header-top');
    $(window).on('load resize', function () {
        
        if ($window.width() < 1024) {
            $headerMobile.removeClass('header-top').addClass('mobile');
        } else {
            $headerMobile.removeClass('mobile').addClass('header-top');
        }
    
    });

    /* Sticky navigation
    --------------------------------------------------*/
    
    $(function() {
        var header = $('.header-top');
        $(window).on('scroll', function () {
            var scroll = $(window).scrollTop();

            if (scroll >= 50) {
                header.removeClass('header-top').addClass('header-top-dark');
            } else {
                header.removeClass('header-top-dark').addClass('header-top');
            }
        
        });
    });

    /* FitVids Responsive Video
    --------------------------------------------------*/
    
    $('.grid').fitVids();
    
    /* Title fade on scroll
    --------------------------------------------------*/
    
    var windowWidth = $(window).width();
        
    if(windowWidth > 1024) {
    
        $(window).scroll(function () {
            var $titleFade = $('.custom-headings, .custom-header-image');
            var windowScroll = $(this).scrollTop();
            $titleFade.css({
                'margin-top': -(windowScroll / 0) + "px",
                'opacity': 1 - (windowScroll / 720)
            });
        });
    
    }

    /* Scroll
    --------------------------------------------------*/

    // $.fn.scrollView = function() {
    //     return this.each(function() {
    //         $('html, body').animate({
    //             scrollTop: $(this).offset().top - 150
    //         }, 600);
    //     });
    // };

    // $('#scroll-link').click(function(event) {
    //     event.preventDefault();
    //     $('.page-content').scrollView();
    // });

});