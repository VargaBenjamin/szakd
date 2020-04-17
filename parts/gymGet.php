<?php
//gymGet.php
require 'db.php';

if (isset($_POST['gymid'])) {
  $output = "Nincs beállítva";
  if ($stmt = $con->prepare('SELECT * FROM gym WHERE id ="' . $_POST['gymid'] . '"'))
  {
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
      $output = $row['name'];
    }
  }
  echo $output;
}
?>
