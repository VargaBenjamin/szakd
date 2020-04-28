<?php
//calendarLoad.php
session_start();
require 'db.php';

if(isset($_SESSION['id'], $_SESSION['coachid']))
{
  $data = array();
  $id = mysqli_real_escape_string($con, $_SESSION['id']);
  $coachid = mysqli_real_escape_string($con, $_SESSION['coachid']);
  if ($stmt = $con->prepare('SELECT * FROM events WHERE coachid = ? AND clientid = ? ORDER BY id'))
  {
    $stmt->bind_param('ii', $coachid, $id);
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
