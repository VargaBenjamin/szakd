// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable( {
            responsive: true,
            language: {
               url: "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Hungarian.json"
            }
        } );
});
