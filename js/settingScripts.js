//settingScripts.js
$(document).ready(function() {
  var gymid;
  var username;
  var gym;
  var role = $('#role').val();
  var telephone;
  var newPass;
  var newPassRe;
  var pass;
  var id;

  function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
  };


  $(document).on('click', '#gym', function() {
    gymid = $('#gym').val();
    if (role != 1) {
      if (gymid) {
        $('#coaches').css("display", "block");
      } else {
        $('#coaches').css("display", "none");
      }
    }
    $.ajax({
      url: "parts/settingCRUD.php",
      method: "POST",
      data: {
        gym: "true",
        gymid: gymid
      },
      success: function(data) {
        $('#coach').html(data);
      },
      error: function(data) {
        console.log("Gond van");
        console.log(data);
      }
    })
  })

  $('#settingsUpdate').submit(function(e) {
    e.preventDefault();
    username = $('#username').val();
    email = $('#email').val();
    gym = $('#gym').val();
    coach = $('#coach').val();
    telephone = $('#telephone').val();
    newPass = $('#newPass').val();
    newPassRe = $('#newPassRe').val();
    pass = $('#pass').val();
    id = $('#id').val();
    $.ajax({
      url: "parts/settingCRUD.php",
      type: "POST",
      data: {
        check: "true",
        username: username,
        pass: pass,
        id: id
      },
      success: function(data) {
        console.log(data);
        if (data == "true") {
          if (email != "") {
            if (validateEmail(email)) {
              if (newPass == newPassRe) {
                update();
              } else {
                $('#alert').html('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>A két új jelszó nem egyezik!</strong></div>');
                setTimeout(function() {
                  $('.alert').fadeOut('slow');
                }, 1500);
                $('#settingsUpdate')[0].reset();
              }
            } else {
              $('#alert').html('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Az email formátum nem megfelelő!</strong></div>');
              setTimeout(function() {
                $('.alert').fadeOut('slow');
              }, 1500);
              $('#settingsUpdate')[0].reset();
            }
          } else {
            if (newPass == newPassRe) {
              update();
            } else {
              $('#alert').html('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>A két új jelszó nem egyezik!</strong></div>');
              setTimeout(function() {
                $('.alert').fadeOut('slow');
              }, 1500);
              $('#settingsUpdate')[0].reset();
            }
          }
        } else {
          $('#alert').html('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>' + data + '</strong></div>');
          setTimeout(function() {
            $('.alert').fadeOut('slow');
          }, 1500);
          $('#settingsUpdate')[0].reset();
        }
      }
    })
  })

  function update() {
    $.ajax({
      url: "parts/settingCRUD.php",
      type: "POST",
      data: {
        update: "true",
        username: username,
        email: email,
        gym: gym,
        coach: coach,
        telephone: telephone,
        newPass: newPass,
        id: id
      },
      success: function(data) {
        $('#alert').html('<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Sikeres frissítés!</strong></div>');
        setTimeout(function() {
          $('.alert').fadeOut('slow');
        }, 1500);
        $('#settingsUpdate')[0].reset();
      }
    })
  }

});
