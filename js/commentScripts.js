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
  },
  error: function (data)
   {
   console.log(data);
   }
  })
 }

 $(document).on('click', '.reply', function(){
  var parent = $(this).attr("id");
  $('#parent').val(parent);
 });

});
