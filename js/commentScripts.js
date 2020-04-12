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
     console.log('Submission was successful.');
     console.log(data);
    },
   error: function (data)
    {
    console.log('An error occurred.');
    console.log(data);
    }
  })
 });

 load_comment();

 function load_comment()
 {
  $.ajax({
   url:"parts/commentLoad.php?title=szíes",
   method:"GET",
   success:function(data)
   {
    $('#display').html(data);
  },
  error: function (data)
   {
   console.log('An error occurred.');
   console.log(data);
   }
  })
 }

 $(document).on('click', '.reply', function(){
  var parent = $(this).attr("id");
  $('#parent').val(parent);
  $('#comment_name').focus();
 });

});
