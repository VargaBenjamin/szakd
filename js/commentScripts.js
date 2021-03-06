//commentScripts.js
$(document).ready(function() {
  $("#commentForm").submit(function(e) {
    e.preventDefault();
    var commentText = $('#commentText').val();
    var parent = $('#parent').val();
    var title = $('#title').val();
    $.ajax({
      url: "parts/commentCRUD.php",
      method: "POST",
      data: {
        create: "true",
        commentText: commentText,
        parent: parent,
        title: title
      },
      success: function(data) {
        console.log(data);
        $('#alert').html('<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Üzenet elküldve!</strong></div>');
        setTimeout(function() {
          $('.alert').fadeOut('slow');
        }, 1500);
        load_comment();
      },
      error: function(data) {
        console.log(data);
      }
    })
  });

  load_comment();

  function load_comment() {
    var stringUrl = window.location.href;
    var url = new URL(stringUrl);
    var title = url.searchParams.get("title");
    $.ajax({
      url: "parts/commentCRUD.php",
      method: "POST",
      data: {
        read: "true",
        title: title
      },
      success: function(data) {
        $('#display').html(data);
        console.log("Sikeres üzenet betöltés");
      },
      error: function(data) {
        console.log(data);
        console.log("Sikertelen üzenet betöltés");
      }
    })
  }

  $(document).on('click', '.reply', function() {
    var parent = $(this).attr("id");
    $('#parent').val(parent);
    $('.card-header').html("Válasz írása");
  });

});
