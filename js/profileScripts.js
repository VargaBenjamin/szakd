$(document).ready(function() {
  var role = $('#role').val();

  if (role == 0) { //vendég
    getGym();
    getCoach();
  } else {
    $('#coachLabel').css({
      "display": "none"
    });
    getGym();
  }


  function getGym() {
    var gymid = $('#gym').val();
    $.ajax({
      url: "parts/profileCRUD.php",
      method: "POST",
      data: {
        gym: "true",
        gymid: gymid
      },
      success: function(data) {
        $('#resultG').html(data);
      },
      error: function(data) {
        console.log(data);
      }
    })
  };

  function getCoach() {
    var coachid = $('#coach').val();
    $.ajax({
      url: "parts/profileCRUD.php",
      method: "POST",
      data: {
        coach: "true",
        coachid: coachid
      },
      success: function(data) {
        $('#resultC').html(data);
      },
      error: function(data) {
        console.log(data);
      }
    })
  };
});
