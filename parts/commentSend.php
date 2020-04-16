<?php

session_start();
require 'db.php';

  $commentText = mysqli_real_escape_string($con, $_POST["commentText"]);
	$parent = (int)mysqli_real_escape_string($con, $_POST["parent"]);
	$title = mysqli_real_escape_string($con, $_POST["title"]);
if ($stmt = $con->prepare('INSERT INTO comments (authorid, commenttext, reply, articleid) VALUES (?, ?, ?, (SELECT id FROM articles WHERE title = ?))')) {
	$stmt->bind_param('ssis', $_SESSION['id'], $commentText, $parent, $title);
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
