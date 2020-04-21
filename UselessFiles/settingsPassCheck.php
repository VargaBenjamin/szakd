<?php
require 'db.php';
if(isset($_POST['id']))
{
  $passHass = '';
  if ($stmt = $con->prepare('SELECT password FROM accounts WHERE id ="' . $_POST['id'] . '"')) {
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $passHass = $user['password'];
    if (password_verify($_POST['pass'], $passHass)) {
      echo "true";
    } else {
      echo "false";
    }
  }
}
if ($stmt) {
  $stmt->close();
}
$con->close();
?>
