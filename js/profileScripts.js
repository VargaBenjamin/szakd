$(document).ready(function(){
  gymGet();
  coachGet();

  function gymGet(){
    var gymid = $('#gym').val();
    console.log(gymid);
    $.ajax({
      url: "parts/gymGet.php",
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

  function coachGet(){
    var coachid = $('#coach').val();
    console.log(coachid);
    $.ajax({
      url: "parts/coachGet.php",
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
