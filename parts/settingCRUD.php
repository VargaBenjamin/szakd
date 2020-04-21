<?php
//coachLoad.php
require 'db.php';

if (isset($_POST['gym'])) {
  if (isset($_POST['gymid'])) {
    $output = '<option value="">Válassz!</option>';
    if ($stmt = $con->prepare('SELECT * FROM accounts WHERE coach = 1 AND gymid = "' . $_POST['gymid'] . '"'))
    {
      $stmt->execute();
      $result = $stmt->get_result();
      while ($row = $result->fetch_assoc()) {
        $output.= '<option value="' . $row['id'] . '">' . $row['username'] . '</option>';
      }
    }
    echo $output;
  }
}

if (isset($_POST['check'])) {
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
}

if (isset($_POST['update'])) {
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
}
$con->close();
?>
