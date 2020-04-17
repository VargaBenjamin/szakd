//settingScripts.js
$(document).ready(function(){
  var gymid;

  $(document).on('click', '#gym', function(){
    gymid = $('#gym').val();
    if (gymid) {
      $('#coaches').css("display", "block");
    }
    else {
      $('#coaches').css("display", "none");
    }
    $.ajax({
      url: "parts/coachLoad.php",
      method: "POST",
      data: {gymid: gymid},
      success: function(data)
      {
        console.log("Sikeres az edzők kilistázása");
        console.log(data);
        $('#coach').html(data);
      },
      error: function(data)
      {
        console.log("Gond van");
        console.log(data);
      }
    })
  });

});
