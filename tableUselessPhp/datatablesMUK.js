$(document).ready(function() {

  fetch_data();

  function fetch_data() {
    var dataTable = $('#user_data').DataTable({
      dom: 'Bfrltip',
      buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
      responsive: true,
      processing: true,
      serverSide: true,
      fixedHeader: true,
      fixedColumns: true,
      aoColumns: [
        null,
        null,
        null,
        null,
        {
          "orderSequence": []
        }
      ],
      language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Hungarian.json"
      },
      order: [],
      ajax: {
        url: "parts/tableFetch.php",
        type: "POST"
      }
    });
  }

  function update_data(id, column_name, value) {
    $.ajax({
      url: "parts/tableUpdate.php",
      method: "POST",
      data: {
        id: id,
        column_name: column_name,
        value: value
      },
      success: function(data) {
        //'<div class="alert alert-danger alert-dismissible fixed-top"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Figyelem!</strong></div>'
        $('#alert_message').html('<div class="alert alert-success">' + data + '</div>');

        $('#user_data').DataTable().destroy();
        fetch_data();
      }
    });
    setInterval(function() {
      $('#alert_message').html('');
    }, 5000);
  }

  $(document).on('blur', '.update', function() {
    var id = $(this).data("id");
    var column_name = $(this).data("column");
    var value = $(this).text();
    update_data(id, column_name, value);
  });

  $('#add').click(function() {
    var html = '<tr>';
    html += '<td contenteditable id="data1"></td>';
    html += '<td contenteditable id="data2"></td>';
    html += '<td contenteditable id="data3"></td>';
    html += '<td contenteditable id="data4"></td>';
    html += '<td contenteditable id="data5"></td>';
    html += '<td width="5%"><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Beilleszt</button></td>';
    html += '</tr>';
    $('#user_data tbody').prepend(html);
  });

  $(document).on('click', '#insert', function() {
    var author = $('#data1').text();
    var maintext = $('#data2').text();
    var reply = $('#data3').text();
    var article = $('#data4').text();
    if (author != '' || maintext != '' || reply != '' || article != '') {
      $.ajax({
        url: "parts/tableInsert.php",
        method: "POST",
        data: {
          author: author,
          maintext: maintext,
          reply: reply,
          article: article
        },
        success: function(data) {
          $('#alert_message').html('<div class="alert alert-success">' + data + '</div>');
          $('#user_data').DataTable().destroy();
          fetch_data();
        }
      });
      setInterval(function() {
        $('#alert_message').html('');
      }, 5000);
    } else {
      alert("At least one filed required");
    }
  });

  $(document).on('click', '.delete', function() {
    var id = $(this).attr("id");
    if (confirm("Are you sure you want to remove this?")) {
      $.ajax({
        url: "parts/tableDelete.php",
        method: "POST",
        data: {
          id: id
        },
        success: function(data) {
          $('#alert_message').html('<div class="alert alert-success">' + data + '</div>');
          $('#user_data').DataTable().destroy();
          fetch_data();
        }
      });
      setInterval(function() {
        $('#alert_message').html('');
      }, 5000);
    }
  });
});
