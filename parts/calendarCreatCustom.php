<?php
//calendarCreatCustom.php
require 'db.php';

if(isset($_POST["title"], $_POST["duration"], $_POST["color"], $_POST["coachid"]))
{
  echo $_POST["title"];
  $title = mysqli_real_escape_string($con, $_POST["title"]);
  $duration = mysqli_real_escape_string($con, $_POST["duration"]);
  $color = mysqli_real_escape_string($con, $_POST["color"]);
  $coachid = mysqli_real_escape_string($con, $_POST["coachid"]);
  if ($stmt = $con->prepare('INSERT INTO customevents(title, duration, color, coachid) VALUES (?, ?, ?, ?)'))
  {
    $stmt->bind_param('sssi', $title, $duration, $color, $coachid);
    $stmt->execute();
    $stmt->close();
  }
}
$con->close();
?>
