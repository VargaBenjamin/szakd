$(document).ready(function(){
  getGym();
  getCoach();

  function getGym(){
    var gymid = $('#gym').val();
    console.log(gymid);
    $.ajax({
      url: "parts/getGym.php",
      method: "POST",
      data: {gymid: gymid},
      success: function(data)
      {
        console.log("Sikeres az terem lekérése");
        console.log(data);
        $('#resultG').html(data);
      },
      error: function(data)
      {
        console.log("Gond van");
        console.log(data);
      }
    })
  };

  function getCoach(){
    var coachid = $('#coach').val();
    console.log(coachid);
    $.ajax({
      url: "parts/getCoach.php",
      method: "POST",
      data: {coachid: coachid},
      success: function(data)
      {
        console.log("Sikeres az terem lekérése");
        console.log(data);
        $('#resultC').html(data);
      },
      error: function(data)
      {
        console.log("Gond van");
        console.log(data);
      }
    })
  };
});
