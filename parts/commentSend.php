<?php

session_start();
require 'db.php';
//die($_POST['parent']);
if ($stmt = $con->prepare('INSERT INTO comments (author, maintext, reply, article) VALUES (?, ?, ?, ?)')) {
	$stmt->bind_param('ssis', $_SESSION['name'], $_POST['commentText'], $_POST['parent'], $_POST['title']);
  $stmt->execute();
  } else {
  // Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
  echo 'Could not prepare statement!';
  }
	if ($stmt) {
		$stmt->close();
	}
	$con->close();
?>
