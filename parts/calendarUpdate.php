<?php
//calendarUpdate.php
require 'db.php';

if(isset($_POST["id"], $_POST["title"], $_POST["start"], $_POST["end"], $_POST["color"]))
{
  $id = mysqli_real_escape_string($con, $_POST["id"]);
  $title = mysqli_real_escape_string($con, $_POST["title"]);
  $start = mysqli_real_escape_string($con, $_POST["start"]);
  $end = mysqli_real_escape_string($con, $_POST["end"]);
  $color = mysqli_real_escape_string($con, $_POST["color"]);
  if ($stmt = $con->prepare('UPDATE events SET title = ?, start_event = ?, end_event = ?, color = ? WHERE id = ?'))
  {
    $stmt->bind_param('ssssi', $title, $start, $end, $color, $id);
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
