<?php

session_start();
require 'db.php';
if ($stmt = $con->prepare('INSERT INTO articles (author, title, preview, maintext) VALUES (?, ?, ?, ?)')) {
	$stmt->bind_param('ssss', $_SESSION['name'], $_POST['title'], $_POST['preview'], $_POST['maintext'] );
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
