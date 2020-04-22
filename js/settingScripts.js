//settingScripts.js
$(document).ready(function() {
  var gymid;
  var username;
  var gym;
  var coach;
  var telephone;
  var newPass;
  var newPassRe;
  var pass;
  var id;


  $(document).on('click', '#gym', function() {
    gymid = $('#gym').val();
    if (gymid) {
      $('#coaches').css("display", "block");
    } else {
      $('#coaches').css("display", "none");
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
        pass: pass,
        id: id
      },
      success: function(data) {
        if (data == "true") {
          if (newPass == newPassRe) {
            update();
          } else {
            $('#alert').html('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>A két új jelszó nem egyezik!</strong></div>');
            setTimeout(function() {
              $('.alert').fadeOut('slow');
            }, 1500);
            $('#settingsUpdate').reset();
          }
        } else {
          $('#alert').html('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Hibás jelszó!</strong></div>');
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
