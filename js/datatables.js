// Call the dataTables jQuery plugin
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
      [5, 'desc']
    ],
    responsive: true,
    fixedHeader: true,
    language: {
      url: "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Hungarian.json"
    },
    ajax: {
      url: "parts/tableJSON.php",
      dataSrc: ""
    },
    columns: [{
        "data": "id"
      },
      {
        "data": "author"
      },
      {
        "data": "maintext"
      },
      {
        "data": "reply"
      },
      {
        "data": "article"
      },
      {
        "data": "commentdate"
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
      let selected = table.row({selected: true}).data();
      $.ajax({
        url: "parts/tableDelete.php",
        type: "POST",
        data: {
          id: selected.id
        },
        success: function() {
          dt.ajax.reload();
        }
      })
    }
  };
  $.fn.dataTable.ext.buttons.create = {
    text: 'Sor létrehozás',
    action: function(e, dt, node, config) {
      $('#creatModal').modal();
    }
  };
  $.fn.dataTable.ext.buttons.update = {
    text: 'Sor változatás',
    action: function(e, dt, node, config) {
      let selected = table.row({selected: true}).data();
      console.log(selected.author);
      $('#updateModal').modal();
      $('#authorU').val(selected.author);
      $('#maintextU').val(selected.maintext);
      $('#replyU').val(selected.reply);
      $('#articleU').val(selected.article);
      $('#idU').val(selected.id);
      $('#updateModal').modal();
    }
  };
  $('#dataTable tbody').on('click', 'tr', function() {
    var data = table.row(this).data();
    console.log('You clicked on ' + data.id + '\'s row');
  });


  $("#creatModal").submit(function(e) {
    e.preventDefault();
    var author = $("#authorC").val();
    var maintext = $("#maintextC").val();
    var reply = $("#replyC").val();
    var article = $("#articleC").val();
    $.ajax({
      url: "parts/tableCreat.php",
      type: "POST",
      data: {
        author: author,
        maintext: maintext,
        reply: reply,
        article: article
      },
      success: function() {
        table.ajax.reload();
        $('#creatModal').modal('hide');
      }
    });
  });

  $("#updateModal").submit(function(e) {
    e.preventDefault();
    var author = $("#authorU").val();
    var maintext = $("#maintextU").val();
    var reply = $("#replyU").val();
    var article = $("#articleU").val();
    var id = $("#idU").val();
    $.ajax({
      url: "parts/tableUpdate.php",
      type: "POST",
      data: {
        author: author,
        maintext: maintext,
        reply: reply,
        article: article,
        id: id
      },
      success: function() {
        table.ajax.reload();
        $('#updateModal').modal('hide');
      }
    });
  })

});
