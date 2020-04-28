//loginScript.js
$(document).ready(function() {
  $(".login a").click(function() {
    $(".register").slideDown("slow"),
      $(".login").slideUp("slow");
  });

  $(".register a").click(function() {
    $(".login").slideDown("slow"),
      $(".register").slideUp("slow");
  });

  function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
  };

  $('#loginForm').submit(function(e) {
    e.preventDefault();
    var usernameL = $('#usernameL').val();
    var passwordL = $('#passwordL').val();
    $.ajax({
      url: "parts/loginCRUD.php",
      type: "POST",
      data: {
        login: "true",
        username: usernameL,
        password: passwordL
      },
      success: function(data) {
        if (data == "valid") {
          window.location.replace("home.php");
        } else {
          console.log(data);
          $('#alert').html('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>' + data + '</strong></div>');
          setTimeout(function() {
            $('.alert').fadeOut('slow');
          }, 1500);
        }
      },
      error: function(data) {
        console.log(data);
      }
    });
  });

  $('#registrationForm').submit(function(e) {
    e.preventDefault();
    var usernameR = $('#usernameR').val();
    var emailR = $('#emailR').val();
    var passwordR = $('#passwordR').val();
    var passwordReR = $('#passwordReR').val();
    var roleR = $('#roleR').prop('checked');
    var role = "";
    if (roleR) {
      role = 0; //kliens
    } else {
      role = 1; //edző
    }
    if (validateEmail(emailR)) {
      if (passwordR == passwordReR) {
        $.ajax({
          url: "parts/loginCRUD.php",
          type: "POST",
          data: {
            registration: "true",
            username: usernameR,
            email: emailR,
            password: passwordR,
            role: role
          },
          success: function(data) {
            if (data == "valid") {
              window.location.replace("home.php");
            } else {
              console.log(data);
              $('#alert').html('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>' + data + '!</strong></div>');
              setTimeout(function() {
                $('.alert').fadeOut('slow');
              }, 1500);
            }
          },
          error: function(data) {
            console.log(data);
          }
        });
      } else {
        $('#alert').html('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>A két jelszó nem egyezik!</strong></div>');
        setTimeout(function() {
          $('.alert').fadeOut('slow');
        }, 1500);
      }
    } else {
      $('#alert').html('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Továbbra is helytelen email!</strong></div>');
      setTimeout(function() {
        $('.alert').fadeOut('slow');
      }, 1500);
    }
  });
});
