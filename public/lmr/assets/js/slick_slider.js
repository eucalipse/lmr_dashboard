$('.wrapper_slider').slick({
    dots: false,
    infinite: true,
    speed: 2800,
    pauseOnHover:false,
    autoplay: true,
    autoplaySpeed: 2500,
    slidesToShow: 1,
    adaptiveHeight: true,
    responsive: [
        {
            breakpoint: 568,
            settings: {
                dots: false
            }
        }
    ]

});