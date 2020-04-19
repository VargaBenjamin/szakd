<?php
require 'db.php';

if(isset($_POST['id']))
{
  if (!empty($_POST["username"])) {
    $username = mysqli_real_escape_string($con, $_POST["username"]);
    if ($stmt = $con->prepare('UPDATE accounts SET username = ? WHERE id ="' . $_POST["id"] . '"')) {
      $stmt->bind_param('s', $username);
      $stmt->execute();
    }
  }
  if (!empty($_POST["email"])) {
    $email = mysqli_real_escape_string($con, $_POST["email"]);
    if ($stmt = $con->prepare('UPDATE accounts SET email = ? WHERE id ="' . $_POST["id"] . '"')) {
      $stmt->bind_param('s', $email);
      $stmt->execute();
    }
  }
  if (!empty($_POST["telephone"])) {
    $telephone = mysqli_real_escape_string($con, $_POST["telephone"]);
    if ($stmt = $con->prepare('UPDATE accounts SET telephone = ? WHERE id ="' . $_POST["id"] . '"')) {
      $stmt->bind_param('s', $telephone);
      $stmt->execute();
    }
  }
  if (!empty($_POST["newPass"])) {
    $password = password_hash($_POST["newPass"], PASSWORD_DEFAULT);
    if ($stmt = $con->prepare('UPDATE accounts SET password = ? WHERE id ="' . $_POST["id"] . '"')) {
      $stmt->bind_param('s', $password);
      $stmt->execute();
    }
  }
  if (!empty($_POST["gym"])) {
    $gym = mysqli_real_escape_string($con, $_POST["gym"]);
    if ($stmt = $con->prepare('UPDATE accounts SET gymid = ? WHERE id ="' . $_POST["id"] . '"')) {
      $stmt->bind_param('s', $gym);
      $stmt->execute();
    }
  }
  if (!empty($_POST["coach"])) {
    $coach = mysqli_real_escape_string($con, $_POST["coach"]);
    if ($stmt = $con->prepare('UPDATE accounts SET coachid = ? WHERE id ="' . $_POST["id"] . '"')) {
      $stmt->bind_param('s', $coach);
      $stmt->execute();
    }
  }
}
?>
