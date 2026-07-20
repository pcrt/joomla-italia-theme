$(document).ready(function() {
    $("#filtri-tipologia").click(function(){
        $(".tipologia-menu").addClass("attivomenu");
    });

    $("#back-filtri-tipologia").click(function(){
        $(".tipologia-menu").removeClass("attivomenu");
    });

    $('#carosellonotizie').owlCarousel({
        loop:false,
        margin:30,
        nav:false,
        items:3,
        autoplay:false,
        autoplayTimeout:5000,/*,
        animateOut: 'fadeOut'*/
        responsive:{
            0:{
                items:1
            },
            992:{
                items:3
            }
        }
    });
    
    $('#carosellocircolari').owlCarousel({
        loop:false,
        margin:30,
        nav:false,
        items:3,
        autoplay:false,
        autoplayTimeout:5000,/*,
        animateOut: 'fadeOut'*/
        responsive:{
            0:{
                items:1
            },
            992:{
                items:3
            }
        }
    });

    $('#caroselloeventi').owlCarousel({
        loop:false,
        margin:30,
        nav:false,
        items:3,
        autoplay:false,
        autoplayTimeout:5000,/*,
        animateOut: 'fadeOut'*/
        responsive:{
            0:{
                items:1
            },
            992:{
                items:3
            }
        }
    });

    $('#carosello-didattica').owlCarousel({
        loop:false,
        margin:30,
        nav:false,
        items:3,
        autoplay:false,
        autoplayTimeout:5000,/*,
        animateOut: 'fadeOut'*/
        responsive:{
            0:{
                items:1
            },
            992:{
                items:3
            }
        }
    });

    $('#carosello-documenti').owlCarousel({
        loop:false,
        margin:30,
        nav:false,
        items:2,
        autoplay:false,
        autoplayTimeout:5000,/*,
        animateOut: 'fadeOut'*/
        responsive:{
            0:{
                items:1
            },
            992:{
                items:2
            }
        }
    });

});