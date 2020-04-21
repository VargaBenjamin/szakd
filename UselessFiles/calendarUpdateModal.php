<?php
//calendarUpdate.php
require 'db.php';

if(isset($_POST["eventid"], $_POST["title"], $_POST["color"]))
{
  $eventid = mysqli_real_escape_string($con, $_POST["eventid"]);
  $title = mysqli_real_escape_string($con, $_POST["title"]);
  $color = mysqli_real_escape_string($con, $_POST["color"]);
  if ($stmt = $con->prepare('UPDATE events SET title = ?, color = ? WHERE id = ?'))
  {
    $stmt->bind_param('ssi', $title, $color, $eventid);
    $stmt->execute();
    $stmt->close();
  }
}
$con->close();

/*
$connect = new PDO('mysql:host=localhost;dbname=framedb', 'root', '');

if(isset($_POST["id"]))
{
 $query = "
 UPDATE events
 SET title=:title, start_event=:start_event, end_event=:end_event, color=:color
 WHERE id=:id
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':title'  => $_POST['title'],
   ':start_event' => $_POST['start'],
   ':end_event' => $_POST['end'],
   ':id'   => $_POST['id'],
   ':color'   => $_POST['color']
  )
 );
}
*/
?>
