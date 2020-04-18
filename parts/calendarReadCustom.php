<?php
//calendarReadCustom.php
require 'db.php';

if(isset($_SESSION['id'], $_SESSION['coachid']))
{
  $myid = mysqli_real_escape_string($con, $_SESSION['id']);
  $coachid = mysqli_real_escape_string($con, $_SESSION['coachid']);
  if ($stmt = $con->prepare('SELECT * FROM customevents WHERE coachid = ? ORDER BY id'))
  {
    $stmt->bind_param('i', $coachid);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()) {
      echo "<div class='card-body fc-event' style='border-color: ".$row["color"]."; background-color: ".$row["color"].";' data-event='{".$row["id"]."ß".$row["duration"]."ß".$row["color"]."ß".$row["coachid"]."ß" . $myid . "}'>".$row["title"]."</div>";
    }
    $stmt->close();
  }
}
$con->close();
?>
