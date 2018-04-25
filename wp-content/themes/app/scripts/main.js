(function($) {
    'use strict';

   ///////////////
   // Returns width / heoght of browser viewport
    var $windowWidth = $(window).width();
    var $windowHeight = $(window).height();

    ///////////////
    // COOKIES
    $(function() {
      // COOKIE BANNER
      $('#cookies_banner').show();
      var expireDate = new Date;
      expireDate.setDate(expireDate.getDate() + 390); // It expires in a 13 months

      // HIDE BANDEAU COOKIE
      if($.cookie('user')) {
          $('#cookies_banner').hide();
      }

      // Fermeture bandeau COOKIE
      $('#cookies_banner_close').click(function (e) {
             e.preventDefault();
            $('#cookies_banner').hide();
            // create cookie
            $.cookie('user', 'infocookies', { expires: expireDate.getDate() + 390 });
            var currentusr = $.cookie('user');
      });

    });


    ///////////////
    // carousel

    // SLICK CAROUSEL HOME PAGE
    $('.single-item').slick({
       dots: true,
       arrows: false,
       autoplay: false,
       autoplaySpeed: 6000
     });

    // SLICK CAROUSEL HOME ACTUS
    $('.slider-news').slick({
     infinite:false,
     slidesToShow: 3,
     slidesToScroll: 3,
     dots: true,
     arrows: false,
     autoplay: false,
     autoplaySpeed: 6000,
     responsive: [
       {
         breakpoint: 991,
         settings: {
           slidesToShow: 2
         }
       },
      {
        breakpoint: 681,
        settings: {
          slidesToShow: 1
        }
      }
     ]
   });


})(window.jQuery);


$( document ).ready(function() {
  ///////////////
  // datepicker
  $(".datepicker").datepicker({
    inline: true,
    showOtherMonths: true
  });
});


$(window).load(function() {



});
