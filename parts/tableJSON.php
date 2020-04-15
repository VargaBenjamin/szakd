<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "framedb");
$sql = "SELECT * FROM workoutdata WHERE clientID = " . $_SESSION['id'];

$result = mysqli_query($con, $sql);

$json_array = array();

while ($row = mysqli_fetch_assoc($result)) {
  $json_array[] = $row;
}

echo json_encode($json_array);
?>
