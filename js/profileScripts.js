$(document).ready(function() {
  getGym();
  getCoach();

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
