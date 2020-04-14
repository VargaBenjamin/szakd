// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable({
    responsive: true,
    fixedHeader: true,
    language: {
      url: "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Hungarian.json"
    },
    ajax: {
           url: "parts/tableJSON.php",
           dataSrc: ""
       },
       columns: [
           { "data": "author" },
           { "data": "maintext" },
           { "data": "reply" },
           { "data": "article" },
           { "data": "commentdate" }
       ]
  });
});
