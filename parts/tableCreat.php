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

if(isset($_POST["author"], $_POST["maintext"], $_POST["reply"], $_POST["article"]))
{
 $author = mysqli_real_escape_string($con, $_POST["author"]);
 $maintext = mysqli_real_escape_string($con, $_POST["maintext"]);
 $reply = mysqli_real_escape_string($con, $_POST["reply"]);
 $article = mysqli_real_escape_string($con, $_POST["article"]);
 $query = "INSERT INTO comments(author, maintext, reply, article) VALUES('$author', '$maintext', '$reply', '$article')";
 if(mysqli_query($con, $query))
 {
  echo 'Data Inserted';
 }
}
?>
