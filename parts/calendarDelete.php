<?php
//calendarDelete.php
require 'db.php';

if(isset($_POST["id"]))
{
  $id = mysqli_real_escape_string($con, $_POST["id"]);
  if ($stmt = $con->prepare('DELETE FROM events WHERE id = ?'))
  {
    $stmt->bind_param('i', $id);
    $stmt->execute();
  }
}
/*
if(isset($_POST["id"]))
{
 $connect = new PDO('mysql:host=localhost;dbname=framedb', 'root', '');
 $query = "
 DELETE from events WHERE id=:id
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':id' => $_POST['id']
  )
 );
}
*/
?>
