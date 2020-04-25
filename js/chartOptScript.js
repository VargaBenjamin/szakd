$(document).ready(function() {
  var max = 8;
  var min = 1;
  $('input.form-check-input').on('change', function(evt) {
     if($(this).siblings(':checked').length >= max) {
         this.checked = false;
     }
     if($(this).siblings(':checked').length < min) {
         this.checked = true;
     }
  });

  var day;
  var selected = [];
  var useridOpt = $('#useridOpt').val();

  $.ajax({
    url: "parts/chartCRUD.php",
    type: "POST",
    data: {
      getChart: "true",
      userid: useridOpt
    },
    success: function(getData) {
      var array = JSON.parse(getData);
      console.log(array);
      day = array.day;
      $('#valueRange').val(day);
      $('#valueSpan').val(day);

      selected = (array.selected).split(",");
      for (var i = 0; i < selected.length; i++) {
        $('#' + selected[i]).prop('checked', true);
      }
      var valueSpan = $('#valueSpan');
      var valueRange = $('#valueRange');
      valueSpan.html(valueRange.val());
      valueRange.on('input change', function() {
        valueSpan.html(valueRange.val());
      })
    }
  });



  $('#chartMainForm').submit(function(e) {
    e.preventDefault();
    day = $('#valueRange').val();
    selected = "";
    for (var i = 0; i < 16; i++) {
      if ($('#' + i).is(':checked')) {
        selected += $('#' + i).val() + ",";
      }
    }
    if (selected != "") {
      selected = selected.slice(0, -1);
    }
    $.ajax({
      url: "parts/chartCRUD.php",
      type: "POST",
      data: {
        setChart: "true",
        userid: useridOpt,
        day: day,
        selected: selected
      },
      succes: function(data) {
        console.log("Sikeres" + data);
        $('#alert').html('<div class="alert alert-success alert-dismissible col-md-12 col-md-pull-12" style="position: fixed;z-index:+101;" ><button type="button" class="close" data-dismiss="alert">&times;</button><strong>kimutatás beállítások frissítve!</strong></div>');
        setTimeout(function() {
          $('.alert').fadeOut('slow');
        }, 1500);
      }
    })
  });

});
