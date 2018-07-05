jQuery(document).ready(function($){
    $('.home-slider .owl-carousel').owlCarousel({
        items: 1,
        loop: true,
        margin: 0,
        autoplay: false,
        nav: false,
        dots: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true
    });
    $('.story .timeline .item .circle').on('click', function() {
        $('.story .timeline .item').removeClass('active');
        var parent = $(this).parents('.item').first();
        var index = parent.index();
         $('.story .timeline > div .content-left').css('padding-bottom', '0');
        if (index > 2) {
            index -= 2;
            $('.story .timeline > div:eq(' + index + ') .content-left').css('padding-bottom', '375px');
        }
        parent.addClass('active');
    });
});