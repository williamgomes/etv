var infiniteLoader;
(function($) {
  "use strict";
  //windows load event
  $(window).load(function() {
	
	/* ---------------------------------------------------------------------- */
	/* -------------------------- 01 - Preloader ---------------------------- */
	/* ---------------------------------------------------------------------- */
    $('#preloader').delay(20).fadeOut('slow');
	
	/* ---------------------------------------------------------------------- */
	/* ---------------------------- 02 - OwlCarousel  ----------------------- */
	/* ---------------------------------------------------------------------- */	
	/* latest */
	$(".service-carousel").owlCarousel({
	    autoPlay: true,
		items : 3,
		pagination : false,
		responsive : true,
		itemsDesktop : [1199, 4],
		itemsDesktopSmall : [979, 3],
		itemsTablet : [768, 3],
		itemsTabletSmall : [600, 2],
		itemsMobile : [479, 1]
		
	});
	$(".epi-carousel4").owlCarousel({
	    autoPlay: true, 
		items : 4,
		pagination : false,
		responsive : true,
		itemsDesktop : [1199, 4],
		itemsDesktopSmall : [979, 4],
		itemsTablet : [768, 3],
		itemsTabletSmall : [600, 3],
		itemsMobile : [479, 3]
		
	});
	/* portfolio Logos */
	$(".epi-carousel").owlCarousel({
		autoPlay: true,
		items : 1,
		pagination : false,
		navigation:true,
    navigationText: [
      "<span class='leftarrow'></span>",
      "<span class='rightarrow'></span>"
      ],
		responsive : false
	}); 
        /* jscroll Initialize */
       infiniteLoader = new Waypoint.Infinite({
        element: $('.scrollLoader')[0],
        //more : $('.infinite-more-link:last')
        });
    
	/* ------------------------- 03 - Wow initialize  ----------------------- */
	new WOW().init(
		{
			offset: 10	
		}
	);
	
  });
  
  /* -------------------------- 04 - Sticky ---------------------------- */
  $(".sticky").sticky({topSpacing:0});

  /* -------------------------- 06 - scrollToTop  ------------------------- */
  $(window).scroll(function(){
	  if ($(this).scrollTop() > 600) {
		  $('.scrollToTop').fadeIn();
	  } else {
		  $('.scrollToTop').fadeOut();
	  }
  });
  
  $('.scrollToTop').click(function(){
	  $('html, body').animate({scrollTop : 0},800);
	  return false;
  });
  
  /* ---------------------------------------------------------------------- */
  /* -------------------------- 08 - Nivo Lightbox ------------------------ */
  /* ---------------------------------------------------------------------- */ 
  $('.gallery a').nivoLightbox({
	  effect: 'fadeScale'
  });

  $(".search_btn").click(function(){
		if($(this).parent().hasClass('closed')){
			$(this).parent().removeClass('closed');
			$(this).parent().find('.btmsearch').slideUp(200);
			
		} else {
			$(this).parent().addClass('closed');
			$(this).parent().find('.btmsearch').slideDown(200);
			
			
		}
	});
  /* ---------------------------------------------------------------------- */
  /* -------------------------- 10 - Fit Vids ----------------------------- */
  /* ---------------------------------------------------------------------- */
  $('#wrapper').fitVids();
   /* ---------------------------------------------------------------------- */
  /* ------------------------- 11 - YT Player for Video ------------------- */
  /* ---------------------------------------------------------------------- */
  $(".player").mb_YTPlayer();
  /*-----------------------------  selectpicker------------------*/
  $('.selectpicker').selectpicker({
    style: 'btn-info',
    size: 4
    });
  /* ---------------------------------------------------------------------- */
  /* -------------------------- 12 - Contact Form ------------------------- */
  /* ---------------------------------------------------------------------- */
  // Needed variables
  var $contactform = $('#contact-form'),
      $response = '';
	  
  // After contact form submit
  $contactform.submit(function() {
    // Hide any previous response text
    $contactform.children(".alert").remove();

    // Are all the fields filled in? 
    if (!$('#contact_name').val()) {
      $response = '<div class="alert alert-danger">Please enter your name.</div>';
	  $('#contact_name').focus();
      $contactform.prepend($response);

    } else if (!$('#contact_message').val()) {
      $response = '<div class="alert alert-danger">Please enter your message.</div>';
	  $('#contact_message').focus();
      $contactform.prepend($response);

    } else if (!$('#contact_email').val()) {
      $response = '<div class="alert alert-danger">Please enter valid e-mail.</div>';
	  $('#contact_email').focus();
      $contactform.prepend($response);

    } else {
      // Yes, submit the form to the PHP script via Ajax 
	  $contactform.children('button[type="submit"]').button('loading');
      $.ajax({
        type: "POST",
        url: "php/contact-form.php",
        data: $(this).serialize(),
        success: function(msg) {
          if (msg == 'sent') {
            $response = '<div class="alert alert-success">Your message has been sent. Thank you!</div>';
			$contactform[0].reset();
          } else {
            $response = '<div class="alert alert-danger">' + msg + '</div>';
          }
          // Show response message
          $contactform.prepend($response);
		  $contactform.children('button[type="submit"]').button('reset');
        }
      });
    }
    return false;
  });
  $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("body").toggleClass("toggled");
    });
  /* ---------------------------------------------------------------------- */
  /* -------------------------- bootstrap dropdown menu ----------------------------- */
  /* ---------------------------------------------------------------------- */
	$('.navbar .dropdown').hover(function() {
	$(this).find('.dropdown-menu').first().stop(true, true).delay(250).slideDown();
	
	}, function() {
	$(this).find('.dropdown-menu').first().stop(true, true).delay(100).slideUp();
	
	});
	
	$('.navbar a').click(function(){
	location.href = this.href;
	});
	
	 $('nav#menu').mmenu();
	 
	// Replace source
	$('img').error(function(){
		//alert ("missing Image");
		   $(this).attr('src', window.siteUrl+'/assets/images/missing.jpg');
	});
	
})(jQuery);
