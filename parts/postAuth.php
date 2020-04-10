<?php

session_start();
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'framedb';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    // If there is an error with the connection, stop the script and display the error.
    die('Failed to connect to MySQL: ' . mysqli_connect_error());
}
if ($stmt = $con->prepare('INSERT INTO articles (author, title, preview, maintext) VALUES (?, ?, ?, ?)')) {
	$stmt->bind_param('ssss', $_SESSION['name'], $_POST['title'], $_POST['preview'], $_POST['maintext'] );
  $stmt->execute();
  //header("Location: ../blog.php");
  } else {
  // Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
  echo 'Could not prepare statement!';
  }
$stmt->close();
$con->close();
?>
