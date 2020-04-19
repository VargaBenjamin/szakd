<?php

session_start();
require 'db.php';

$id = mysqli_real_escape_string($con, $_SESSION["id"]);
$title = mysqli_real_escape_string($con, $_POST["title"]);
$preview = mysqli_real_escape_string($con, $_POST["preview"]);
$maintext = mysqli_real_escape_string($con, $_POST["maintext"]);
$picture = mysqli_real_escape_string($con, $_POST["picture"]);
if ($stmt = $con->prepare('INSERT INTO articles (authorid, title, preview, maintext, picture) VALUES (?, ?, ?, ?, ?)')) {
	$stmt->bind_param('sssss', $id, $title, $preview, $maintext, $picture );
  $stmt->execute();
  header("Location: ../blog.php");
  } else {
  // Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
  echo 'Could not prepare statement!';
  }
	if ($stmt) {
		$stmt->close();
	}
	$con->close();
?>
