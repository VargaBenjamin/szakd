<?php
require 'db.php'; 

if(isset($_POST["id"]))
{
 $query = 'DELETE FROM workoutdata WHERE id ="' . $_POST["id"] . '"';
 if(mysqli_query($con, $query))
 {
  echo 'Data Deleted';
 }
}
?>
