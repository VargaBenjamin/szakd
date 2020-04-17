<?php
require 'db.php';

if(isset($_POST['id']))
{
  if ($_POST["username"] != "") {
    $username = mysqli_real_escape_string($con, $_POST["username"]);
    if ($stmt = $con->prepare('UPDATE accounts SET username = ? WHERE id ="' . $_POST["id"] . '"')) {
      $stmt->bind_param('s', $username);
      $stmt->execute();
    }
  }
  if ($_POST["email"] != "") {
    $email = mysqli_real_escape_string($con, $_POST["email"]);
    if ($stmt = $con->prepare('UPDATE accounts SET email = ? WHERE id ="' . $_POST["id"] . '"')) {
      $stmt->bind_param('s', $email);
      $stmt->execute();
    }
  }
  if ($_POST["telephone"] != "") {
    $telephone = mysqli_real_escape_string($con, $_POST["telephone"]);
    if ($stmt = $con->prepare('UPDATE accounts SET telephone = ? WHERE id ="' . $_POST["id"] . '"')) {
      $stmt->bind_param('s', $telephone);
      $stmt->execute();
    }
  }
  if ($_POST["newPass"] != "") {
    $password = password_hash($_POST["newPass"], PASSWORD_DEFAULT);
    if ($stmt = $con->prepare('UPDATE accounts SET password = ? WHERE id ="' . $_POST["id"] . '"')) {
      $stmt->bind_param('s', $password);
      $stmt->execute();
    }
  }
}
if ($stmt) {
  $stmt->close();
}
$con->close();
?>
