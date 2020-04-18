<?php
//tableRead.php
session_start();
require 'db.php';

if(isset($_SESSION['id']))
{
  $data = array();
  $id = mysqli_real_escape_string($con, $_SESSION['id']);
  if ($stmt = $con->prepare('SELECT * FROM workoutdata WHERE clientID = ?'))
  {
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()) {
      $data[] = $row;
    }
  }
  echo json_encode($data);
}
/*
  $id = mysqli_real_escape_string($con, $_SESSION['id']);
  $sql = "SELECT * FROM workoutdata WHERE clientID = " . $id;
  $result = mysqli_query($con, $sql);
  $json_array = array();
  while ($row = mysqli_fetch_assoc($result)) {
    $json_array[] = $row;
  }
  echo json_encode($json_array);
}*/
?>
