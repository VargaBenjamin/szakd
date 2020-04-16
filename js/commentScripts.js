//commentScripts.js
$(document).ready(function(){
 $("#commentForm").submit(function(e) {
  e.preventDefault();
  var commentText = $('#commentText').val();
  var parent = $('#parent').val();
  var title = $('#title').val();
  $.ajax({
   url:"parts/commentSend.php",
   method:"POST",
   data: {
     commentText: commentText,
     parent: parent,
     title: title
   },
   success:function(data)
    {
      console.log("Sikeres üzenet küldés");
      $('#alert').html('<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Üzenet elküldve!</strong></div>');
      setTimeout(function() {
          $('.alert').fadeOut('slow');
      }, 1500);
     load_comment();
    },
   error: function (data)
    {
      console.log("Sikertelen üzenet küldés");
    }
  })
 });

 load_comment();

 function load_comment()
 {
   var url = window.location.search;
  $.ajax({
   url:"parts/commentLoad.php"+url,
   method:"POST",
   success:function(data)
   {
    $('#display').html(data);
    console.log("Sikeres üzenet betöltés");
  },
  error: function (data)
   {
   console.log(data);
   console.log("Sikertelen üzenet betöltés");
   }
  })
 }

 $(document).on('click', '.reply', function(){
  var parent = $(this).attr("id");
  $('#parent').val(parent);
  $('.card-header').html("Válasz írása");
 });

});
