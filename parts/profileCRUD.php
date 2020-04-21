<?php
//getGym.php
require 'db.php';

if (isset($_POST['gym'])) {
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
}

if (isset($_POST['coach'])) {
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
}
?>
