<?php
//calendarLoad.php
session_start();
require 'db.php';

if(isset($_SESSION['coachid']))
{
  $data = array();
  $coachid = mysqli_real_escape_string($con, $_SESSION['coachid']);
  if ($stmt = $con->prepare('SELECT * FROM events WHERE coachid = ? ORDER BY id'))
  {
    $stmt->bind_param('i', $coachid);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()) {
      $data[] = array(
        'id'   => $row["id"],
        'title'   => $row["title"],
        'start'   => $row["start_event"],
        'end'   => $row["end_event"],
        'color'   => $row["color"]
      );
    }
    $stmt->close();
  }
  echo json_encode($data);
}
$con->close();
?>
