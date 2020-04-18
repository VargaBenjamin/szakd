<?php
//calendarCreat.php
require 'db.php';
echo $_POST["coachid"];
if(isset($_POST["title"], $_POST["start"], $_POST["end"], $_POST["color"], $_POST["coachid"], $_POST["clientid"], $_POST["customeventid"]))
{
  $title = mysqli_real_escape_string($con, $_POST["title"]);
  $start = mysqli_real_escape_string($con, $_POST["start"]);
  $end = mysqli_real_escape_string($con, $_POST["end"]);
  $color = mysqli_real_escape_string($con, $_POST["color"]);
  $coachid = mysqli_real_escape_string($con, $_POST["coachid"]);
  $clientid = mysqli_real_escape_string($con, $_POST["clientid"]);
  $customeventid = mysqli_real_escape_string($con, $_POST["customeventid"]);
  if ($stmt = $con->prepare('INSERT INTO events (title, start_event, end_event, color, coachid, clientid, customeventid) VALUES (?, ?, ?, ?, ?, ?, ?)'))
  {
    $stmt->bind_param('ssssiii', $title, $start, $end, $color, $coachid, $clientid, $customeventid);
    $stmt->execute();
  }
}
?>
