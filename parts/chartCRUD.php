<?php
//chartCRUD.php
require "db.php";

if (isset($_POST['getChart'])) {
  if (isset($_POST['userid'])) {
    if ($stmt = $con->prepare('SELECT * FROM charts WHERE userid = ?'))
    {
      $stmt->bind_param('i', $_POST['userid']);
      $stmt->execute();
      $result = $stmt->get_result();
      if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stmt->close();
        echo json_encode($row);
      }
    }
  }
}

if (isset($_POST['setChart'])) {
  if (isset($_POST['userid'],$_POST['day'],$_POST['selected'])) {
    $userid = mysqli_real_escape_string($con, $_POST["userid"]);
    $day = mysqli_real_escape_string($con, $_POST["day"]);
    $selected = mysqli_real_escape_string($con, $_POST["selected"]);
    if ($stmt = $con->prepare('UPDATE charts SET selected = ?, day = ? WHERE userid = ?')) {
      $stmt->bind_param('sii', $selected, $day, $userid);
      $stmt->execute();
      $stmt->close();
    }
  }
}


$con->close();

?>
