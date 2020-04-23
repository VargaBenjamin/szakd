$(document).ready(function() {
  var coachidOpt = $('#coachidOpt').val();
  var basicView;
  var views = [];
  var hiddendays = [];
  var minTime;
  var maxTime;
  var overlap;

  $.ajax({
    url: "parts/calendarCRUD.php",
    type: "POST",
    data: {
      getCalOpt: "true",
      coachid: coachidOpt
    },
    success: function(getData) {
      var array = JSON.parse(getData);
      console.log(array);
      basicView = array.basicview;
      $('#basicView').val(array.basicview);

      views = (array.views).split(",");
      for (var i = 0; i < views.length; i++) {
        $('#' + views[i]).prop('checked', true);
      }

      hiddendays = (array.hiddendays).split(",");
      for (var i = 0; i < hiddendays.length; i++) {
        $('#' + hiddendays[i]).prop('checked', true);
      }

      minTime = array.mintime;
      $('#dayStart').val(array.mintime);

      maxTime = array.maxtime;
      $('#dayEnd').val(array.maxtime);

      overlap = array.overlap;
      if (array.overlap == 1) //lehet átfedés
      {
        $('#overlap').bootstrapToggle('on')
      } else {
        $('#overlap').bootstrapToggle('off')
      }
    }
  });

  $('#calendarOptionUpdate').submit(function(e) {
    e.preventDefault();
    basicView = $('#basicView').val();
    dayStart = $('#dayStart').val();
    dayEnd = $('#dayEnd').val();
    var overlapBool = $('#overlap').prop('checked');
    if (overlapBool) {
      overlap = 1;
    } else {
      overlap = 0;
    }
    views = "list";
    if ($('#timeGridDay').is(':checked')) {
      views += "," + $('#timeGridDay').val();
    }
    if ($('#timeGridWeek').is(':checked')) {
      views += "," + $('#timeGridWeek').val();
    }
    if ($('#dayGridMonth').is(':checked')) {
      views += "," + $('#dayGridMonth').val();
    }
    hiddendays = "";
    for (var i = 0; i < 7; i++) {
      if ($('#' + i).is(':checked')) {
        hiddendays += $('#' + i).val() + ",";
      }
    }
    if (hiddendays != "") {
      hiddendays = hiddendays.slice(0, -1);
    }
    $.ajax({
      url: "parts/calendarCRUD.php",
      type: "POST",
      data: {
        setCalOpt: "true",
        coachid: coachidOpt,
        basicView: basicView,
        dayStart: dayStart,
        dayEnd: dayEnd,
        overlap: overlap,
        views: views,
        hiddendays: hiddendays
      },
      success: function(data) {
        console.log("Sikeres" + data);
        $('#alert').html('<div class="alert alert-success alert-dismissible col-md-12 col-md-pull-12" style="position: fixed;z-index:+101;" ><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Naptár beállítások frissítve!</strong></div>');
        setTimeout(function() {
          $('.alert').fadeOut('slow');
        }, 1500);
      }
    })
  })

})
