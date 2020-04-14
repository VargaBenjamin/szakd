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

if(isset($_POST["author"], $_POST["maintext"], $_POST["reply"], $_POST["article"], $_POST["id"]))
{
  $author = mysqli_real_escape_string($con, $_POST["author"]);
  $maintext = mysqli_real_escape_string($con, $_POST["maintext"]);
  $reply = mysqli_real_escape_string($con, $_POST["reply"]);
  $article = mysqli_real_escape_string($con, $_POST["article"]);
 $query = "UPDATE comments SET author = '".$_POST["author"]."', maintext = '".$_POST["maintext"]."', reply = '".$_POST["reply"]."', article = '".$_POST["article"]."' WHERE id = '".$_POST["id"]."'";
 if(mysqli_query($con, $query))
 {
  echo 'Data Updated';
 }
}
?>
