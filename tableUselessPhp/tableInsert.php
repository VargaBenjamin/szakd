<?php
require 'db.php';
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
