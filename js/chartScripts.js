$(document).ready(function(){
var categories= ["kg", "cm", "darab", "százalék", "táv", "idő"];
var types = [
  ["Testsúly", "Maximális felhúzott súly", "Maximális fekvenyomott súly", "Maximális gugolt súly"],
  ["Comb", "Derék", "Csípő", "Mell", "Váll", "Kar"],
  ["Felhúzás max db", "Fekvőtámasz max db", "Gugolás max db"],
  ["Testzsír"],
  ["12 perc/m"],
  ["2300 m/perc"]];

var sql = [
    ["suly", "felhuzasmax", "fekvenyomasmax", "gugolasmax"],
    ["combboseg", "derekboseg", "csipoboseg", "mellboseg", "vallszelesseg", "karboseg"],
    ["felhuzassajat", "fekvenyomassajat", "gugolassajat"],
    ["testzsirszazalek"],
    ["adottido"],
    ["adottkm"]];



  $('#second').change(function(){
    if ($('#second').val()==1) {
      $('#secondType').css("display", "none");
      $('#typeS').val("");
      $('#catS').val("");
    } else {
      $('#secondType').css("display", "block");
    }
  });

    $('#catF').change(function(){
      var categid = $("#catF").val();
      if (categid != -1)
      {
        var values="<label class='control-label'>Csoporton belüli elemek</label>";
        for (var i = 0; i < types[categid].length; i++)
        {
          values += "<div class='form-check'><label class='form-check-label'><input type='checkbox' name='valuesF' class='form-check-input' value='" + i + "'>" + types[categid][i] + "</label></div>";
          // values +='<option value="' + i +'">' + types[categid][i] +  '</option>';
        }
        $("#valF").html(values);
        if ($('#second').val()!=1)
        {
          var secCat="<option value='-1'>Válassz</option>";
          for (var i = 0; i < categories.length; i++)
          {
            if (i != categid)
            {
              secCat +='<option value="' + i +'">' + categories[i] +  '</option>';
            }
          }
          $("#catS").html(secCat);
        }
      }
      else
      {
        $("#valF").html('<option value="-1">Válassz mértékegység csoportot!</option>');
      }
    });

    $('#catS').change(function(){
      var categid = $("#catS").val();
      if (categid != -1)
      {
        var values="<label class='control-label'>Csoporton belüli elemek</label>";
        for (var i = 0; i < types[categid].length; i++)
        {
          values += "<div class='form-check'><label class='form-check-label'><input type='checkbox' name='valuesS' class='form-check-input' value='" + i + "'>" + types[categid][i] + "</label></div>";
        }
        $("#valS").html(values);
      }
    });

    $('#chartAdd').submit(function(e)
    {
      e.preventDefault();
      var title = $('#title').val();
      var priority = $('#priority').val();
      var second = $('#second').val();
      var typeF = $('#typeF').val();
      var catF = $('#catF').val();
      var clientid = $('#id').val();
      var valuesArray = [];
      var jsonarray = [];
            $.each($("input[name='valuesF']:checked"), function(){
                valuesArray.push($(this).val());
            });
      for (var i = 0; i < valuesArray.length; i++) {
        jsonarray[i] = sql[catF][valuesArray[i]];
      }
      var sqlarray = jsonarray.join(", ");
      $.ajax({
        url: "parts/chartGetValues.php",
        type: "POST",
        data: {
          postval: "true",
          sqlarray: sqlarray,
          jsonarray: jsonarray
        },
        success: function(data){
          console.log(data);
        }
      });
    });

});
