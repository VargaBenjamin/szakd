<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'framedb';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    // If there is an error with the connection, stop the script and display the error.
    die('Failed to connect to MySQL: ' . mysqli_connect_error());
};

if(isset($_POST["id"]))
{
 $query = 'DELETE FROM comments WHERE id ="' . $_POST["id"] . '"';
 if(mysqli_query($con, $query))
 {
  echo 'Data Deleted';
 }
}
?>
