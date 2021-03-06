(function($) {
  "use strict"; // Start of use strict

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

  // Configure tooltips for collapsed side navigation
  $('.navbar-sidenav [data-toggle="tooltip"]').tooltip({
    template: '<div class="tooltip navbar-sidenav-tooltip" role="tooltip" style="pointer-events: none;"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
  })
  // Toggle the side navigation
  $("#sidenavToggler").click(function(e) {
    e.preventDefault();
    $("body").toggleClass("sidenav-toggled");
    $(".navbar-sidenav .nav-link-collapse").addClass("collapsed");
    $(".navbar-sidenav .sidenav-second-level, .navbar-sidenav .sidenav-third-level").removeClass("show");
  });
  // Force the toggled class to be removed when a collapsible nav link is clicked
  $(".navbar-sidenav .nav-link-collapse").click(function(e) {
    e.preventDefault();
    $("body").removeClass("sidenav-toggled");
  });
  // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
  $('body.fixed-nav .navbar-sidenav, body.fixed-nav .sidenav-toggler, body.fixed-nav .navbar-collapse').on('mousewheel DOMMouseScroll', function(e) {
    var e0 = e.originalEvent,
      delta = e0.wheelDelta || -e0.detail;
    this.scrollTop += (delta < 0 ? 1 : -1) * 30;
    e.preventDefault();
  });
  // Scroll to top button appear
  $(document).scroll(function() {
    var scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
      $('.scroll-to-top').fadeIn();
    } else {
      $('.scroll-to-top').fadeOut();
    }
  });
  // Configure tooltips globally
  $('[data-toggle="tooltip"]').tooltip()
  // Smooth scrolling using jQuery easing
  $(document).on('click', 'a.scroll-to-top', function(event) {
    var $anchor = $(this);
    $('html, body').stop().animate({
      scrollTop: ($($anchor.attr('href')).offset().top)
    }, 1000, 'easeInOutExpo');
    event.preventDefault();
  });

    $('.delete-link').click(function(){
        const delete_url = $(this).attr('data-url');
        const return_url = $(this).attr('data-return-url');

        if (confirm('Are you sure?')) {
            $.ajax({
                url: delete_url,
                type: 'DELETE',
                success: function(result) {
                    if (result.responseCode === 1) {
                        window.location = return_url;
                    } else {
                        alert(result.responseMessage);
                    }
                }
            });
        }
    });

    $.mask.definitions['9'] = '';
    $.mask.definitions['d'] = '[0-9]';
    $('.maskedPhone').mask('(+994) dd ddddddd');
    $('.maskedCarNumber').mask('dd-aa-ddd');

    $('#datetimepickerDateOfBirth').datetimepicker({
        format: 'L',
        locale: 'ru',
    });

    $('#datetimepickerPeriod').datetimepicker({
        format: 'MM/YYYY',
        viewMode: 'months',
        ignoreReadonly: true,
    });

    $('#filterUser').on('change', function () {
        const filterUserId = $('#filterUser').val();
        location.href = `http://promo.bmwstyle.az/admin/subscriptions/user/${filterUserId}`;
    });
})(jQuery); // End of use strict
