$(document).ready(function(){

 $('#commentForm').on('submit', function(event){
  event.preventDefault();
  var form_data = $(this).serialize();
  $.ajax({
   url:"parts/commentSend.php",
   method:"POST",
   data:form_data,
   dataType:"JSON",
   success:function(data)
    {
     load_comment();
    },
   error: function (data)
    {
    load_comment();
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
