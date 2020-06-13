// Set Height Intro
function SetHeightIntro(){
    var h = $(window).height();
    $("#intro").height(h-148);
}
$(document).ready(SetHeightIntro);
// $(window).resize(SetHeightIntro);

$('.testimonial-slider').owlCarousel({
    loop:true,
    autoplay: true,
    autoplayTimeout:3000,
    autoplayHoverPause: true,
    margin:60,
    nav:true,
    items: 1,
    rtl: true,
    nav: true,
	  dots: false,
	  navText: ['<span class="left"><i class="fas fa-arrow-left"></i></span>','<span class="right"><i class="fas fa-arrow-right"></i></span>'],
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
});

$('.clients').owlCarousel({
    loop:false,
    rewind: true,
    autoplay: true,
    autoplayTimeout:3000,
    autoplayHoverPause: true,
    margin:30,
    nav:true,
    items: 6,
    nav: false,
    rtl: true,
	  dots: true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:6
        }
    }
});

$('.portfolio').owlCarousel({
    loop:true,
    autoplay: true,
    autoplayTimeout:3000,
    autoplayHoverPause: true,
    margin:30,
    nav:true,
    items: 1,
    rtl: true,
    nav: false,
	  dots: true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
});

AOS.init();
