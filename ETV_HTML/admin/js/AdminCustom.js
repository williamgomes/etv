(function($) {
  "use strict";
  //windows load event
  $(window).load(function() {
	
	/* ---------------------------------------------------------------------- */
	/* -------------------------- 01 - Preloader ---------------------------- */
	/* ---------------------------------------------------------------------- */
    $('#preloader').delay(20).fadeOut('slow');
  });
  /* ---------------------------------------------------------------------- */
	/* ---------------------------- 02 - OwlCarousel  ----------------------- */
	/* ---------------------------------------------------------------------- */	
	/* latest */
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
  /* -------------------------- search_btn ------------------------ */
  /* ---------------------------------------------------------------------- */ 
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
	 $("[name='my-checkbox']").bootstrapSwitch();
	 
	 // Replace source
	$('img').error(function(){
		//alert ("missing Image");
		   $(this).attr('src', window.siteUrl+'/assets/images/missing.jpg');
	});
	
$(document).ready(function () {
	$('.group').hide();
	$('#userreport').show();
	$('#selectMe').change(function () {
		$('.group').hide();
		$('#'+$(this).val()).show();
	})
	$('.showreport').hide();
	$('#Ratings').show();
	$('#showlist').change(function () {
		$('.showreport').hide();
		$('#'+$(this).val()).show();
	})
});
$(function() {
 
    $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
 
    $('#reportrange').daterangepicker({
        format: 'MM/DD/YYYY',
        startDate: moment().subtract(29, 'days'),
        endDate: moment(),
        minDate: '01/01/2012',
        maxDate: '12/31/2015',
        dateLimit: { days: 60 },
        showDropdowns: true,
        showWeekNumbers: true,
        timePicker: false,
        timePickerIncrement: 1,
        timePicker12Hour: true,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        opens: 'left',
        drops: 'down',
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-primary',
        cancelClass: 'btn-default',
        separator: ' to ',
        locale: {
            applyLabel: 'Submit',
            cancelLabel: 'Cancel',
            fromLabel: 'From',
            toLabel: 'To',
            customRangeLabel: 'Custom',
            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            firstDay: 1
        }
    }, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    });
	$('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
 
    $('#reportrange').daterangepicker({
        format: 'MM/DD/YYYY',
        startDate: moment().subtract(29, 'days'),
        endDate: moment(),
        minDate: '01/01/2012',
        maxDate: '12/31/2015',
        dateLimit: { days: 60 },
        showDropdowns: true,
        showWeekNumbers: true,
        timePicker: false,
        timePickerIncrement: 1,
        timePicker12Hour: true,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        opens: 'left',
        drops: 'down',
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-primary',
        cancelClass: 'btn-default',
        separator: ' to ',
        locale: {
            applyLabel: 'Submit',
            cancelLabel: 'Cancel',
            fromLabel: 'From',
            toLabel: 'To',
            customRangeLabel: 'Custom',
            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            firstDay: 1
        }
    }, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    });
	
	
	
	$('#reportrange2 span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
 
    $('#reportrange2').daterangepicker({
        format: 'MM/DD/YYYY',
        startDate: moment().subtract(29, 'days'),
        endDate: moment(),
        minDate: '01/01/2012',
        maxDate: '12/31/2015',
        dateLimit: { days: 60 },
        showDropdowns: true,
        showWeekNumbers: true,
        timePicker: false,
        timePickerIncrement: 1,
        timePicker12Hour: true,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        opens: 'left',
        drops: 'down',
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-primary',
        cancelClass: 'btn-default',
        separator: ' to ',
        locale: {
            applyLabel: 'Submit',
            cancelLabel: 'Cancel',
            fromLabel: 'From',
            toLabel: 'To',
            customRangeLabel: 'Custom',
            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            firstDay: 1
        }
    }, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
        $('#reportrange2 span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    });
	$('#reportrange2 span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
 
    $('#reportrange2').daterangepicker({
        format: 'MM/DD/YYYY',
        startDate: moment().subtract(29, 'days'),
        endDate: moment(),
        minDate: '01/01/2012',
        maxDate: '12/31/2015',
        dateLimit: { days: 60 },
        showDropdowns: true,
        showWeekNumbers: true,
        timePicker: false,
        timePickerIncrement: 1,
        timePicker12Hour: true,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        opens: 'left',
        drops: 'down',
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-primary',
        cancelClass: 'btn-default',
        separator: ' to ',
        locale: {
            applyLabel: 'Submit',
            cancelLabel: 'Cancel',
            fromLabel: 'From',
            toLabel: 'To',
            customRangeLabel: 'Custom',
            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            firstDay: 1
        }
    }, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
        $('#reportrange2 span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    });
 
});
	
})(jQuery);
