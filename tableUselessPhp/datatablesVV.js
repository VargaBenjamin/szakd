$(document).ready(function() {
  $('#dataTable').DataTable({
    fixedHeader: true,
    responsive: true,
    dom: 'Bfrtlip',
    buttons: [{
        text: 'Bejegyzés hozzáadása',
        action: function(e, dt, node, config) {
          alert('Button activated');
        }
      },
      'colvis', 'copy', 'csv', 'excel', 'pdf', 'print'
    ],
    language: {
      url: "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Hungarian.json"
    },
    columnDefs: [{
      "targets": [0],
      "visible": false,
      "searchable": false
    }],
    select: true
  });
});
