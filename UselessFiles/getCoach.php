<?php
//getCoach.php
require 'db.php';

if (isset($_POST['coachid'])) {
  $output = "Nincs beállítva";
  if ($stmt = $con->prepare('SELECT * FROM accounts WHERE id ="' . $_POST['coachid'] . '"'))
  {
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
      $output = $row['username'];
    }
  }
  echo $output;
}
?>
