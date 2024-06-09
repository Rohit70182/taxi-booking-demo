$(document).ready(function () {
  // For Convert Bootstrap Navbar in Side Navbar
  $('.navbar-toggler').click(function () {
    $('#navbarNav').toggleClass('menu-show');
    $(this).toggleClass('collapsed');
    $('body').toggleClass('menu-open');
  });

  // Navbar Toggler Animation
  $('#nav-icon2').click(function () {
    $(this).toggleClass('open');
  });

  $('.add-compare').click(function () {
    $(this).toggleClass('active');
  });
});

// Header Fixed
$(window).on('load resize', function () {
  var headerHeight = $('.theme-header').outerHeight();
  $('.page-body').css('paddingTop', headerHeight);
});

$(window).on('scroll', function () {
  var sticky = $('.theme-header'),
  scroll = $(window).scrollTop();
  if (scroll >= 250) {
    sticky.addClass('fixed');
  }
  else {
    sticky.removeClass('fixed');
  }
});
