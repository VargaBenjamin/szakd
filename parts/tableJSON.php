<?php
$con = mysqli_connect("localhost", "root", "", "framedb");
$sql = "SELECT * FROM comments ORDER BY commentdate DESC";

$result = mysqli_query($con, $sql);

$json_array = array();

while ($row = mysqli_fetch_assoc($result)) {
  $json_array[] = $row;
}

echo json_encode($json_array);
?>
