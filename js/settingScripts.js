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
      url: "parts/coachLoad.php",
      method: "POST",
      data: {
        gymid: gymid
      },
      success: function(data) {
        console.log("Sikeres az edzők kilistázása");
        console.log(data);
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
      url: "parts/settingsPassCheck.php",
      type: "POST",
      data: {
        pass: pass,
        id: id
      },
      success: function(data) {
        console.log(data);
        if (data == "true") {
          if (newPass == newPassRe) {
            console.log("ha van ha nincs az új jelszavak megegyeznek");
            update();
          } else {
            $('#alert').html('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>A két új jelszó nem egyezik!</strong></div>');
            setTimeout(function() {
              $('.alert').fadeOut('slow');
            }, 1500);
            $('#settingsUpdate')[0].reset();
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
      url: "parts/settingsUpdate.php",
      type: "POST",
      data: {
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
        console.log(data);
      }
    })
  }

});
