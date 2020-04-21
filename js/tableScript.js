//datatablesScript.js
$(document).ready(function() {
  var table = $('#dataTable').DataTable({
    dom: 'Bfrltip',
    buttons: [{
        extend: 'copyHtml5',
        text: '<i class="fas fa-copy"></i>',
        titleAttr: 'Copy'
      },
      {
        extend: 'excelHtml5',
        text: '<i class="fas fa-file-excel"></i>',
        titleAttr: 'Excel'
      },
      {
        extend: 'csvHtml5',
        text: '<i class="fas fa-file-csv"></i>',
        titleAttr: 'CSV'
      },
      {
        extend: 'pdfHtml5',
        text: '<i class="fas fa-file-pdf"></i>',
        titleAttr: 'PDF'
      },
      {
        extend: 'print',
        text: '<i class="fas fa-print"></i>',
        titleAttr: 'Print'
      },
      "delete", "create", "update", 'colvis'
    ],
    columnDefs: [{
      orderable: false,
      className: 'select-checkbox',
      targets: 0
    }],
    select: {
      style: 'os',
      selector: 'td:first-child'
    },
    order: [
      [1, 'desc']
    ],
    responsive: true,
    fixedHeader: true,
    language: {
      url: "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Hungarian.json"
    },
    ajax: {
      url: "parts/tableInit.php",
      dataSrc: ""
    },
    columns: [{
        "data": "id"
      },
      {
        "data": "datum"
      },
      {
        "data": "suly"
      },
      {
        "data": "testzsirszazalek"
      },
      {
        "data": "combboseg"
      },
      {
        "data": "derekboseg"
      },
      {
        "data": "csipoboseg"
      },
      {
        "data": "mellboseg"
      },
      {
        "data": "vallszelesseg"
      },
      {
        "data": "karboseg"
      },
      {
        "data": "adottido"
      },
      {
        "data": "adottkm"
      },
      {
        "data": "felhuzasmax"
      },
      {
        "data": "fekvenyomasmax"
      },
      {
        "data": "gugolasmax"
      },
      {
        "data": "felhuzassajat"
      },
      {
        "data": "fekvenyomassajat"
      },
      {
        "data": "gugolassajat"
      }
    ],
  });

  $.fn.dataTable.ext.buttons.refresh = {
    text: 'Refresh',
    action: function(e, dt, node, config) {
      dt.clear().draw();
      dt.ajax.reload();
    }
  };

  $.fn.dataTable.ext.buttons.delete = {
    text: 'Sor törlés',
    action: function(e, dt, node, config) {
      e.preventDefault();
      let selected = table.row({
        selected: true
      }).data();
      $.ajax({
        url: "parts/tableCRUD.php",
        type: "POST",
        data: {
          delete: "true",
          id: selected.id
        },
        success: function() {
          dt.ajax.reload();
          $('#alert').html('<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Sikeres törlés!</strong></div>');
          setTimeout(function() {
            $('.alert').fadeOut('slow');
          }, 1500);
          console.log("Sikeres törlés");
        },
        error: function(request, status, error) {
          console.log("Sikertelen törlés");
          console.log(request.responseText);
        }
      })
    }
  };
  $.fn.dataTable.ext.buttons.create = {
    text: 'Sor létrehozás',
    action: function(e, dt, node, config) {
      console.log("Sor létrehozás kiválasztva");
      $('#creatModal').modal();
    }
  };
  $.fn.dataTable.ext.buttons.update = {
    text: 'Sor változatás',
    action: function(e, dt, node, config) {
      let selected = table.row({
        selected: true
      }).data();
      console.log("Kiválasztott sor változtatásra:" + selected.suly);
      $('#sulyU').val(selected.suly);
      $('#zsirU').val(selected.testzsirszazalek);
      $('#combU').val(selected.combboseg);
      $('#derekU').val(selected.derekboseg);
      $('#csipoU').val(selected.csipoboseg);
      $('#mellU').val(selected.mellboseg);
      $('#vallU').val(selected.vallszelesseg);
      $('#karU').val(selected.karboseg);
      $('#futidoU').val(selected.adottido);
      $('#futkmU').val(selected.adottkm);
      $('#huzmaxU').val(selected.felhuzasmax);
      $('#nyommaxU').val(selected.fekvenyomasmax);
      $('#gugmaxU').val(selected.gugolasmax);
      $('#huzsajatU').val(selected.felhuzassajat);
      $('#nyomsajatU').val(selected.fekvenyomassajat);
      $('#gugsajatU').val(selected.gugolassajat);
      $('#idU').val(selected.id);
      $('#updateModal').modal();
    }
  };

  $("#creatModal").submit(function(e) {
    e.preventDefault();
    var suly = $('#sulyC').val();
    var zsir = $('#zsirC').val();
    var comb = $('#combC').val();
    var derek = $('#derekC').val();
    var csipo = $('#csipoC').val();
    var mell = $('#mellC').val();
    var vall = $('#vallC').val();
    var kar = $('#karC').val();
    var futido = $('#futidoC').val();
    var futkm = $('#futkmC').val();
    var huzmax = $('#huzmaxC').val();
    var nyommax = $('#nyommaxC').val();
    var gugmax = $('#gugmaxC').val();
    var huzsajat = $('#huzsajatC').val();
    var nyomsajat = $('#nyomsajatC').val();
    var gugsajat = $('#gugsajatC').val();
    var id = $('#idC').val();
    $.ajax({
      url: "parts/tableCRUD.php",
      type: "POST",
      data: {
        creat: "true",
        suly: suly,
        zsir: zsir,
        comb: comb,
        derek: derek,
        csipo: csipo,
        mell: mell,
        vall: vall,
        kar: kar,
        futido: futido,
        futkm: futkm,
        huzmax: huzmax,
        nyommax: nyommax,
        gugmax: gugmax,
        huzsajat: huzsajat,
        nyomsajat: nyomsajat,
        gugsajat: gugsajat,
        clientid: id
      },
      success: function() {
        table.ajax.reload();
        $('#creatModal').modal('hide');
        $('#alert').html('<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Sikeres felvitel!</strong></div>');
        setTimeout(function() {
          $('.alert').fadeOut('slow');
        }, 1500);
      },
      error: function(request, status, error) {
        console.log(request.responseText);
      }
    });
  });

  $("#updateModal").submit(function(e) {
    e.preventDefault();
    var suly = $('#sulyU').val();
    var zsir = $('#zsirU').val();
    var comb = $('#combU').val();
    var derek = $('#derekU').val();
    var csipo = $('#csipoU').val();
    var mell = $('#mellU').val();
    var vall = $('#vallU').val();
    var kar = $('#karU').val();
    var futido = $('#futidoU').val();
    var futkm = $('#futkmU').val();
    var huzmax = $('#huzmaxU').val();
    var nyommax = $('#nyommaxU').val();
    var gugmax = $('#gugmaxU').val();
    var huzsajat = $('#huzsajatU').val();
    var nyomsajat = $('#nyomsajatU').val();
    var gugsajat = $('#gugsajatU').val();
    var id = $('#idU').val();
    $.ajax({
      url: "parts/tableCRUD.php",
      type: "POST",
      data: {
        update: "true",
        suly: suly,
        zsir: zsir,
        comb: comb,
        derek: derek,
        csipo: csipo,
        mell: mell,
        vall: vall,
        kar: kar,
        futido: futido,
        futkm: futkm,
        huzmax: huzmax,
        nyommax: nyommax,
        gugmax: gugmax,
        huzsajat: huzsajat,
        nyomsajat: nyomsajat,
        gugsajat: gugsajat,
        id: id
      },
      success: function() {
        table.ajax.reload();
        $('#updateModal').modal('hide');
        $('#alert').html('<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Sikeres frissítés!</strong></div>');
        setTimeout(function() {
          $('.alert').fadeOut('slow');
        }, 1500);
      },
      error: function(request, status, error) {
        console.log(request.responseText);
      }
    });
  });

  // $('#dataTable tbody').on('click', 'tr', function() {
  //   var data = table.row(this).data();
  //   console.log('You clicked on ' + data.id + '\'s row');
  // });
});
