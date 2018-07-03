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
});