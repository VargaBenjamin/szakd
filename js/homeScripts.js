(function($) {
  "use strict";

  // Add active state to sidbar nav links
  var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
  $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function() {
    if (this.href === path) {
      $(this).addClass("active");
    }
  });

  // Toggle the side navigation
  $("#sidebarToggle").on("click", function(e) {
    e.preventDefault();
    $("body").toggleClass("sb-sidenav-toggled");
  });

  window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function() {
      $(this).remove();
    });
  }, 3000);

})(jQuery);

$(document).ready(function() {
  var role = $('#role').val();
  if (role == 1) {
    $('#coacNav').show();
    $('#createPost').show();
  } else {
    $('#coacNav').hide();
    $('#createPost').hide();
  }
});
